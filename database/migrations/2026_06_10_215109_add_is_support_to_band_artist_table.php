<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // MySQL doesn't allow dropping a unique index that's used by a FK.
        // Workaround: drop FKs, drop unique, add column, new unique, re-add FKs.

        DB::statement('ALTER TABLE band_artist DROP FOREIGN KEY band_artist_artist_id_foreign');
        DB::statement('ALTER TABLE band_artist DROP FOREIGN KEY band_artist_band_id_foreign');

        Schema::table('band_artist', function (Blueprint $table) {
            $table->dropUnique('band_artist_band_id_artist_id_role_unique');
            $table->boolean('is_support')->default(false)->after('role');
            $table->unique(['band_id', 'artist_id', 'role', 'is_support'], 'band_artist_band_id_artist_id_role_support_unique');
        });

        DB::statement('ALTER TABLE band_artist ADD CONSTRAINT band_artist_band_id_foreign FOREIGN KEY (band_id) REFERENCES bands(id) ON DELETE CASCADE');
        DB::statement('ALTER TABLE band_artist ADD CONSTRAINT band_artist_artist_id_foreign FOREIGN KEY (artist_id) REFERENCES artists(id) ON DELETE CASCADE');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE band_artist DROP FOREIGN KEY band_artist_artist_id_foreign');
        DB::statement('ALTER TABLE band_artist DROP FOREIGN KEY band_artist_band_id_foreign');

        Schema::table('band_artist', function (Blueprint $table) {
            $table->dropUnique('band_artist_band_id_artist_id_role_support_unique');
            $table->dropColumn('is_support');
            $table->unique(['band_id', 'artist_id', 'role'], 'band_artist_band_id_artist_id_role_unique');
        });

        DB::statement('ALTER TABLE band_artist ADD CONSTRAINT band_artist_band_id_foreign FOREIGN KEY (band_id) REFERENCES bands(id) ON DELETE CASCADE');
        DB::statement('ALTER TABLE band_artist ADD CONSTRAINT band_artist_artist_id_foreign FOREIGN KEY (artist_id) REFERENCES artists(id) ON DELETE CASCADE');
    }
};
