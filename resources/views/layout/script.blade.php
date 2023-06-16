<script src="{{ asset('js/flatpickr.js') }}"></script>
<script src="{{ asset('aos/aos.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    AOS.init({
        duration: 1000, // values from 0 to 3000, with step 50ms
        easing: 'linear', // default easing for AOS animations
        anchorPlacement: 'center-center', // defines which position of the element regarding to window should trigger the animation
    });
</script>
<script>
    flatpickr('.datepicker', {
        altInput: true,
        altFormat: 'F j, Y',
        dateFormat: 'Y-m-d'
    });
</script>


@livewireScripts
