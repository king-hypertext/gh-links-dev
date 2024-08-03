self.addEventListener('DOMContentLoaded', () => {
    setInterval(() => {
        $('[data-date-time]').html(new Date().toUTCString())
    }, 1000);
    var urlParams = new URLSearchParams(window.location.search);
    var activeTab = urlParams.get('tab');

    if (activeTab !== null) {
        $('#ex1 a[href="#' + activeTab + '"]').tab('show');

    }

    // toggle show password
    $('.input-group-icon > i').on('click', (e) => {
        target = e.currentTarget.offsetParent.offsetParent.children[0];
        icon = e.currentTarget;
        if (target.type == 'password') {
            target.type = 'text';
            icon.classList.add("fa-eye-slash");
            icon.classList.remove("fa-eye");
            icon.title = 'Click to hide password';
        } else {
            target.type = 'password';
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
            icon.title = 'Click to show password';
        };
    });
    //handle employee signup 
    const $response = $('#response');
    const $loader = '<span id="btn-icon" class="fas fa-spinner fa-spin me-2"></span>';
    $('form#reg').on('submit', function (e) {
        e.preventDefault();
        console.log(e);
        $('form#reg :submit').html($loader + 'saving data ...').addClass('disabled');
        const candidate_data = $(this).serialize();
        $.ajax('/app/create-account', {
            type: 'POST',
            data: candidate_data,
            success: function (response) {
                console.log('Success:', response);
                if (response.success) {
                    window.location.href = response.redirect_url;
                }
            },
            error: function (error) {
                console.log('Error:', error);
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
                $('form#reg :submit').text('register').removeClass('disabled');
            }
        });
    });
    // handle employer signup 
    $('form#reg-as-employer').on('submit', function (e) {
        e.preventDefault();
        $('form#reg-as-employer :submit').html($loader + 'saving data ...').addClass('disabled');
        const employer_data = $(this).serialize();
        $.ajax('/app/employer/create-account', {
            type: 'POST',
            data: employer_data,
            success: function (response) {
                console.log('Success:', response);
                if (response.success) {
                    window.location.href = response.redirect_url;
                }
            },
            error: function (error) {
                $('form#reg-as-employer :submit').text('register').removeClass('disabled');
                console.log('Error:', error);
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
                $('form#reg-as-employer :submit').text('register').removeClass('disabled');
            }
        });
    });
    // handle employee login
    $('form#login').on('submit', function (e) {
        $('form#login :submit').html($loader + 'authenticating...').addClass('disabled');
        e.preventDefault();
        $.ajax('/app/login', {
            type: 'POST',
            data: $(this).serialize(),
            success: function (response) {
                console.log('Success:', response);
                if (response.success) {
                    window.location.href = response.redirect_url;
                }
            },
            error: function (error) {
                console.log('Error:', error);
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
                } else if (error.status === 403) {
                    $response.show().text(error.responseText);
                }
                $('form#login :submit').html('secure login <i class="fas fa-arrow-right ms-2"></i>').removeClass('disabled');
            }
        });
    });
    // handle employer login
    $('form#login-as-employer').on('submit', function (e) {
        $('form#login-as-employer :submit').html($loader + 'authenticating...').addClass('disabled');
        e.preventDefault();
        $.ajax('/app/login/employer', {
            type: 'POST',
            data: $(this).serialize(),
            success: function (response) {
                console.log('Success:', response);
                if (response.success) {
                    // console.log(response);
                    window.open(response.redirect_url, '_self');
                }
            },
            error: function (error) {
                console.log('Error:', error);
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
                } else if (error.status === 403) {
                    $response.show().text(error.responseText);
                }
                $('form#login-as-employer :submit').html('secure login <i class="fas fa-arrow-right ms-2"></i>').removeClass('disabled');
            }
        });
    });
})