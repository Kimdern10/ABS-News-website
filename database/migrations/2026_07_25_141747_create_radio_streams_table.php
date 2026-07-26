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
     Schema::create('radio_streams', function (Blueprint $table) {
    $table->id();

    $table->string('title');
    $table->string('stream_url');

    $table->boolean('is_live')->default(true);
    $table->boolean('status')->default(true);

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('radio_streams');
    }
};
