<template>
    <div class="text-sm">
        <div class="rounded p-5 bg-gray-100">
            <div class="flex flex-col justify-start mt-2">
            <p class="py-2 my-2 text-gray-600 border-b font-bold">Интерактивные элементы</p>
                <router-link :to="{ name: 'settingsSlider'}" class="py-2 bg-gray-50 pl-4 mt-2 rounded text-gray-500 hover:text-black hover:bg-gray-200 cursor-pointer">
                    Слайдер на главной
                </router-link>
                <router-link :to="{ name: 'settingsBannerHead'}" class="py-2 bg-gray-50 pl-4 mt-2 rounded text-gray-500 hover:text-black hover:bg-gray-200 cursor-pointer">
                    Баннер сверху
                </router-link>
            </div>
            <div class="flex flex-col justify-start mt-2">
            <p class="py-2 my-2 text-gray-600 border-b font-bold"> Настройки магазина</p>
                <router-link :to="{ name: 'settingsCity'}" class="py-2 bg-gray-50 pl-4 mt-2 rounded text-gray-500 hover:text-black hover:bg-gray-200 cursor-pointer">
                    Управление магазинами
                </router-link>
                <a class="py-2 bg-gray-50 pl-4 mt-2 rounded text-gray-500 hover:text-black hover:bg-gray-200 cursor-pointer">Склад</a>
            </div>
            <div class="flex flex-col justify-start mt-2">
            <p class="py-2 my-2 text-gray-600 border-b font-bold">Реклама</p>
                <a class="py-2 bg-gray-50 pl-4 mt-2 rounded text-gray-500 hover:text-black hover:bg-gray-200 cursor-pointer">seo</a>
            </div>

        </div>
    </div>
</template>
