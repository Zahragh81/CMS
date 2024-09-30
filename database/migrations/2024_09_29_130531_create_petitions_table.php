<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        //دادخواست ها
        Schema::create('petitions', function (Blueprint $table) {
            $table->id();
            $table->string('petition_number')->unique()->comment('شماره دادخواست');
            $table->date('petition_date')->comment('تاریخ دادخواست');
            $table->text('petition_text')->comment('متن دادخواست');
            $table->boolean('status')->default(true);

            $table->foreignId('document_id')->comment('کد پرونده')->constrained();

            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('petitions');
    }
};
