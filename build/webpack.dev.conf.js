const merge = require('webpack-merge')
const baseWebpackConfig = require('./webpack.base.conf')

//other
const HtmlWebpackPlugin = require('html-webpack-plugin');

//dev
const devWebpackConfig = merge(baseWebpackConfig, {
  // DEV SETTINGS

  // Source map
  devtool: 'source-map',
  plugins: [
    new HtmlWebpackPlugin({
      //* '../' - fix static folder for *.html files
      filename: 'index.html',
      template: 'src/index.pug',
      inject: false
    })
  ],
});

module.exports = new Promise((resolve, reject) => {

resolve(devWebpackConfig)

})
