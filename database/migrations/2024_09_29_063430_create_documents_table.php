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
            $table->string('court_filing_number')->unique()->comment('شماره بایگانی دادگاه');
            $table->string('court_class_number')->unique()->comment('شماره کلاسه دادگاه');
            $table->text('description')->comment('توضیحات');
            $table->boolean('status')->default(true);

            $table->foreignId('document_status_id')->comment('کد وضعیت پرونده')->default(1)->constrained();
            $table->foreignId('document_type_id')->comment('کد نوع پرونده')->constrained();

            $table->foreignId('lawyer_id')->comment('کدوکیل')->constrained();
            $table->foreignId('plaintiff_id')->comment('کد مشتکی عن')->constrained('users');
            $table->foreignId('user_id')->comment('کد کارمند')->constrained();
            $table->foreignId('court_branch_id')->comment('کد شعبه دادگاه')->constrained();

            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
