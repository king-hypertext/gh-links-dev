(() => {
    self.addEventListener('DOMContentLoaded', () => {
        // remove candidates from the list
        const token = $('[name="_token"]').attr('content');
        $('button.unsave-candidate').on('click', async function (e) {
            e.stopPropagation();
            var candidate_id = $(this).data('candidate-id');
            await $.ajax({
                type: 'POST',
                url: '/employer/unsave-candidate',
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
        tinymce.init({
            selector: 'textarea#about',
            height: 300,
            plugins: [
                'advlist', 'lists', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'fullscreen', 'media', 'table', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | blocks | bold italic backcolor | ' +
                'alignleft aligncenter alignright alignjustify | ' +
                'bullist numlist outdent indent | removeformat | help'
        });
        tinymce.init({
            selector: 'textarea#company_vision',
            height: 300,
            plugins: [
                'advlist', 'lists', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'fullscreen', 'media', 'table', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | blocks | bold italic backcolor | ' +
                'alignleft aligncenter alignright alignjustify | ' +
                'bullist numlist outdent indent | removeformat | help'
        });
        // $('.selectize').selectize();
        $('.select2').select2({
            // placeholder: 'Select an option',
            allowClear: false,
            // theme: 'bootstrap5',

        });

        var urlParams = new URLSearchParams(window.location.search);
        var activeTab = urlParams.get('tab');
        console.log(activeTab, $('a[href="#' + activeTab + '"]'));
        if (activeTab !== null) {
            $('a[href="#' + activeTab + '"]').tab('show');
        }
    });
})();