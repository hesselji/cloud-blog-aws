<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->integer('id_posts')->autoIncrement();
            $table->integer('categories_id');
            $table->string('title', 255)->nullable();
            $table->string('slug', 255);
            $table->longText('content')->nullable();
            $table->string('image', 255);
            $table->enum('status', ['draft', 'published']);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('categories_id')
                ->references('id_categories')
                ->on('categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};