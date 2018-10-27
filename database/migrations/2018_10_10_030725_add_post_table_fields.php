<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPostTableFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create posts table fields
        Schema::table('posts', function(Blueprint $table) {
            // Identifiers
            $table->uuid('guid')->collation('utf8mb4_unicode_ci');
            // Related
            $table->bigInteger('parent')->unsigned();
            $table->bigInteger('author')->unsigned();
            // Content
            $table->text('title')->collation('utf8mb4_unicode_ci');
            $table->longText('content')->collation('utf8mb4_unicode_ci');
            $table->text('excerpt')->collation('utf8mb4_unicode_ci');
            // Other
            $table->string('type', 20)->collation('utf8mb4_unicode_ci');
            $table->string('status', 20)->collation('utf8mb4_unicode_ci');
            $table->string('route', 200)->collation('utf8mb4_unicode_ci');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Remove posts table fields
        Schema::table('posts', function(Blueprint $table) {
            $table->dropColumn([
                'guid',
                'parent',
                'author',
                'title',
                'excerpt',
                'content',
                'status',
                'route'
            ]);
        });
    }
}
