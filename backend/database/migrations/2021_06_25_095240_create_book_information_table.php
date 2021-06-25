<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_information', function (Blueprint $table) {
            $table->id();
            $table->integer('registant_id')->unsigned();
            $table->string('author_name', 30);
            $table->string('author_name_kana', 60);
            $table->string('book_title', 50);
            $table->string('book_title_kana', 60);
            $table->text('memo')->nullable();
            $table->boolean('favorite');
            $table->integer('number_of_volumes')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_information');
    }
}
