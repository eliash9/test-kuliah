<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Question::insert([
            [
                'text' => 'Apa minat utama Anda?',
                'option_a' => 'Desain grafis', 'option_a_sub' => 'multimedia',
                'option_b' => 'Jaringan komputer', 'option_b_sub' => 'tkj',
                'option_c' => 'Pemrograman', 'option_c_sub' => 'rpl',
                'option_d' => 'Kegiatan sosial', 'option_d_sub' => 'umum',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'text' => 'Aktivitas favorit di sekolah?',
                'option_a' => 'Membuat video', 'option_a_sub' => 'multimedia',
                'option_b' => 'Setting router', 'option_b_sub' => 'tkj',
                'option_c' => 'Membuat aplikasi', 'option_c_sub' => 'rpl',
                'option_d' => 'Organisasi', 'option_d_sub' => 'umum',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'text' => 'Apa yang paling Anda sukai?',
                'option_a' => 'Mengedit foto', 'option_a_sub' => 'multimedia',
                'option_b' => 'Memperbaiki komputer', 'option_b_sub' => 'tkj',
                'option_c' => 'Menulis kode program', 'option_c_sub' => 'rpl',
                'option_d' => 'Diskusi kelompok', 'option_d_sub' => 'umum',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'text' => 'Mata pelajaran favorit?',
                'option_a' => 'Seni rupa', 'option_a_sub' => 'multimedia',
                'option_b' => 'Komputer', 'option_b_sub' => 'tkj',
                'option_c' => 'Matematika', 'option_c_sub' => 'rpl',
                'option_d' => 'Sosiologi', 'option_d_sub' => 'umum',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'text' => 'Kegiatan ekstrakurikuler?',
                'option_a' => 'Multimedia', 'option_a_sub' => 'multimedia',
                'option_b' => 'Robotika', 'option_b_sub' => 'tkj',
                'option_c' => 'Olimpiade komputer', 'option_c_sub' => 'rpl',
                'option_d' => 'Pramuka', 'option_d_sub' => 'umum',
                'created_at' => now(), 'updated_at' => now(),
            ],
        ]);
    }
}
