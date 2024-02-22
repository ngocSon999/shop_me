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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('email', 150)->unique();
            $table->string('phone', 15);
            $table->tinyInteger('gender')->nullable();
            $table->string('avatar', 255)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('password', 150);
            $table->integer('coin')->nullable()->default(0);
            $table->string('token', 255)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
