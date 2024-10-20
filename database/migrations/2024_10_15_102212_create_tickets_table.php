<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        //تیکت ها
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('عنوان');

            $table->text('description')->comment('توضیحات');
            $table->boolean('status')->default(true);

            $table->foreignId('user_id')->comment('کاربر ایجاد کننده')->constrained();
            $table->foreignId('ticket_group_id')->comment('گروه تیکت')->constrained();
            $table->foreignId('ticket_priority_id')->comment('اولویت')->constrained();
            $table->foreignId('ticket_status_id')->comment('وضعیت تیک ها')->constrained();

            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
