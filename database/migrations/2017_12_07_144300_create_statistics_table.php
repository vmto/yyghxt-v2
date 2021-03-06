<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //按钮数据统计表
        Schema::create('statistics', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('office_id')->comment('科室');
            $table->string('domain')->comment('域名');
            $table->string('flag')->comment('所统计按钮标识');
            $table->string('date_tag')->comment('日期标识');
            $table->text('description')->nullable()->comment('说明');
            $table->unsignedInteger('count')->default(0)->comment('点击次数');
            $table->index(['office_id']);
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
        Schema::dropIfExists('statistics');
    }
}
