<!DOCTYPE html>
<html>
	<head>

		@include('frontend.includes.header')
        @yield('page-title')
		@include('frontend.includes.css')
		@yield('body-css')

	</head>
	<body>

		<div class="body">
			@include('frontend.includes.topbar')

			@yield('body-content')

			@include('frontend.includes.footer')
		</div>

		@include('frontend.includes.scripts')
		@yield('body-script')

	</body>
</html>
