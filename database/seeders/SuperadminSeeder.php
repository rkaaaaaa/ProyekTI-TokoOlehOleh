<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SuperadminSeeder extends Seeder
{
    public function run()
    {
        // Periksa apakah Superadmin sudah ada
        $superadminExists = DB::table('ms_user')->where('levelUser', 'Superadmin')->exists();

        if (!$superadminExists) {
            DB::table('ms_user')->insert([
                'idUser' => 1,
                'namaUser' => 'Superadmin',
                'passwordUser' => md5('tokooleholeh'),
                'levelUser' => 'Superadmin',
                'statusUser' => 'Aktif'
            ]);
        }
    }
}
