<div>
    <!-- No surplus words or unnecessary actions. - Marcus Aurelius -->
</div>
<div class="modal fade" id="login" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
    aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-md-down" role="form">
        <div class="modal-content">
            <div class="modal-header my-1 py-0">
                <h5 class="modal-title text-uppercase" id="modalTitleId">
                    gh-links
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" title="exit modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body align-items-center justify-content-center">
                <div class="card shadow-0 mb-4 px-4" style="max-width: 450px;margin: 1rem auto;">
                    <div class="card-header text-uppercase text-center text-primary">
                        login
                    </div>
                    <h6 class="h6 text-center" data-date-time="true"></h6>
                    <form id="form-login" action="#" method="POST">
                        <div id="response"></div>
                        @csrf
                        <div class="form-outline my-3">
                            <input required class="form-control" type="text" name="username" />
                            <label for="username" class="form-label">Username</label>
                        </div>
                        <div class="form-outline mb-3">
                            <input required class="form-control" type="password" name="password" />
                            <label for="password" class="form-label">Username</label>
                        </div>
                        <button type="submit" class="btn btn-primary">secure login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    self.addEventListener('DOMContentLoaded', () => {
        $('form#form-login').submit(form => {
            form.preventDefault();
            $('form#form-login :submit').html(
                    '<span id="btn-icon" class="fas fa-spinner fa-spin me-2"></span> saving...')
                .addClass('disabled');
            console.log($(this).serialize());
            $.ajax('{{ route('login.authenticate') }}', {
                type: 'POST',
                data: {
                    _token: form.currentTarget[0].value,
                    username: form.currentTarget[1].value,
                    password: form.currentTarget[2].value
                },
                success: (data) => {
                    console.log(data);
                    if (data.redirect_url) {
                        window.location.href = data.redirect_url;
                    }
                },
                error: (err) => {
                    console.log(err);
                    if (err.status === 422) {
                        const response = err.responseJSON.errors;
                        var ErrorList = '';
                        Object.keys(response).map(error => {
                            ErrorList += `<li>${response[error][0]}</li>`;
                        });
                        const errorMessage = `
                    <div class="alert alert-danger animate animate__animated animate__fadeIn text-center">
                        <ul class="list-unstyled mb-0">
                           ${ErrorList}
                        </ul>
                    </div>
                    `;
                        $('form#form-login > #response').html(errorMessage);
                    } else if (err.status === 500) {
                        $('form#form-login > #response').html(
                            `<h6 class="h6 text-center alert alert-danger animate__animated animate__fadeIn">${err.responseText}</h6>`
                        )
                    }else if (err.status === 429) {
                        
                    }
                    $('form#form-login :submit').text('secure login')
                        .removeClass('disabled')
                }
            });
        });
    });
</script>
