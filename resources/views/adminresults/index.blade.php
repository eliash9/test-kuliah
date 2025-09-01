@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Rekap Hasil Tes Mahasiswa (Admin)</h1>
    <table class="min-w-full bg-white rounded-lg shadow-lg overflow-hidden">
        <thead class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white">
            <tr>
                <th class="border px-2 py-1">#</th>
                <th class="border px-2 py-1">Nama</th>
                <th class="border px-2 py-1">Email</th>
                <th class="border px-2 py-1">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $u)
            <tr>
                <td class="border px-2 py-1">{{ $loop->iteration }}</td>
                <td class="border px-2 py-1">{{ $u->name }}</td>
                <td class="border px-2 py-1">{{ $u->email }}</td>
                <td class="border px-2 py-1 space-x-3">
                    <a href="{{ route('adminresults.show', $u) }}" class="text-blue-600">Lihat Detail</a>
                    <a href="{{ route('adminresults.printPdf', $u) }}" class="text-green-600">Cetak PDF</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="border px-2 py-1 text-center">Tidak ada data hasil tes</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
