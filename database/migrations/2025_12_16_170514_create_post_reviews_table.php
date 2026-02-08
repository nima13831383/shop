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
        Schema::create('post_reviews', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->nullable()
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('post_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('parent_id')->nullable()->constrained('post_reviews')->cascadeOnDelete();
            $table->enum('status', ['approved', 'unapproved', 'pending'])->default('unapproved');
            $table->string('name');
            $table->string('email');
            $table->text('comment')->nullable();
            $table->softDeletes();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_reviews');
    }
};
