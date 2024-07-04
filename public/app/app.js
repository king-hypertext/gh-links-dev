(() => {
    self.addEventListener('DOMContentLoaded', () => {
        console.log('js loaded');
        setInterval(() => {
            $('[data-date-time]').html(new Date().toUTCString())
        }, 1000);
        $('.selectize').selectize();
        $('.select2').select2({
            placeholder: 'Select an option',
            allowClear: true,
            theme: 'bootstrap5',

        });
        const job_locations = [
            "accra", // Greater Accra Region
            "kumasi", // Ashanti Region
            "cape Coast", // Central Region
            "ho", // Volta Region
            "sunyani", // Bono Region
            "tamale", // Northern Region
            "koforidua", // Eastern Region
            "wa", // Upper West Region
            "bolgatanga", // Upper East Region
            "takoradi", // Western Region
            "techiman", // Bono East Region
            "goaso", // Ahafo Region
            "denu", // Oti Region
            "nsukwao", // North East Region
            "yamoransa" // Savannah Region
        ];
        $('input[name="job_location"').autocomplete({
            source: job_locations,
        });

        $('#menu-toggler').click(function () {
            var toggler_icon = $(this).find('i#toggler-icon');
            toggler_icon.addClass('fa-x');
            $(this).dropdown('show');
            // $(this).parent().find('ul.nav-menu').addClass('fade');
        });
        $(document).on('click', function (e) {
            if (!$(e.target).closest('#menu-toggler').length && !$(e.target).closest('#menu').length) {
                $('#menu-toggler').find('i#toggler-icon').removeClass('fa-x')
            }
        });
        $(window).scroll(function () {
            if ($(this).scrollTop() >= 100) {
                $('header').addClass('shadow fixed-top animate__fadeIn');
            } else {
                $('header').removeClass('shadow fixed-top animate__fadeIn').css('top', '0px');
            }
        });
    });
})();