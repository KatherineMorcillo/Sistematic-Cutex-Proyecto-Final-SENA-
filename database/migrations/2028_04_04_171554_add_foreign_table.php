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
        /*
         *
         * Tabla Clientes
         */
        Schema::table('clients', function (Blueprint $table) {
            $table
                ->foreign('document_id')
                ->references('id')
                ->on('documents');
        });
        /*
         *
         * Tabla Su
         * 
         
         
         bcategoria
         */

        Schema::table('subcategories', function (Blueprint $table) {
            $table
                ->foreign('category_id')
                ->references('id')
                ->on('categories');
        });
        /*
         *
         * Tabla Usuarios
         */
        Schema::table('users', function (Blueprint $table) {
            $table
                ->foreign('document_id')
                ->references('id')
                ->on('documents');
            $table
                ->foreign('rol_id')
                ->references('id')
                ->on('roles');
            $table
                ->foreign('company_id')
                ->references('id')
                ->on('companies');
        });
        /*
         *
         * Tabla Productos
         */
        Schema::table('products', function (Blueprint $table) {
            $table
                ->foreign('company_id')
                ->references('id')
                ->on('companies');
            $table
                ->foreign('provider_id')
                ->references('id')
                ->on('providers');
            $table
                ->foreign('color_id')
                ->references('id')
                ->on('colors');
            $table
                ->foreign('subcategory_id')
                ->references('id')
                ->on('subcategories');
            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users');
        });
        /*
         *
         * Tabla Facturas
         */
        Schema::table('invoices', function (Blueprint $table) {
            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users');
            $table
                ->foreign('client_id')
                ->references('id')
                ->on('clients');
        });
        /*
         *
         * Tabla Detalles de facturas
         */
        Schema::table('details', function (Blueprint $table) {
            $table
                ->foreign('invoice_id')
                ->references('id')
                ->on('invoices');
            $table
                ->foreign('product_id')
                ->references('id')
                ->on('products');
        });

        /*
         *
         * Tabla Notificaciones
         */
        Schema::table('notifications', function (Blueprint $table) {
            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
