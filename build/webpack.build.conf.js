const merge = require('webpack-merge')
const baseWebpackConfig = require('./webpack.base.conf')

//other
const HtmlWebpackPlugin = require('html-webpack-plugin');

// build
const buildWebpackConfig = merge(baseWebpackConfig, {
  // BUILD SETTINGS
  // Source map
  // devtool: 'eval-soucemap'
  plugins: [
    //TODO FIX
    // index en
    new HtmlWebpackPlugin({
      //* '../' - fix static folder for *.html files
      filename: '../index.html',
      template: 'src/index-en.pug',
      inject: false
    }),
    // index ru
    new HtmlWebpackPlugin({
      //* '../' - fix static folder for *.html files
      filename: '../ru/index.html',
      template: 'src/index-ru.pug',
      inject: false
    }),
    // download en 
    new HtmlWebpackPlugin({
      //* '../' - fix static folder for *.html files
      filename: '../download.html',
      template: 'src/download-en.pug',
      inject: false
    }),
    // download ru
    new HtmlWebpackPlugin({
      //* '../' - fix static folder for *.html files
      filename: '../ru/download.html',
      template: 'src/download-ru.pug',
      inject: false
    })
  ],
});

module.exports = new Promise((resolve, reject) => {

resolve(buildWebpackConfig)
})
