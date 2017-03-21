<!--Font Awesome CSS -->
<link href="/assets/vendor/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" type="text/css">

<!--Froala CSS -->
<link href="/assets/vendor/froala/2.5.1/css/froala_editor.css" rel="stylesheet" type="text/css">
<link href="/assets/vendor/froala/2.5.1/css/froala_style.css" rel="stylesheet" type="text/css">

<!--Froala Plugins CSS-->
<link href="/assets/vendor/froala/2.5.1/css/plugins/char_counter.css" rel="stylesheet" type="text/css">
<link href="/assets/vendor/froala/2.5.1/css/plugins/code_view.css" rel="stylesheet" type="text/css">
<link href="/assets/vendor/froala/2.5.1/css/plugins/colors.css" rel="stylesheet" type="text/css">
<link href="/assets/vendor/froala/2.5.1/css/plugins/emoticons.css" rel="stylesheet" type="text/css">
<link href="/assets/vendor/froala/2.5.1/css/plugins/table.css" rel="stylesheet" type="text/css">
<link href="/assets/vendor/froala/2.5.1/css/plugins/video.css" rel="stylesheet" type="text/css">
<link href="/assets/vendor/froala/2.5.1/css/plugins/image.css" rel="stylesheet" type="text/css">

<!--Include Code Mirror CSS-->
<link href="/assets/vendor/codemirror/5.3.0/codemirror.css" rel="stylesheet" type="text/css">

<!--Froala JS-->
<script src="/assets/vendor/froala/2.5.1/js/froala_editor.min.js"></script>

<!--Include Code Mirror JS-->
<script src="/assets/vendor/codemirror/5.3.0/codemirror.js"></script>
<script src="/assets/vendor/codemirror/5.3.0/mode/xml/xml.js"></script>

<!--Froala Plugins JS-->
<script src="/assets/vendor/froala/2.5.1/js/plugins/align.min.js"></script>
<script src="/assets/vendor/froala/2.5.1/js/plugins/char_counter.min.js"></script>
<script src="/assets/vendor/froala/2.5.1/js/plugins/code_beautifier.min.js"></script>
<script src="/assets/vendor/froala/2.5.1/js/plugins/code_view.min.js"></script>
<script src="/assets/vendor/froala/2.5.1/js/plugins/colors.min.js"></script>
<script src="/assets/vendor/froala/2.5.1/js/plugins/emoticons.min.js"></script>
<script src="/assets/vendor/froala/2.5.1/js/plugins/font_size.min.js"></script>
<script src="/assets/vendor/froala/2.5.1/js/plugins/image.min.js"></script>
<script src="/assets/vendor/froala/2.5.1/js/plugins/link.min.js"></script>
<script src="/assets/vendor/froala/2.5.1/js/plugins/lists.min.js"></script>
<script src="/assets/vendor/froala/2.5.1/js/plugins/paragraph_format.min.js"></script>
<script src="/assets/vendor/froala/2.5.1/js/plugins/paragraph_style.min.js"></script>
<script src="/assets/vendor/froala/2.5.1/js/plugins/quote.min.js"></script>
<script src="/assets/vendor/froala/2.5.1/js/plugins/table.min.js"></script>
<script src="/assets/vendor/froala/2.5.1/js/plugins/video.min.js"></script>

<script>
    $(document).ready(function () {
        $('.wysiwyg-editor').froalaEditor({
            imageUploadURL: '/<?= config('admin_segment') ?>/images/upload',

            imageUploadParams: {
                setup: 'editor'
            }
        });

        $('.fr-box a:contains("Unlicensed")').parent().remove();
    });
</script>