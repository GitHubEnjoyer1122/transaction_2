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
        Schema::create('tb_siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nisn');
            $table->string('nama_siswa');
            $table->string('jk');
            $table->string('agama')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->text('alamat');
            $table->string('no_telepon')->nullable();
            $table->string('tahun_angkatan');
            $table->integer('status_aktif');
            $table->integer('id_kelas_siswa');
            $table->integer('id_user')->nullable();
            $table->timestamps();
        });
    }

    // -- CREATE TABLE `tb_siswa` (
    //     --   `id` int NOT NULL,
    //     --   `nisn` varchar(15) NOT NULL,
    //     --   `nama_siswa` varchar(100) NOT NULL,
    //     --   `jk` varchar(15) NOT NULL,
    //     --   `agama` varchar(10) DEFAULT NULL,
    //     --   `tempat_lahir` varchar(15) DEFAULT NULL,
    //     --   `tgl_lahir` date DEFAULT NULL,
    //     --   `alamat` text,
    //     --   `no_telepon` varchar(15) DEFAULT NULL,
    //     --   `tahun_angkatan` varchar(15) NOT NULL,
    //     --   `status_aktif` int NOT NULL,
    //     --   `id_kelas_siswa` int NOT NULL,
    //     --   `id_user` int DEFAULT NULL
    //     -- ) ENGINE=MyISAM DEFAULT CHARSET=latin1;

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
