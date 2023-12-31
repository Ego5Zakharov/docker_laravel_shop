<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRolesTable extends Migration
{

    public function up()
    {
        Schema::create('user_roles', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->index()->constrained('users')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreignId('role_id')->index()->constrained('roles')
                ->cascadeOnDelete()
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_roles');
    }
}
