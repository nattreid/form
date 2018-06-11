(function ($, window) {
    if (window.jQuery === undefined) {
        console.error('Plugin "jQuery" required by "spectrum.js" is missing!');
        return;
    } else if (window.jQuery.fn.spectrum === undefined) {
        console.error('Plugin "Spectrum" required by "spectrum.js" is missing!');
        return;
    }

    function spectrum() {
        $('input.spectrum').spectrum({
            color: $(this).val(),
            showAlpha: true,
            preferredFormat: 'rgb'
        });
    }

    $(document).ready(spectrum);
    $(document).ajaxComplete(spectrum);

})(jQuery, window);