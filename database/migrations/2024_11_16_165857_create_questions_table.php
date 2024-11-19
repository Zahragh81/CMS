<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // سوالات
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('عنوان سوال');
            $table->tinyInteger('weight')->default(1)->comment('ضریب وزنی');
            $table->boolean('status')->default(true);

            $table->foreignId('form_id')->comment('کد فرم')->constrained();

            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
