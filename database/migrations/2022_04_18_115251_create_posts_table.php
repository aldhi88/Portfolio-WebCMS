<?php

use App\Models\PostCategory;
use App\Models\User;
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
            $table->foreignIdFor(User::class);
            $table->tinyText('title');
            $table->tinyText('slug');
            $table->text('summary');
            $table->text('content')->nullable();
            $table->tinyText('image');
            $table->boolean('is_publish');
            $table->boolean('allow_comment');
            $table->unsignedBigInteger('count_visitor')->default(0);
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
