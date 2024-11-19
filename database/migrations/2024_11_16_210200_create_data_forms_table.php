<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        //جدول فرم-دیتا
        Schema::create('data_forms', function (Blueprint $table) {
            $table->id();

            $table->boolean('status')->default(true);

            $table->foreignId('form_id')->comment('کد فرم')->constrained();
            $table->foreignId('question_id')->comment('کد سوال')->constrained();
            $table->foreignId('unit_selection_id')->comment('کد انتخاب واحد دانشجو')->constrained();
            $table->foreignId('answer_id')->nullable()->comment('کد پاسخ')->constrained();

            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('data_forms');
    }
};
