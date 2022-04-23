import { defineConfig } from 'vite';
import tailwindcss from 'tailwindcss';
import autoprefixer from 'autoprefixer';
import laravel from 'vite-plugin-laravel';
import vue from '@vitejs/plugin-vue';
import path from 'path';

export default defineConfig({
    server: {
        host: '0.0.0.0',
    },
    plugins: [
        laravel({
            postcss: [tailwindcss(), autoprefixer()],
        }),
        vue(),
    ],
	resolve: {
		alias: {
			'@': path.resolve(__dirname, './resources')
		}
	}
});
