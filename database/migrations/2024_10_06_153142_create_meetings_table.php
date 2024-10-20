<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        //جلسات
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('عنوان جلسه');
            $table->dateTime('start_time')->comment('زمان شروع');
            $table->dateTime('end_time')->nullable()->comment('زمان پایان');
            $table->string('location')->comment('مکان');
            $table->text('description')->comment('توضیحات');
            $table->boolean('notification')->default(true)->comment('اطلاع رسانی');
            $table->boolean('status')->default(true);

            $table->foreignId('document_id')->comment('کد پرونده')->constrained();
            $table->foreignId('meeting_status_id')->comment('وضعیت جلسه')->default(1)->constrained();
            $table->foreignId('holding_type_id')->comment('نوع برگذاری')->constrained();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('meetings');
    }
};
