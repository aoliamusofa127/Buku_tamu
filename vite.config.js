import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import Highcharts from 'https://code.highcharts.com/es-modules/masters/highcharts.src.js';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
