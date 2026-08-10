<?php

namespace Database\Seeders;

use App\Models\SkTemplate;
use Illuminate\Database\Seeder;

class SkTemplateSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Template SK Pengurus Takmir Masjid
        SkTemplate::firstOrCreate(
            ['code' => 'SK-TAKMIR'],
            [
                'title' => 'Surat Keputusan Camat Pekalongan Utara Tentang Pengesahan Pengurus Takmir Masjid',
                'html_template' => '<div style="font-family: serif; text-align: justify; line-height: 1.6;">
                    <h3 style="text-align: center; text-transform: uppercase; margin-bottom: 5px;">KEPUTUSAN CAMAT PEKALONGAN UTARA</h3>
                    <h4 style="text-align: center; margin-top: 0;">NOMOR: {{sk_number}}</h4>
                    <p style="text-align: center; font-weight: bold;">TENTANG<br>PENGESAHAN SUSUNAN PENGURUS TAKMIR MASJID {{nama_masjid}} KELURAHAN {{nama_kelurahan}}<br>PERIODE {{periode_jabatan}}</p>
                    <hr style="border: 1px solid #000; margin: 15px 0;">
                    <p><strong>CAMAT PEKALONGAN UTARA,</strong></p>
                    <p>Menimbang: bahwa untuk kelancaran kegiatan ibadah dan pengelolaan Masjid {{nama_masjid}} yang beralamat di {{alamat_masjid}}, perlu menetapkan Susunan Pengurus Takmir Masjid yang diketuai oleh Saudara/i <strong>{{nama_ketua}}</strong>.</p>
                    <p>Mengingat: Peraturan Daerah Kota Pekalongan Nomor 10 Tahun 2020 tentang Pembentukan Produk Hukum Daerah.</p>
                    <p style="text-align: center; font-weight: bold; margin-top: 20px;">MEMUTUSKAN:</p>
                    <p><strong>MENETAPKAN:</strong></p>
                    <p>KESATU: Mengesahkan Susunan Pengurus Takmir Masjid {{nama_masjid}} Kelurahan {{nama_kelurahan}} Periode {{periode_jabatan}} dengan Ketua: {{nama_ketua}}.</p>
                    <p>KEDUA: Keputusan ini mulai berlaku pada tanggal ditetapkan.</p>
                </div>',
                'dynamic_fields' => [
                    ['name' => 'nama_masjid', 'label' => 'Nama Masjid', 'type' => 'text', 'required' => true],
                    ['name' => 'nama_kelurahan', 'label' => 'Nama Kelurahan', 'type' => 'text', 'required' => true],
                    ['name' => 'alamat_masjid', 'label' => 'Alamat Lengkap Masjid', 'type' => 'textarea', 'required' => true],
                    ['name' => 'nama_ketua', 'label' => 'Nama Ketua Takmir', 'type' => 'text', 'required' => true],
                    ['name' => 'periode_jabatan', 'label' => 'Periode Jabatan (Misal: 2026-2029)', 'type' => 'text', 'required' => true],
                ],
                'is_active' => true,
            ]
        );

        // 2. Template SK Pengurus RT/RW
        SkTemplate::firstOrCreate(
            ['code' => 'SK-RTRW'],
            [
                'title' => 'Surat Keputusan Camat Pekalongan Utara Tentang Pengesahan Pengurus RT / RW',
                'html_template' => '<div style="font-family: serif; text-align: justify; line-height: 1.6;">
                    <h3 style="text-align: center; text-transform: uppercase;">KEPUTUSAN CAMAT PEKALONGAN UTARA</h3>
                    <h4 style="text-align: center;">NOMOR: {{sk_number}}</h4>
                    <p style="text-align: center; font-weight: bold;">TENTANG<br>PENGESAHAN KETUA RT {{nomor_rt}} RW {{nomor_rw}} KELURAHAN {{nama_kelurahan}}</p>
                    <hr style="border: 1px solid #000; margin: 15px 0;">
                    <p>Mengingat hasil musyawarah warga RT {{nomor_rt}} RW {{nomor_rw}} Kelurahan {{nama_kelurahan}}, memutuskan menetapkan Saudara/i <strong>{{nama_ketua_rt}}</strong> sebagai Ketua RT terhitung mulai tahun {{tahun_berlaku}}.</p>
                </div>',
                'dynamic_fields' => [
                    ['name' => 'nomor_rt', 'label' => 'Nomor RT', 'type' => 'text', 'required' => true],
                    ['name' => 'nomor_rw', 'label' => 'Nomor RW', 'type' => 'text', 'required' => true],
                    ['name' => 'nama_kelurahan', 'label' => 'Nama Kelurahan', 'type' => 'text', 'required' => true],
                    ['name' => 'nama_ketua_rt', 'label' => 'Nama Ketua RT Terpilih', 'type' => 'text', 'required' => true],
                    ['name' => 'tahun_berlaku', 'label' => 'Masa Berlaku (Tahun)', 'type' => 'text', 'required' => true],
                ],
                'is_active' => true,
            ]
        );
    }
}
