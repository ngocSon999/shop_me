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
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('quantity');
            $table->string('account')->after('active');
            $table->string('password')->after('account');
            $table->tinyInteger('is_reward')->nullable()
                ->default(0)
                ->comment('la phan thuong')
                ->after('password');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->integer('quantity')->unsigned()->nullable()->default(0);
            $table->dropColumn(['account', 'password', 'is_reward']);
        });
    }
};
