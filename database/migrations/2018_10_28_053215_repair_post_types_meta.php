<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RepairPostTypesMeta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        //
        DB::table('posttypesmeta')->insert(array(
            array(
                'posttype_id' => '2',
                'meta_key' => 'labels',
                'meta_value' => json_encode(array(
                    'singular' => 'Post',
                    'plural' => 'Posts'
                ))
            ),
            array(
                'posttype_id' => '3',
                'meta_key' => 'labels',
                'meta_value' => json_encode(array(
                    'singular' => 'Page',
                    'plural' => 'Pages'
                ))
            ),
            array(
                'posttype_id' => '4',
                'meta_key' => 'labels',
                'meta_value' => json_encode(array(
                    'singular' => 'Medium',
                    'plural' => 'Media'
                ))
            )
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
