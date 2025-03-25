<?php

use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostRelatedCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_related_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Post::class);
            $table->foreignIdFor(PostCategory::class);
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
        Schema::dropIfExists('post_related_categories');
    }
}
