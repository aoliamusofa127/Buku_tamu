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
        Schema::create('tamu', function (Blueprint $table) {
            $table->id('tamu_id');
            $table->foreignId('pegawai_id');
            $table->string('nama', 50);
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('alamat_atau_instansi', 50);
            $table->string('email', 100);
            $table->string('telepon', 12);
            $table->string('tempat_pertemuan')->nullable();
            $table->longText('keperluan');
            $table->date('request_tanggal');
            $table->enum('status_tamu', ['pending', 'verifikasi'])->default('pending');
            $table->timestamps();
            $table->foreign('pegawai_id')->references('pegawai_id')->on('pegawai')->cascadeOnUpdate()->cascadeOnDelete();

            // rubah tanggal datang menjadi auto insert (timestamps)
            // field new alamat/instansi
            // pilihan pilih_tempat("di tempat")
            // filed request enum("kabid","sekretaris", "sekdis", "pejabat yang mewakili")
            // kode QR
            // tampilan end user
            // opsional bertamu menggunakan QR atau input manual
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tamu');
    }
};