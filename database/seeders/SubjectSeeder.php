<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Subject::insert([
            [
                'name' => 'Desain Multimedia',
                'description' => 'Belajar desain grafis, video, animasi, dsb.',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'name' => 'Jaringan Komputer',
                'description' => 'Belajar jaringan, server, dan perangkat keras.',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'name' => 'Rekayasa Perangkat Lunak',
                'description' => 'Belajar pemrograman, software, dan aplikasi.',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'name' => 'MBKM',
                'description' => 'Mata kuliah umum dan pengembangan diri.',
                'created_at' => now(), 'updated_at' => now(),
            ],
            // Tambahkan mata kuliah lain sesuai kebutuhan
        ]);
    }
}
