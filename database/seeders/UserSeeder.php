<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $password = Hash::make('password123');

        // 1. Admin Kelurahan Krapyak
        $kelurahan1 = User::firstOrCreate(
            ['email' => 'kelurahan.krapyak@pekalonganutara.go.id'],
            [
                'name' => 'Admin Kelurahan Krapyak',
                'password' => $password,
                'kelurahan_name' => 'Krapyak',
                'nip' => '198501012010011001',
                'phone' => '081234567890',
            ]
        );
        $kelurahan1->assignRole('admin_kelurahan');

        // 2. Admin Kelurahan Panjang Wetan
        $kelurahan2 = User::firstOrCreate(
            ['email' => 'kelurahan.panjangwetan@pekalonganutara.go.id'],
            [
                'name' => 'Admin Kelurahan Panjang Wetan',
                'password' => $password,
                'kelurahan_name' => 'Panjang Wetan',
                'nip' => '198703152011011002',
                'phone' => '081234567891',
            ]
        );
        $kelurahan2->assignRole('admin_kelurahan');

        // 3. Admin Kecamatan Pekalongan Utara
        $kecamatan = User::firstOrCreate(
            ['email' => 'admin.kecamatan@pekalonganutara.go.id'],
            [
                'name' => 'Admin Verifikator Kecamatan',
                'password' => $password,
                'kelurahan_name' => null,
                'nip' => '198005122005011003',
                'phone' => '081234567892',
            ]
        );
        $kecamatan->assignRole('admin_kecamatan');

        // 4. Bagian Hukum Setda
        $hukum = User::firstOrCreate(
            ['email' => 'hukum.setda@pekalonganutara.go.id'],
            [
                'name' => 'Bagian Hukum Setda Kota Pekalongan',
                'password' => $password,
                'kelurahan_name' => null,
                'nip' => '197908202003121004',
                'phone' => '081234567893',
            ]
        );
        $hukum->assignRole('bagian_hukum');

        // 5. Camat Pekalongan Utara
        $camat = User::firstOrCreate(
            ['email' => 'camat@pekalonganutara.go.id'],
            [
                'name' => 'Camat Pekalongan Utara',
                'password' => $password,
                'kelurahan_name' => null,
                'nip' => '197204101995031005',
                'phone' => '081234567894',
            ]
        );
        $camat->assignRole('camat');
    }
}
