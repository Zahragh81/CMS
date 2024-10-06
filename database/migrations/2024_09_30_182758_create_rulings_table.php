<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        //احکام
        Schema::create('rulings', function (Blueprint $table) {
            $table->id();
            $table->string('judgment_number')->comment('شماره حکم');
            $table->date('judgment_date')->comment('تاریخ حکم');
            $table->text('judgment_text')->comment('متن حکم');
            $table->boolean('status')->default(true);

            $table->foreignId('document_id')->comment('کد پرونده')->constrained();
            $table->foreignId('ruling_status_id')->comment('وضعیت حکم')->constrained();

            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('rulings');
    }
};
