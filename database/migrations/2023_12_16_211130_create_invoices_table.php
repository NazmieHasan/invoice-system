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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
			$table->unsignedInteger('invoice_number');
			$table->string('customer_name');
			$table->string('customer_email');
			$table->string('line_items_and_qty');
            $table->foreignId('user_id')->constrained();
			$table->unsignedDecimal('total_amount', $precision = 8, $scale = 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
