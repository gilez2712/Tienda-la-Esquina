<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',100);
            $table->text('descripcion');
            $table->integer('cantidad')->default(0);
            $table->decimal('precio',10,2)->default(0.0);
            $table->integer('stock')->default(0);
            $table->decimal('costo',10,2)->default(0.0);
            $table->date('fecha_caducidad')->nullable();
            $table->enum('departamento',['LACTEOS','BEBIDAS','ENLATADOS','BLANCOS','FERRETERIA','JARDINERIA','PINTURA','PAPELERIA','GENERAL']);
            $table->unsignedBigInteger('id_prov');
            $table->point('ubicacion');
            $table->timestamps();
            //Relaciones
            $table->foreign('id_prov')->references('id')->on('proveedores');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articulos');
    }
}
