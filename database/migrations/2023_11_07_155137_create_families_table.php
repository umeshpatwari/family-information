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
            $table->string('name');
            $table->string('surname');
            $table->date('birthdate');
            $table->string('mobile_no');
            $table->string('address');
            $table->string('state');
            $table->string('city');
            $table->string('pincode');
            $table->enum('marital_status', ['Married', 'Unmarried']);
            $table->date('wedding_date')->nullable(); // Only used if 'IsMarried' is true
            $table->json('hobbies')->nullable(); // Use JSON to store multiple hobbies
            $table->string('photo')->nullable(); // Assuming you store photo paths
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('families');
    }
}

