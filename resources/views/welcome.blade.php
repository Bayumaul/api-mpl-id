<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Unofficial MPL Indonesia</title>
    <!-- Tautan ke Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Gaya Khusus */
        .custom-bg-blue {
            background-color: #032541;
        }

        .custom-bg-light-blue {
            background-color: #E6F7FF;
        }

        .custom-bg-light-gray {
            background-color: #F4F4F4;
        }

        .custom-bg-lighter-blue {
            background-color: #D0E9FF;
        }

        .custom-bg-lightest-blue {
            background-color: #C1E1FF;
        }

        .custom-bg-dark-blue {
            background-color: #8EB9FF;
        }
    </style>
</head>

<body class="bg-gray-100">

    <!-- Navigasi -->
    <nav class="bg-white py-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="#" class="text-xl font-semibold">API MPL Indonesia</a>
            <ul class="hidden md:flex space-x-6">
                <li><a href="#features" class="hover:text-blue-500">Fitur</a></li>
                <li><a href="#documentation" class="hover:text-blue-500">Dokumentasi</a></li>
                <li><a href="#about" class="hover:text-blue-500">Tentang Kami</a></li>
                <li><a href="#contact" class="hover:text-blue-500">Kontak</a></li>
            </ul>
            <div class="md:hidden">
                <button class="mobile-menu-button">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <header class="custom-bg-blue py-60 text-center text-white relative">
        <img src="{{ asset('MPLID_BANNER.jpg') }}" alt="Banner"
            class="absolute inset-0 w-full h-full object-cover opacity-50">
        <div class="container mx-auto relative z-10">
            <h1 class="text-4xl md:text-6xl font-semibold mb-2">API Unofficial MPL Indonesia</h1>
            <p class="text-lg md:text-xl mb-8">Akses Data MPL Indonesia dengan Mudah</p>
            <a href="#documentation"
                class="bg-white text-blue-500 hover:bg-blue-500 hover:text-white px-6 py-3 rounded-full font-semibold transition duration-300 ease-in-out">Mulai
                Gunakan</a>
            <p class="text-sm text-gray-300 mt-4">API ini adalah tidak resmi dan tidak berafiliasi dengan MPL Indonesia
                secara resmi.</p>
        </div>
    </header>

    <!-- Fitur -->
    <section id="features" class="custom-bg-light-blue py-16">
        <div class="container mx-auto">
            <h2 class="text-3xl font-semibold text-center mb-8">Fitur Utama</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div class="bg-white p-6 rounded shadow">
                    <h3 class="text-xl font-semibold mb-4">Endpoint Data Lengkap</h3>
                    <p class="text-gray-600">Akses ke berbagai data statistik dan informasi terkini dari MPL Indonesia.
                    </p>
                </div>
                <div class="bg-white p-6 rounded shadow">
                    <h3 class="text-xl font-semibold mb-4">Integrasi Mudah</h3>
                    <p class="text-gray-600">Integrasikan API dengan mudah ke dalam aplikasi atau situs web Anda.</p>
                </div>
                <div class="bg-white p-6 rounded shadow">
                    <h3 class="text-xl font-semibold mb-4">Dokumentasi Lengkap</h3>
                    <p class="text-gray-600">Panduan lengkap untuk menggunakan API, termasuk contoh kode dan endpoint.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Dokumentasi -->
    <section id="documentation" class="custom-bg-light-gray py-16">
        <div class="container mx-auto">
            <div class="text-center">
                <h2 class="text-3xl font-semibold mb-4">Dokumentasi</h2>
                <p class="text-gray-600 mb-8">Panduan lengkap untuk mulai menggunakan API Unofficial MPL Indonesia.
                    Segera akses data berharga dari MPL Indonesia.</p>
                <a href="{{ url('api/documentation') }}"
                    class="bg-blue-500 text-white px-6 py-3 rounded-full font-semibold transition duration-300 ease-in-out hover:bg-blue-600">Dokumentasi</a>
            </div>
        </div>
    </section>

    <!-- Keterangan Tidak Resmi -->
    <section id="unofficial" class="custom-bg-lighter-blue py-16">
        <div class="container mx-auto text-center px-10">
            <h2 class="text-2xl md:text-4xl font-semibold mb-4">API Unofficial MPL Indonesia</h2>
            <p class="text-lg text-gray-600 mb-6">Kami ingin menjelaskan bahwa API yang kami buat adalah tidak resmi dan
                tidak berafiliasi dengan MPL Indonesia secara resmi. API ini dibuat untuk tujuan pembelajaran dan
                pengembangan proyek pribadi.</p>
            <p class="text-sm text-gray-400">Silakan gunakan API ini dengan bijak dan sesuai dengan pedoman penggunaan
                yang berlaku. Untuk informasi lebih lanjut, silakan lihat <a href="#"
                    class="text-blue-500 hover:underline">Syarat dan Ketentuan</a>.</p>
        </div>
    </section>

    <!-- Tentang Kami -->
    <section id="about" class="custom-bg-lightest-blue py-16">
        <div class="container mx-auto text-center px-10">
            <h2 class="text-2xl md:text-4xl font-semibold mb-4">Tentang Kami</h2>
            <p class="text-lg text-gray-600 mb-6">Halo, nama saya Bayu Maulana Ikhsan. Saya adalah pengembang perangkat
                lunak yang telah membuat API Unofficial MPL Indonesia ini. API ini adalah hasil dari upaya saya dalam
                memberikan akses data yang mudah bagi komunitas MPL Indonesia.</p>
            <p class="text-lg text-gray-600 mt-6">Saya percaya bahwa API ini dapat memberikan manfaat bagi pengguna yang
                ingin mengakses informasi terkini tentang MPL Indonesia.</p>
        </div>
    </section>
    <!-- Kontribusi -->
    <section id="contribute" class="custom-bg-dark-blue py-16">
        <div class="container mx-auto text-center px-10">
            <h2 class="text-2xl md:text-4xl font-semibold mb-4">Berkontribusi</h2>
            <p class="text-lg text-gray-600 mb-6">Kami mengundang Anda untuk berkontribusi pada pengembangan API
                Unofficial MPL Indonesia. Jika Anda memiliki pengetahuan dan keterampilan yang ingin Anda bagikan, kami
                sangat menghargai setiap kontribusi yang Anda berikan.</p>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Card 1 -->
                <div class="bg-white rounded-lg p-6 shadow-md">
                    <h3 class="text-xl font-semibold mb-2">Menambahkan Fitur Baru</h3>
                    <p class="text-gray-600">Anda dapat membantu kami dengan menambahkan fitur baru yang dapat
                        memperkaya fungsionalitas API.</p>
                </div>
                <!-- Card 2 -->
                <div class="bg-white rounded-lg p-6 shadow-md">
                    <h3 class="text-xl font-semibold mb-2">Memperbaiki Bug</h3>
                    <p class="text-gray-600">Apabila Anda menemukan bug atau masalah dalam API, Anda dapat membantu kami
                        dengan memperbaikinya.</p>
                </div>
                <!-- Card 3 -->
                <div class="bg-white rounded-lg p-6 shadow-md">
                    <h3 class="text-xl font-semibold mb-2">Meningkatkan Dokumentasi</h3>
                    <p class="text-gray-600">Kontribusi tidak hanya pada kode, tetapi juga pada dokumentasi, agar
                        pengguna dapat lebih mudah memahami dan menggunakan API ini.</p>
                </div>
            </div>
            <p class="text-lg text-gray-600 mt-6">Jika Anda tertarik untuk berkontribusi, silakan kunjungi repositori
                kami di <a href="#" class="text-blue-500 hover:underline">GitHub</a>.</p>
        </div>
    </section>

    <!-- Kontak -->
    <section id="contact" class="custom-bg-light-blue py-16">
        <div class="container mx-auto px-10">
            <div class="text-center">
                <h2 class="text-3xl font-semibold mb-4">Hubungi Kami</h2>
                <p class="text-gray-600 mb-8">Kami siap membantu Anda! Silakan hubungi kami jika Anda memiliki
                    pertanyaan atau memerlukan dukungan terkait penggunaan API kami.</p>
                <a href="mailto:bayu.maulanaikhsan123@gmail.com"
                    class="bg-blue-500 text-white px-6 py-3 rounded-full font-semibold transition duration-300 ease-in-out hover:bg-blue-600">Kirim
                    Email</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="custom-bg-lighter-blue py-8">
        <div class="container mx-auto text-center">
            <p class="text-gray-600">&copy; 2023 API MPL Indonesia</p>
        </div>
    </footer>
    <!-- Script untuk mobile menu toggle -->
    <script>
        const mobileMenuButton = document.querySelector('.mobile-menu-button');
        const navList = document.querySelector('ul');

        mobileMenuButton.addEventListener('click', () => {
            navList.classList.toggle('hidden');
        });
    </script>
</body>

</html>
