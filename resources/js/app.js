// Lodash
window._ = require('lodash');

// Bootstrap 4
window.Popper = require('popper.js').default;
window.$ = window.jQuery = require('jquery');

require('bootstrap');

// Sidebar and Header
require('jquery-slimscroll');
require('./vendor/waves');
require('sticky-kit/dist/sticky-kit');
require('./vendor/jquery.sparkline.min');

// JSZip
window.JSZip = require('jszip');

// pdfMake
window.pdfMake = require('pdfmake/build/pdfmake');
window.pdfFonts = require('pdfmake/build/vfs_fonts');
pdfMake.vfs = pdfFonts.pdfMake.vfs;

// Datatables
require('datatables.net-bs4');
require('datatables.net-buttons-bs4');
require('datatables.net-buttons/js/buttons.colVis.js');
require('datatables.net-buttons/js/buttons.html5.js');
require('datatables.net-buttons/js/buttons.print.js');
require('datatables.net-fixedcolumns-bs4');
require('datatables.net-responsive-bs4');

// Moment JS
window.moment = require('moment');

// Toastr
window.toastr = require('toastr');

// Sweet Alert 2
window.Swal = require('sweetalert2');

// Dropify
window.Dropify = require('dropify');

// Theme
require('./theme/sidebarmenu');
require('./theme/main');

// App
require('./app/custom_file_input');
