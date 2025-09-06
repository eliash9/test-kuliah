@extends('layouts.app')

@section('content')

  <!-- Header -->
  
  <!-- Hero -->
  <section class="relative overflow-hidden">
    <div class="absolute inset-0 -z-10 bg-gradient-to-b from-amber-50 via-white to-white"></div>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16 lg:py-24 grid lg:grid-cols-2 gap-12">
      <div class="flex flex-col justify-center">
        <div class="inline-flex items-center gap-2 self-start rounded-full border border-amber-200 bg-amber-50 px-3 py-1 text-amber-700 text-xs font-medium">Tes Minat & Bakat</div>
        <h1 class="mt-4 text-4xl font-bold tracking-tight sm:text-5xl">Hindari salah jurusan. <span class="text-amber-600">Tes minat & bakat</span> gratis.</h1>
        <p class="mt-4 max-w-prose text-slate-600">Jawab pertanyaan sederhana untuk memetakan kecenderungan karier dan jurusan kuliah yang cocok—berdasarkan kerangka RIASEC yang umum dipakai.</p>
        <div class="mt-6 flex flex-col sm:flex-row gap-3">
          <a href="{{ route('test.instructions') }}" class="inline-flex items-center justify-center rounded-xl bg-amber-500 px-6 py-3 text-white font-semibold shadow hover:bg-amber-600 transition">Coba Tes Sekarang</a>
          <a href="#how-it-works" class="inline-flex items-center justify-center rounded-xl px-6 py-3 border border-slate-300 font-medium hover:bg-slate-50">Lihat cara kerja</a>
        </div>
        <p class="mt-3 text-xs text-slate-500">Gratis. Hasil langsung muncul. Tidak ada jawaban benar/salah.</p>
      </div>
      <div class="relative">
        <div class="absolute -top-8 -right-8 h-64 w-64 rounded-full bg-amber-100 blur-3xl opacity-70"></div>
        <div class="relative aspect-[4/3] w-full overflow-hidden rounded-3xl border border-slate-200 shadow-sm">
          <img src="https://images.unsplash.com/photo-1513258496099-48168024aec0?auto=format&fit=crop&w=800&q=80" alt="Tes Minat & Bakat" class="h-full w-full object-cover" />
        </div>
        <div class="mt-4 grid grid-cols-3 gap-3 text-center text-xs text-slate-600">
          <div class="rounded-xl border border-slate-200 p-3">± 10–15 menit</div>
          <div class="rounded-xl border border-slate-200 p-3">Berbasis RIASEC</div>
          <div class="rounded-xl border border-slate-200 p-3">Hasil instan</div>
        </div>
      </div>
    </div>
  </section>

  <!-- How it Works -->
  <section id="how-it-works" class="py-16 lg:py-24 border-t border-slate-100">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="mx-auto max-w-2xl text-center">
        <h2 class="text-3xl font-bold tracking-tight">Bagaimana cara kerjanya?</h2>
        <p class="mt-3 text-slate-600">Isi kuisioner ringan, sistem memetakan kecenderunganmu, dan kamu dapat rekomendasi jurusan/karier untuk dipertimbangkan.</p>
      </div>
      <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        <!-- Card 1 -->
        <div class="rounded-2xl border border-slate-200 p-6 shadow-sm">
          <div class="text-amber-600 text-sm font-semibold">Langkah 1</div>
          <h3 class="mt-2 text-lg font-semibold">Jawab pertanyaan</h3>
          <p class="mt-1 text-slate-600 text-sm">Pilih pernyataan yang paling menggambarkan dirimu saat ini. Tidak ada benar atau salah.</p>
        </div>
        <!-- Card 2 -->
        <div class="rounded-2xl border border-slate-200 p-6 shadow-sm">
          <div class="text-amber-600 text-sm font-semibold">Langkah 2</div>
          <h3 class="mt-2 text-lg font-semibold">Lihat hasil instan</h3>
          <p class="mt-1 text-slate-600 text-sm">Dapatkan ringkasan tipe kepribadian dan minat dominanmu secara langsung.</p>
        </div>
        <!-- Card 3 -->
        <div class="rounded-2xl border border-slate-200 p-6 shadow-sm">
          <div class="text-amber-600 text-sm font-semibold">Langkah 3</div>
          <h3 class="mt-2 text-lg font-semibold">Eksplor jurusan/karier</h3>
          <p class="mt-1 text-slate-600 text-sm">Gunakan hasil sebagai acuan awal untuk diskusi dengan orang tua, guru, atau mentor.</p>
        </div>
      </div>
    </div>
  </section>
