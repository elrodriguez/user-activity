<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateActivityLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('activity_log', function (Blueprint $table) {
            $table->id();
            $table->string('tenant_id')->nullable();
            $table->text('component')->nullable();
            $table->json('data_json_old')->nullable();
            $table->json('data_json_updated')->nullable();
            $table->string('table_name')->nullable();
            $table->string('table_column_id')->nullable();
            $table->string('model_name')->nullable();
            $table->string('route')->nullable();
            $table->text('description')->nullable();
            $table->string('context')->nullable();
            $table->string('response_code')->nullable();
            $table->string('response_message')->nullable();
            $table->string('type_activity')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('user')->nullable();
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
        Schema::dropIfExists('users');
    }
}
