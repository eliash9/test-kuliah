@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Rekap Hasil Tes Saya</h1>

    @if(!empty($scores))
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded-lg shadow-lg overflow-hidden">
                <thead class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white">
                    <tr>
                        <th class="px-4 py-3 text-left">#</th>
                        <th class="px-4 py-3 text-left">Subject</th>
                        <th class="px-4 py-3 text-left">Skor</th>
                        <th class="px-4 py-3 text-left">Prosentase</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach($scores as $row)
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="px-4 py-3">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3 font-medium">{{ $row['subject_name'] }}</td>
                            <td class="px-4 py-3 font-semibold">{{ $row['score'] }}</td>
                            <td class="px-4 py-3 align-middle">
                                @php
                                    $total = max(array_sum(array_column($scores, 'score')), 1);
                                    $percent = round(($row['score'] / $total) * 100, 1);
                                @endphp
                                <div class="bg-gradient-to-r from-indigo-100 to-indigo-200 px-3 py-2 rounded-lg shadow hover:shadow-lg transition w-fit">
                                    <p class="text-lg font-bold text-indigo-600">{{ $percent }}%</p>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4 flex gap-3">
            <a href="{{ route('results.show') }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white text-sm px-3 py-2 rounded-lg shadow">Lihat Detail</a>
            <a href="{{ route('results.printPdf') }}" class="inline-block bg-green-500 hover:bg-green-600 text-white text-sm px-3 py-2 rounded-lg shadow">Unduh PDF</a>
        </div>
    @else
        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-lg">
            <p class="font-medium">Anda belum mengikuti tes</p>
            <p class="text-sm">Silakan kerjakan tes terlebih dahulu untuk melihat hasil di sini.</p>
        </div>
    @endif
</div>
@endsection

