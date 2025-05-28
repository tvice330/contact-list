import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import path from 'path'

export default defineConfig({
    plugins: [vue()],
    build: {
        outDir: 'dist',
        rollupOptions: {
            input: path.resolve(__dirname, 'resources/js/contact-list-app.js'),
            output: {
                entryFileNames: 'contact-list-app.js',
                assetFileNames: 'contact-list-app.[ext]'
            }
        }
    }
})