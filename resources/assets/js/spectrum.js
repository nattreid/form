(function ($, window) {
    if (window.jQuery === undefined) {
        console.error('Plugin "jQuery" required by "spectrum.js" is missing!');
        return;
    } else if (window.moment === undefined) {
        console.error('Plugin "moment.js" required by "spectrum.js" is missing!');
        return;
    } else if (window.jQuery.fn.spectrum === undefined) {
        console.error('Plugin "Spectrum" required by "spectrum.js" is missing!');
        return;
    }

    var localize = {
        cs: {
            choose: 'Vybrat',
            cancel: 'Zrušit'
        },
        en: {
            choose: 'Choose',
            cancel: 'Cancel'
        }
    };

    var locale = localize[window.moment.locale()];

    function spectrum() {
        $('input.spectrum').spectrum({
            color: $(this).val(),
            showAlpha: true,
            showInitial: true,
            showInput: true,
            allowEmpty: true,
            preferredFormat: 'rgb',
            chooseText: locale.choose,
            cancelText: locale.cancel
        });
    }

    $(document).ready(spectrum);
    $(document).ajaxComplete(spectrum);

})(jQuery, window);