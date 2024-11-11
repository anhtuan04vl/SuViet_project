import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',           // CSS chính
                'resources/css/style.css',         // CSS phụ
                'resources/css/bootstrap.min.css',         // CSS phụ
                'resources/js/app.js',             // File JS chính
                'resources/js/admin.js',      // JS cho admin (Bootstrap)        
            ],
            refresh: true,
        }),
    ],
});
