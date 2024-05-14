<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('roles');
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name',255);
            $table->timestamps();
        });

        if (Schema::hasTable('users')) {
            if (Schema::hasColumn('users', 'idRole')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->dropForeign(['idRole']);
                    $table->dropColumn('idRole');
                });
            }
        }
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('idRole')->nullable()->after('id');
            $table->foreign('idRole')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
