<?php

namespace App\Http\Requests;

use App\Helpers\ReminderHelper;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Illuminate\Validation\Rule;
use Illuminate\Http\RedirectResponse;

class ReminderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {

        return [
            'name' => 'required|string',
            'email' => 'nullable|string|max:255',
            'phone' => 'nullable|max:255',
            'subject' => 'required|string',
            'body' => 'required',
            'interval' => 'in:DAILY,WEEKLY,MONTHLY,QUARTERLY,HALF-YEARLY,YEARLY',
            'cron' => Rule::when($this->interval_format == 'cron', 'required|string'),
            'cron_start_date' => 'nullable|regex:/^\d{2}\/\d{2}\/\d{4}$/',
            'frequency' => Rule::when($this->interval_format != 'cron', 'required|int'),
            'basic_start_date' => 'nullable|regex:/^\d{4}\-\d{2}\-\d{2}[T]\d{2}\:\d{2}$/'
        ];
    }

    protected function passedValidation()
    {
        $this->merge(ReminderHelper::setDate(
            $this->get('basic_start_date'),
            $this->get('interval'),
            $this->get('frequency')
        ));
    }

    public function fulfil(): array
    {
        $validationErrors = $this->has('email') ?
            $this->validateOption($this->get('email'), 'email') :
            $this->validateOption($this->get('phone'), 'phone');

        if ($validationErrors !== null ) {
            return $validationErrors->toArray();
        }

        $data = $this->only(['name', 'body', 'subject', 'start_date', 'end_date']);

        if ($this->get('interval_format') == 'cron') {
            $data['cron'] = $this->cron;
        } else {
            $data['frequency'] = $this->frequency;
            $data['interval'] = $this->interval;
            $data['cron'] = $this->interval == 'QUARTERLY' ?
            $this->quarterly($data['start_date'], $this->frequency) : null;
        }

        $email = $this->get('email');
        $phone = $this->get('phone');

        if(str_ends_with($email, ',')) {
           $email = substr($email, 0 , -1);
        }

        if(str_ends_with($phone, ',')) {
           $phone = substr($phone, 0 , -1);
        }

        $this->has('email') ?
            $data['email'] = $email :
            $data['phone'] = $phone;

        return $data;
    }

    public function validateOption(): ?array
    {
        if ($this->has('email')) {
            $data = $this->get('email');

            $option ='email';

        } else {
            $data = $this->get('phone');

            $option = 'phone';
        }

        if (str_ends_with($data, ',')) {
            $data = substr($data, 0 , -1);
        }

        $inputs = explode(',', $data);

        $rule = [
            'email' => 'required|email|max:255',
            'phone' => ['required', 'regex:/^(?:\+234|0)\d{10}$/']
        ];

        $validationData = [];
        $validationErrors = new MessageBag();

        foreach ($inputs as $input) {
            $validationData[$option] = trim($input);

            $validation = Validator::make($validationData, [
                $option => $rule[$option]
            ]);

            if ($validation->fails()) {
                $validationErrors->merge($validation->errors());
            }
        }

        return $validationErrors->count() > 0 ? $validationErrors->toArray() : null;

    }

    /**
     * Format a quarterly reminder into a cron string
     *
     * @param Carbon $date
     * @param int $frequency
     * @return string
     */
    private function quarterly(Carbon $date, int $frequency): string
    {
        $minute = $date->minute;
        $hour = $date->hour;
        $day = $date->format('N');
        $start_month = $date->month;

        $add_month = [1 => 3, 2 => 6, 3 => 9];
        $end_month = $start_month + $add_month[$frequency];
        $end_month = ($end_month > 12) ? 12 : $end_month;

        return "$minute $hour * $start_month-$end_month/3 $day";
    }


}
