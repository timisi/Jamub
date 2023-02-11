    // $(document).ready(function() {
    //     var dynamic_form =  $("#dynamic_form").dynamicForm("#dynamic_form","#plus5", "#minus5", {
    //         limit:5,
    //         formPrefix : "dynamic_form",
    //         normalizeFullForm : false
    //     });

    //     dynamic_form.inject([{taskname: 'Task Done',taskqty: '123',taskachieved: '123'},{taskname: 'Task Done',taskqty: '123',taskachieved: '123'}]);

    //     $("#dynamic_form #minus5").on('click', function(){
    //         var initDynamicId = $(this).closest('#dynamic_form').parent().find("[id^='dynamic_form']").length;
    //         if (initDynamicId === 2) {
    //             $(this).closest('#dynamic_form').next().find('#minus5').hide();
    //         }
    //         $(this).closest('#dynamic_form').remove();
    //     });

    //     $('form').on('submit', function(event){
    //         var values = {};
    //         $.each($('form').serializeArray(), function(i, field) {
    //             values[field.name] = field.value;
    //         });
    //         console.log(values)
    //         event.preventDefault();
    //     })
    // });

    
    // $(document).ready(function(){
    //     $("body").on("click",".add_new_frm_field_btn", function (){ 
    //       console.log("clicked");
    //       var index = $(".form_field_outer").find(".form_field_outer_row").length + 1;
    //       $(".form_field_outer").append(`
    //           <div class="row form_field_outer_row">
    //               <div class="form-group col-md-6">
    //                 <input type="text" class="form-control w_90" name="mobileb_no[]" id="mobileb_no_${index}" placeholder="Enter mobiel no." />
    //               </div>
    //               <div class="form-group col-md-4">
    //                 <select name="no_type[]" id="no_type_${index}" class="form-control" >
    //                   <option>--Select type--</option>
    //                   <option>Personal No.</option>
    //                   <option>Company No.</option>
    //                   <option>Parents No.</option>
    //                 </select>
    //               </div>
    //               <div class="form-group col-md-2 add_del_btn_outer">
    //                 <button class="btn_round add_node_btn_frm_field" title="Copy or clone this row">
    //                   <i class="fas fa-copy"></i>
    //                 </button>
    
    //                 <button class="btn_round remove_node_btn_frm_field" disabled>
    //                   <i class="fas fa-trash-alt"></i>
    //                 </button>
    //               </div>
    //             </div>
    //         `);
    
    //       $(".form_field_outer").find(".remove_node_btn_frm_field:not(:first)").prop("disabled", false);
    //       $(".form_field_outer").find(".remove_node_btn_frm_field").first().prop("disabled", true);
    //     });
    //  });
    
    
        ///======Clone method
    // $(document).ready(function(){
    //     $("body").on("click", ".add_node_btn_frm_field", function (e) {
    //       var index = $(e.target).closest(".form_field_outer").find(".form_field_outer_row").length + 1;
    //       var cloned_el = $(e.target).closest(".form_field_outer_row").clone(true);
    
    //       $(e.target).closest(".form_field_outer").last().append(cloned_el).find(".remove_node_btn_frm_field:not(:first)").prop("disabled", false);
    
    //       $(e.target).closest(".form_field_outer").find(".remove_node_btn_frm_field").first().prop("disabled", true);
    
        
          //change id
          // $(e.target).closest(".form_field_outer").find(".form_field_outer_row").last().find("input[type='text']").attr("id", "mobileb_no_"+index);
    
          // $(e.target).closest(".form_field_outer").find(".form_field_outer_row").last().find("select").attr("id", "no_type_"+index);
    
          // console.log(cloned_el);
          //count++;
    //     });
    //  });
    
    
    // $(document).ready(function(){
        //===== delete the form fieed row
    //     $("body").on("click", ".remove_node_btn_frm_field", function () {
    //       $(this).closest(".form_field_outer_row").remove();
    //       console.log("success");
    //     });
    //   });
    


    // CURRENT
    
    // $(document).ready(function(){
 
    //   $(document).on('click', '.add', function(){
    //    var html = '';
    //    html += '<tr>';
    //    html += '<td><input type="text" name="taskname[]" class="form-control taskname" required="true" placeholder="Enter task here&hellip;"></td>';
    //    html += '<td><input type="text" name="taskname[]" class="form-control taskname" required="true" placeholder="Enter task here&hellip;"></td>';
    //    html += '<input type="text" name="taskexpected[]" class="form-control taskexpected" required="true" placeholder="Enter number&hellip;"></td>';
    //    html += '<td><input type="text" name="taskachieved[]" class="form-control taskachieved" required="true" placeholder="Enter number&hellip;"></td>';
    //    html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="fa fa-minus" aria-hidden="true"></span></button></td></tr>';
       
      //  html += '<td><input type="text" name="item_name[]" class="form-control item_name" /></td>';
      //  html += '<td><input type="text" name="item_quantity[]" class="form-control item_quantity" /></td>';
      //  html += '<td><select name="item_unit[]" class="form-control item_unit"><option value="">Select Unit</option><?php echo fill_unit_select_box($connect); ?></select></td>';
      //  html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="fa fa-minus" aria-hidden="true"></span></button></td></tr>';
    //    $('#item_table').append(html);
    //   });
      
    //   $(document).on('click', '.remove', function(){
    //    $(this).closest('tr').remove();
    //   });
      
    //   $('#insert_form').on('submit', function(event){
    //    event.preventDefault();
    //    var error = '';
    //    $('.taskname[]').each(function(){
    //     var count = 1;
    //     if($(this).val() == '')
    //     {
    //      error += "<p>Describe the task done at "+count+" Row</p>";
    //      return false;
    //     }
    //     count = count + 1;
    //    });

       
    //    $('.taskexpected[]').each(function(){
    //     var count = 1;
    //     if($(this).val() == '')
    //     {
    //      error += "<p>Kindly enter the number of expected task at "+count+" Row</p>";
    //      return false;
    //     }
    //     count = count + 1;
    //    });

       
    //    $('.taskachieved[]').each(function(){
    //     var count = 1;
    //     if($(this).val() == '')
    //     {
    //      error += "<p>Kindly enter the number of task achieved at "+count+" Row</p>";
    //      return false;
    //     }
    //     count = count + 1;
    //    });


    //    var form_data = $(this).serialize();
    //    if(error == '')
    //    {
    //     $.ajax({
    //      url:"insert.php",
    //      method:"POST",
    //      data:form_data,
    //      success:function(data)
    //      {
    //       if(data == 'ok')
    //       {
    //        $('#item_table').find("tr:gt(0)").remove();
    //        $('#error').html('<div class="alert alert-success">Item Details Saved</div>');
    //       }
    //      }
    //     });
    //    }
    //    else
    //    {
    //     $('#error').html('<div class="alert alert-danger">'+error+'</div>');
    //    }
    //   });
      
    //  });
     



    