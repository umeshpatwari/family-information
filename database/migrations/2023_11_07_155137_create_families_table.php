<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamiliesTable extends Migration
{
    public function up()
    {
        Schema::create('families', function (Blueprint $table) {
            $table->id();
            $table->string('Name');
            $table->string('Surname');
            $table->date('Birthdate');
            $table->string('MobileNo');
            $table->string('Address');
            $table->string('State');
            $table->string('City');
            $table->string('Pincode');
            $table->enum('MaritalStatus', ['Married', 'Unmarried']);
            $table->date('WeddingDate')->nullable(); // Only used if 'IsMarried' is true
            $table->json('Hobbies')->nullable(); // Use JSON to store multiple hobbies
            $table->string('Photo')->nullable(); // Assuming you store photo paths
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('families');
    }
}

