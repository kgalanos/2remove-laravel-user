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
        Schema::create('filter_sym_username_omadaasfalisis', function (Blueprint $table) {

            $table->string('username',6)->index('username');
            $table->string('omada_asfalisis',20)->index('omada_asfalisis');

            $table->primary(['omada_asfalisis','username']);
        });
        /*
         *
         */
        Schema::create('sym', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('kodsym')->unique();   // I use kodsym
            $table->string('username',6)->index('username'); // I use userename for kodpra
            $table->string('kodpran',10);
            $table->string('eponimia',40)->index('eponimia');
            $table->string('afm',10);
            $table->string('epagelma',25);
            $table->string('odos',30);
            $table->string('polh',20);
            $table->string('t_k',5);
            $table->string('tel_1',15);
            $table->string('tel_2',15);
            $table->string('tel_3',15);
            $table->string('email',40);
            $table->string('omada_asfalisis',20)->index('omada_asfalisis');
            $table->date('date_ekdd')->nullable();
            $table->date('date_end')->nullable();
            $table->date('date_lhjh')->nullable();
            $table->string('kalipsi');
            $table->string('kindinos');
            $table->string('perigrafi');
            $table->decimal('ekptosi')->default(0);
            $table->string('status');
            $table->date('date_ppd')->nullable();
            $table->decimal('masf')->default(0);
            $table->string('oros_kal');
            $table->integer('oros_num')->default(0);
            $table->decimal('ofilomena')->default(0);
            $table->string('kodiko_pliromis',25);
            $table->string('keimeno_1',70);
            $table->string('keimeno_2',70);
            $table->integer('parast')->default(0);
            $table->decimal('asf_poso')->default(0);
            $table->decimal('plafon')->default(0);
            $table->integer('tropos_pliromis')->default(0);
            $table->integer('consent')->nullable()->default(null)->index('consent');
            $table->decimal('kasf')->default(0);

            $table->foreign('username')
                ->references('username')
                ->on('users');

            $table->foreign(['username','omada_asfalisis'])
                ->references(['username','omada_asfalisis'])
                ->on('filter_sym_username_omadaasfalisis');
        });

        Schema::create('symox', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('sym_kodsym')->index('kodsym');
            $table->Integer('oxaa');
            $table->string('oxkykl',10);
            $table->string('marka',10);

            $table->foreign('sym_kodsym','symox_kodsym_sym')
                ->references('kodsym')
                ->on('sym');
        });
        /*
         *
         */
        Schema::create('symprost', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('sym_kodsym')->index('kodsym');
            $table->Integer('pmaa');
            $table->string('pmperi',30);

            $table->foreign('sym_kodsym','sympost_kodsym_sym')
                ->references('kodsym')
                ->on('sym')
            ;
        });
        /*
         *
         */
        Schema::create('symap', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('sym_kodsym')->index('kodsym');
            $table->integer('apaa');
            $table->string('apperi',30);

            $table->foreign('sym_kodsym','symap_kodsym_sym')
                ->references('kodsym')
                ->on('sym');
        });
        }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('filter_sym_username_omadaasfalisis');
        Schema::dropIfExists('sym');
        Schema::dropIfExists('symox');
        Schema::dropIfExists('symprost');
        Schema::dropIfExists('symap
        ');
    }
};
