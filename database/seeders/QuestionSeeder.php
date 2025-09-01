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
        $subjects = \App\Models\Subject::all()->keyBy(function($s){
            return strtolower($s->name);
        });

        $findSubject = function(string $key) use ($subjects) {
            $key = strtolower($key);
            foreach ($subjects as $name => $s) {
                if (str_contains($name, $key)) return $s->id;
            }
            return $subjects->first()->id ?? null;
        };

        $data = [
            [
                'text' => 'Apa minat utama Anda?',
                'options' => [
                    ['text' => 'Desain grafis', 'subject_key' => 'multimedia'],
                    ['text' => 'Jaringan komputer', 'subject_key' => 'jaringan'],
                    ['text' => 'Pemrograman', 'subject_key' => 'rekayasa perangkat lunak'],
                    ['text' => 'Kegiatan sosial', 'subject_key' => 'mbkm'],
                ],
            ],
            [
                'text' => 'Aktivitas favorit di sekolah?',
                'options' => [
                    ['text' => 'Membuat video', 'subject_key' => 'multimedia'],
                    ['text' => 'Setting router', 'subject_key' => 'jaringan'],
                    ['text' => 'Membuat aplikasi', 'subject_key' => 'rekayasa perangkat lunak'],
                    ['text' => 'Organisasi', 'subject_key' => 'mbkm'],
                ],
            ],
            [
                'text' => 'Apa yang paling Anda sukai?',
                'options' => [
                    ['text' => 'Mengedit foto', 'subject_key' => 'multimedia'],
                    ['text' => 'Memperbaiki komputer', 'subject_key' => 'jaringan'],
                    ['text' => 'Menulis kode program', 'subject_key' => 'rekayasa perangkat lunak'],
                    ['text' => 'Diskusi kelompok', 'subject_key' => 'mbkm'],
                ],
            ],
            [
                'text' => 'Mata pelajaran favorit?',
                'options' => [
                    ['text' => 'Seni rupa', 'subject_key' => 'multimedia'],
                    ['text' => 'Komputer', 'subject_key' => 'jaringan'],
                    ['text' => 'Matematika', 'subject_key' => 'rekayasa perangkat lunak'],
                    ['text' => 'Sosiologi', 'subject_key' => 'mbkm'],
                ],
            ],
            [
                'text' => 'Kegiatan ekstrakurikuler?',
                'options' => [
                    ['text' => 'Multimedia', 'subject_key' => 'multimedia'],
                    ['text' => 'Robotika', 'subject_key' => 'jaringan'],
                    ['text' => 'Olimpiade komputer', 'subject_key' => 'rekayasa perangkat lunak'],
                    ['text' => 'Pramuka', 'subject_key' => 'mbkm'],
                ],
            ],
        ];

        foreach ($data as $qData) {
            $q = \App\Models\Question::create(['text' => $qData['text']]);
            foreach ($qData['options'] as $idx => $opt) {
                $q->options()->create([
                    'text' => $opt['text'],
                    'subject_id' => $findSubject($opt['subject_key']),
                    'key' => chr(65 + $idx),
                ]);
            }
        }
    }
}
