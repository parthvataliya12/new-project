/*
 *  Document   : base_forms_validation.js
 *  Author     : pixelcave
 *  Description: Custom JS code used in Form Validation Page
 */

var BaseFormValidation = function() {
    // Init Bootstrap Forms Validation, for more examples you can check out https://github.com/jzaefferer/jquery-validation
    var initValidationBootstrap = function(){
        jQuery('.js-validation-bootstrap').validate({
            errorClass: 'help-block animated fadeInDown',
            errorElement: 'div',
            errorPlacement: function(error, e) {
                jQuery(e).parents('.form-group > div').append(error);
            },
            highlight: function(e) {
                jQuery(e).closest('.form-group').removeClass('has-error').addClass('has-error');
                jQuery(e).closest('.help-block').remove();
            },
            success: function(e) {
                jQuery(e).closest('.form-group').removeClass('has-error');
                jQuery(e).closest('.help-block').remove();
            },
            rules: {
                'brand_id': {
                    required: true
                   
                },
                'a_type': {
                    required: true
            
                },
                'model_id[]': {
                    required: true
                   
                },
                'a_name': {
                    required: true
                  
                },
                'a_picture': {
                    required: true
                   
                },
                'a_description': {
                    required: true
                   
                }
            },
            messages: {
                
                'brand_id': 'Please Select Brand',
                'a_type': 'Please Accessories Type',
                'model_id[]': 'Please Select Models',
                'a_name': 'Please Enter Name',
                'a_picture': 'Please Select Picture',
                'a_description': 'Please Enter Details'
               
            }
        });
    };

    // Init Material Forms Validation, for more examples you can check out https://github.com/jzaefferer/jquery-validation
  

    return {
        init: function () {
            // Init Bootstrap Forms Validation
            initValidationBootstrap();

          
        }
    };
}();

// Initialize when page loads
jQuery(function(){ BaseFormValidation.init(); });