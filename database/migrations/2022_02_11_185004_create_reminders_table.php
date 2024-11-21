<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRemindersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reminders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->json('email')->nullable();
            $table->json('phone')->nullable();
            $table->string('subject');
            $table->longText('body');
            $table->string('cron')->nullable(); // if cron interval format is not selected, this would be null
            $table->timestamp('start_date');
            $table->timestamp('end_date')->nullable();
            $table->enum('interval', ['DAILY', 'WEEKLY', 'MONTHLY', 'QUARTERLY', 'HALF-YEARLY', 'YEARLY'])->default('DAILY');
            $table->integer('frequency')->nullable(); // if cron interval format is selected, this would be null
            $table->integer('total_sent')->default(0);
            $table->boolean('is_done')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reminders');
    }
}
