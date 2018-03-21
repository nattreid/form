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

    var localize = {
        cs: {
            locale: {
                applyLabel: 'Vložit',
                cancelLabel: 'Zrušit',
                fromLabel: 'Od',
                toLabel: 'Do',
                weekLabel: 'T',
                monthNames: moment.months(),
                customRangeLabel: 'Vybrané období'
            },
            ranges: {
                today: 'Dnes',
                yesterday: 'Včera',
                thisMonth: 'Tento měsíc',
                lastMonth: 'Minulý měsíc',
                lastDay: 'Za posledních 1 den',
                lastXDays: 'Za poslední %i dny',
                lastDays: 'Posledních %i dní'
            },
            format: {
                date: 'D.M.YYYY',
                time: 'H:mm'
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
                today: 'Today',
                yesterday: 'Yesterday',
                thisMonth: 'This Month',
                lastMonth: 'Last Month',
                lastDay: 'Last 1 Day',
                lastDays: 'Last %i Days'
            },
            format: {
                date: 'M/D/YYYY',
                time: 'H:mm'
            }
        }
    };

    var locale = localize[window.moment.locale()];

    function localeInterval(interval) {
        switch (interval) {
            case 1:
                return locale.ranges.lastDay
            case 2:
            case 3:
            case 4:
                if (locale.ranges.lastXDays !== undefined) {
                    return locale.ranges.lastXDays.replace('%i', interval);
                }
            default:
                return locale.ranges.lastDays.replace('%i', interval);
        }
    }

    function getRanges(intervals) {
        var ranges = {};
        ranges[locale.ranges.today] = [window.moment(), window.moment()];
        ranges[locale.ranges.yesterday] = [window.moment().subtract(1, 'days'), window.moment().subtract(1, 'days')];

        intervals.forEach(function (interval) {
            ranges[localeInterval(interval)] = [window.moment().subtract(interval - 1, 'days'), window.moment()];
        });

        ranges[locale.ranges.thisMonth] = [window.moment().startOf('month'), window.moment().endOf('month')];
        ranges[locale.ranges.lastMonth] = [window.moment().subtract(1, 'month').startOf('month'), window.moment().subtract(1, 'month').endOf('month')];

        return ranges;
    }

    // datepicker
    $(document).on('focus', '.form-date', function () {
        if ($(this).data('daterangepicker') === undefined) {
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
        if ($(this).data('daterangepicker') === undefined) {
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
        if ($(this).data('daterangepicker') === undefined) {
            var loc = locale.locale;
            loc.format = locale.format.date;

            var data = {
                showDropdowns: true,
                autoApply: true,
                autoUpdateInput: false,
                locale: loc
            };
            if (!$(this).data('only-range')) {
                data.ranges = getRanges($(this).data('intervals'));
            }

            $(this).daterangepicker(data)
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

Nette.validators.NAttreidFormRules_validateImage = function (elem, arg, val) {
    if (window.FileList && val instanceof window.FileList) {
        for (var i = 0; i < val.length; i++) {
            var type = val[i].type;
            if (type && type !== 'image/gif' && type !== 'image/png' && type !== 'image/jpeg' && type !== 'image/svg+xml') {
                return false;
            }
        }
    }
    return true;
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
                    minLength: $(this).data('min-length') ? $(this).data('min-length') : 1
                };

                var dataset = {
                    source: source
                };
                if ($(this).data('limit') !== undefined) {
                    dataset.limit = $(this).data('limit');
                }
                if ($(this).data('empty-message') !== undefined) {
                    dataset.templates = {
                        empty: [
                            '<div class="empty-message">',
                            $(this).data('empty-message'),
                            '</div>'
                        ].join('\n')
                    };
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