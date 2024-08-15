(() => {
    self.addEventListener('DOMContentLoaded', () => {
        var urlParams = new URLSearchParams(window.location.search);
        const $loader = '<span id="btn-icon" class="fas fa-spinner fa-spin me-2"></span>';
        const currentUrl = window.location.href;
        var TargetLink = document.querySelectorAll('ul#nav li a, .list-group a');
        const stripURL = currentUrl.replace(/(#.*|[\?].*)/g, '');        
        TargetLink.forEach(e => {
            if (e.href == stripURL) {
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
            placeholder: 'Select any',
            // allowClear: true,
            // theme: 'bootstrap5',

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
        // autocomplete initalization
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
        // handles autocomplete on job search input
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
        // handles back to top button click
        $('#btn-back-to-top').on('click', () => {
            $("html, body").animate({ scrollTop: 0 }, 100);
        });
        // scroll event for header animation
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
        // token
        const token = $('[name="_token"]').attr('content');
        // an event handler for the job page redirect
        $('.job-card').on('click', function (e) {
            e.preventDefault();
            const targetUrl = $(this).data('target-url');
            window.open(targetUrl, '_self');
        });
        // add or remove job from favorites

        $('button.bookmark').on('click', async function (e) {
            e.stopPropagation();
            var jobId = $(this).data('job-id');
            var icon = $(this).find('i');
            // var target = $(this);
            try {
                await $.ajax({
                    type: 'POST',
                    url: '/save_job',
                    data: {
                        _token: token,
                        job_id: jobId,
                    },
                    success: function (data) {
                        if (data.success) {
                            icon.toggleClass('fas far'); // toggle the icon
                            e.currentTarget.title = data.title;
                        }
                    },
                    error: function (err) {
                        console.log(err);
                    },
                });
            } catch (err) {
                alert('Sytem under maintenance, please try again later');
            }
        });
        // add or remove candidate from wish list
        $('button.bookmark-candidate').on('click', async function (e) {
            e.stopPropagation();
            var candidateId = $(this).data('candidate-id');
            var icon = $(this).find('i');
            await $.ajax({
                type: 'POST',
                url: '/dashboard/save-candidate',
                data: {
                    _token: token,
                    candidate_id: candidateId,
                },
                success: function (data) {
                    if (data.success) {
                        icon.toggleClass('fa far'); // toggle the icon
                        console.log($(e));
                        $(e).attr('data-mdb-content', data.message).popover();
                    }
                },
                error: function (err) {
                    console.log(err);
                },
            });
        });
        // remove job from favorites
        $('button.unsave-job').on('click', async function (e) {
            e.stopPropagation();
            var jobId = $(this).data('job-id');
            await $.ajax({
                type: 'POST',
                url: '/candidate/unsave_job',
                data: {
                    _token: token,
                    job_id: jobId,
                },
                success: function (data) {
                    if (data.success) {
                        window.location.href = data.url; // toggle the icon
                    }
                },
                error: function (err) {
                    console.log(err);
                },
            });
        });
        // remove candidates from the list
        $('button.unsave-candidate').on('click', async function (e) {
            e.stopPropagation();
            var candidate_id = $(this).data('candidate-id');
            await $.ajax({
                type: 'POST',
                url: '/dashboard/save-candidate',
                data: {
                    _token: token,
                    candidate_id: candidate_id,
                },
                success: function (data) {
                    if (data.success) {
                        window.location.href = data.url; // toggle the icon
                    }
                },
                error: function (err) {
                    console.log(err);
                },
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
        // handle job application by candidates
        $('button.apply-job').on('click', (e) => {
            var job_id = e.currentTarget.dataset.jobId;
            const is_login = e.currentTarget.dataset.is_login;
            if (is_login == false) {
                return window.location.href = '/app/login?to=' + window.location.pathname;
            }
            $('#modal-apply').modal('show');
            const $response = $('#validate-res');
            $('form#form-apply').on('submit', function (event) {
                event.preventDefault();
                var subject = $(this).find('textarea#cover_letter').val().toString();
                const btn = $('form#form-apply :submit');
                btn.html($loader + 'sending...').addClass('disabled');
                if (confirm('By Applying For This Job, Your CV Are Shared With The Employer')) {
                    $.ajax('/apply_job', {
                        type: 'POST',
                        data: {
                            _token: token,
                            cover_letter: subject,
                            job_id: job_id,
                        },
                        success: (response) => {
                            if (response.success) {
                                btn.html('sent <i class="fa fa-check-double ms-2"></i>');
                            }
                            $response.removeClass('alert-danger').addClass('alert-success').text(response.message).show();
                        },
                        error: (error) => {
                            console.log('✅ response    ', error);
                            if (error.status === 422) {
                                const response = error.responseJSON.errors;
                                var ErrorList = '';
                                Object.keys(response).map(error => {
                                    ErrorList += `<li>${response[error][0]}</li>`;
                                });
                                const errorMessage = `
                                            <ul class="list-unstyled mb-0">
                                            ${ErrorList}
                                            </ul>
                                        `;
                                $response.show().html(errorMessage);
                            } else if (error.status === 500) {
                                $response.show().text('An unexpected error occurred');
                            }
                            btn.html('send <i class="fas fa-arrow-right fa-send ms-2"></i>')
                                .removeClass('disabled');
                        }
                    });
                }
            });
        });
        // handle logout button
        $('.btn-logout').on('click', function (b) {
            $(this).addClass('disabled').html($loader + 'please wait...');
            window.location.href = $(this).data('url');
        });
    });
})();
