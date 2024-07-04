self.addEventListener('DOMContentLoaded', () => {
    setInterval(() => {
        $('[data-date-time]').html(new Date().toUTCString())
    }, 1000);
    document.querySelectorAll('input').forEach(input =>
        input.addEventListener('blur', () => {
            if (input.value == null || input.value == '') {
                input.classList.remove('active')
            } else if (input.value !== null) {
                input.classList.add('active')
            }
        })
    );
    $('form#login').on('submit', () => {
        $('form#login :submit').
            html('<span id="btn-icon" class="fas fa-spinner fa-spin me-2 "></span> authenticating...');
        return 1;
    });
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
    const $loader = '<span id="btn-icon" class="fas fa-spinner fa-spin me-2 "></span>';
    $('form#reg-as-candidate').on('submit', function (e) {
        e.preventDefault();
        console.log(e);
        $('form#reg-as-candidate :submit').html($loader + 'saving data ...').addClass('disabled');
        const candidate_data = $(this).serialize();
        $.ajax('/app/register', {
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
                if (err.status === 422) {
                    const response = err.responseJSON.errors;
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
                } else if (err.status === 500) {
                    $response.show().text('An unexpected error occurred');
                }
                $('form#reg-as-candidate :submit').text('register').removeClass('disabled');
            }
        });
    });
    // handle employer signup 
    $('form#reg-as-employer').on('submit', function (e) {
        e.preventDefault();
        console.log(e);
        $('form#reg-as-employer :submit').html($loader + 'saving data ...').addClass('disabled');
        const candidate_data = $(this).serialize();
        $.ajax('/app/employer/create-account', {
            type: 'POST',
            data: candidate_data,
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
    $('form#login-as-employee').on('submit', function (e) {
        e.preventDefault();
        console.log(e);
    });
    // handle employer login
    $('form#login-as-employer').on('submit', function (e) {
        e.preventDefault();
        console.log(e);
    });
})