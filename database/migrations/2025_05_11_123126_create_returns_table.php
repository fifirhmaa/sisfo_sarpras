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
        Schema::create('returns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('borrow_id')->constrained()->onDelete('cascade');
            $table->date('return_date')->nullable();
            $table->enum('condition', ['good', 'bad', 'lost'])->default('good');
            $table->text('note')->nullable();
            $table->enum('status', ['finish', 'finish(bad)', 'finish(lost)'])->default('finish');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('returns');
    }
};