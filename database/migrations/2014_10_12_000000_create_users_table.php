<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->rememberToken();
            $table->timestamps();
            $table->string('name')->comment('用户昵称');
            $table->string('confirm_code',64)->nullable()->comment('激活确认码');
            $table->string('is_confirmed')->default(0)->comment('是否确认');
            $table->string('password')->nullable()->comment('用户密码');
            $table->string('email')->nullable()->index()->comment('用户邮箱,用来登录');
            $table->string('phone')->nullable()->index()->comment('用户电话号码');
            $table->string('company')->nullable()->comment('用户的公司');
            $table->string('position')->default('专家')->comment('职称');
            $table->string('status')->default('0')->comment('用户状态');//1邮箱注册用户 0邀请但未注册用户 2QQ???
            $table->string('headimg')->default('/images/default_headimg.jpg')->comment('用户头像');
            //第三方登录
            $table->string('weixin_id')->default('')->index()->comment('微信id');
            $table->string('weibo_id')->default('')->index()->comment('微博id');
            $table->string('qq_id')->default('')->index()->comment('QQ id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
