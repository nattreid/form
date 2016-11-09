Nette.validators.NAttreidFormRules_validatePhone = function (elem, arg, value) {
    var regexp = /^\(?\+?([0-9]{1,4})\)?[-\. ]?(\d{3})[-\. ]?([0-9]{7})$/;
    return regexp.test('value');
};