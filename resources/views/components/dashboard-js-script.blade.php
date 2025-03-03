<script src="{{ asset('assets/assets/plugins/common/common.min.js') }}" type="a69da5dac325925ac4c4d885-text/javascript"></script>
<script src="{{ asset('assets/assets/plugins/OwlCarousel/owl.carousel.min.js') }}" type="a69da5dac325925ac4c4d885-text/javascript">
</script>
<script src="{{ asset('assets/assets/plugins/counterup/waypoints.min.js') }}" type="a69da5dac325925ac4c4d885-text/javascript"></script>
<script src="{{ asset('assets/assets/plugins/counterup/jquery.counterup.min.js') }}" type="a69da5dac325925ac4c4d885-text/javascript">
</script>
<script src="{{ asset('assets/assets/plugins/gmap3/gmap3.min.js') }}" type="a69da5dac325925ac4c4d885-text/javascript"></script>
<script src="{{ asset('assets/assets/plugins/MorrisChart/raphael-min.js') }}" type="a69da5dac325925ac4c4d885-text/javascript"></script>
<script src="{{ asset('assets/assets/plugins/MorrisChart/morris.min.js') }}" type="a69da5dac325925ac4c4d885-text/javascript"></script>

<script src="{{ asset('assets/main/js/scripts.js') }}" type="a69da5dac325925ac4c4d885-text/javascript"></script>
<script type="a69da5dac325925ac4c4d885-text/javascript">
    // Ride chart
    Morris.Area({
        element: 'ride-chart',
        data: [{
            time: '2024',
            days: 0,
            nights: 0
        }, {
            time: '2025',
            days: 90,
            nights: 60
        }, {
            time: '2026',
            days: 40,
            nights: 80
        },  {
            time: '2027',
            days: 110,
            nights: 10
        }],
        lineColors: ['#3B3B3B', '#F7BC00'],
        xkey: 'time',
        ykeys: ['days', 'nights'],
        // labels: ['Phone', 'nights', 'Mac'],
        pointSize: 0,
        lineWidth: 0,
        resize: true,
        fillOpacity: 0.8,
        behaveLikeLine: true,
        gridLineColor: 'transparent',
        hideHover: 'auto'
    });
</script>
<script src="{{ asset('assets/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js') }}"
    data-cf-settings="a69da5dac325925ac4c4d885-|49" defer></script>
    
<script>

    //For FORMS
    // Disable buttons when clicked
    //SignIn
    function profileF(form) {
        form.signIn.disabled = true;
        form.signIn.value = "Signing in...";
        return true;
    }

    //Register
    function settingsF(form) {
        form.register.disabled = true;
        form.register.value = "Please wait...";
        return true;
    }

</script>