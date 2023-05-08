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
        Schema::create('filter_ist_username_lekt', function (Blueprint $table) {
            $table->string('username',6)->index('username');
            $table->string('lekt',20)->index('lekt');

            $table->primary(['lekt','username']);
        });
        /*
         *
         */
        Schema::create('ist', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('sym_kodsym')->index('sym_kodsym');
            $table->bigInteger('aaparas');
            $table->string('username',6)->index('username');
            $table->date('symekdd')->nullable();
            $table->date('symend')->nullable();
            $table->date('symlhd')->nullable();
            $table->string('symkal',3);
            $table->string('symkin',4);
            $table->string('symperi',20);
            $table->date('symkind')->nullable();
            $table->decimal('symekp');
            $table->string('symstatus',1);
            $table->decimal('prposost');
            $table->bigInteger('prendprom');
            $table->decimal('prforos');
            $table->string('asfkod');
            $table->decimal('asfposo');
            $table->decimal('symdiaf');
            $table->decimal('ekpt');
            $table->decimal('kasf');
            $table->decimal('masf');
            $table->decimal('dik');
            $table->decimal('fke');
            $table->decimal('posfke');
            $table->decimal('epib1');
            $table->decimal('epib2');
            $table->decimal('plafon');
            $table->string('lekt',20)->index('lekt');
            $table->string('symepo',40);
            $table->decimal('prpromh');
            $table->decimal('msforos');
            $table->string('kodpran',40);
            $table->string('afm',20);

            $table->foreign('username')
                ->references('username')
                ->on('users');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ist_username_lekt');
        Schema::dropIfExists('ist');
    }
};
