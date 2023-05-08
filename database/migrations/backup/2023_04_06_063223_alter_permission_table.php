<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $tableNames = config('permission.table_names');
        $columnNames = config('permission.column_names');
        $teams = config('permission.teams');

        if (empty($tableNames)) {
            throw new \Exception('Error: config/permission.php not loaded. Run [php artisan config:clear] and try again.');
        }
        if ($teams && empty($columnNames['team_foreign_key'] ?? null)) {
            throw new \Exception('Error: team_foreign_key on config/permission.php not loaded. Run [php artisan config:clear] and try again.');
        }

        Schema::table($tableNames['model_has_permissions'], function (Blueprint $table) use ($tableNames, $columnNames, $teams) {
            $table->dropColumn($columnNames['model_morph_key']);
        });
        Schema::table($tableNames['model_has_permissions'], function (Blueprint $table) use ($tableNames, $columnNames, $teams) {
            $table->ulid($columnNames['model_morph_key'])->after('model_type');
        });
        Schema::table($tableNames['model_has_roles'], function (Blueprint $table) use ($tableNames, $columnNames, $teams) {
            $table->dropColumn($columnNames['model_morph_key']);
        });
        Schema::table($tableNames['model_has_roless'], function (Blueprint $table) use ($tableNames, $columnNames, $teams) {
            $table->ulid($columnNames['model_morph_key'])->after('model_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
