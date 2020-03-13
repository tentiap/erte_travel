<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="/adminlte/css/datetimepicker/bootstrap.min.css">
  	<link rel="stylesheet" href="/adminlte/css/datetimepicker/bootstrap-datetimepicker.min.css">
</head>
<body>
	<!-- DateTimePicker -->
	<script src="{{asset('Adminlte/js/datetimepicker/jquery.min.js')}}"></script>
	<script src="{{asset('Adminlte/js/datetimepicker/moment-with-locales.min.js')}}"></script>
	<script src="{{asset('Adminlte/js/datetimepicker/bootstrap.min.js')}}"></script>
	<script src="{{asset('Adminlte/js/datetimepicker/bootstrap-datetimepicker.min.js')}}"></script>

	<script>
	    $(function () {
	      $('#datetime').datetimepicker({
	        format:'YYYY-MM-DD hh:mm:ss'
	      })
	    })
	</script>
</body>
</html>