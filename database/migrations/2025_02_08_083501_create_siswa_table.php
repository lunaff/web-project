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
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->boolean('active')->default(true);
            $table->string('nama_lengkap', 200);
            $table->string('nipd', 50)->nullable();
            $table->enum('jk', ['L', 'P']);
            $table->string('nis')->unique();
            $table->string('nisn', 50);
            $table->string('tempat_lahir', 50);
            $table->date('tanggal_lahir')->nullable();
            $table->string('nik', 50)->nullable();
            $table->enum('agama', ['Islam', 'Katolik', 'Protestan', 'Buddha', 'Hindu', 'Lainnya']);
            $table->string('alamat', 300);
            $table->integer('rt')->nullable();
            $table->integer('rw')->nullable();
            $table->string('kelurahan', 150)->nullable();
            $table->string('kecamatan', 150)->nullable();
            $table->string('kode_pos', 10)->nullable();
            $table->enum('jenis_tinggal', ['Asrama', 'Bersama orang tua', 'Kost', 'Lainnya', 'Pesantren', 'Wali'])->nullable();
            $table->enum('alat_transportasi', ['ojek', 'sepeda motor', 'angkutan umum', 'jalan kaki', 'mobil', 'antar jemput'])->nullable();
            $table->string('no_hp', 20);
            $table->string('email')->unique();
            $table->boolean('penerima_kps')->default(false);
            $table->string('no_kps', 50)->nullable();
            $table->enum('kewarganegaraan', ['WNI', 'WNA']);
            //Data Ayah
            $table->string('nama_ayah', 50)->nullable();
            $table->date('tanggal_lahir_ayah')->nullable();
            $table->enum('jenjang_pendidikan_ayah', ['SD', 'SMP', 'SMA', 'SMK', 'D1', 'D2', 'D3', 'D4', 'S1', 'S2', 'S3','lainnya'])->nullable();
            $table->enum('pekerjaan_ayah',['Buruh','Karyawan BUMN','Karyawan Swasta','Pedagang Besar','Pedagang Kecil','Pensiunan','Petani','PNS/TNI/Polri','Sudah Meninggal','Tidak Bekerja','Wiraswasta','Wirausaha','Lainnya'])->nullable();
            $table->enum('penghasilan_ayah', ['Tidak Berpenghasilan','Kurang dari Rp. 500,000','Rp. 500,000 - Rp. 999,999','Rp. 1,000,000 - Rp. 1,999,999','Rp. 2,000,000 - Rp. 4,999,999','Rp. 5,000,000 - Rp. 20,000,000','Lebih dari Rp. 20,000,000'])->nullable();
            $table->string('nik_ayah', 16)->nullable();
            //Data Ibu
            $table->string('nama_ibu', 50)->nullable();
            $table->date('tanggal_lahir_ibu')->nullable();
            $table->enum('jenjang_pendidikan_ibu', ['SD', 'SMP', 'SMA', 'SMK', 'D1', 'D2', 'D3', 'D4', 'S1', 'S2', 'S3','lainnya'])->nullable();
            $table->enum('pekerjaan_ibu',['Buruh','Karyawan BUMN','Karyawan Swasta','Pedagang Besar','Pedagang Kecil','Pensiunan','Petani','PNS/TNI/Polri','Sudah Meninggal','Tidak Bekerja','Wiraswasta','Wirausaha','Lainnya'])->nullable();
            $table->enum('penghasilan_ibu', ['Tidak Berpenghasilan','Kurang dari Rp. 500,000','Rp. 500,000 - Rp. 999,999','Rp. 1,000,000 - Rp. 1,999,999','Rp. 2,000,000 - Rp. 4,999,999','Rp. 5,000,000 - Rp. 20,000,000','Lebih dari Rp. 20,000,000'])->nullable();
            $table->string('nik_ibu', 16)->nullable();
            //Data wali
            $table->string('nama_wali', 50)->nullable();
            $table->date('tanggal_lahir_wali')->nullable();
            $table->enum('jenjang_pendidikan_wali', ['SD', 'SMP', 'SMA', 'SMK', 'D1', 'D2', 'D3', 'D4', 'S1', 'S2', 'S3','lainnya'])->nullable();
            $table->enum('pekerjaan_wali',['Buruh','Karyawan BUMN','Karyawan Swasta','Pedagang Besar','Pedagang Kecil','Pensiunan','Petani','PNS/TNI/Polri','Sudah Meninggal','Tidak Bekerja','Wiraswasta','Wirausaha','Lainnya'])->nullable();
            $table->enum('penghasilan_wali', ['Tidak Berpenghasilan','Kurang dari Rp. 500,000','Rp. 500,000 - Rp. 999,999','Rp. 1,000,000 - Rp. 1,999,999','Rp. 2,000,000 - Rp. 4,999,999','Rp. 5,000,000 - Rp. 20,000,000','Lebih dari Rp. 20,000,000'])->nullable();
            $table->string('nik_wali', 16)->nullable();
            $table->string('no_ortu', 20);


            $table->unsignedBigInteger('kdkelas')->nullable();
            $table->foreign('kdkelas')->references('id')->on('kelas')->onDelete('set null');
            $table->unsignedBigInteger('kdkompetensi')->nullable();
            $table->foreign('kdkompetensi')->references('id')->on('kompetensi_keahlian')->onDelete('set null');
            $table->string('no_peserta_un', 50)->nullable();
            $table->string('no_seri_ijazah', 50)->nullable();
            $table->boolean('penerima_kip')->default(false);
            $table->string('nomor_kip', 50)->nullable();
            $table->string('nama_di_kip', 100)->nullable();
            $table->string('nomor_kks', 50)->nullable();
            $table->string('no_registrasi_akta_lahir', 100)->nullable();
            $table->string('bank', 50)->nullable();
            $table->string('nomor_rekening_bank', 50)->nullable();
            $table->string('rekening_atas_nama', 150)->nullable();
            $table->boolean('layak_pip')->default(false);
            $table->enum('alasan_layak_pip', [
                'Dampak Bencana Alam',
                'Menolak',
                'Pemegang PKH/KPS/KKS',
                'Siswa Miskin/Rentan Miskin',
                'Sudah Mampu',
                'Yatim Piatu/Panti Asuhan/Panti Sosial',
            ])->nullable();
            $table->string('kebutuhan_khusus', 100)->nullable();
            $table->string('nama_sekolah_asal', 100);
            $table->integer('anak_keberapa')->nullable();
            $table->decimal('lintang', 10, 7)->nullable();
            $table->decimal('bujur', 10, 7)->nullable();
            $table->string('no_kk', 50)->nullable();
            $table->decimal('berat_badan', 5, 2)->nullable();
            $table->decimal('tinggi_badan', 5, 2)->nullable();
            $table->decimal('jarak_rmh_sklh', 10, 3)->nullable();
            $table->string('riwayat_penyakit', 50)->nullable();
            $table->string('prestasi_akademik', 300)->nullable();
            $table->string('prestasi_non_akademik', 300)->nullable();
            $table->string('ekstrakurikuler', 50)->nullable();
            $table->timestamps();
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
