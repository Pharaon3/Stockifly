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
        Schema::table('products', function (Blueprint $table) {
            $table->string('supplier')->nullable()->default(null);
            $table->string('size')->nullable()->default(null);
            $table->string('model')->nullable()->default(null);
            $table->string('design')->nullable()->default(null);
            $table->string('gold_type')->nullable()->default(null);
            $table->string('stone_type')->nullable()->default(null);
            $table->string('jewerly_group')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
};
