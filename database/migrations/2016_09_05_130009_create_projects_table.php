<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            //
            $table->increments('id')->unsigned();
            $table->timestamps();
            $table->string('name')->comment('产品名称');
            $table->string('url')->unique()->comment('产品地址');
            $table->string('qrcode')->nullable()->comment('二维码');
            $table->string('description')->nullable()->comment('产品简介');
            $table->tinyInteger('status')->default(0)->comment('产品状态');
            $table->string('iconimg')->default('/images/project.png')->comment('产品图标');
            $table->integer('doc_id')->nullable()->comment('文档id');
            $table->integer('user_id')->unsigned()->comment('产品主人');
            $table->string('backgdimg')->default('12.jpg')->comment('背景图片');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('projects');
    }
}
