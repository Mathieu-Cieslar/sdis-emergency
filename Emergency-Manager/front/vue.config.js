module.exports = {
  devServer: {
    proxy: {
      '/api': {
        target: 'http://backend:80',
        changeOrigin: true,
      },
    },
  },
};