<!-- Modal -->
<style>
    .tox-statusbar__branding {
        display: none !important;
    }

    .tox-promotion {
        visibility: hidden !important;
    }
</style>
<div class="modal fade" id="modal-apply" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
    aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-capitalize" id="modalTitleId">
                    apply job
                </h5>
                <button type="button" title="exit" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-apply" action="" method="POST">
                    <div class="form-group mb-3">
                        <label for="subject" class="form-label text-black">Application Cover Letter</label>
                        <textarea required class="form-control" name="subject" id="subject" rows="3">
                            <p class="text-muted">
                                write down your cover letter here, let the employee know who you are, and what you can do....
                            </p>
                    </textarea>
                    </div>
                    <div class="d-flex flex-row p-3 justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            send
                            <i class="fas fa-arrow-right fa-send ms-2"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@section('script')
    <script src="{{ asset('app/plugins/tinymce/tinymce.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            tinymce.init({
                selector: 'textarea[name="subject"]',
                height: 300,
                menubar: false,
                toolbar: 'undo redo | blocks | insert |' +
                    'alignleft aligncenter alignright alignjustify | ' +
                    'bullist numlist'
            });
            const $loader = '<span id="btn-icon" class="fas fa-spinner fa-spin me-2"></span>';
            $('form#form-apply').on('submit', function(event) {
                event.preventDefault();
                console.log('✅ event.serialize()    ', $(this).serialize())
                var data = $(this).serialize();
                const btn = $('form#form-apply :submit');
                btn.html($loader + 'sending...').addClass('disabled');
                if (confirm('By Applying For This Job, Your CV Are Shared With The Employer')) {
                    $.ajax('', {
                        type: 'POST',
                        data: data,
                        success: (response) => {
                            btn.html('send <i class="fas fa-arrow-right fa-send ms-2"></i>')
                                .removeClass('disabled');
                        },
                        error: (response) => {
                            console.log('✅ response    ', response)
                            
                            btn.html('send <i class="fas fa-arrow-right fa-send ms-2"></i>')
                                .removeClass('disabled');
                                if (response.statusCode == 422) {
                                    alert(response.message);
                                }
                        }
                    });
                }
            });
        });
    </script>
@endsection
