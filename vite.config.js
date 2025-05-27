import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'

export default defineConfig({
    plugins: [vue()],
    build: {
        outDir: 'dist',
        rollupOptions: {
            input: 'resources/js/contact-list-app.js',
            output: {
                entryFileNames: `contact-list-app.js`,
                assetFileNames: `contact-list-app.css`
            }
        }
    }
})