<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->longText('description')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('video_preview')->nullable();
            $table->enum('status', ['active', 'pending', 'draft'])->default('active');
            $table->string('price_original')->nullable();
            $table->string('price_sale')->nullable();
            $table->enum('type', ['free', 'paid'])->default('free');
            $table->string('duration')->nullable();
            $table->bigInteger('views')->default(0);
            $table->enum('level', ['beginner', 'intermediate', 'anvanced', 'expert'])->default('beginner');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
        });
        Schema::dropIfExists('courses');
    }
};
