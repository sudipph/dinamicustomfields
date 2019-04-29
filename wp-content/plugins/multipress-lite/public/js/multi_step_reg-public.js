jQuery(function($) {
 
  /***
  * All the tags with .msr_form_steps class will render with the form.
  ***/

  $("#msr-form-wrapper .msr_form_steps").each(function( index ){
    formData = all_steps[index];
    var formRenderOpts = {
      formData,
      dataType: 'json'
    };
    $(this).formRender(formRenderOpts);
  });

  $("#msr-form-wrapper #main-form").show();
  $("#msr-form-wrapper #form-loader").hide();

  /***
  * After the form is generated then making it multistep
  ***/
  var $signupForm = $( "#SignupForm" );
 
  $signupForm.validate({
    ignore: ".ignore",
    errorElement: "em",
    rules : {
        msr_username:{
          minlength : 5,
          required: true,
          checkUsername: true
        },
        msr_email:{
          required: true,
          email:true,
          checkEmail: true
        },
        msr_password : {
          minlength : 5
        },
        msr_cpassword : {
            minlength : 5,
            equalTo : "input[name='msr_password']"
        },
        hiddenRecaptcha: {
            required: function () {
                if (grecaptcha.getResponse() == '') {
                    return true;
                } else {
                    return false;
                }
            }
        }
    },
    submitHandler: function (form) {
      form.submit();
    }
  });
 
  $signupForm.formToWizard({
    submitButton: "SaveAccount",
    nextBtnClass: "btn btn-primary next",
    prevBtnClass: "btn btn-default prev",
    buttonTag:    "button",
    validateBeforeNext: function(form, step) {
      var stepIsValid = true;
      var validator = form.validate();
      $(":input", step).each( function(index) {
          var xy = validator.element(this);
          stepIsValid = stepIsValid && (typeof xy == "undefined" || xy);
      });
      return stepIsValid;
    },
    progress: function (i, count) {
      $("#progress-complete").width(""+(i/count*100)+"%");
    }
  });

  //Extra method to check the username
  $.validator.addMethod("checkUsername",
    function(value, element) {
        var result = false;
        $.ajax({
            type:"GET",
            async: false,
            url: msr_jsvars.msr_admin_ajaxurl+'?action=is_field_exists&msr_username='+value,
            success: function(msg) {
              result = (msg == "exists") ? false : true;
            }
        });
        return result;
    },
    "Username Already Exists."
  );

  //Extra method to check the email
  $.validator.addMethod("checkEmail",
    function(value, element) {
        var result = false;
        $.ajax({
            type:"GET",
            async: false,
            url: msr_jsvars.msr_admin_ajaxurl+'?action=is_field_exists&msr_email='+value,
            success: function(msg) {
              result = (msg == "exists") ? false : true;
            }
        });
        return result;
    },
    "Email Already Exists."
  );

});