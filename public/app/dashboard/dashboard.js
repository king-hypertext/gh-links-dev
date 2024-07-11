(() => {
    self.addEventListener('DOMContentLoaded', () => {

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
            placeholder: 'Select an option',
            allowClear: true,
            theme: 'bootstrap5',

        });
    });
})();