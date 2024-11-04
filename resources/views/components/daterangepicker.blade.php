@props(['single' => false, 'opens' => 'center', 'drops' => 'down', 'label'])

@assets
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
@endassets

<div
    x-data="{
        value: @entangle($attributes->wire('model')),
        init() {
            $(this.$refs.picker).daterangepicker({
                locale: {
                  format: 'DD/MM/YYYY'
                },
                drops: @js($drops),
                opens: @js($opens),
                singleDatePicker: @json($single),
                autoApply: true,
                autoUpdateInput: false,
                minDate: moment(),
                startDate: this.value[0],
                endDate: this.value[1],
            }, (start, end) => {
                this.value[0] = start.format('DD/MM/YYYY')
                this.value[1] = end.format('DD/MM/YYYY')
            })

            this.$watch('value', () => {
                $(this.$refs.picker).data('daterangepicker').setStartDate(this.value[0])
                $(this.$refs.picker).data('daterangepicker').setEndDate(this.value[1])
            })

            $(this.$refs.picker).on('apply.daterangepicker', function(ev, picker) {
                if(picker.singleDatePicker) {
                    $(this).val(picker.startDate.format('DD/MM/YYYY'));
                } else {
                    $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
                }
            })
        },
    }"
    class="max-w-sm w-full"
>
    <div x-ref="picker">
        <div
            class="relative min-h-14 mx-auto w-full max-w-sm bg-white border border-e2eaeb rounded-[30px] flex flex-col justify-center divide-y px-4 lg:hidden">
            <div class="flex items-center h-14 space-x-2.5">
                @isset($icon)
                    <div class="text-ffbb7c">
                        {{ $icon }}
                    </div>
                @endisset
                <span class="text-sm text-0d171a">
                    {{ $title }}
                </span>
            </div>
            {{--            <input type="hidden" value="" class="w-full rounded-md border border-gray-200 py-2.5 pl-12 pr-3">--}}
        </div>
    </div>


    {{--    <div class="relative">--}}
    {{--        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">--}}
    {{--            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-900" fill="none" viewBox="0 0 24 24"--}}
    {{--                 stroke="currentColor" stroke-width="2">--}}
    {{--                <path stroke-linecap="round" stroke-linejoin="round"--}}
    {{--                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>--}}
    {{--            </svg>--}}
    {{--        </div>--}}

    {{--        <input type="text" x-ref="picker" value="" class="w-full rounded-md border border-gray-200 py-2.5 pl-12 pr-3">--}}
    {{--    </div>--}}
</div>
