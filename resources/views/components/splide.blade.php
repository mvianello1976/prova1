@props(['type' => 'loop', 'autoplay' => false, 'perPage' => 1, 'loop' => false, 'arrows' => true, 'pagination' => true, 'gap' => '1rem', 'padding' => '1rem', 'breakpoints' => []])
@assets
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/css/splide.min.css">
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>
<style>
    .splide__pagination {
        transform: translateY(1.5rem);
    }
    .splide__pagination__page {
        background-color: #cccccc;
    }
    .splide__pagination__page.is-active {
        background-color: #3c3c3c;
    }
</style>
@endassets

<div
    x-data="{
        init() {
            var splide = new Splide(this.$refs.splide, {
                type: @js($type),
                drag: true,
                autoplay: @json($autoplay),
                perPage: @js($perPage),
                arrows: @json($arrows),
                gap: @js($gap),
                autoWidth: true,
                padding: @js($padding),
                pagination: @json($pagination),
                mediaQuery: 'min',
                breakpoints: @js($breakpoints),
            });

            addEventListener('prev_' + $id('splide'), function() {
                splide.go('-1');
            }),
            addEventListener('next_' + $id('splide'), function() {
                splide.go('+1');
            })

            splide.mount()
        },
    }"
>
    <section x-ref="splide" class="splide">
        <div class="splide__arrows">
            @isset($navigation)
                <button class="splide__arrow splide__arrow--prev">
                    {{ $navigation }}
                </button>
                <button class="splide__arrow splide__arrow--next">
                    {{ $navigation }}
                </button>
            @endisset
        </div>
        <div class="splide__track pb-6">
            <ul class="splide__list">
                {{ $slot }}
            </ul>
        </div>
    </section>
</div>
