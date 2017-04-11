(function ($, window) {
    if (window.jQuery === undefined) {
        console.error('Plugin "jQuery" required by "typeahead.js" is missing!');
        return;
    }

    if ($.fn.typeahead === undefined) {
        console.error('Plugin "typeahead.js" required by "typeahead.js" is missing!');
        return;
    }

    function typeahead() {
        $('.typeahead').each(function () {
            if (!$(this).parent().hasClass('twitter-typeahead')) {
                var source = new Bloodhound({
                    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                    remote: {
                        url: $(this).data('typeahead-url'),
                        wildcard: '__QUERY_PLACEHOLDER__'
                    }
                });

                var options = {
                    hint: true,
                    highlight: true,
                    minLength: 1
                };
                var dataset = {
                    source: source
                };
                if ($(this).data('limit') !== undefined) {
                    dataset.limit = $(this).data('limit');
                }

                $(this).typeahead(options, dataset);
            }
        });
    }

    $(document).ready(typeahead);
    $(document).ajaxComplete(typeahead);

})(jQuery, window);