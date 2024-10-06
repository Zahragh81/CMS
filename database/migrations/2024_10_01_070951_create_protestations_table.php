<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        //اعتراضات
        Schema::create('protestations', function (Blueprint $table) {
            $table->id();
            $table->string('protestation_number')->comment('شماره اعتراض');
            $table->date('protestation_date')->comment('تاریخ اعتراض');
            $table->text('protestation_text')->comment('متن اعتراض');
            $table->boolean('status')->default(true)->comment('وضعیت');

            $table->foreignId('document_id')->comment('کد پرونده')->constrained();
            $table->foreignId('protestation_status_id')->comment('وضعیت اعتراض')->constrained();

            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('protestations');
    }
};
