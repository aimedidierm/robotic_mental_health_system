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
            $table->string('province')->nullable()->after('available');
            $table->string('district')->nullable()->after('province');
            $table->string('sector')->nullable()->after('district');
            $table->string('cell')->nullable()->after('sector');
            $table->string('village')->nullable()->after('cell');
            $table->string('sponsor')->nullable()->after('village');
            $table->integer('age')->nullable()->after('sponsor');
            $table->enum('m_status', ['single', 'married', 'divorced'])->default('single')->after('age');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('province');
            $table->dropColumn('district');
            $table->dropColumn('sector');
            $table->dropColumn('cell');
            $table->dropColumn('village');
            $table->dropColumn('age');
            $table->dropColumn('m_status');
            $table->dropColumn('sponsor');
        });
    }
};
