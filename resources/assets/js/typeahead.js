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
                    minLength: $(this).data('min-length') ? $(this).data('min-length') : 1
                };

                var dataset = {
                    source: source
                };
                if ($(this).data('suggestion-display') !== undefined) {
                    dataset.display = $(this).data('suggestion-display');
                }
                if ($(this).data('limit') !== undefined) {
                    dataset.limit = $(this).data('limit');
                }

                dataset.templates = {};
                if ($(this).data('empty-message') !== undefined) {
                    dataset.templates.empty = '<div class="empty-message">' + $(this).data('empty-message') + '</div>';
                }
                if ($(this).data('suggestion-callback') !== undefined) {
                    var callback = $(this).data('suggestion-callback');
                    dataset.templates.suggestion = eval(callback);
                }

                $(this).typeahead(options, dataset);

                if ($(this).data('submit-on-select') !== undefined) {
                    var form = $(this).closest('form');
                    $(this).bind('typeahead:select', function (ev, suggestion) {
                        form.submit();
                    });
                }
            }
        });

        $('.tt-hint').removeAttr('data-nette-rules');
    }

    $(document).ready(typeahead);
    $(document).ajaxComplete(typeahead);

})(jQuery, window);