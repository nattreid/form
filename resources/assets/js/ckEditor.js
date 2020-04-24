(function ($, window) {
    if (window.jQuery === undefined) {
        console.error('Plugin "jQuery" required by "ckEditor.js" is missing!');
        return;
    } else if (window.CKEDITOR === undefined) {
        console.error('Plugin "ckEditor" required by "ckEditor.js" is missing!');
        return;
    }

    function ckEditorInline() {
        $('textarea.ckEditorInline').ckeditor({
            height: '80px',
            toolbar: [
                {name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', '-', 'CopyFormatting', 'RemoveFormat']},
                {name: 'paragraph', items: ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl']},
                {name: 'links', items: ['Link', 'Unlink']},
                {name: 'insert', items: ['Image', 'Table']},
                {name: 'styles', items: ['Font', 'FontSize']},
                {name: 'colors', items: ['TextColor']}
            ],
            enterMode: CKEDITOR.ENTER_BR,
            resize_enabled: false,
            on: {
                change: function (evt) {
                    this.updateElement();
                }
            }
        });
    }

    $(document).ready(ckEditorInline);
    $(document).ajaxComplete(ckEditorInline);

})(jQuery, window);