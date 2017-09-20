<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSyslogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('syslogs', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('description')->nullable()->comment('描述');
            $table->string('type')->nullable()->comment('类型登录前/控制台/预览');
            $table->string('level')->nullable()->comment('级别');
            $table->integer('project_id')->unsigned()->default(0)->comment('所属产品');
            $table->integer('user_id')->unsigned()->comment('所属用户');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('syslogs');
    }
}
