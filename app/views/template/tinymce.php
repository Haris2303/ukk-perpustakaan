<script src="<?= BASEURL ?>/vendor/tinymce/tinymce.min.js"></script>

<script>
    tinymce.init({
        selector: 'textarea#default',
        height: 300,
        plugins: [
            'advlist',
            'autolink',
            'link',
            'image',
            'lists',
            'charmap',
            'preview',
            'anchor',
            'pagebreak',
            'searchreplace',
            'wordcount',
            'visualblocks',
            'code',
            'fullscreen',
            'media',
            'nonbreaking',
            'emoticons',
            'outdent',
            'indent'
        ],
        toolbar: 'undo redo | code | styles | bold italic underline | alignleft aligncenter alignright | numlist bullist | outdent indent | emoticons | nonbreaking',
        lists_indent_on_tab: false,
        menu: {
            favs: {
                title: 'menu',
                items: 'code visualaid | searchreplace | emoticons'
            }
        },
        menubar: 'favs file edit view insert format tools table',
        content_style: 'body{font-family:sans-serif; font-size:16px}'
    })
</script>