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