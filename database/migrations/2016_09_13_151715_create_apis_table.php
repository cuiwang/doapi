<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apis', function (Blueprint $table) {
            //
            $table->increments('id')->unsigned();
            $table->timestamps();
            $table->string('url')->comment('接口地址');
            $table->string('type')->default('static')->comment('接口类型');
            $table->string('method')->default('any')->comment('请求方式');
            $table->string('url_method')->unique()->comment('唯一索引');
            $table->string('description')->nullable()->comment('接口描述');
            $table->string('param')->nullable()->comment('参数');
            $table->string('param_description')->nullable()->comment('参数解释');
            $table->text('json')->nullable()->comment('请求内容');
            $table->text('json_data')->nullable()->comment('动态请求内容');
            $table->text('json_description')->nullable()->comment('请求内容解释');
            $table->string('baseurl')->nullable()->comment('接口基地址');
            $table->string('status')->nullable()->default('200')->comment('请求状态');
            $table->integer('project_id')->unsigned()->comment('所属产品');
            $table->integer('user_id')->unsigned()->comment('所属用户');
            $table->string('version')->default('1.0.0')->comment('版本号');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('apis');
    }
}
