import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";

export default defineConfig({
    server: {
        https: false,
        host: "0.0.0.0",
        port: 8094,
        hmr: {
            host: "hmr.kbshop.loc",
            clientPort: 443,
            protocol: "wss",
            https: true,
        },
    },
    plugins: [
        laravel({
            input: "resources/js/app.js",
            ssr: "resources/js/ssr.js",
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
});
