<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{ 
    public function up()
    {
        Schema::create('guest_lists', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('id_guest')->constrained('guests')->onDelete('cascade');
            $table->foreignId('id_table')->constrained('tables')->onDelete('cascade'); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('guest_lists');
    }
};
