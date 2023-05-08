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
        Schema::create('eisf', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('username',6)->index('username');
            $table->string('symepo',40);
            $table->string('sym_kodsym')->index('sym_kodsym');
            $table->bigInteger('anxpr');
            $table->date('anxexof')->nullable();
            $table->decimal('anxprom');
            $table->bigInteger('loghpar');
            $table->decimal('loghaxia');

            $table->foreign('username')
                ->references('username')
                ->on('users');
            /*
                        $table->foreign('sym_id','eisf_symid_sym')
                            ->references('id')
                            ->on('sym');
            */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eisf');
    }
};
