// webpack.mix.js
let mix = require('laravel-mix');
let LiveReloadPlugin = require('webpack-livereload-plugin');

mix.webpackConfig({
    plugins: [
        (new LiveReloadPlugin({
            // https://github.com/livereload/livereload-js/blob/master/src/options.js
            ignore: /(node_modules)|(vendor)/,
            ext: "js,css"
        })),
    ],
    module: {
        rules: [
            {
                test: /\.s[ac]ss$/i,
                use: [
                    {
                        loader: "sass-loader",
                        options: {
                            additionalData: [
                                "$env: " + process.env.NODE_ENV + ";",
                                "$debug-links: " + !!process.env.DEBUG_LINKS + ";",
                                (!!process.env.DEBUG_LINKS) 
                                    ? '@import "martino-scss/global/debug";' 
                                    : '',
                            ].join('\n')
                        },
                    },
                ],
            },
        ],
    }
})

mix
    .sass('assets/css/martino.scss', 'assets/css')
    .sass('assets/css/martino-carousel.scss', 'assets/css')
    .options({
        processCssUrls: false,
        watchOptions: {
            ignored: /node_modules/
        }
    });
mix
    .sass('assets/css/martino-admin.scss', 'inc/admin-css/style-admin.css')
    .options({ processCssUrls: false });

if (process.env.MIX_NOTIFICATIONS == 'false') {
    mix.disableNotifications();
}