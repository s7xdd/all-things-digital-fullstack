import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                // 'resources/css/app.css',
                // 'resources/js/app.js',
                'dist/assets/app-ab0e78c4.js',
                'dist/assets/app-bfd32cbf.css',
                'dist/assets/app-f055accc.css'
            ],
            refresh: true,
        }),
    ],
    build: {
        outDir: 'dist',
        emptyOutDir: true,
    }
});
