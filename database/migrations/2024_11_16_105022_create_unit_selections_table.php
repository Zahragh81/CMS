<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // انتخاب واحد
        Schema::create('unit_selections', function (Blueprint $table) {
            $table->id();
            $table->string('score')->comment('نمره');
            $table->boolean('status')->default(true);

            $table->foreignId('lesson_offered_id')->comment('کد درس ارائه شده')->constrained('lessons_offered');
            $table->foreignId('student_id')->comment('کد دانشجو')->constrained('users');
            $table->foreignId('unit_selection_status_id')->comment('کد وضعیت')->constrained('unit_selection_statuses');

            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('unit_selections');
    }
};
