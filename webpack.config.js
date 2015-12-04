var Extract          = require("extract-text-webpack-plugin");
var cssAutoprefixer  = require("autoprefixer");
var cssColorFunction = require("postcss-color-function");
var cssNested        = require("postcss-nested");

require("babel-polyfill");

module.exports = {
  entry: {
    basic        : './src/js/basic.js',
    basicStorage : './src/js/basicStorage.js'
  },
  output: {
    filename: './public/js/[name].js'
  },
  module: {
    loaders: [
      { test: /\.js$/, loader: 'babel-loader' },
      { test: /\.css$/, loader: Extract.extract("style-loader", "css-loader!postcss-loader")},
    ]
  },
  postcss: [
    cssAutoprefixer,
    cssColorFunction,
    cssNested
  ],
  plugins: [
    new Extract("./public/css/basic.css", { allChunks: true })
  ]
};
