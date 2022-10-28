<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<script type="text/javascript" src="{{asset('js/app.js')}}"></script>
</head>
<body>
	<form action="{{route('alert')}}" method="POST">
		@csrf
		<input type="text"  name="message">
		<input type="submit" name="">
	</form>
</body>
</html>