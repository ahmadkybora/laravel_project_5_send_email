<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('userId');
            $table->foreignId('bankId');
            $table->string('transaction_code');
            $table->string('amount');
            $table->text('description');
            $table->string('image')->nullable();
            $table->enum('status', ['ACTIVE', 'DEACTIVE', 'PENDING', 'SUSPENDED']);
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
        Schema::dropIfExists('transactions');
    }
}
