<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
 // app/database/migrations/xxxx_xx_xx_xxxxxx_create_sales_table.php
public function up(): void
{
    Schema::create('sales', function (Blueprint $table) {
        $table->id();
        $table->foreignId('customer_id')->constrained()->onDelete('cascade');
        $table->string('receipt_type');
        $table->string('receipt_series')->nullable();
        $table->string('receipt_number')->nullable();
        $table->dateTime('date_time');
        $table->decimal('tax', 10, 2);
        $table->decimal('total', 10, 2); // Total sin impuestos
        $table->decimal('total_sale', 10, 2); // Total con impuestos, este es el nuevo campo
        $table->timestamps();
    });
}


    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
