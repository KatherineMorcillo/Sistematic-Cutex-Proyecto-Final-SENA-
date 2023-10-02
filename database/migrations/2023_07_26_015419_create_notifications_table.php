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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('Titulo de la notificación');
            $table->text('message')->comment('Mensaje de la notificación');
            $table->enum('status', ["read", "unread", "send"])->default("send")->comment('Estado de la notificación: leído, no leído, envíado');
            $table->enum('type', ["product", "invoice"])->comment('Tipo de la notificación: notificación de producto ó de factura');
            $table->string('reference')->comment('Referencia de la notificación');
            //Declaración de llave foranea
            $table->bigInteger('user_id')->unsigned()->comment('Relación de la tabla notificaciones con la tabla usuarios');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
