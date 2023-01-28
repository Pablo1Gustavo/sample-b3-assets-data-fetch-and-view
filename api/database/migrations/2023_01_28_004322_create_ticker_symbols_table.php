<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('ticker_symbols', function (Blueprint $table)
        {
            $table->id();
            $table->string('ticker_symbol', 6)->unique();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ticker_symbols');
    }
};
