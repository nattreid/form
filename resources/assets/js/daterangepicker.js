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
                applyLabel: 'Vložit',
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
                'Today': ranges.today,
                'Yesterday': ranges.yesterday,
                'Last 7 Days': ranges.last7Days,
                'Last 30 Days': ranges.last30Days,
                'This Month': ranges.thisMonth,
                'Last Month': ranges.lastMonth
            },
            format: {
                date: 'M/D/YYYY',
                time: 'H:mm'
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

            var data = {
                showDropdowns: true,
                autoApply: true,
                autoUpdateInput: false,
                locale: loc
            };
            if (!$(this).data('only-range')) {
                data.ranges = locale.ranges
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