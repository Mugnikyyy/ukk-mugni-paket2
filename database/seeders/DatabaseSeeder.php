<?php

namespace Database\Seeders;

use App\Models\Masyarakat;
use App\Models\Petugas;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();


        Petugas::create([
            'nama_petugas' => 'Mugniz',
            'username' => 'mugni',
            'password' => Hash::make('password'),
            'telp' => '0812345678',
            'level' => 'admin',
        ]);

        Masyarakat::create([
            'nik' => "3671081111040001",
            'nama' => "Masyarakat 1",
            'username' => "Masyarakat1",
            'password' => Hash::make('password'),
            'jenis_kelamin' => "Laki-Laki",
            'telp' => "45678987678",
            'alamat' => "Alun-Alun RT01/RW01"
        ]);
        Masyarakat::create([
            'nik' => "3671081111040002",
            'nama' => "Masyarakat 2",
            'username' => "Masyarakat2",
            'password' => Hash::make('password'),
            'jenis_kelamin' => "Perempuan",
            'telp' => "45678987679",
            'alamat' => "Kampung Baru RT02/RW03"
        ]);
        Masyarakat::create([
            'nik' => "3671081111040003",
            'nama' => "Masyarakat 3",
            'username' => "Masyarakat3",
            'password' => Hash::make('password'),
            'jenis_kelamin' => "Laki-Laki",
            'telp' => "456789876710",
            'alamat' => "Tegal Batu RT01/RW09"
        ]);
    }
}
