@props(['href' => null, 'color' => null])
@php
    $default_classes = 'inline-flex text-sm items-center justify-center px-8 py-2.5 font-semibold rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150 disabled:opacity-50 disabled:cursor-not-allowed';

   switch($color) {
        case 'orange':
            $default_classes .= ' bg-ffbb7c text-white hover:bg-ffa14a';
            break;
             case 'red':
            $default_classes .= ' bg-ff7968 text-white hover:bg-e57868';
            break;
            case 'gray':
            $default_classes .= ' bg-fafcfc ring-1 ring-e2eaeb text-b0b7be hover:bg-e2eaeb hover:text-1e2e33';
            break;
            case 'white':
            $default_classes .= ' bg-white text-1e2e33 hover:bg-1e2e33 hover:text-white';
            break;
            case 'black':
                $default_classes .= ' bg-0d171a text-white hover:bg-1e2e33';
                break;
                case 'lightblue':
                $default_classes .= ' bg-d3ecff ring-1 ring-006cbc text-006cbc hover:bg-006cbc hover:text-white';
                break;
                case 'blue':
                $default_classes .= ' bg-00abc0 text-white hover:bg-03b8ce';
                break;
                case 'green':
                $default_classes .= ' bg-67b26a text-white hover:bg-259332';
                break;
                case 'fluoblue':
                    $default_classes .= ' bg-3ed1ca text-white hover:bg-00abc0';
            default:
                $default_classes .= ' text-627277';
   }
@endphp
@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $default_classes]) }}
    tabindex="-1"
    >
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['type' => 'submit', 'class' => $default_classes]) }}
            tabindex="-1"
    >
        {{ $slot }}
    </button>
@endif
