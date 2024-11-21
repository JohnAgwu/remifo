<?php

namespace App\Models;

use App\Notifications\ReminderNotification;
use App\Repository\BulkSmsNigeria;
use App\Repository\Infobip;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use mysql_xdevapi\Exception;

class Reminder extends Model
{
    use HasFactory, Notifiable;

    const STATUSES = ['pending', 'PENDING', 'COMPLETED', 'completed', 'COMPLETE', 'complete'];

    protected $guarded = ['id'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_done'   => 'bool',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'email' => 'array',
        'phone' => 'array'
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function (Reminder $reminder) {
            if ($reminder->start_date->isCurrentHour() && $reminder->start_date->isCurrentMinute())
                $reminder->send();
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function subject(): Attribute
    {
        return Attribute::get( fn ($value) => ucwords($value));
    }

    public function name(): Attribute
    {
        return Attribute::get( fn ($value) => ucwords($value));
    }

    public function scopeNotDone(Builder $builder)
    {
        $builder->where('is_done', false);
    }

    public function scopeIsCron(Builder $builder)
    {
        $builder->whereNotNull('cron');
    }

    public function scopeIsFrequency(Builder $builder)
    {
        $builder->whereNotNull('frequency')->whereNotIn('interval', ['QUARTERLY']);
    }

    public function scopeViewable(Builder $builder)
    {
        $builder->latest()->unless(isAdmin(),
            fn($query) => $query->whereBelongsTo(auth()->user()))->when(request()->has('status'), function ($query) {
            $is_done = in_array(request('status'), ['completed', 'COMPLETED']);
            return $query->whereIsDone($is_done);
        });
    }

    /**
     * Send reminder notification
     *
     * @return void
     */
    public function send(): void
    {
        if ($this->email != null){
          try {
              $emails = str_replace('"', '', $this->email); // Remove all double quotes

              $msg = '';

              // Split the comma-separated string into an array
              $emails = explode(', ', $emails);

              foreach ($emails as $email) {
                  if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

                      Notification::route('mail', $email)->notify(new ReminderNotification($this));



                  } else {
                      $msg = 'Invalid email address: ';
                      // Log an error or handle the invalid email address accordingly
                      Log::error($msg . $email);
                  }
              }

              if ($msg == ''){
                  $this->total_sent ++;
              }

          }catch (\Exception $e){
              // Log any exceptions that occur during the process
              Log::error('Exception: ' . $e->getMessage());
          }

        } else {
            try {
                $phone = trim($this->phone, '"');
                $phone = str_replace('"', '', $phone); // Remove all double quotes

                $response = (new BulkSmsNigeria)->sendSMS( $this, $phone);

                $res = json_decode($response, true);

                if (isset($res['data']) && $res['data']['status'] == 'success'){

                    $this->total_sent ++;

                    Log::info('Success:::' . json_encode($res['data']));
                } else{

                    if (isset($res['error']['message'])){

                        Log::error('Error:::'. $res['error']['message']);
                    } else{
                        Log::error('Unknown Error Occurred!');
                    }

                }
            } catch (\Exception $e) {
                // Log any exceptions that occur during the process
                Log::error('Exception: ' . $e->getMessage());
            }

        }

        if ($this->frequency <= $this->total_sent) {
            $this->is_done = true;
            $this->save();
        }

        $this->saveQuietly();
    }
}
