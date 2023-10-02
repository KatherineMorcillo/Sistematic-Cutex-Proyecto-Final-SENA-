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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 125)->comment('Nombre del usuario del sistema');
            $table->string('surname', 125)->comment('Apellido del usuario del sistema');
            $table->string('document_number', 30)->comment('Número del documento del usuario del sistema');
            $table->string('address', 125)->comment('Dirección del usuario del sistema');
            $table->string('cellphone', 20)->comment('Número del celular del usuario del sistema');
            $table->string('email')->unique()->comment('Correo electrónico del usuario del sistema');
            $table->enum('gender', ["masculino", "femenino"])->comment('Género del usuario del sistema');
            $table->enum('status', ["active", "inactive"])->default("active")->comment('Estado del usuario del sistema');
            //Declaración llave foranea
            $table->bigInteger('document_id')->unsigned()->comment('Relación tabla usuarios con tabla documentos');
            $table->bigInteger('rol_id')->unsigned()->comment('Relación tabla usuarios con tabla roles');
            $table->bigInteger('company_id')->unsigned()->comment('Relación tabla usuarios con tabla compañias');
            //Unión llave foranea
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
