<?php
use App\Models\Reminder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('reminders', function (Blueprint $table) {
            $table->string('phone')->change();
        });

        Reminder::each(function ($reminder){
            $reminder->email = $reminder->email['email'];
            $reminder->phone = $reminder->phone['phone'];

            $reminder->save();
        });

        Schema::table('reminders', function (Blueprint $table) {
            $table->json(   'email')->change();
            $table->json('phone')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reminders', function (Blueprint $table) {
            $table->string('email')->change();
            $table->string('phone')->change();
        });
    }
};
