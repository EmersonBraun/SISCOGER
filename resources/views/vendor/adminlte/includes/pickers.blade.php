<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js'"></script>
<script src="{{ asset('public/vendor/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- datepicker -->
<script src="{{ asset('public/vendor/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('public/vendor/plugins/datepicker/locales/bootstrap-datepicker.pt-BR.js') }}"></script>
<!-- bootstrap color picker -->
<script src="{{ asset('public/vendor/plugins/colorpicker/bootstrap-colorpicker.min.js') }}"></script>
<!-- bootstrap time picker -->
<script src="{{ asset('public/vendor/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
<script>
$(function () {
    

                    // give $().bootstrapDP the bootstrap-datepicker functionality

    //Date range picker
    //$('#reservation').daterangepicker()
    //Date range picker with time picker
    //$('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
    //Date range as a button
    /*$('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    );*/
    //var datepicker = $.fn.datepicker.noConflict(); // return $.fn.datepicker to previously assigned value
    //$.fn.bootstrapDP = datepicker; 

   //Date picker
   $('.datepicker').datepicker({
      format: 'dd/mm/yyyy',
    	language: 'pt-BR',
    	weekStart: 0,
    	startDate:'0d',
    	todayHighlight: true,
      autoclose: true,
      daysOfWeekDisabled: [0,6],
      todayHighlight: true,
    });
  });

  // $(".datepicker").datepicker({
  //       dateFormat: 'mm-dd-yy'
  //   }).datepicker('setDate', new Date());

  //Timepicker
  $('.timepicker').timepicker({
    showInputs: false,
    showMeridian: false
  });
</script>