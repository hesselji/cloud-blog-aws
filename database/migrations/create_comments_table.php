<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->integer('id_comments')->autoIncrement();
            $table->integer('posts_id');
            $table->string('name', 100);
            $table->string('email', 100);
            $table->text('comment');
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('posts_id')
                ->references('id_posts')
                ->on('posts')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};