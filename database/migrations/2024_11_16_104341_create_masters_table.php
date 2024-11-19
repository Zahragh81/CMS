<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // اساتید
        Schema::create('masters', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->comment('اسم');
            $table->string('last_name')->comment('فامیل');
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('masters');
    }
};
