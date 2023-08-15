<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_finances', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->bigInteger('amount');
            $table->date('date')->nullable();
            $table->enum('type', ['income','expense']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personal_finances');
    }
};
