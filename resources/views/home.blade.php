<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GymTekno - Transform Your Body</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900">

    <nav class="bg-black text-white fixed w-full z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center space-x-2">
                    <span class="text-2xl font-extrabold tracking-tight text-red-500">Gym<span class="text-white">Tekno</span></span>
                </div>
                <div class="hidden md:flex space-x-8 text-sm font-medium uppercase tracking-wider">
                    <a href="#home" class="hover:text-red-500 transition">Home</a>
                    <a href="#about" class="hover:text-red-500 transition">Tentang</a>
                    <a href="#fasilitas" class="hover:text-red-500 transition">Fasilitas</a>
                    <a href="#kelas" class="hover:text-red-500 transition">Kelas</a>
                    <a href="#kontak" class="hover:text-red-500 transition">Kontak</a>
                </div>
                <div class="flex items-center space-x-3">
                    @auth('web')
                        <a href="{{ route('admin.members.index') }}" class="border-2 border-red-500 text-red-500 hover:bg-red-500 hover:text-white px-5 py-2 rounded-full text-sm font-semibold transition">Dashboard</a>
                    @elseauth('members')
                        <a href="{{ route('member.dashboard') }}" class="border-2 border-blue-500 text-blue-500 hover:bg-blue-500 hover:text-white px-5 py-2 rounded-full text-sm font-semibold transition">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="border-2 border-red-500 text-red-500 hover:bg-red-500 hover:text-white px-5 py-2 rounded-full text-sm font-semibold transition">Masuk</a>
                    @endauth
                    <a href="{{ route('register') }}" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-full text-sm font-semibold transition">Daftar Sekarang</a>
                </div>
            </div>
        </div>
    </nav>

    <section id="home" class="relative h-screen flex items-center justify-center bg-black overflow-hidden">
        <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1534438327276-14e5300c3a48?q=80&w=2070')] bg-cover bg-center opacity-40"></div>
        <div class="relative z-10 text-center px-4">
            <h1 class="text-5xl md:text-7xl font-extrabold text-white mb-6 leading-tight">
                Transformasi <span class="text-red-500">Dirimu</span><br>Mulai Hari Ini
            </h1>
            <p class="text-lg md:text-xl text-gray-300 mb-8 max-w-2xl mx-auto">
                GymTekno adalah pusat kebugaran modern dengan fasilitas lengkap dan pelatih profesional siap membantumu mencapai tujuan fitness.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}" class="bg-red-600 hover:bg-red-700 text-white px-8 py-4 rounded-full text-lg font-bold transition shadow-lg">Gabung Sekarang</a>
                <a href="#kelas" class="border-2 border-white text-white hover:bg-white hover:text-black px-8 py-4 rounded-full text-lg font-bold transition">Lihat Kelas</a>
            </div>
        </div>
    </section>

    <section id="about" class="py-20 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <span class="text-red-500 font-semibold uppercase tracking-widest text-sm">Tentang Kami</span>
                    <h2 class="text-4xl font-extrabold mt-2 mb-6">Lebih Dari Sekadar Gym</h2>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        GymTekno hadir untuk mengubah paradigma kebugaran di Indonesia. Kami percaya bahwa setiap orang memiliki potensi untuk menjadi versi terbaik dari dirinya.
                    </p>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Dengan peralatan modern dan instruktur bersertifikasi, kami menyediakan lingkungan yang mendukung perjalanan kebugaranmu — dari pemula hingga atlet profesional.
                    </p>
                    <div class="grid grid-cols-3 gap-4 text-center">
                        <div class="bg-white rounded-xl p-4 shadow-md">
                            <div class="text-3xl font-extrabold text-red-500">5+</div>
                            <div class="text-sm text-gray-500 mt-1">Tahun</div>
                        </div>
                        <div class="bg-white rounded-xl p-4 shadow-md">
                            <div class="text-3xl font-extrabold text-red-500">2000+</div>
                            <div class="text-sm text-gray-500 mt-1">Member</div>
                        </div>
                        <div class="bg-white rounded-xl p-4 shadow-md">
                            <div class="text-3xl font-extrabold text-red-500">15+</div>
                            <div class="text-sm text-gray-500 mt-1">Instruktur</div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <img src="https://images.unsplash.com/photo-1576678927484-cc907957088c?q=80&w=1974" alt="Gym" class="rounded-xl object-cover h-64 w-full shadow-lg">
                    <img src="https://images.unsplash.com/photo-1581009146145-b5ef050c2e1e?q=80&w=2070" alt="Training" class="rounded-xl object-cover h-64 w-full shadow-lg mt-8">
                </div>
            </div>
        </div>
    </section>

    <section id="fasilitas" class="py-20 px-4 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <span class="text-red-500 font-semibold uppercase tracking-widest text-sm">Fasilitas</span>
                <h2 class="text-4xl font-extrabold mt-2">Apa Yang Kami Tawarkan</h2>
                <p class="text-gray-500 mt-4 max-w-xl mx-auto">Lengkapi perjalanan fitness-mu dengan fasilitas terbaik kami</p>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-gray-50 rounded-2xl p-8 hover:shadow-xl transition text-center group">
                    <div class="w-16 h-16 bg-red-100 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-red-500 transition">
                        <svg class="w-8 h-8 text-red-500 group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Alat Modern</h3>
                    <p class="text-gray-500">Peralatan gym terkini dari merek terkemuka dunia untuk hasil latihan maksimal.</p>
                </div>
                <div class="bg-gray-50 rounded-2xl p-8 hover:shadow-xl transition text-center group">
                    <div class="w-16 h-16 bg-red-100 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-red-500 transition">
                        <svg class="w-8 h-8 text-red-500 group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Pelatih Profesional</h3>
                    <p class="text-gray-500">Instruktur bersertifikasi siap membimbing dan menyusun program latihan pribadimu.</p>
                </div>
                <div class="bg-gray-50 rounded-2xl p-8 hover:shadow-xl transition text-center group">
                    <div class="w-16 h-16 bg-red-100 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-red-500 transition">
                        <svg class="w-8 h-8 text-red-500 group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Lingkungan Nyaman</h3>
                    <p class="text-gray-500">Ruangan ber-AC, bersih, dan dilengkapi musik motivasi untuk kenyamanan latihan.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="kelas" class="py-20 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <span class="text-red-500 font-semibold uppercase tracking-widest text-sm">Kelas</span>
                <h2 class="text-4xl font-extrabold mt-2">Jadwal Kelas</h2>
                <p class="text-gray-500 mt-4 max-w-xl mx-auto">Pilih kelas yang sesuai dengan tujuan kebugaranmu</p>
            </div>
            <div class="grid md:grid-cols-4 gap-6">
                <div class="bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition">
                    <img src="https://images.unsplash.com/photo-1517836357463-d25dfeac3438?q=80&w=2070" alt="Body Building" class="h-48 w-full object-cover">
                    <div class="p-6">
                        <h3 class="font-bold text-lg">Body Building</h3>
                        <p class="text-gray-500 text-sm mt-2">Senin, Rabu, Jumat</p>
                        <p class="text-gray-500 text-sm">06:00 - 07:30</p>
                        <a href="#" class="mt-4 inline-block text-red-500 font-semibold text-sm hover:text-red-700 transition">Selengkapnya →</a>
                    </div>
                </div>
                <div class="bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition">
                    <img src="https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?q=80&w=1920" alt="Yoga" class="h-48 w-full object-cover">
                    <div class="p-6">
                        <h3 class="font-bold text-lg">Yoga</h3>
                        <p class="text-gray-500 text-sm mt-2">Selasa, Kamis, Sabtu</p>
                        <p class="text-gray-500 text-sm">07:00 - 08:00</p>
                        <a href="#" class="mt-4 inline-block text-red-500 font-semibold text-sm hover:text-red-700 transition">Selengkapnya →</a>
                    </div>
                </div>
                <div class="bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition">
                    <img src="https://images.unsplash.com/photo-1599058945522-28d584b6f0ff?q=80&w=2069" alt="Cardio" class="h-48 w-full object-cover">
                    <div class="p-6">
                        <h3 class="font-bold text-lg">Cardio</h3>
                        <p class="text-gray-500 text-sm mt-2">Senin - Sabtu</p>
                        <p class="text-gray-500 text-sm">08:00 - 09:00</p>
                        <a href="#" class="mt-4 inline-block text-red-500 font-semibold text-sm hover:text-red-700 transition">Selengkapnya →</a>
                    </div>
                </div>
                <div class="bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition">
                    <img src="https://images.unsplash.com/photo-1534258936925-c58bed479fcb?q=80&w=1931" alt="Zumba" class="h-48 w-full object-cover">
                    <div class="p-6">
                        <h3 class="font-bold text-lg">Zumba</h3>
                        <p class="text-gray-500 text-sm mt-2">Selasa, Kamis</p>
                        <p class="text-gray-500 text-sm">17:00 - 18:00</p>
                        <a href="#" class="mt-4 inline-block text-red-500 font-semibold text-sm hover:text-red-700 transition">Selengkapnya →</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="kontak" class="py-20 px-4 bg-black text-white">
        <div class="max-w-7xl mx-auto">
            <div class="grid md:grid-cols-2 gap-12">
                <div>
                    <span class="text-red-500 font-semibold uppercase tracking-widest text-sm">Kontak</span>
                    <h2 class="text-4xl font-extrabold mt-2 mb-6">Hubungi Kami</h2>
                    <p class="text-gray-400 mb-8">Siap memulai perjalanan fitness-mu? Kunjungi atau hubungi kami sekarang.</p>
                    <div class="space-y-4 text-gray-300">
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span>Jl. Zainal Abidin Pagar Alam No. 9-11, Labuhan Ratu, Kota Bandar Lampung, Provinsi Lampung</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            <span>+62 21 1234 5678</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <span>info@gymtekno.com</span>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-900 rounded-2xl p-8">
                    <h3 class="text-2xl font-bold mb-6">Kirim Pesan</h3>
                    <form class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <input type="text" placeholder="Nama" class="bg-gray-800 text-white rounded-lg px-4 py-3 w-full focus:outline-none focus:ring-2 focus:ring-red-500">
                            <input type="email" placeholder="Email" class="bg-gray-800 text-white rounded-lg px-4 py-3 w-full focus:outline-none focus:ring-2 focus:ring-red-500">
                        </div>
                        <textarea rows="4" placeholder="Pesan" class="bg-gray-800 text-white rounded-lg px-4 py-3 w-full focus:outline-none focus:ring-2 focus:ring-red-500"></textarea>
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-8 py-3 rounded-lg font-semibold transition w-full">Kirim Pesan</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-gray-900 text-gray-400 py-8 px-4">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between">
            <p>&copy; {{ date('Y') }} GymTekno. All rights reserved.</p>
            <div class="flex space-x-6 mt-4 md:mt-0">
                <a href="#" class="hover:text-white transition">Instagram</a>
                <a href="#" class="hover:text-white transition">Facebook</a>
                <a href="#" class="hover:text-white transition">Twitter</a>
            </div>
        </div>
    </footer>

</body>
</html>
