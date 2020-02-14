<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProduitsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_categories')->unsigned();
            $table->foreign('id_categories')-> references ('id')->on('categories')->onDelete ('cascade');
            $table->string('nom');
            $table->string('emplacement');
            $table->double('prix');
            $table->integer('qté');
            $table->text('description');;
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('produits');
    }
}
