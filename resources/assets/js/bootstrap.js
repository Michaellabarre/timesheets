//import Popper from 'popper.js/dist/umd/popper.js';

window._ = require('lodash');

try {
    $ = jQuery = window.$ = window.jQuery = require('jquery');
    //window.Popper = Popper;

    //require('jquery');
    require('bootstrap-sass');
    require('select2');
    d3 = window.d3 = require('d3');
    c3 = window.c3 = require('c3');
    require('admin-lte');
      
    //require( 'jszip' );
    //require( 'pdfmake' );
    //require( 'datatables.net' )(window, $);
    require( 'datatables.net-bs' )(window, $);
    //require( 'datatables.net-buttons-bs' );
    //require( 'datatables.net-buttons/js/buttons.colVis.js' );
    //require( 'datatables.net-buttons/js/buttons.html5.js' );
    //require( 'datatables.net-buttons/js/buttons.print.js' );

} catch (e) {
   // console.log(e);
}

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}
