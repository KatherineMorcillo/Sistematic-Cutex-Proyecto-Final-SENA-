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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('names', 125)->comment('Nombre del cliente');
            $table->string('surnames', 125)->nullable()->comment('Apellido del cliente');
            $table->string('cellphone', 20)->nullable()->comment('Número de teléfono del cliente');
            $table->string('email', 125)->nullable()->comment('Correo electrónico del cliente');
            $table->string('address', 125)->nullable()->comment('Dirección del cliente');
            $table->string('document_number', 30)->comment('Número de documento del cliente');
            $table->enum('status', ["active", "inactive"])->default("active")->comment('Estado del cliente');
            //Declaración llave foranea
            $table->bigInteger('document_id')->unsigned()->comment('Relación de la tabla clientes con la tabla documentos');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
