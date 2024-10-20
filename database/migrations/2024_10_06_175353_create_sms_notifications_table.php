<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        //اطلاع رسانی پیامکی
        Schema::create('sms_notifications', function (Blueprint $table) {
            $table->id();
            $table->text('text')->comment('متن');
            $table->morphs('model');
            $table->dateTime('send_time')->comment('زمان ارسال');
            $table->boolean('status')->default(true);

            $table->foreignId('sms_notification_recipient_id')->comment('اطلاع رسانی پیامکی گیرندگان')->constrained();

            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('sms_notification');
    }
};
