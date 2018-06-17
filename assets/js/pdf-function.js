/* pdf-functions.js contains pdf JS  */
/*  Author : CrdioStudio Dev team */

/* custom functions */

jQuery('#lp_profile_pdf').click(function () {
    doc.fromHTML(jQuery('#lp_profile_for_pdf').html(), 15, 15, {
        'width': 170,
            'elementHandlers': specialElementHandlers
    });
    doc.save('my-profile.pdf');
});


/* core function */

var doc = new jsPDF();
var specialElementHandlers = {
    '.lpeditor': function (element, renderer) {
        return true;
    }
};

