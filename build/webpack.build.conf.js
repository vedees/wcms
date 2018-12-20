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
    new HtmlWebpackPlugin({
      //* '../' - fix static folder for *.html files
      filename: '../index.html',
      template: 'src/index.pug',
      inject: false
    })
  ],
});

module.exports = new Promise((resolve, reject) => {

resolve(buildWebpackConfig)
})
