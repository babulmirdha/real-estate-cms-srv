<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('slug')->unique();

            // Real-estate fields
            $table->enum('type', ['Residential', 'Commercial'])->default('Residential');
            $table->enum('status', ['Ready', 'Under Construction'])->default('Ready');

            $table->string('city')->nullable();
            $table->string('area')->nullable();

            $table->unsignedSmallInteger('bedrooms')->default(0);
            $table->unsignedInteger('size_sqft')->default(0);
            $table->unsignedBigInteger('price')->default(0);

            $table->double('lat', 10, 7)->nullable();
            $table->double('lng', 10, 7)->nullable();

            $table->json('images')->nullable();
            $table->json('amenities')->nullable();

            $table->string('video_url')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_published')->default(false);
            $table->timestamp('published_at')->nullable();

            $table->timestamps();

            // Helpful indexes
            $table->index(['city', 'area']);
            $table->index(['status', 'type']);
            $table->index(['price']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
