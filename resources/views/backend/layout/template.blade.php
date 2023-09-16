<!doctype html>
<html lang="en" class="semi-dark">
<!-- Mirrored from codervent.com/rukada/demo/vertical/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 31 Jan 2023 17:26:15 GMT -->
<head>
	@yield('page-title')
	@include('backend.includes.header')
	@include('backend.includes.css')
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		@include('backend.includes.asidebar')
		@include('backend.includes.topbar')
		@yield('body-content')
		@include('backend.includes.footer')
	</div>
	<!--end wrapper-->

	@include('backend.includes.scripts')
	@yield('body-script')
</body>
<!-- Mirrored from codervent.com/rukada/demo/vertical/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 31 Jan 2023 17:26:48 GMT -->
</html>


