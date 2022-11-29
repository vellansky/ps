</section>
<footer class="w-full mt-10">
    <div>
        <p class="cursor-default">

            @if (empty($policy->site_policy))
                <div class="fixed inset-0 bg-black/60 flex items-center justify-center ">
                    <div class="w-2/3 h-2/3 bg-white rounded-2xl flex justify-center">
                        <div class="w-1/3">
                            <h6 class="mt-5 text-2xl italic">Добро пожаловать в магазин Papa Smoke</h6>
                            <div class="border-y-2 py-10 my-5 space-y-5">
                                <p class="text-3xl">Вам исполнилось 18 лет?</p>
                                <div x-data >
                                    <button @click="$policy.buttonPolicy('no')" class="rounded-md px-2 py-3 bg-gray-200">Нет</button>
                                    <button @click="$policy.buttonPolicy('yes')" class="rounded-md px-2 py-3 bg-yellow-400">Да, мне исполнилось 18 лет</button>
                                </div>
                            </div>
                            <div>
                                    <p class="">
                                        Мы используем файлы cookie для наилучшего взаимодействия.
                                        Соглашаясь с возрастом, вы так же принимаете согласие на дальнейшую обработку данных на этом сайте.
                                    </p>
                            </div>

                        </div>
                    </div>


                </div>
            @endif



            Интернет магазин Papa Smoke не занимается продажей своей продукции дистанционным способом и предназначен для лиц 18+
        </p>
    </div>
</footer>
<script src="{{ mix('user/js/user.js') }}"></script>
</body>
</html>
