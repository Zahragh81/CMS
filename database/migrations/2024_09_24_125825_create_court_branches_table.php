<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // شعبه های دادگاه
        Schema::create('court_branches', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('نام');
            $table->foreignId('city_id')->constrained('cities');
            $table->string('branch_code')->unique();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->foreignId('branch_type_id')->constrained();
            $table->boolean('status')->default(true)->comment('وضعییت');
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('court_branches');
    }
};
