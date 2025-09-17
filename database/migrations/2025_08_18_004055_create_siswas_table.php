<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('no_pendaftaran')->unique();

            $table->string('nama');
            $table->enum('jenis_kelamin', ['Laki-Laki', 'Perempuan']);
            $table->string('nisn')->nullable();

            // NIK terenkripsi + hash
            $table->text('nik_encrypted');
            $table->string('nik_hash')->unique();

            // No KK terenkripsi + hash
            $table->text('no_kk_encrypted')->nullable();
            $table->string('no_kk_hash')->nullable();

            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');

            // Nomor Reg Akta Lahir terenkripsi + hash
            $table->text('no_reg_akta_encrypted')->nullable();
            $table->string('no_reg_akta_hash')->nullable()->unique();

            $table->decimal('tinggi_badan', 5, 1)->nullable();
            $table->decimal('berat_badan', 5, 1)->nullable();
            $table->decimal('lingkar_kepala', 5, 1)->nullable();
            $table->string('cita_cita')->nullable();
            $table->string('hobi')->nullable();
            
            // alamat
            $table->string('jalan')->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('rt_rw')->nullable();
            $table->decimal('jarak_rumah', 4, 1)->nullable();
            $table->integer('anak_ke')->nullable();

            $table->enum('status', ['calon', 'diterima', 'ditolak', 'lulus'])->default('calon');
            $table->foreignUuid('user_id')->constrained('users')->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
