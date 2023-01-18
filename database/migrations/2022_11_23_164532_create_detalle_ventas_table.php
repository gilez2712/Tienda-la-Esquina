<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_ventas', function (Blueprint $table) {
           $table->id();
            $table->unsignedBigInteger('id_venta');
            $table->unsignedBigInteger('id_articulo');
            //$table->primary(['id_venta', 'id_articulo']);
            $table->integer('cantidad');
            $table->decimal('precio',10,0);
            $table->decimal('subtotal',10,0);
            $table->timestamps();
            $table->index(['id_venta', 'id_articulo']);
            $table->unique(['id_venta', 'id_articulo']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_ventas');
    }
}
