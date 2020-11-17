<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteHelpTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_help_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 55)->comment('分类名称');
            $table->string('desc')->nullable()->comment('分类介绍');
            $table->string('ico')->nullable()->comment('小图标');
            $table->unsignedInteger('sort')->default(0)->comment('分类排序');
            $table->boolean('status')->default(1)->comment('分类状态');
            $table->timestamps();
        });

        Schema::create('site_helps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('site_help_category_id')->index()->comment('所属分类');
            $table->string('title')->nullable()->comment('标题');
            $table->string('desc')->nullable()->comment('概要');
            $table->string('thumbnail')->nullable()->comment('缩略图');
            $table->longText('content')->comment('内容');
            $table->unsignedInteger('useful')->default(0)->comment('有用');
            $table->boolean('status')->default(1)->comment('状态');
            $table->timestamps();
        });

        Schema::create('site_help_replies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('site_help_id')->index()->comment('所属内容');
            $table->unsignedBigInteger('user_id')->index()->comment('发布人');
            $table->text('content')->comment('评论内容');
            $table->text('reply')->comment('回复内容');
            $table->boolean('status')->default(1)->comment('状态');
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
        Schema::dropIfExists('site_help_categories');
        Schema::dropIfExists('site_helps');
        Schema::dropIfExists('site_help_replies');
    }
}
