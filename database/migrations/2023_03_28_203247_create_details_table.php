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
        Schema::create('details', function (Blueprint $table) {
            $table->id();
            $table->double('price', 10, 2)->comment('Precio del detalle de la factura');
            $table->integer('stock')->comment('Cantidad del detalle de la factura');
            $table->integer('subtotal')->comment('Subtotal del detalle de la factura');
            $table->enum('status', ["active", "inactive"])->default("active")->comment('Estado del detalle de la factura');
            //Declaración llave foranea
            $table->bigInteger('invoice_id')->unsigned()->comment('Relación de la tabla detalles con la tabla factura');
            $table->bigInteger('product_id')->unsigned()->comment('Relación de la tabla detalles con la tabla productos');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('details');
    }
};
