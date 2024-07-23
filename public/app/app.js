(() => {
    self.addEventListener('DOMContentLoaded', () => {
        var urlParams = new URLSearchParams(window.location.search);
        var activeTab = urlParams.get('tab');
        const currentUrl = window.location.href;
        var TargetLink = document.querySelectorAll('ul#nav li a, .list-group a');
        TargetLink.forEach(e => {
            if (e.href == currentUrl) {
                e.classList.add('active');
            } else {
                e.classList.remove('active');
            }
        });
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
            "cape coast", // Central Region
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
        $('input[name="job_location"], input[name="location"]').autocomplete({
            minLength: 0,
            source: job_locations,
        });
        $('input[name="job_type"').autocomplete({
            minLength: 0,
            source: [
                'full-time',
                'part-time',
                'freelance',
                'contract',
                'temporary',
                'internship',
            ],
        });
        $('input[name="job_title"]').autocomplete({
            minLength: 3,
            source: function (request, response) {
                $.ajax({
                    url: '/autocompleteJobList',
                    dataType: 'json',
                    data: {
                        query: request.term
                    },
                    success: function (data) {
                        $.each(data, function (i, d) {
                            response(d);
                        });
                    }
                });
            },
            select: function (event, ui) {

            }
        });
        $('input[name="job_type"], input[name="location"]').focus(function () {
            $(this).autocomplete('search', $(this).val());
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
        $(document).on('click', '#app-search', function (e) {
            if (!$('.search-dropdown').hasClass('show')) {
                $('.search-dropdown').show().addClass('show');
                $('form#full-search input').focus()
            } else {
                $('.search-dropdown').hide().removeClass('show');
            }
        });
        $('#close-search').click(function () {
            if (!$('.search-dropdown').hasClass('show')) {
                $('.search-dropdown').show().addClass('show');
            } else {
                $('.search-dropdown').hide().removeClass('show');
            }
        });

        $('#btn-back-to-top').on('click', () => {
            $("html, body").animate({ scrollTop: 0 }, 100);
        });
        $(window).scroll(function () {
            if ($(this).scrollTop() >= 100) {
                $('#btn-back-to-top').fadeIn();
                $('header').addClass('shadow fixed-top animate__fadeIn');
                $('header > div.app-container').addClass('bg-white').removeClass('bg-secondary');
            } else {
                $('#btn-back-to-top').fadeOut();
                $('header').removeClass('shadow fixed-top animate__fadeIn').css('top', '0px');
                $('header > div.app-container').removeClass('bg-white').addClass('bg-secondary');
            }
        });
        const token = $('[name="_token"]').attr('content');
        var cards = $('.job-card'), bookmarks = $(cards).find('.bookmark');
        $.each(cards, (i, card) => {
            const targetUrl = $(card).data('target-url');
            card.addEventListener('click', () => {
                window.open(targetUrl);
            });
        });
        $.each(bookmarks, (i, bookmark) => {
            const targetId = $(bookmark).closest('.job-card').data('target-id');
            bookmark.addEventListener('click', (e) => {
                e.stopPropagation();
                // perform http request to bookmark job
                // $.ajax('', {
                //     type: 'POST',
                //     data: {
                //         _token: token,
                //         job_id: targetId,
                //     },
                //     succes: res => {
                //         console.log(res);
                //     },
                //     error: err => {
                //         console.log(err);
                //     }
                // });
            });
        });
        $.each($('button.copy-url'), (i, button) => {
            var url = $(button).data('url');
            $(button).on('click', async () => {
                try {
                    await navigator.clipboard.writeText(url);
                    alert('link copied to clipboard');
                } catch (error) {
                    console.error('clipboard error', error);
                }
            });
        });
        $.each($('button.share-to-whatsapp'), (i, button) => {
            var url = $(button).data('url');
            const text = `I saw this job at GH-LINKS. Check it out! \n${url} `;
            $(button).on('click', async () => {
                try {
                    window.open(`https://api.whatsapp.com/send/?text=${encodeURIComponent(text)}`);
                } catch (error) {
                    console.error('clipboard error', error);
                }
            });
        });
        $(document).on('click', 'button#search-job', () => {
            var $t = $('input#search-job-job_title').val(),
                $l = $('input#search-job-location').val();
            window.location.href = '/jobs?job_title=' + $t + '&location=' + $l;
        });
        // $('.form-search').
        $('button#apply-job').on('click', (e) => {
            // alert('Apply')
            const is_login = e.currentTarget.dataset.is_login;
            if (is_login == false) {
                return window.location.href = '/app/login?to=' + window.location.pathname;
            }
            $('#modal-apply').modal('show');
        });
    });
})();
