<x-header />
<section class="cursor-default">
    <div class="py-5">
        <h1 class="text-2xl font-semibold tracking-wide ">Контакты наших магазинов</h1>
    </div>
    {{ $shop }}
    <div class="flex flex-wrap space-x-10">
    <div class="bg-gradient-to-b from-indigo-500 via-purple-500 to-pink-500 relative rounded-lg bg-white h-60 w-1/2">
        <h2 class="text-xl  absolute top-10 left-5 font-black text-white">Расположение на карте в Юрге</h2>
    </div>
        <div class="flex flex-col gap-y-5 items-center justify-center">
            <div class="bg-white rounded-lg  h-40 w-full px-10 py-5">
                <h2 class="text-xl font-black ">Адрес в Томске</h2>

                <h2 class="text-xl font-black ">Адрес в других городах</h2>

            </div>
            <div class="bg-white rounded-lg  h-40 w-full px-10 py-5">
                <h2 class="text-xl font-black ">Телефон в Томске</h2>
                <h2 class="text-xl font-black ">Телефон в других городах</h2>

            </div>
        </div>
    </div>

</section>
<x-footer-shop />
