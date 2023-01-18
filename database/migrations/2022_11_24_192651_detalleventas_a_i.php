<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DetalleventasAI extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS `detalleventasAI`');
        DB::unprepared("CREATE DEFINER=`Vendedor`@`%` TRIGGER `detalleventasAI` BEFORE INSERT ON `detalle_ventas` FOR EACH ROW begin Set @precio = (select precio from articulos where id_art=new.id_articulo); Set @cantidad = new.cantidad; Set @total = @precio * @cantidad; Set @existencia = (select cantidad from articulos where id_art=new.id_articulo); if @existencia >= @cantidad then Set new.precio = @precio; set new.subtotal = @total; Set @id_ult = new.id_venta; Update articulos a Set a.cantidad = a.cantidad - new.cantidad Where a.id_art = new.id_articulo; Update ventas v Set v.total = v.total + @total Where v.id = @id_ult; ELSE SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'la existencias es insuficiente, Registro invalido'; end if; END");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS `detalleventasAI`');

    }
}
