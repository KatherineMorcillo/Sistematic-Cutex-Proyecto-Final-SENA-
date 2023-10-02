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
        Schema::create('subcategories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 125)->comment('Nombre de la subcategoría');
            $table->enum('status', ["active", "inactive"])->default("active")->comment('Estado de la subcategoría');
            //Declaración llave foranea
            $table->bigInteger('category_id')->unsigned()->comment('Relación de la tabla subcategorías con la tabla categorías');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subcategories');
    }
};
