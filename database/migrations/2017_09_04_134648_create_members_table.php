<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('user_id')->unsigned()->comment('用户id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('project_id')->unsigned()->comment('产品id');
            $table->foreign('project_id')->references('id')->on('projects');
            $table->string('role')->comment('角色');//admin writer reader
            $table->string('status')->comment('状态');//已加入 已邀请 已删除
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
