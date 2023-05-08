<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('id');
        });
        Schema::table('users', function (Blueprint $table) {

            $table->ulid('id')->primary()->first();
            $table->string('username')->nullable()->default(null)->unique('username')->after('id');
            $table->boolean('is_super_admin')->nullable()->default(false)->after('username');
            $table->string('phone')->nullable()->default(null)->unique('phone')->after('email_verified_at');
            $table->timestamp('phone_verified_at')->nullable()->default(null)->after('phone');
            $table->date('ban_from')->nullable()->default(null)->after('phone_verified_at');
            $table->date('ban_until')->nullable()->default(null)->after('ban_from');
        });
    }
};
