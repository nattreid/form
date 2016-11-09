(function ($, window, Nette) {
    if (window.jQuery === undefined) {
        console.error('Plugin "jQuery" required by "nextras.js" is missing!');
        return;
    }

    // nextras form
    Nette.getValuePrototype = Nette.getValue;
    Nette.getValue = function (elem) {
        if (!elem || !elem.nodeName || !(elem.nodeName.toLowerCase() == 'input' && elem.name.match(/\[\]$/))) {
            return Nette.getValuePrototype(elem);
        } else {
            var value = [];
            for (var i = 0; i < elem.form.elements.length; i++) {
                var e = elem.form.elements[i];
                if (e.nodeName.toLowerCase() == 'input' && e.name == elem.name && e.checked) {
                    value.push(e.value);
                }
            }

            return value.length == 0 ? null : value;
        }
    };

    // typehead
    $('.typeahead').each(function () {
        $(this).typeahead({
            remote: {
                url: $(this).attr('data-typeahead-url'),
                wildcard: '__QUERY_PLACEHOLDER__'
            }
        });
    });

})(jQuery, window, Nette);