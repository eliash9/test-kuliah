@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">📊 Rekap Hasil Tes Saya</h1>

    @if($results->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded-lg shadow-lg overflow-hidden">
                <thead class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white">
                    <tr>
                        <th class="px-4 py-3 text-left">#</th>
                        <th class="px-4 py-3 text-left">Multimedia</th>
                        <th class="px-4 py-3 text-left">TKJ</th>
                        <th class="px-4 py-3 text-left">RPL</th>
                        <th class="px-4 py-3 text-left">Umum</th>
                        <th class="px-4 py-3 text-left">User</th>
                        <th class="px-4 py-3 text-left">Dibuat</th>
                        <th class="px-4 py-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach($results as $r)
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="px-4 py-3">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3 font-semibold text-blue-600">{{ $r->multimedia_score }}</td>
                            <td class="px-4 py-3 font-semibold text-green-600">{{ $r->tkj_score }}</td>
                            <td class="px-4 py-3 font-semibold text-purple-600">{{ $r->rpl_score }}</td>
                            <td class="px-4 py-3 font-semibold text-yellow-600">{{ $r->umum_score }}</td>
                            <td class="px-4 py-3">
                                <div>
                                    <p class="font-medium">{{ $r->user->name ?? '-' }}</p>
                                    <p class="text-sm text-gray-500">{{ $r->user->email ?? '' }}</p>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-500">
                                {{ $r->created_at->format('d M Y, H:i') }}
                            </td>
                            <td class="px-4 py-3">
                                <a href="{{ route('results.show', $r) }}" 
                                   class="inline-block bg-blue-500 hover:bg-blue-600 text-white text-sm px-3 py-1 rounded-lg shadow">
                                    Lihat Detail
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-lg">
            <p class="font-medium">⚠️ Anda belum mengikuti tes</p>
            <p class="text-sm">Silakan kerjakan tes terlebih dahulu untuk melihat hasil di sini.</p>
        </div>
    @endif
</div>
@endsection
