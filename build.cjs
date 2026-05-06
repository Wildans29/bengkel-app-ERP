const esbuild = require('esbuild');
const { execSync } = require('child_process');
const fs = require('fs');

const isWatch = process.argv.includes('--watch');

console.log('Building assets...');

execSync('npx tailwindcss -i ./resources/css/app.css -o ./public/css/app.css --minify', { stdio: 'inherit' });

esbuild.build({
    entryPoints: ['resources/js/app.js'],
    bundle: true,
    outfile: 'public/js/app.js',
    minify: !isWatch,
    sourcemap: isWatch,
    target: ['es2020'],
    format: 'iife',
    define: {
        'process.env.NODE_ENV': isWatch ? '"development"' : '"production"'
    }
}).then(() => {
    console.log('Build complete!');
}).catch(() => process.exit(1));

if (isWatch) {
    esbuild.context({
        entryPoints: ['resources/js/app.js'],
        bundle: true,
        outfile: 'public/js/app.js',
        minify: false,
        sourcemap: true,
        target: ['es2020'],
        format: 'iife',
    }).then(ctx => {
        ctx.watch();
        console.log('Watching for changes...');
    });
}