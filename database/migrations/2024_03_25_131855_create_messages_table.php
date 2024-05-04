<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments("id");
            $table->longText('msg');
            $table->UnsignedInteger("sender_id");
            $table->UnsignedInteger("receiver_id");
            $table->foreign('sender_id')->references('id')->on('users')->restrictOnDelete();
            $table->foreign('receiver_id')->references('id')->on('users')->restrictOnDelete();
            $table->timestamp('sent_at', precision: 0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
