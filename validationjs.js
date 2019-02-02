//CUSTOM FUNCTIONS ---------

$.validator.addMethod("alpha", function(value, element) {
    return this.optional(element) || value == value.match(/^[a-zA-Z]+$/);
 }, "Letters only Please");

 $.validator.addMethod("au_post", function(value, element) {
     return this.optional(element) || value == value.match(/[0-9]{3,4}/);
  }, "Valid Postcode Please");

//------END CUSTOM FUNCTIONS--------------
 
$(document).ready(function () {

    $('#myform').validate({ // initialize the plugin
        rules: {
            email: {
                required: false,
                email: true
            },
            text: {
                required: false,
                minlength: 2,
                maxlength: 300,
                alpha: true
            },
            phone: {
                required: false,
                digits: true
            },
            postcode: {
                required: false,
                digits: true,
                au_post: true
            },
            domain: {
                required: false,
                minlength: 7
            },
        },
        submitHandler: function (form) {
            return true;
        }
    });

});
