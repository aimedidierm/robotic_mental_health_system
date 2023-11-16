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
            $table->string('address')->nullable()->after('available');
            $table->string('sponsor')->nullable()->after('address');
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
            $table->dropColumn('age');
            $table->dropColumn('m_status');
            $table->dropColumn('address');
            $table->dropColumn('sponsor');
        });
    }
};
