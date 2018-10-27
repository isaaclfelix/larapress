<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePosttypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posttypes', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            // Relations
            //$table->bigInteger('post_id')->unsigned();
            // Post meta useful columns
            $table->string('name', 255)->collation('utf8mb4_unicode_ci')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posttypes');
    }
}
