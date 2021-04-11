<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableArtworksChangeLonitude extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('artworks', function (Blueprint $table) {
            DB::statement('ALTER TABLE artworks MODIFY latitude DECIMAL(8,6)');
            DB::statement('ALTER TABLE artworks MODIFY longitude DECIMAL(9,6)');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('artworks', function (Blueprint $table) {
            //
        });
    }
}
