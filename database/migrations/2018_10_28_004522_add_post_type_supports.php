<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPostTypeSupports extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('posttypesmeta')->where('id', 1)->update([
            'meta_value' => json_encode([
                'labels' => [
                    'singular' => 'Post',
                    'plural' => 'Posts'
                ],
                'supports' => [
                    'title',
                    'editor',
                    'excerpt'
                ]
            ]),
            'meta_key' => 'options'
        ]);
        DB::table('posttypesmeta')->where('id', 2)->update([
            'meta_value' => json_encode([
                'labels' => [
                    'singular' => 'Page',
                    'plural' => 'Pages'
                ],
                'supports' => [
                    'title',
                    'editor',
                    'excerpt'
                ]
            ]),
            'meta_key' => 'options'
        ]);
        DB::table('posttypesmeta')->where('id', 3)->update([
            'meta_value' => json_encode([
                'labels' => [
                    'singular' => 'Medium',
                    'plural' => 'Media'
                ],
                'supports' => [
                    'title',
                    'editor',
                    'excerpt'
                ]
            ]),
            'meta_key' => 'options'
        ]);
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