<section id="mata-kuliah" class="py-16 lg:py-24 bg-white border-t border-slate-100">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-2xl text-center mb-8">
            <h2 class="text-3xl font-bold tracking-tight">Pilihan Jurusan Kuliah</h2>
            <p class="mt-3 text-slate-600">Berikut beberapa jurusan yang dapat menjadi rekomendasi akhir dari tes minat & bakat. Setiap jurusan memiliki karakteristik dan peluang karier berbeda.</p>
        </div>
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach(\App\Models\Subject::all() as $subject)
                <div class="rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-lg transition duration-300 transform hover:-translate-y-2 bg-white flex flex-col items-center">
                    <div class="mb-3">
                        <svg class="h-10 w-10 text-amber-500 animate-bounce" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="#fde68a"/>
                            <path d="M8 12h8M12 8v8" stroke="#d97706" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">{{ $subject->name }}</h3>
                    <p class="text-sm text-slate-600">{{ $subject->description }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

  <!-- RIASEC -->
  <section id="riasec" class="py-16 lg:py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="mx-auto max-w-2xl text-center">
        <h2 class="text-3xl font-bold tracking-tight">Tipe Kepribadian RIASEC</h2>
        <p class="mt-3 text-slate-600">Enam tipe berikut sering dipakai untuk memahami kecenderungan minat & cara kerja seseorang.</p>
      </div>
      <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        <!-- Tile -->
        <article class="rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-md transition">
          <div class="flex items-center gap-3">
            <span class="inline-flex h-9 w-9 items-center justify-center rounded-xl bg-amber-500/10 text-amber-700 font-bold">R</span>
            <h3 class="text-lg font-semibold">Realistic</h3>
          </div>
          <p class="mt-2 text-sm text-slate-600">Menyukai aktivitas praktis, teknis, dan penggunaan alat. Cenderung hands-on.</p>
        </article>
        <article class="rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-md transition">
          <div class="flex items-center gap-3">
            <span class="inline-flex h-9 w-9 items-center justify-center rounded-xl bg-amber-500/10 text-amber-700 font-bold">I</span>
            <h3 class="text-lg font-semibold">Investigative</h3>
          </div>
          <p class="mt-2 text-sm text-slate-600">Tertarik analisis, riset, pemecahan masalah, dan berpikir kritis.</p>
        </article>
        <article class="rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-md transition">
          <div class="flex items-center gap-3">
            <span class="inline-flex h-9 w-9 items-center justify-center rounded-xl bg-amber-500/10 text-amber-700 font-bold">A</span>
            <h3 class="text-lg font-semibold">Artistic</h3>
          </div>
          <p class="mt-2 text-sm text-slate-600">Menghargai kreativitas, ekspresi diri, dan lingkungan kerja yang fleksibel.</p>
        </article>
        <article class="rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-md transition">
          <div class="flex items-center gap-3">
            <span class="inline-flex h-9 w-9 items-center justify-center rounded-xl bg-amber-500/10 text-amber-700 font-bold">S</span>
            <h3 class="text-lg font-semibold">Social</h3>
          </div>
          <p class="mt-2 text-sm text-slate-600">Senang membantu orang lain, mengajar, membimbing, atau memberi layanan.</p>
        </article>
        <article class="rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-md transition">
          <div class="flex items-center gap-3">
            <span class="inline-flex h-9 w-9 items-center justify-center rounded-xl bg-amber-500/10 text-amber-700 font-bold">E</span>
            <h3 class="text-lg font-semibold">Enterprising</h3>
          </div>
          <p class="mt-2 text-sm text-slate-600">Gesit memimpin dan memengaruhi; enjoy bernegosiasi dan mengambil keputusan.</p>
        </article>
        <article class="rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-md transition">
          <div class="flex items-center gap-3">
            <span class="inline-flex h-9 w-9 items-center justify-center rounded-xl bg-amber-500/10 text-amber-700 font-bold">C</span>
            <h3 class="text-lg font-semibold">Conventional</h3>
          </div>
          <p class="mt-2 text-sm text-slate-600">Terstruktur, rapi, teliti; nyaman dengan sistem dan prosedur yang jelas.</p>
        </article>
      </div>
    </div>
  </section>

  <!-- FAQ -->
  <section id="faq" class="py-16 lg:py-24 border-t border-slate-100">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="mx-auto max-w-2xl text-center">
        <h2 class="text-3xl font-bold tracking-tight">Pertanyaan Umum</h2>
        <p class="mt-3 text-slate-600">Beberapa hal yang sering ditanyakan tentang tes minat & bakat ini.</p>
      </div>
      <div class="mt-10 grid gap-4 md:grid-cols-2">
        <details class="group rounded-2xl border border-slate-200 p-5 open:shadow-sm">
          <summary class="flex cursor-pointer list-none items-center justify-between gap-4">
            <h3 class="font-semibold">Apakah tes ini gratis?</h3>
            <svg class="h-5 w-5 shrink-0 transition group-open:rotate-180" viewBox="0 0 20 20" fill="currentColor"><path d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 10.17l3.71-2.94a.75.75 0 1 1 1.04 1.08l-4.24 3.36a.75.75 0 0 1-.94 0L5.25 8.31a.75.75 0 0 1-.02-1.1z"/></svg>
          </summary>
          <p class="mt-2 text-sm text-slate-600">Ya. Kamu bisa mengerjakan tanpa biaya. Cukup buat akun dan pastikan koneksi internet stabil.</p>
        </details>
        <details class="group rounded-2xl border border-slate-200 p-5 open:shadow-sm">
          <summary class="flex cursor-pointer list-none items-center justify-between gap-4">
            <h3 class="font-semibold">Berapa lama mengerjakannya?</h3>
            <svg class="h-5 w-5 shrink-0 transition group-open:rotate-180" viewBox="0 0 20 20" fill="currentColor"><path d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 10.17l3.71-2.94a.75.75 0 1 1 1.04 1.08l-4.24 3.36a.75.75 0 0 1-.94 0L5.25 8.31a.75.75 0 0 1-.02-1.1z"/></svg>
          </summary>
          <p class="mt-2 text-sm text-slate-600">Tidak dibatasi waktu, namun kebanyakan orang menyelesaikan dalam 10–15 menit.</p>
        </details>
        <details class="group rounded-2xl border border-slate-200 p-5 open:shadow-sm">
          <summary class="flex cursor-pointer list-none items-center justify-between gap-4">
            <h3 class="font-semibold">Bagaimana cara menjawab?</h3>
            <svg class="h-5 w-5 shrink-0 transition group-open:rotate-180" viewBox="0 0 20 20" fill="currentColor"><path d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 10.17l3.71-2.94a.75.75 0 1 1 1.04 1.08l-4.24 3.36a.75.75 0 0 1-.94 0L5.25 8.31a.75.75 0 0 1-.02-1.1z"/></svg>
          </summary>
          <p class="mt-2 text-sm text-slate-600">Pilih opsi yang paling cocok menggambarkan dirimu saat ini. Tidak ada jawaban benar/salah.</p>
        </details>
        <details class="group rounded-2xl border border-slate-200 p-5 open:shadow-sm">
          <summary class="flex cursor-pointer list-none items-center justify-between gap-4">
            <h3 class="font-semibold">Kapan hasilnya keluar?</h3>
            <svg class="h-5 w-5 shrink-0 transition group-open:rotate-180" viewBox="0 0 20 20" fill="currentColor"><path d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 10.17l3.71-2.94a.75.75 0 1 1 1.04 1.08l-4.24 3.36a.75.75 0 0 1-.94 0L5.25 8.31a.75.75 0 0 1-.02-1.1z"/></svg>
          </summary>
          <p class="mt-2 text-sm text-slate-600">Segera setelah selesai, sistem menampilkan ringkasan kepribadian & minat dominanmu.</p>
        </details>
        <details class="group rounded-2xl border border-slate-200 p-5 open:shadow-sm">
          <summary class="flex cursor-pointer list-none items-center justify-between gap-4">
            <h3 class="font-semibold">Apa manfaatnya?</h3>
            <svg class="h-5 w-5 shrink-0 transition group-open:rotate-180" viewBox="0 0 20 20" fill="currentColor"><path d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 10.17l3.71-2.94a.75.75 0 1 1 1.04 1.08l-4.24 3.36a.75.75 0 0 1-.94 0L5.25 8.31a.75.75 0 0 1-.02-1.1z"/></svg>
          </summary>
          <p class="mt-2 text-sm text-slate-600">Kamu mendapat gambaran awal jurusan/karier yang bisa dieksplor lebih lanjut.</p>
        </details>
        <details class="group rounded-2xl border border-slate-200 p-5 open:shadow-sm">
          <summary class="flex cursor-pointer list-none items-center justify-between gap-4">
            <h3 class="font-semibold">Mengapa hasil bisa berubah?</h3>
            <svg class="h-5 w-5 shrink-0 transition group-open:rotate-180" viewBox="0 0 20 20" fill="currentColor"><path d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 10.17l3.71-2.94a.75.75 0 1 1 1.04 1.08l-4.24 3.36a.75.75 0 0 1-.94 0L5.25 8.31a.75.75 0 0 1-.02-1.1z"/></svg>
          </summary>
          <p class="mt-2 text-sm text-slate-600">Ketertarikan dapat bergeser seiring waktu atau konteks. Wajar bila hasil berbeda saat diulang.</p>
        </details>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section id="cta" class="py-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="overflow-hidden rounded-3xl border border-amber-200 bg-amber-50 p-8 sm:p-12 text-center shadow">
        <h2 class="text-2xl sm:text-3xl font-bold tracking-tight text-amber-900">Jangan salah pilih jurusan. Mulai tes sekarang!</h2>
        <p class="mt-2 text-amber-800/80">Gratis, cepat, dan hasil langsung muncul.</p>
        <div class="mt-6 flex items-center justify-center gap-3">
          <a href="#" class="inline-flex rounded-xl bg-amber-500 px-6 py-3 text-white font-semibold shadow hover:bg-amber-600 transition">Mulai Tes</a>
          <a href="#download" class="inline-flex rounded-xl bg-white px-6 py-3 font-medium border border-amber-200 hover:bg-amber-100">Unduh Aplikasi</a>
        </div>
      </div>
    </div>
  </section>

 
@endsection
