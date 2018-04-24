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
            var increment = $(this).data('increment');

            var data = {
                showDropdowns: true,
                timePicker: true,
                timePicker24Hour: true,
                singleDatePicker: true,
                autoApply: true,
                autoUpdateInput: false,
                locale: loc
            };

            if (increment !== undefined) {
                data.timePickerIncrement = increment;
            }

            $(this).daterangepicker(data)
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