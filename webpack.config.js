const path = require( 'path' );
const Webpack = require('webpack');
const CopyWebpackPlugin = require("copy-webpack-plugin");

module.exports = {
    entry: './dev/app.js',
    output: {
        clean: true,
        filename: 'bundle.js',
        path: path.resolve( __dirname , './assets/js' ),
    },
    plugins:[
        new Webpack.optimize.ModuleConcatenationPlugin(),
        new CopyWebpackPlugin({
            patterns: [
                { from: './dev/fonts', to: '../fonts' },
                { from: './dev/images', to: '../images' }
            ]
        })
    ],
    module: {
        rules: [{
            test: /\.m?js$/,
            exclude: /node_modules/,
            use: {
                loader: "babel-loader",
                options: {
                presets: ['@babel/preset-env']
                }
            }
        }]
    },
    devServer: {
        static: path.resolve( __dirname, './' ),
        port: 3010,
        hot: true,
        open: true,
        headers: {
            "Access-Control-Allow-Origin": "*",
            "Access-Control-Allow-Methods": "GET, POST, PUT, DELETE, PATCH, OPTIONS",
            "Access-Control-Allow-Headers": "X-Requested-With, content-type, Authorization"
        }
    }
};