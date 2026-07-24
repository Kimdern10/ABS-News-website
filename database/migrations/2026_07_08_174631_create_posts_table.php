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
        Schema::create('posts', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | USER & CATEGORY
            |--------------------------------------------------------------------------
            */

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('category_id')
                ->constrained()
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | BLOG CONTENT
            |--------------------------------------------------------------------------
            */

            $table->string('title');

            $table->string('slug')->unique();

            $table->text('excerpt')->nullable();

            $table->longText('content');

            /*
            |--------------------------------------------------------------------------
            | IMAGES
            |--------------------------------------------------------------------------
            */

            $table->string('image1')->nullable();

            $table->string('image2')->nullable();

            $table->string('image3')->nullable();

            $table->string('image4')->nullable();

            $table->string('image5')->nullable();

            /*
            |--------------------------------------------------------------------------
            | NEWS OPTIONS
            |--------------------------------------------------------------------------
            */

            $table->boolean('featured')->default(false);

            $table->boolean('breaking_news')->default(false);

            $table->boolean('trending')->default(false);

            $table->boolean('headline')->default(false);

            $table->boolean('slider')->default(false);

            $table->boolean('popular')->default(false);

            /*
            |--------------------------------------------------------------------------
            | POST STATUS
            |--------------------------------------------------------------------------
            */

            $table->enum('status', [
                'draft',
                'published'
            ])->default('draft');

            /*
            |--------------------------------------------------------------------------
            | PUBLISHING
            |--------------------------------------------------------------------------
            */

            $table->timestamp('published_at')->nullable();

            $table->foreignId('published_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            /*
            |--------------------------------------------------------------------------
            | REPORTER
            |--------------------------------------------------------------------------
            */

            $table->string('author_name')->nullable();

            $table->string('source')->nullable();

            $table->unsignedInteger('reading_time')->default(1);

            /*
            |--------------------------------------------------------------------------
            | COMMENTS
            |--------------------------------------------------------------------------
            */

            $table->boolean('allow_comments')->default(true);

            /*
            |--------------------------------------------------------------------------
            | ANALYTICS
            |--------------------------------------------------------------------------
            */

            $table->unsignedBigInteger('views')->default(0);

            $table->unsignedBigInteger('likes')->default(0);

            $table->unsignedBigInteger('shares')->default(0);

            /*
            |--------------------------------------------------------------------------
            | SEO
            |--------------------------------------------------------------------------
            */

            $table->string('meta_title')->nullable();

            $table->text('meta_description')->nullable();

            $table->text('meta_keywords')->nullable();

            /*
            |--------------------------------------------------------------------------
            | EXTRA
            |--------------------------------------------------------------------------
            */

            $table->boolean('active')->default(true);

            $table->timestamps();

            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};