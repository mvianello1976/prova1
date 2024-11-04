@props(['image' => null, 'title' => null, 'activities' => null])
<div class="group shrink-0 hover:cursor-pointer">
    <div class="relative flex items-end p-4 w-60 h-40 rounded-md overflow-hidden xl:w-72">
        <img
            src="{{ $image }}"
            alt=""
            class="absolute inset-0 transition-transform group-hover:scale-110"
        >
        <div class="absolute inset-0 bg-gradient-to-t from-0d171a/80 via-0d171a/60 via-30%"></div>
        <div class="w-full z-[5]">
            <h4 class="font-semibold text-xl text-white text-left lg:text-center">{{ $title }}</h4>
            <div class="flex items-center mt-1 space-x-2 lg:hidden">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
