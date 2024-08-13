<!-- Modal Body -->
<!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
<div class="modal fade" id="skill-set-modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
    role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-top modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-capitalize" id="modalTitleId">
                    add skill set
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="window.location.reload(0)"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="response" style="display: none;" class="alert " role="alert">

                </div>

                <form id="skill_set">
                    <div class="row my-2">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input required type="text" class="form-control" name="name" id="name"
                                aria-describedby="helpId" placeholder="e.g. graphic design" />
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('form#skill_set').on('submit', function(e) {
        e.preventDefault();
        btn = $('form#skill_set :submit');
        const response = $('#response');
        const $loader = '<span id="btn-icon" class="fas fa-spinner fa-spin me-2"></span>';
        btn.addClass('disabled').html($loader);
        $.ajax('/add-skill-set', {
            type: 'POST',
            data: $(this).serialize(),
            success: function(data) {
                btn.removeClass('disabled').text('save');
                response.show().removeClass('alert-danger').addClass('alert-success').text(
                    'success');
            },
            error: function(error) {
                btn.removeClass('disabled').text('save');
                console.log(error);
                response.show.removeClass('alert-success').addClass('alert-danger').text(
                    `${error.responseJSON.message}`);
            }
        })
    });
</script>
