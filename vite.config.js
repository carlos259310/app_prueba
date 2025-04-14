import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        laravel({
          //  input: 'resources/js/app.jsx',
          input: ['resources/css/app.css', 'resources/js/app.tsx'], // Asegúrate de que el archivo esté aquí  
          refresh: true,
        }),
        react(),
    ],
});
