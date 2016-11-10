Nette.validators.NAttreidFormRules_validatePhone = function (elem, arg, value) {
    var regexp = /^(\(?\+?([0-9]{1,4})\)?)?([0-9]{6,16})$/;
    return regexp.test(value.replace(/[-\.\s]+/g, ''));
};