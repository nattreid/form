Nette.validators.NAttreidFormRules_validatePhone = function (elem, arg, value) {
    if (!elem.hasAttribute('required') && value.length === 0) {
        return true;
    }
    var regexp = /^(\(?\+?([0-9]{1,4})\)?)?([0-9]{6,16})$/;
    return regexp.test(value.replace(/[-\.\s]+/g, ''));
};