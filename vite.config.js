import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/js/app.js"],
            refresh: true,
        }),
    ],
    build: {
        rollupOptions: {
            output: {
                assetFileNames: (assetInfo) => {
                    let extType = assetInfo.name.split(".")[1];
                    if (/woff|woff2|ttf/.test(extType)) {
                        extType = "fonts";
                    } else if (
                        /png|jpe?g|svg|gif|tiff|bmp|ico/i.test(extType)
                    ) {
                        extType = "img";
                    }
                    return `${extType}/[name]-[hash][extname]`;
                },
                // chunkFileNames: "static/js/[name]-[hash].js",
                // entryFileNames: "static/js/[name]-[hash].js",
            },
        },
    },


});
