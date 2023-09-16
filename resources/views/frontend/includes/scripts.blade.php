<!-- Vendor -->
<script src="{{ asset('frontend/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/jquery.appear/jquery.appear.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/jquery.easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/jquery.cookie/jquery.cookie.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/popper/umd/popper.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/common/common.min.js') }}"></script>
<script src="{{ asset('frontend/') }}vendor/jquery.validation/jquery.validate.min.js"></script>
<script src="{{ asset('frontend/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/jquery.gmap/jquery.gmap.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/jquery.lazyload/jquery.lazyload.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/isotope/jquery.isotope.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/owl.carousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/vide/jquery.vide.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/vivus/vivus.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/bootstrap-star-rating/js/star-rating.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/bootstrap-star-rating/themes/krajee-fas/theme.min.js') }}"></script>

<!-- Theme Base, Components and Settings -->
<script src="{{ asset('frontend/js/theme.js') }}"></script>

<!-- Current Page Vendor and Views -->
<script src="{{ asset('frontend/js/views/view.shop.js') }}"></script>

<!-- Theme Custom -->
<script src="{{ asset('frontend/js/custom.js') }}"></script>

<!-- Theme Initialization Files -->
<script src="{{ asset('frontend/js/theme.init.js') }}"></script>

<!-- Google Analytics: Change UA-XXXXX-X to be your site's ID. Go to http://www.google.com/analytics/ for more information.
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-12345678-1', 'auto');
    ga('send', 'pageview');
</script>
    -->

<!-- Toastr JS  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- Toastr calling JS Methods -->
<script>
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
</script>
<script>
    @if ( Session::has('message') )
        var type = "{{ Session::get('alert-type', 'info') }}" ;

        switch (type) {
            case 'info':
                toastr.info( "{{ Session::get('message') }}" );
            break;
            case 'success':
                toastr.success( "{{ Session::get('message') }}" );
            break;
            case 'warning':
                toastr.warning( "{{ Session::get('message') }}" );
            break;
            case 'error':
                toastr.error( "{{ Session::get('message') }}" );
            break;
        }
    @endif
</script>

<script>
    (function (window, document) {
        var loader = function () {
            var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
            script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7);
            tag.parentNode.insertBefore(script, tag);
        };

        window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
    })(window, document);
</script>
