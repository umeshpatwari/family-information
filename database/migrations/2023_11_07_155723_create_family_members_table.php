<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamilyMembersTable extends Migration
{
    public function up()
    {
        Schema::create('family_members', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('family_id'); // Foreign key to reference 'families' table
            $table->string('name');
            $table->date('birthdate');
            $table->enum('marital_status', ['Married', 'Unmarried']);
            $table->date('wedding_date')->nullable(); // Only used if 'IsMarried' is true
            $table->string('education');
            $table->string('photo')->nullable(); // Assuming you store photo paths
            $table->timestamps();

            $table->foreign('family_id')->references('id')->on('families');
        });
    }

    public function down()
    {
        Schema::dropIfExists('family_members');
    }
}
