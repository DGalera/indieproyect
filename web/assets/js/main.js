require('../scss/global.scss');
// CSS
require('../css/bootstrap.min.css');
require('../css/bootstrap-grid.min.css');
require('../css/bootstrap-reboot.min.css');
// JS
require('./bootstrap.bundle.min.js');
require('./bootstrap.min.js');


//SCEditor WhatYouSeeIsWhatYouGet
/*
require('../SCEditor_wysiwyg/minified/themes/default.min.css');
require('../SCEditor_wysiwyg/minified/sceditor.min.js');
require('../SCEditor_wysiwyg/minified/icons/monocons.js');
require('../SCEditor_wysiwyg/minified/formats/xhtml.js');

const imagesContext = require.context('../SCEditor_wysiwyg/emoticons', true, /\.(png|jpg|jpeg|gif|ico|svg|webp)$/);
imagesContext.keys().forEach(imagesContext);
*/


// loads the jquery package from node_modules
var $ = require('jquery');
global.$ = $;
global.jQuery = $;

/*
// DatePicker
require('../bootstrap-datepicker-1.6.4-dist/css/bootstrap-datepicker.css');
require('../bootstrap-datepicker-1.6.4-dist/js/bootstrap-datepicker.js');
*/
// Icons
require('webpack-icons-installer');



console.info('Your script is loaded.');

