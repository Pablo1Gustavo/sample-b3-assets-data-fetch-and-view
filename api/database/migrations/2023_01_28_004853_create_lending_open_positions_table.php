<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('lending_open_positions', function (Blueprint $table)
        {
            $table->id();
            $table->char('isin', 12)->unique();
            $table->date('date');
            $table->foreignId('ticker_symbol_id')->constrained();
            $table->integer('balance_amount');
            $table->float('average_price', 10, 6);
            $table->float('total_balence', 13, 2);
        });
    }

    public function down()
    {
        Schema::dropIfExists('lending_open_positions');
    }
};
