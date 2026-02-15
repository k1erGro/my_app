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
        Schema::table('users', function (Blueprint $table) {
            $table->string('l_name',50)->after('id');
            $table->string('f_name', 50)->after('l_name');
            $table->string('m_name',50)->after('f_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('l_name');
            $table->dropColumn('f_name');
            $table->dropColumn('m_name');
        });
    }
};
