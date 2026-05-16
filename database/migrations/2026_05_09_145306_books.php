<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use function Laravel\Prompts\table;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('books', function(Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('publisher_id')->nullable();
            $table->unsignedBigInteger('author_id')->nullable();
            $table->foreign('publisher_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('author_id')->references('id')->on('users')->onDelete('set null');
            $table->string('title');
            $table->text('content');
            $table->text('summary_ai')->nullable();
            $table->string('coverUrl')->nullable();
            $table->enum('status', ['draft', 'published', 'curated','printed'])->default('draft');
            $table->decimal('price', 10, 2)->default(0.00);
            $table->integer('stock')->unsigned()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
