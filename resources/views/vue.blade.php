<html>
	<head>
		<link rel="stylesheet" href="{{ asset('plugins/bootstrap-3.3.7-dist/css/bootstrap.css') }}" type="text/css">
		<link rel="stylesheet" href="{{ asset('plugins/bootstrap-3.3.7-dist/css/bootstrap-theme.css') }}" type="text/css">
		<link href="{{ asset('plugins/datatables/css/datatables.bootstrap.css') }}" rel="stylesheet">
		<link href="{{ asset('plugins/datatables/css/keyTable.dataTables.min.css') }}" rel="stylesheet">
		<link href="{{ asset('plugins/datatables/extensions/rowReorder-1.2.0/css/rowReorder.dataTables.css') }}" rel="stylesheet">
		{{--<link href="{{ asset('css/datatables.css') }}" rel="stylesheet">--}}
	</head>
<body>
@if(isset($dataTable))
	{!! $dataTable->table() !!}
@endif
<div id="app">

	<example></example>
	<example></example>
	<example></example>
</div>
</body>
	<script src="{{ asset('plugins/jquery/jquery-3.2.1.js') }}"></script>
	<script src="{{ asset('plugins/bootstrap-3.3.7-dist/js/bootstrap.js') }}"></script>
	<script type="text/javascript" src="{{ asset('plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('plugins/datatables/js/dataTables.select.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('plugins/datatables/js/dataTables.keyTable.min.js') }}"></script>
	{{--<script type="text/javascript" src="{{ asset('js/Library/Components/dtHelper.js') }}"></script>--}}
	<script type="text/javascript" src="{{ asset('plugins/datatables/js/datatables.bootstrap.js') }}"></script>
	<script type="text/javascript" src="{{ asset('plugins/datatables/extensions/rowReorder-1.2.0/js/dataTables.rowReorder.min.js') }}"></script>
	<script src="{{ asset('js/app.js') }}"></script>
	<script>
		@if(isset($dataTable))
			{!! $dataTable->scripts() !!}
		@endif
	</script>
</html>
