<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold leading-tight text-center text-gray-800 dark:text-gray-200">
            {{ __('Welcome to Voucher Game') }}
        </h2>
    </x-slot>

    <!-- Carousel Section -->
    <div x-data="{
        activeSlide: 0,
        slides: [
            'https://w0.peakpx.com/wallpaper/335/1006/HD-wallpaper-gamer-3d-gaming-playstation-playstation5-sony-xbox.jpg',
            'https://w0.peakpx.com/wallpaper/770/791/HD-wallpaper-control4-controller-gamer-games-gaming-playstation-ps4.jpg',
            'https://w0.peakpx.com/wallpaper/785/469/HD-wallpaper-steam-gaming-android-computer-cool-gamer-gaming-pc-stam-steam-stem.jpg'
        ]
    }" class="relative h-screen">
        <template x-for="(slide, index) in slides" :key="index">
            <div x-show="activeSlide === index"
                class="absolute inset-0 h-full transition-all duration-700 bg-center bg-cover"
                :style="'background-image: url(' + slide + ');'">
                <div class="flex items-center justify-center h-full bg-black bg-opacity-50">
                    <div class="text-center text-white">
                        <h1 class="text-4xl font-bold md:text-6xl">INI VOUCHER GAME.COM</h1>
                        <p class="mt-4 text-base md:text-lg">Top Up Mudah, Dan Berkualitas Disini Aja !</p>
                        <a href="#"
                            class="inline-block px-6 py-2 mt-6 text-base font-medium text-white bg-indigo-600 border border-transparent rounded-md md:px-8 md:py-3 hover:bg-indigo-700">
                            Our Offers
                        </a>
                    </div>
                </div>
            </div>
        </template>

        <!-- Carousel Controls -->
        <div class="absolute inset-0 flex items-center justify-between px-4">
            <button @click="activeSlide = activeSlide > 0 ? activeSlide - 1 : slides.length - 1"
                class="px-2 py-1 text-white bg-gray-800 bg-opacity-50 rounded-full hover:bg-opacity-75 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
            <button @click="activeSlide = activeSlide < slides.length - 1 ? activeSlide + 1 : 0"
                class="px-2 py-1 text-white bg-gray-800 bg-opacity-50 rounded-full hover:bg-opacity-75 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        </div>

        <!-- Indicators -->
        <div class="absolute bottom-0 left-0 right-0 flex justify-center pb-4 space-x-2">
            <template x-for="(slide, index) in slides" :key="index">
                <button @click="activeSlide = index" class="w-3 h-3 rounded-full focus:outline-none"
                    :class="{ 'bg-white': activeSlide === index, 'bg-gray-500': activeSlide !== index }"></button>
            </template>
        </div>
    </div>

    <!-- Features Section -->
    <div class="py-12 bg-gray-100 dark:bg-gray-900">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="mb-4 text-2xl font-bold">Apa sih keuntungan kamu Top Up di Website ini ?</h2>
                    <ul class="pl-6 list-disc">
                        <li class="mb-2">Sangat mudah dalam memproses kan semua game, tidak tunggu lama sampai 5 menit
                            akun mu sudah dipasti kan sudah di Top Up.</li>
                        <li class="mb-2">Terpercaya untuk semua jenis game, kami tidak menipu tapi kami memeras duit
                            anda untuk Top Up selalu.</li>
                        <li class="mb-2">Kualitas keamanan sangat di tangguhkan dari kami agar pembeli selalu aman
                            dalam Transaksi.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- About Section -->
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="mb-4 text-2xl font-bold">About Us</h2>
                    <p class="mb-4">
                        Toko INI GAME.COM mengkhususkan diri dalam menyediakan produk dengan kualitas terbaik bagi
                        pelanggan kami.
                        Kami memiliki tim berdedikasi yang memastikan setiap produk memenuhi standar tertinggi.
                    </p>
                    <p>
                        Misi kami adalah memberikan produk terbaik dengan tetap menjaga praktik berkelanjutan dan etis.
                        Kami percaya dalam membangun masa depan yang lebih baik melalui komitmen kami terhadap kualitas
                        dan inovasi.
                    </p>
                    <h3 class="mt-6 mb-2 text-xl font-semibold">Why Choose Us?</h3>
                    <ul class="pl-6 list-disc">
                        <li class="mb-2"><strong>Kualitas Tak Tertandingi:</strong> Kami memastikan bahwa setiap
                            voucher 100% sah dan terverifikasi, memberi Anda ketenangan pikiran dalam setiap pembelian.
                        </li>
                        <li class="mb-2"><strong>Pengiriman Instan:</strong> Sistem kami dirancang untuk pengiriman
                            instan, sehingga Anda dapat mulai menikmati pembelian Anda tanpa penundaan.</li>
                        <li class="mb-2"><strong>Harga yang terjangkau:</strong> Kami menawarkan harga paling
                            kompetitif di pasar, memastikan Anda mendapatkan nilai terbaik untuk uang Anda.</li>
                        <li class="mb-2"><strong>24/7 Customer Support:</strong> Tim dukungan pelanggan kami yang
                            berdedikasi tersedia 24/7 untuk membantu Anda dengan pertanyaan atau masalah apa pun yang
                            mungkin Anda miliki.</li>
                        <li class="mb-2"><strong>Platform yang Ramah Pengguna:</strong> Website kami didesain
                            user-friendly sehingga memudahkan Anda dalam menelusuri, memilih, dan membeli voucher.</li>
                        <li class="mb-2"><strong>Secure Transactions:</strong> Kami menggunakan langkah-langkah
                            keamanan tingkat lanjut untuk melindungi informasi pribadi Anda dan memastikan transaksi
                            aman.</li>
                    </ul>
                    <p class="mt-4">
                        Kami berkomitmen untuk memberikan pelayanan terbaik dan menjamin kepuasan pelanggan. Pilih kami
                        untuk semua kebutuhan voucher game Anda dan rasakan perbedaannya!
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
