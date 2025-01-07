<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Nonaktifkan foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Hapus semua data dari tabel users
        DB::table('users')->delete();

        // Isi tabel users dengan data baru
        DB::table('users')->insert([
            [
                'nama' => 'BadFellaz',
                'email' => 'deru@gmail.com',
                'password' => Hash::make('deru123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Fajri Xjr',
                'email' => 'fajri@gmail.com',
                'password' => Hash::make('fajri123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Aktifkan kembali foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
