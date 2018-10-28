<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxonomiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxonomies', function (Blueprint $table) {
            $table->increments('id');
            // Relations
            $table->bigInteger('term_id')->unsigned();

            // Content
            $table->text('taxonomy', 32)->collation('utf8mb4_unicode_ci');
            $table->longText('description')->collation('utf8mb4_unicode_ci');
            // Related
            $table->bigInteger('parent')->unsigned();
            $table->bigInteger('count');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('taxonomies');
    }
}
