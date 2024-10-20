<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // اقدامات تیکت
        Schema::create('ticket_actions', function (Blueprint $table) {
            $table->id();
            $table->text('referral_order')->comment('دستور ارجاع');
            $table->text('description_action')->comment('توضیحات اقدام')->nullable();
            $table->tinyInteger('progress_percentage')->default(0)->comment('درصد پیشرفت کار');
            $table->boolean('status')->default(true);

            $table->foreignId('referral_type_id')->comment('نوع ارجاع')->constrained();
            $table->foreignId('referrer_id')->comment('کدارجاع دهنده')->constrained('users');
            $table->foreignId('organization_id')->comment('دپارتمان ارجاع گیرنده')->constrained();
            $table->foreignId('referral_recipient_id')->comment('کارشناس ارجاع گیرنده')->constrained('users');
            $table->foreignId('action_status_id')->comment('کد وضعیت اقدام')->constrained('ticket_statuses');
            $table->foreignId('ticket_id')->comment('کد تیکت')->constrained();

            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('ticket_actions');
    }
};
