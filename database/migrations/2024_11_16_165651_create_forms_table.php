<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        //فرم ها
        Schema::create('forms', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->boolean('status')->default(true);

            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('forms');
    }
};
