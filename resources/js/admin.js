require('./bootstrap');
require('bootstrap-datepicker/js/bootstrap-datepicker.js');
require('bootstrap-select/dist/js/bootstrap-select.min.js');

// $.fn.selectpicker.Constructor.BootstrapVersion = '4';
$('.selectpicker').selectpicker();

$('.datepicker').datepicker({
    format: 'mm/dd/yyyy',
    todayHighlight: true,
});

