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
        Schema::create('filter_anex_username_lekt', function (Blueprint $table) {
            $table->string('username',6)->index('username');
            $table->string('lekt',10)->index('lekt');

            $table->primary(['lekt','username']);
        });
        /*
         *
         */
        Schema::create('anex', function (Blueprint $table) {
            //
            $table->ulid('id')->primary();
            $table->string('sym_kodsym')->index('sym_kodsym');  // it is not unique
            $table->bigInteger('kodpr');
            $table->string('username',6)->index('username');
            $table->date('anxekd')->nullable();
            $table->date('anxena')->nullable();
            $table->date('anxlhd')->nullable();
            $table->bigInteger('anxkod');
            $table->decimal('anxkasf');
            $table->decimal('anxmasf');
            $table->decimal('anxypol');
            $table->decimal('anxprom');
            $table->date('anxexof')->nullable();
            $table->string('symepo',40);
            $table->decimal('telypol');
            $table->string('lekt',10)->index('lekt');

            $table->foreign('username')
                ->references('username')
                ->on('users');
            /*
                        $table->foreign('kodsym','anex_kodsym_sym')
                            ->references('kodsym')
                            ->on('sym');
            */
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('filter_anex_username_lekt');
        Schema::dropIfExists('anex');
    }
};
