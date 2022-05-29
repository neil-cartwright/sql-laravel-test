<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleTeamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_team', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->integer('role_id')->unsigned();
            $table->foreign('role_id')->references('id')->on('roles');

            // id on teams is [team_id][user_id]; eg 2131 which means [dentist][taylor]

            $table->integer('team_id')->unsigned();
            $table->foreign('team_id')->references('id')->on('teams');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_team');
    }
}