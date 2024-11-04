@props(['image' => null, 'title' => null])
<div class="group shrink-0 hover:cursor-pointer">
    <div
        class="relative flex items-end p-4 w-80 h-60 rounded-md overflow-hidden xl:w-[360px]">
        <img
            src="{{ $image }}"
            alt=""
            class="absolute inset-0 w-full h-full"
        >
        <div class="absolute inset-0 bg-gradient-to-t from-0d171a/80 via-0d171a/60 via-30%"></div>
        <div class="flex flex-col items-center z-[5] mx-auto">
            <h4 class="font-semibold text-xl text-white text-center transition-transform lg:translate-y-24 group-hover:translate-y-0 xl:max-w-48">
                {{ $title }}
            </h4>
            <div class="grid grid-cols-2 mt-6 gap-3 transition-transform lg:translate-y-24 group-hover:translate-y-0">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
