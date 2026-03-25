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
        Schema::create('report_replies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_laporan');
            $table->foreign('id_laporan')->references('id')->on('laporan');

            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users');

            // buat reply ke reply (nested)
            $table->foreignId('parent_id')->nullable()->constrained('report_replies')->cascadeOnDelete();

            $table->text('message');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_replies');
    }
};
