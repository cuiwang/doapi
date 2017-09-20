<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('docs', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('doc_title')->nullable()->comment('自定义标题');
            $table->string('doc_description')->nullable()->comment('doc产品简介');
            $table->string('doc_baseurl')->nullable()->comment('自定义baseurl');
            $table->tinyInteger('doc_status')->default(0)->comment('文档状态');
            $table->string('doc_version')->default('1.0.0')->comment('自定义版本号');
            $table->string('doc_backgdimg')->default('1.jpg')->comment('自定义背景');
            $table->string('doc_passwd')->nullable()->comment('自定义文档密码');
            $table->integer('project_id')->unsigned()->comment('所属产品');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('docs');
    }
}
