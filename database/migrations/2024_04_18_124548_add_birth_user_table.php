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
        Schema::table('users', function (Blueprint $table) {
            $table->string('nickname')->nullable()->default(null);
            $table->string('birthday')->nullable()->default(null);
            $table->string('bankaccount')->nullable()->default(null);
            $table->string('bankname')->nullable()->default(null);
            $table->string('province')->nullable()->default(null);
            $table->string('postcode')->nullable()->default(null);
            $table->string('country')->nullable()->default(null);
            $table->string('ref_invitation_name')->nullable()->default(null);
            $table->string('joined_event')->nullable()->default(null);
            $table->string('credit_memo')->nullable()->default(null);
            $table->string('point')->nullable()->default(null);
            $table->string('remark')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
