<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Welcome to Voucher Game') }}
        </h2>
    </x-slot>

    <!-- Carousel Section -->
    <div x-data="{ activeSlide: 0, slides: ['https://images5.alphacoders.com/136/thumb-1920-1360655.png', 'https://wallpaperaccess.com/full/3942523.jpg', 'https://wallpapercave.com/wp/wp2462450.jpg'] }" class="relative h-screen bg-gray-400 dark:bg-gray-800">
        <template x-for="(slide, index) in slides" :key="index">
            <div x-show="activeSlide === index"
                class="absolute inset-0 h-full transition-all duration-500 bg-center bg-cover"
                :style="'background-image: url(' + slide + ');'">
                <div class="flex items-center justify-center h-full bg-black bg-opacity-50">
                    <div class="text-center text-white">
                        <h1 class="text-4xl font-bold md:text-6xl">Top Up Mudah</h1>
                        <h1 class="text-4xl font-bold md:text-6xl">Berkualitas </h1>
                        <p class="mt-4 text-lg">Dapatkan voucher game dengan harga terbaik hanya di sini.</p>
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
                <div class="flex flex-col h-full p-6 text-gray-900 dark:text-gray-100 md:flex-row">
                    <div class="w-full mb-4 bg-cover rounded-lg md:w-full h-96 md:mb-0"
                        style="background-image: url('https://i.pinimg.com/564x/a2/01/ff/a201ff131ced30e9af1681fd69b30c62.jpg');">
                    </div>
                    <div class="my-6 md:ml-10">
                        <h2 class="mb-4 text-4xl font-bold">Top Up Mudah dan Cepat</h2>
                        <p class="mt-10 text-lg">Kami memproses top up game Anda dengan cepat, tidak perlu menunggu
                            lama. Akun Anda akan terisi dalam waktu kurang dari 5 menit!</p>
                        <br>
                        <p class="text-lg">Kami juga menyediakan berbagai macam game yang dapat Anda top up, mulai dari
                            Mobile Legends, Clash of Clans, PUBG Mobile, Free Fire, hingga Valorant.</p>
                        <br>
                        <p class="text-lg">Dapatkan voucher game dengan harga terbaik hanya di sini. Kami menjamin
                            kepuasan pelanggan dengan layanan terbaik kami.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- More Features Section -->
    <div class="py-12 bg-white dark:bg-gray-900">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="text-center text-gray-900 dark:text-gray-100">
                <h2 class="mb-6 text-3xl font-bold">Kenapa Pilih Kami?</h2>
                <div class="flex flex-wrap justify-center mt-20">
                    <div class="w-full p-4 sm:w-1/3">
                        <div class="mb-4 bg-cover rounded-lg"
                            style="background-image: url('https://i.pinimg.com/564x/e9/b6/4d/e9b64d24696a9f49795c0b03980c7a7a.jpg'); height: 400px;">
                        </div>
                        <div class="p-4 bg-gray-300 rounded-lg dark:bg-gray-800">
                            <p class="text-lg font-semibold">Terpercaya</p>
                            <p class="mt-4">Kami menyediakan layanan yang dapat diandalkan untuk semua jenis game.</p>
                        </div>
                    </div>
                    <div class="w-full p-4 sm:w-1/3">
                        <div class="mb-4 bg-cover rounded-lg"
                            style="background-image: url('https://i.pinimg.com/736x/53/45/9c/53459c179ca08b7ad04b88341fa5f006.jpg'); height: 400px;">
                        </div>
                        <div class="p-4 bg-gray-300 rounded-lg dark:bg-gray-800">
                            <p class="text-lg font-semibold">Keamanan</p>
                            <p class="mt-4">Keamanan Anda adalah prioritas kami. Transaksi dijamin aman.</p>
                        </div>
                    </div>
                    <div class="w-full p-4 sm:w-1/3">
                        <div class="mb-4 bg-cover rounded-lg"
                            style="background-image: url('https://i.pinimg.com/564x/91/ed/b7/91edb7974b5e7b158ac996671f1e6211.jpg'); height: 400px;">
                        </div>
                        <div class="p-4 bg-gray-300 rounded-lg dark:bg-gray-800">
                            <p class="text-lg font-semibold">Harga Terjangkau</p>
                            <p class="mt-4">Dapatkan harga terbaik untuk setiap pembelian voucher game.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- About Us Section -->
    <div class="py-12 bg-gray-100 dark:bg-gray-900">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-lg dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-8">
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div class="p-4 bg-gray-200 rounded-lg shadow-md dark:bg-gray-700">
                                <h4 class="mb-2 text-2xl font-semibold">Visi Kami</h4>
                                <br>
                                <p>
                                    Visi kami adalah menjadi penyedia layanan top-up game terdepan yang terpercaya dan
                                    dapat diandalkan, memberikan nilai terbaik bagi pelanggan kami. Kami berusaha untuk
                                    terus berkembang dan berinovasi agar selalu dapat memenuhi kebutuhan pelanggan
                                    dengan standar tertinggi.
                                    <br><br>
                                    Kami percaya bahwa kepercayaan adalah fondasi dari hubungan yang baik dengan
                                    pelanggan, oleh karena itu kami selalu menjaga integritas dalam setiap aspek layanan
                                    kami.
                                </p>
                            </div>
                            <div class="p-4 bg-gray-200 rounded-lg shadow-md dark:bg-gray-700">
                                <h4 class="mb-2 text-2xl font-semibold">Misi Kami</h4>
                                <br>
                                <p>
                                    Misi kami adalah menyediakan produk terbaik dengan kualitas tertinggi sambil tetap
                                    menjaga praktik berkelanjutan dan etis. Kami berkomitmen untuk membangun masa depan
                                    yang lebih baik melalui inovasi dan kualitas layanan yang luar biasa.
                                    <br><br>
                                    Kami berfokus pada kepuasan pelanggan dengan menawarkan berbagai macam produk top-up
                                    game yang dapat memenuhi berbagai kebutuhan gaming pelanggan kami. Melalui
                                    pendekatan yang berorientasi pada pelanggan, kami berusaha untuk memberikan
                                    pengalaman terbaik yang dapat diandalkan dan aman.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                            <div class="p-4 bg-gray-200 rounded-lg shadow-md dark:bg-gray-700">
                                <h4 class="mb-2 text-2xl font-semibold">Integritas</h4>
                                <br>
                                <p>Kami menjaga kepercayaan pelanggan dengan menyediakan layanan yang jujur dan
                                    transparan.</p>
                            </div>
                            <div class="p-4 bg-gray-200 rounded-lg shadow-md dark:bg-gray-700">
                                <h4 class="mb-2 text-2xl font-semibold">Komitmen</h4>
                                <br>
                                <p>Kami berkomitmen untuk memberikan layanan terbaik dan memenuhi kebutuhan pelanggan.
                                </p>
                            </div>
                            <div class="p-4 bg-gray-200 rounded-lg shadow-md dark:bg-gray-700">
                                <h4 class="mb-2 text-2xl font-semibold">Inovasi</h4>
                                <br>
                                <p>Kami terus berinovasi untuk meningkatkan pengalaman pelanggan dan menyediakan solusi
                                    yang lebih baik.</p>
                            </div>
                            <div class="p-4 bg-gray-200 rounded-lg shadow-md dark:bg-gray-700">
                                <h4 class="mb-2 text-2xl font-semibold">Kualitas</h4>
                                <br>
                                <p>Kami memastikan bahwa setiap produk yang kami tawarkan memenuhi standar kualitas
                                    tertinggi.</p>
                            </div>
                            <div class="p-4 bg-gray-200 rounded-lg shadow-md dark:bg-gray-700">
                                <h4 class="mb-2 text-2xl font-semibold">Keamanan</h4>
                                <br>
                                <p>Kami mengutamakan keamanan dalam setiap transaksi untuk melindungi informasi pribadi
                                    pelanggan.</p>
                            </div>
                            <div class="p-4 bg-gray-200 rounded-lg shadow-md dark:bg-gray-700">
                                <h4 class="mb-2 text-2xl font-semibold">Pelayanan Pelanggan</h4>
                                <br>
                                <p>Kami menyediakan dukungan pelanggan yang responsif dan tersedia 24/7 untuk membantu
                                    Anda.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Call to Action Section -->
    <div class="py-12 text-center bg-gray-300 dark:bg-gray-800">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <h2 class="mb-6 text-2xl font-bold">Bergabunglah dengan Kami Sekarang</h2>
            <p>Nikmati kemudahan dan kenyamanan top up voucher game hanya di sini.</p>
            <p class="mb-10">
                Bergabunglah dengan ribuan pelanggan puas lainnya!
            </p>
            <a href="{{ route('register') }}"
                class="inline-block px-8 py-3 text-base font-medium text-white bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-800">
                Daftar Sekarang
            </a>
        </div>
    </div>
</x-app-layout>

<script>
    setTimeout(function() {
        let flashMessages = document.querySelectorAll('.flash-message');
        flashMessages.forEach(function(flashMessage) {
            flashMessage.style.transition = 'opacity 1s';
            flashMessage.style.opacity = '0';
            setTimeout(function() {
                flashMessage.style.display = 'none';
            }, 1000);
        });
    }, 2000);
</script>
