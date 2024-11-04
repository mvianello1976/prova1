import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';
import container from '@tailwindcss/container-queries';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    safelist: [
        {
            pattern: /(max|min)-(w)-(sm|md|lg|xl|2xl|3xl|4xl|5xl|6xl|7xl)/,
            variants: ["sm", "md", "lg", "xl"],
        },
    ],
    theme: {
        container: {
            center: true,
            padding: {
                DEFAULT: '1rem',
            },
            screens: {
                '2xl': '1520px',
            }
        },
        extend: {
            fontFamily: {
                sans: ['Instrument Sans', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                "ffffff": "#FFFFFF",
                "fafcfc": "#FAFCFC",
                "f0fdff": "#F0FDFF",
                "eff4f5": "#EFF4F5",
                "e2eaeb": "#E2EAEB",
                "d3ecff": "#D3ECFF",
                "defbff": "#DEFBFF",
                "fff9f4": "#FFF9F4",
                "fff2e6": "#FFF2E6",
                "fcebf5": "#fcebf5",
                "e568b5": "#e568b5",
                "e8faed": "#E8FAED",
                "b5eac4": "#B5EAC4",
                "e6ffe7": "#e6ffe7",
                "67b26a": "#67B26A",
                "4c9b5e": "#4C9B5E",
                "259332": "#259332",
                "3ed1ca": "#3ED1CA",
                "00abc0": "#00ABC0",
                "03b8ce": "#03B8CE",
                "006cbc": "#006CBC",
                "627277": "#627277",
                "1e2e33": "#1E2E33",
                "0d171a": "#0D171A",
                "b0b7be": "#B0B7BE",
                "fdac61": "#FDAC61",
                "ffa368": "#FFA368",
                "ffa14a": "#FFA14A",
                "ffbb7c": "#FFBB7C",
                "e57868": "#E57868",
                "ff7968": "#FF7968",
                "fdebe8": "#FDEBE8",
                "fff4ed": "#FFF4ED"
            },
            strokeWidth: {
                '1.5': '1.5px'
            }
        },
    },

    plugins: [forms, typography, container],
};
