<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('penjualan', function (Blueprint $table) {
        $table->decimal('uang_dibayar', 15, 2)->nullable()->after('total_pembayaran');
        $table->decimal('kembalian', 15, 2)->nullable()->after('uang_dibayar');
    });
}

public function down()
{
    Schema::table('penjualan', function (Blueprint $table) {
        $table->dropColumn(['uang_dibayar', 'kembalian']);
    });
}
};
