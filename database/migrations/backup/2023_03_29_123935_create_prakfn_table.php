<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prakfn', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('inspector')->index('inspector');
            $table->string('username')->index('username');

            /*
             * Has inspector
             */
            $table->foreign('username', 'prakfn_has_inspector')
                ->references('username')
                ->on('users');
            /*
             * Is inspector
             */
            $table->foreign('inspector', 'prakfn_is_inspector')
                ->references('username')
                ->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prakfn');
    }
};
