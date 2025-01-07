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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('no_nota', 50); // Batas panjang untuk efisiensi
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relasi ke tabel users dengan penghapusan cascade
            $table->string('nama_pembeli', 100); // Batas panjang nama pembeli
            $table->enum('status', ['pending', 'paid', 'cancelled', 'lunas'])->default('pending'); // Status dengan nilai default
            $table->date('tgl_transaksi');
            $table->decimal('total_harga', 15, 2)->default(0); // Nilai default untuk total harga
            $table->decimal('bayar', 10, 2)->default(0);
            $table->decimal('kembalian', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
