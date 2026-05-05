import { defineConfig } from "vite";
import path from "node:path";

const themeRoot = __dirname;

export default defineConfig({
  root: themeRoot,
  base: "",
  publicDir: false,

  server: {
    host: "127.0.0.1",
    port: 5173,
    strictPort: true,
    origin: "http://127.0.0.1:5173",
  },

  resolve: {
    alias: {
      "@js": path.resolve(themeRoot, "assets/js"),
      "@scss": path.resolve(themeRoot, "assets/scss"),
      "@images": path.resolve(themeRoot, "assets/images"),
      "@fonts": path.resolve(themeRoot, "assets/fonts"),
    },
  },

  build: {
    outDir: path.resolve(themeRoot, "assets/dist"),
    emptyOutDir: true,
    manifest: "manifest.json",
    sourcemap: true,
    rollupOptions: {
      input: {
        app: path.resolve(themeRoot, "assets/js/app.js"),
        editor: path.resolve(themeRoot, "assets/scss/editor.scss"),
      },
      output: {
        entryFileNames: "js/[name]-[hash].js",
        chunkFileNames: "js/[name]-[hash].js",
        assetFileNames: (assetInfo) => {
          const name = assetInfo.name ?? "";

          if (/\.(gif|jpe?g|png|svg|webp|avif)$/i.test(name)) {
            return "images/[name]-[hash][extname]";
          }

          if (/\.(woff2?|ttf|otf|eot)$/i.test(name)) {
            return "fonts/[name]-[hash][extname]";
          }

          if (/\.css$/i.test(name)) {
            return "css/[name]-[hash][extname]";
          }

          return "assets/[name]-[hash][extname]";
        },
      },
    },
  },
});
