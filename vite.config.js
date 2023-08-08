import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    build: {
        manifest: true,
        rollupOptions: {
            input: {
                app: 'resources/js/app.js',
                index: 'resources/js/index.js',
                recruit: 'resources/js/recruit/recruit.js',
                companyDetail: 'resources/js/recruit/companyDetail.js',
            }
        }
    }
});
