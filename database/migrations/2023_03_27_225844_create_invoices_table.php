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
            $table->dateTime('date_hour')->comment('Fecha y hora de la factura');
            $table->integer('total')->comment('Total de la factura');
            $table->enum('status', ["active", "inactive"])->default("active")->comment('Estado de la factura');
            //Declaración de llaves foraneas
            $table->bigInteger('user_id')->unsigned()->comment('Relación de tabla facturas con la tabla usuarios');
            $table->bigInteger('client_id')->unsigned()->comment('Relación de la tabla facturas con la tabla clientes');
            $table->softDeletes();
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
