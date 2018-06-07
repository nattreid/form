(function ($, window) {
    if (window.jQuery === undefined) {
        console.error('Plugin "jQuery" required by "ckEditor.js" is missing!');
        return;
    } else if (window.CKEDITOR === undefined) {
        console.error('Plugin "ckEditor" required by "ckEditor.js" is missing!');
        return;
    }

    function ckEditorLine() {
        $('textarea.ckEditorLine').ckeditor({
            height: '80px',
            toolbarGroups: [
                {name: 'basicstyles', groups: ['basicstyles', 'cleanup']},
                {name: 'paragraph', groups: ['align']},
                {name: 'styles', groups: ['styles']},
                {name: 'colors', groups: ['colors']}
            ],
            enterMode: CKEDITOR.ENTER_BR,
            removeButtons: 'BGColor,Styles,Format,Underline,Strike,Subscript,Superscript',
            removePlugins: 'elementspath',
            resize_enabled: false,
            on: {
                change: function (evt) {
                    this.updateElement();
                }
            }
        });
    }

    $(document).ready(ckEditorLine);
    $(document).ajaxComplete(ckEditorLine);

})(jQuery, window);