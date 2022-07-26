<!DOCTYPE html>
<html>
<head>
	@include('Frontend.Layouts.css')
</head>
<body>
@include('Frontend.Layouts.header')

@yield('body')

@include('Frontend.Layouts.footer')
@include('Frontend.Layouts.js')
</body>
</html>