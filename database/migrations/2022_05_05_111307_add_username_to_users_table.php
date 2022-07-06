<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Se ejecuta cuando se realiza migrate
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique();
        });
    }

    // Se ejecuta cuando se realiza migrate:rollback
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
        });
    }
};
