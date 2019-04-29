jQuery(function($) {
  var fbInstances = [];
  var fields = [{
      label: "Email",
      type: "text",
      subtype: "email",
      icon: "✉"
    }];
  var typeUserDisabledAttrs = {
    'autocomplete': ['access'],
    'button': ['access'],
    'checkbox-group': ['access','other','toggle','inline'],
    'paragraph': ['access'],
    'date': ['access'],
    'file': ['access','multiple','subtype'],
    'header': ['access'],
    'select': ['access'],
    'textarea': ['access','subtype'],
    'text': ['access','subtype'],
    'radio-group': ['access','other','inline'],
    'number': ['access'],
    'hidden': ['access']
  };
  $(".build-wrap").each(function( index ){
    var stepnumber = $(this).attr("data-stepNumber");
    var step_str = 'step_'+stepnumber;
    var form_fields = [];
    
    fbOptions = {
      //fields : fields,
      defaultFields: all_steps[index],
      actionButtons: [],
      typeUserDisabledAttrs: typeUserDisabledAttrs,
      disableFields: ['header','paragraph']
    };
    var formBuilder = $(this).formBuilder( fbOptions );    
    //console.log( stepnumber );
    fbInstances.push( formBuilder );
  });

  //Confirm the delete the tab
  $(".dashicons-dismiss").on("click",function(){
    var content = $(this).parent().text();
    var stepNum = $(this).parent().attr("href");
    var postId = $(this).parents("#msr-form-builder").attr("data-formid");
    if ( confirm( 'Are you sure you want to delete this '+content+'?' ) ) {      
      $.ajax({
        url: ajaxurl,
        method: 'POST',
        data: {action:'delete_section_form',step_number: stepNum,form_id:postId},
        success: function(response){
          alert(response.message);
          window.location.reload();
        }
      });
    }
  });

  $(document.getElementById("save-all")).click(function() {
    var allData = fbInstances.map(function(fb) {
      return fb.formData;
    });        
    var form_id = $("#msr-form-builder").attr("data-formid");
    $.ajax({
      url: ajaxurl,
      method: 'POST',
      data: {action:'save_section_form',formData: allData,form_id:form_id},
      success: function(response){
        alert(response.message);
        window.location.reload();
      }
    });
    console.log(allData);
  });


});