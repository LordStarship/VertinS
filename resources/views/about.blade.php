<x-layout>
    <div class="h-full w-full bg-gradient-to-b from-gray-100 to-teal-100 flex flex-col">
        <div class="mt-12 mb-20 flex-1 h-1/6 w-full flex justify-center items-center">
            <p class="text-primary font-bold text-4xl tracking-wider">ABOUT US</p>
        </div>
        <div class="flex-1 h-4/6 w-full flex justify-center items-center">
            <div class="w-1/2 h-full ml-4 flex items-center justify-center">
                <p class="ml-12 mr-12 text-primary font-normal text-lg text-balance italic">
                    Ava'Lestial adalah sebuah grup yang berkutat di bidang penjualan akun game sejak tahun 2020 dan terus berkembang tanpa henti hingga sekarang. Grup yang sekarang beranggotakan 10 orang ini telah berekspansi ke berbagai macam bidang yang berhubungan dengan video game. Ava'Lestial sudah dipercayai oleh ribuan customer dengan pengalaman yang mumpuni dan jaminan semua proses transaksi berlangsung secara aman. 
                </p>
            </div>
            <div class="w-1/2 h-full r-4">
                <div class="flex items-center h-full">
                    <img class="rounded-2xl h-38" src={{ asset('storage/img/img-avalestial.png') }}>
                </div>
            </div>
        </div>
        <div class="mt-16 mb-10 flex-1 h-2/6 w-full flex justify-center items-center flex-col">
            <p class="font-bold text-xl text-primary">Kunjungi kami di website di bawah ini!</p>
            <div class="mt-8 flex justify-center items-center flex-row">
                <a href="https://fb.itemku.com/sqNn" target="_blank">
                    <div class="mx-6 flex flex-col">
                        <p class="mb-2 text-center font-medium text-lg text-primary italic">Itemku</p>
                        <div class="flex items-center h-full">
                            <img class="rounded-2xl h-32 w-32" src={{ asset('storage/img/img-itemku.png') }}>
                        </div>
                    </div>
                </a>
                <a href="https://zeusx.com/id/seller/avalestial-629654" target="_blank">
                    <div class="mx-6 flex flex-col">
                        <p class="mb-2 text-center font-medium text-lg text-primary italic">ZeusX</p>
                        <div class="flex items-center h-full">
                            <img class="rounded-2xl h-32 w-32" src={{ asset('storage/img/img-zeusx.png') }}>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div> 
</x-layout>