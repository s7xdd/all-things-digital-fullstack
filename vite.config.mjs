import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                // 'resources/css/app.css',
                // 'resources/js/app.js',
                'public/build/assets/app-ab0e78c4-dd6fdc47.js',
                'public/build/assets/app-bfd32cbf-bfd32cbf.css',
                'public/build/assets/app-f055accc-f055accc.css',
            ],
            refresh: true,
        }),
    ],
    build: {
        outDir: 'dist',
        emptyOutDir: true,
    }
});
