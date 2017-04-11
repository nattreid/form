(function ($, window) {
    if (window.jQuery === undefined) {
        console.error('Plugin "jQuery" required by "daterangepicker.js" is missing!');
        return;
    } else if (window.moment === undefined) {
        console.error('Plugin "moment.js" required by "daterangepicker.js" is missing!');
        return;
    } else if ($.fn.daterangepicker === undefined) {
        console.error('Plugin "bootstrap-daterangepicker.js" required by "daterangepicker.js" is missing!');
        return;
    }

    var ranges = {
        today: [window.moment(), window.moment()],
        yesterday: [window.moment().subtract(1, 'days'), window.moment().subtract(1, 'days')],
        last7Days: [window.moment().subtract(6, 'days'), window.moment()],
        last30Days: [window.moment().subtract(29, 'days'), window.moment()],
        thisMonth: [window.moment().startOf('month'), window.moment().endOf('month')],
        lastMonth: [window.moment().subtract(1, 'month').startOf('month'), window.moment().subtract(1, 'month').endOf('month')]
    };

    var localize = {
        cs: {
            locale: {
                applyLabel: 'Odeslat',
                cancelLabel: 'Zrušit',
                fromLabel: 'Od',
                toLabel: 'Do',
                weekLabel: 'T',
                monthNames: moment.months(),
                customRangeLabel: 'Vybrané období'
            },
            ranges: {
                'Dnes': ranges.today,
                'Včera': ranges.yesterday,
                'Posledních 7 dní': ranges.last7Days,
                'Posledních 30 dní': ranges.last30Days,
                'Tento měsíc': ranges.thisMonth,
                'Minulý měsíc': ranges.lastMonth
            },
            format: {
                date: 'DD.MM.YYYY',
                time: 'HH:mm'
            }
        },
        en: {
            locale: {
                applyLabel: 'Apply',
                cancelLabel: 'Cancel',
                fromLabel: 'From',
                toLabel: 'To',
                weekLabel: 'W',
                customRangeLabel: 'Custom Range'
            },
            ranges: {
                'Today': ranges.today,
                'Yesterday': ranges.yesterday,
                'Last 7 Days': ranges.last7Days,
                'Last 30 Days': ranges.last30Days,
                'This Month': ranges.thisMonth,
                'Last Month': ranges.lastMonth
            },
            format: {
                date: 'MM/DD/YYYY',
                time: 'HH:mm'
            }
        }
    };

    var locale = localize[window.moment.locale()];

    // datepicker
    $(document).on('focus', '.form-date', function () {
        if (typeof $(this).data('daterangepicker') === 'undefined') {
            var loc = locale.locale;
            loc.format = locale.format.date;

            $(this).daterangepicker(
                {
                    showDropdowns: true,
                    autoApply: true,
                    singleDatePicker: true,
                    autoUpdateInput: false,
                    locale: loc
                }
            )
                .keyup(function (e) {
                    if (e.keyCode === 46) {
                        $(this).val('');
                    }
                });
            $(this).on('apply.daterangepicker', function (ev, picker) {
                $(this).val(picker.startDate.format(locale.format.date));
                $(this).trigger('change');
            });
        }
    });

    // datetimepicker
    $(document).on('focus', '.form-datetime', function () {
        if (typeof $(this).data('daterangepicker') === 'undefined') {
            var loc = locale.locale;
            loc.format = locale.format.date + ' ' + locale.format.time;

            $(this).daterangepicker(
                {
                    showDropdowns: true,
                    timePicker: true,
                    timePicker24Hour: true,
                    singleDatePicker: true,
                    autoApply: true,
                    autoUpdateInput: false,
                    locale: loc
                }
            )
                .keyup(function (e) {
                    if (e.keyCode === 46) {
                        $(this).val('');
                    }
                });
            $(this).on('apply.daterangepicker', function (ev, picker) {
                $(this).val(picker.startDate.format(locale.format.date + ' ' + locale.format.time));
                $(this).trigger('change');
            });
        }
    });

    // daterangepicker
    $(document).on('focus', '.form-daterange', function () {
        if (typeof $(this).data('daterangepicker') === 'undefined') {
            var loc = locale.locale;
            loc.format = locale.format.date;

            $(this).daterangepicker(
                {
                    showDropdowns: true,
                    ranges: locale.ranges,
                    autoApply: true,
                    autoUpdateInput: false,
                    locale: loc
                }
            )
                .keyup(function (e) {
                    if (e.keyCode === 46) {
                        $(this).val('');
                    }
                });

            $(this).on('apply.daterangepicker', function (ev, picker) {
                $(this).val(picker.startDate.format(locale.format.date) + ' - ' + picker.endDate.format(locale.format.date));
                $(this).trigger('change');
            });
        }
    });

})(jQuery, window);
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

})(jQuery, window, Nette);
Nette.validators.NAttreidFormRules_validatePhone = function (elem, arg, value) {
    if (!elem.hasAttribute('required') && value.length === 0) {
        return true;
    }
    var regexp = /^(\(?\+?([0-9]{1,4})\)?)?([0-9]{6,16})$/;
    return regexp.test(value.replace(/[-\.\s]+/g, ''));
};
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