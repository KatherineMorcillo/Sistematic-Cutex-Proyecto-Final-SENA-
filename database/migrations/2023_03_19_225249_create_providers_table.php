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
        Schema::create('providers', function (Blueprint $table) {
            $table->id();
            $table->string('business_name', 125)->comment('Nombre comercial del proveedor del producto');
            $table->string('admin_name', 125)->comment('Nombre de la administrador del negocio');
            $table->string('cellphone', 20)->comment('Número de celular del proveedor');
            $table->string('email', 125)->comment('Correo electrónico del proveedor');
            $table->string('address', 125)->comment('Dirección del proveedor');
            $table->enum('status', ["active", "inactive"])->default("active")->comment('Estado del proveedor');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('providers');
    }
};
