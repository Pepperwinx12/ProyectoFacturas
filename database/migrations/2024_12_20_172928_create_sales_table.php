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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->string('receipt_type', 20);
            $table->string('receipt_series', 7)->nullable();
            $table->string('receipt_number', 10);
            $table->dateTime('date_time');
            $table->decimal('tax', 4, 2);
            $table->decimal('total_sale', 11, 2);
            $table->boolean('status')->default(1);
            $table->timestamps();
        
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
