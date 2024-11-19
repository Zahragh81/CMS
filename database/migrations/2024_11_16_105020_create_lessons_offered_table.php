<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        //دروس ارائه شده
        Schema::create('lessons_offered', function (Blueprint $table) {
            $table->id();
            $table->boolean('status')->default(true);

            $table->foreignId('lesson_id')->comment('کد درس')->constrained();
            $table->foreignId('semester_id')->comment('کد ترم')->constrained();
            $table->foreignId('master_id')->comment('کد استاد')->constrained();

            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('lessons_offered');
    }
};
