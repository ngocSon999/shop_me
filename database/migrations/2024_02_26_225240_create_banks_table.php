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
        Schema::create('banks', function (Blueprint $table) {
            $table->id();
            $table->string('bank_account', 150)->comment('ten chu tk');
            $table->string('bank_name', 255)->comment('ten ngan hang');
            $table->string('bank_number', 20)->comment('stk ngan hang');
            $table->string('bank_address', 255)->nullable();
            $table->tinyInteger('status')->unsigned()->nullable()->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banks');
    }
};
