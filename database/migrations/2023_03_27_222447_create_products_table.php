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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('photo')->comment('Imagen del producto');
            $table->string('name', 125)->comment('Nombre del producto');
            $table->string('reference', 30)->unique()->comment('Referencia del producto');
            $table->text('description')->comment('Descripción del producto');
            $table->integer('stock')->comment('Cantidad de productos');
            $table->double('price', 10, 2)->comment('Precio del producto');
            $table->double('measure', 10, 2)->comment('Medida del producto cuando son pieles, de lo contrario el valor = 0');
            $table->enum('status', ["active", "inactive"])->default("active")->comment('Estado del producto');
            //Declaración llave foranea
            $table->bigInteger('company_id')->unsigned()->comment('Relación de la tabla productos con la tabla compañia');
            $table->bigInteger('provider_id')->unsigned()->comment('Relación de la tabla productos con la tabla provedor');
            $table->bigInteger('color_id')->unsigned()->comment('Relación de la tabla productos con la tabla color');
            $table->bigInteger('subcategory_id')->unsigned()->comment('Relación de la tabla productos con la tabla subcategoria');
            $table->bigInteger('user_id')->unsigned()->comment('Relación de la tabla productos con la tabla usuario');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
