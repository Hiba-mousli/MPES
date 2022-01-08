<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Categorys extends Migration
{
    public function up()
    {
        Schema::create('categorys', function (Blueprint $table) {
        $table->id();
        $table->string('category_name')->nullable() ;
        $table->timestamps();
    });
    }
    
    public function down()
    {
        Schema::dropIfExists('categorys');
    }
}
