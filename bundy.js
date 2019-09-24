var bundy = require('bundy');
bundy.copy([
    'node_modules/assetsutilities/css/assetsutilities.min.css',
], 'public/css/');
bundy.copy([
    'node_modules/assetsutilities/js/assetsutilities.min.js',
], 'public/js/');

bundy.build();
