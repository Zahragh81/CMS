<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        //پرونده ها
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('file_number')->unique()->comment('شماره پرونده');
            $table->foreignId('document_type_id')->comment('کدنوع')->constrained();
            $table->foreignId('lawyer_id')->comment('کدوکیل')->constrained();
            $table->foreignId('user_id')->comment('کد مشتکی عن ')->constrained();
            $table->foreignId('court_branch_id')->comment('کد شعبه دادگاه')->constrained();
            $table->string('court_class_number')->unique()->comment('شماره کلاسه دادگاه');
            $table->string('court_filing_number')->unique()->comment('شماره بایگانی دادگاه');
            $table->foreignId('document_status_id')->comment('کدوضعیت')->constrained();
            $table->text('description')->comment('توضیحات');
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
