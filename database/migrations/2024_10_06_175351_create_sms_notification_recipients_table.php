<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        //اطلاع رسانی پیامکی گیرندگان
        Schema::create('sms_notification_recipients', function (Blueprint $table) {
            $table->id();
            $table->boolean('status')->default(true);

            $table->foreignId('user_id')->constrained();

            $table->softDeletes();
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('sms_notification_recipients');
    }
};
