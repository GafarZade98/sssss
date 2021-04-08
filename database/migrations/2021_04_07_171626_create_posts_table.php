<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('keyword')->nullable();
            $table->string('description')->nullable();
            $table->text('content')->nullable();
            $table->string('file')->nullable();
            $table->boolean('status')->default(true);
            $table->foreignId('item_id')->nullable()->constrained()->onDelete('set NULL');
            $table->foreignId('topic_id')->nullable()->constrained()->onDelete('set NULL');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set NULL');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
