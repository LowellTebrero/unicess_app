import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/css/preloader.css",
                "resources/css/sidebar.css",
                "resources/css/checkbox.css",
                "resources/css/lnu-additional.css",
                "resources/js/app.js"
            ],
            refresh: true,
        }),
    ],
});
