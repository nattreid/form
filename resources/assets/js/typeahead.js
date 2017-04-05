(function ($, window) {
    if (window.jQuery === undefined) {
        console.error('Plugin "jQuery" required by "typeahead.js" is missing!');
        return;
    }

    if ($.fn.typeahead === undefined) {
        console.error('Plugin "typeahead.js" required by "typeahead.js" is missing!');
        return;
    }

    // typehead
    $('.typeahead').each(function () {
        var source = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            remote: {
                url: $(this).data('typeahead-url'),
                wildcard: '__QUERY_PLACEHOLDER__'
            }
        });

        $(this).typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, {
            source: source
        });
    });

})(jQuery, window);