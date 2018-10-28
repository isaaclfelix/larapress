<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTermmetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('termsmeta', function (Blueprint $table) {
            $table->increments('id');
            // Relations
            $table->bigInteger('term_id')->unsigned();
            // Post meta useful columns
            $table->string('meta_key', 255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->longText('meta_value')->collation('utf8mb4_unicode_ci')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('termmetas');
    }
}
