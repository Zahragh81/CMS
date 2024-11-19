<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // پاسخ ها
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('عنوان پاسخ');
            $table->tinyInteger('value')->comment('ارزش')->default(1);
            $table->boolean('status')->default(true);

            $table->foreignId('form_id')->comment('کد فرم')->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};