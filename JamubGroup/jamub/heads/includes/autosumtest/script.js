// 1
$(function(){
            $('#acceptcontruc, #demostratesple').keyup(function(){
               var value1 = parseFloat($('#acceptcontruc').val()) || 0;
               var value2 = parseFloat($('#demostratesple').val()) || 0;
               var acceptaddition = value1 + value2;
               $('#sumpersonality').val(acceptaddition / 10*100);
               var test1 = acceptaddition /10 * 100;
               document.getElementById('sumpersonality').setAttribute('value', test1);
            });
         });

// 2
$(function(){
            $('#meetestablished, #carefullyfollows').keyup(function(){
               var value3 = parseFloat($('#meetestablished').val()) || 0;
               var value4 = parseFloat($('#carefullyfollows').val()) || 0;
               var meetaddition = value3 + value4;
               $('#sumqow').val(meetaddition / 10*100);
               var test2 = meetaddition /10 * 100;
               document.getElementById('sumqow').setAttribute('value', test2);
            });
         });


// 3
$(function(){
            $('#expressself, #providesfeedback').keyup(function(){
               var value5 = parseFloat($('#expressself').val()) || 0;
               var value6 = parseFloat($('#providesfeedback').val()) || 0;
               var expressaddition = value5 + value6;
               $('#sumcommunication').val(expressaddition / 10*100);
               var test3 = expressaddition /10 * 100;
               document.getElementById('sumcommunication').setAttribute('value', test3);
            });
         });


// 4
$(function(){
            $('#regularlypresent, #usesleave').keyup(function(){
               var value7 = parseFloat($('#regularlypresent').val()) || 0;
               var value8 = parseFloat($('#usesleave').val()) || 0;
               var regularlyaddition = value7 + value8;
               $('#sumattendance').val(regularlyaddition / 10*100);
               var test4 = regularlyaddition /10 * 100;
               document.getElementById('sumattendance').setAttribute('value', test4);
            });
         });


// 5
$(function(){
            $('#performduties, #profersolutions, #comesup').keyup(function(){
               var value9 = parseFloat($('#performduties').val()) || 0;
               var value10 = parseFloat($('#profersolutions').val()) || 0;
               var value11 = parseFloat($('#comesup').val()) || 0;
               var performaddition = value9 + value10 + value11;
               $('#suminitiative').val(performaddition / 15 * 100);
               var test5 = performaddition /15 * 100;
               document.getElementById('suminitiative').setAttribute('value', test5);
            });
         });


// 6
$(function(){
            $('#skilsandknowledge, #properunderstanding').keyup(function(){
               var value12 = parseFloat($('#skilsandknowledge').val()) || 0;
               var value13 = parseFloat($('#properunderstanding').val()) || 0;
               var jobknwaddition = value12 + value13;
               $('#sumjobknowledge').val(jobknwaddition / 10 * 100);
               var test6 = jobknwaddition /10 * 100;
               document.getElementById('sumjobknowledge').setAttribute('value', test6);
            });
         });


// 7
$(function(){
            $('#workwell, #willinglyaccept').keyup(function(){
               var value14 = parseFloat($('#workwell').val()) || 0;
               var value15 = parseFloat($('#willinglyaccept').val()) || 0;
               var cooperationaddition = value14 + value15;
               $('#sumteamwork').val(cooperationaddition / 10 * 100);
               var test7 = cooperationaddition /10 * 100;
               document.getElementById('sumteamwork').setAttribute('value', test7);
            });
         });


// 8
$(function(){
            $('#confidentiality, #personaldevelopment').keyup(function(){
               var value16 = parseFloat($('#confidentiality').val()) || 0;
               var value17 = parseFloat($('#personaldevelopment').val()) || 0;
               var maintainaddition = value16 + value17;
               $('#sumproffessional').val(maintainaddition / 10 * 100);
               var test8 = maintainaddition /10 * 100;
               document.getElementById('sumproffessional').setAttribute('value', test8);
            });
         });

// 9
$(function(){
            $('#motivatemembers, #clearexpectations, #delegateduties').keyup(function(){
               var value18 = parseFloat($('#motivatemembers').val()) || 0;
               var value19 = parseFloat($('#clearexpectations').val()) || 0;
               var value20 = parseFloat($('#delegateduties').val()) || 0;
               var leadershipaddition = value18 + value19+ value20;
               $('#sumleadership').val(leadershipaddition / 15 * 100);
               var test9 = leadershipaddition /15 * 100;
               document.getElementById('sumleadership').setAttribute('value', test9);
            });
         });


// 10
$(function(){
   $('#adheresto, #personalactions, #communicatehigh').keyup(function(){
      var value21 = parseFloat($('#adheresto').val()) || 0;
      var value22 = parseFloat($('#personalactions').val()) || 0;
      var value23 = parseFloat($('#communicatehigh').val()) || 0;
      var integrityaddition = value21 + value22 + value23;
      $('#sumintegrity').val(integrityaddition / 15 * 100);
      var test10 = integrityaddition /15 * 100;
      document.getElementById('sumintegrity').setAttribute('value', test10);
   });
});




// 11
$(function(){
   $('#acceptcontruc, #demostratesple,#adheresto,#personalactions, #communicatehigh, #meetestablished, #carefullyfollows,#expressself, #providesfeedback, #regularlypresent, #usesleave,#performduties, #profersolutions, #comesup,#skilsandknowledge, #properunderstanding,#workwell, #willinglyaccept,#confidentiality, #personaldevelopment,#motivatemembers, #clearexpectations, #delegateduties').keyup(function(){
      var val1 = parseFloat($('#acceptcontruc').val()) || 0;
      var val2 = parseFloat($('#demostratesple').val()) || 0;
      var val3 = parseFloat($('#adheresto').val()) || 0;
      var val4 = parseFloat($('#personalactions').val()) || 0;
      var val5 = parseFloat($('#communicatehigh').val()) || 0;
      var val6 = parseFloat($('#meetestablished').val()) || 0;
      var val7 = parseFloat($('#carefullyfollows').val()) || 0;
      var val8 = parseFloat($('#expressself').val()) || 0;
      var val9 = parseFloat($('#providesfeedback').val()) || 0;
      var val10 = parseFloat($('#regularlypresent').val()) || 0;
      var val11 = parseFloat($('#usesleave').val()) || 0;
      var val12 = parseFloat($('#performduties').val()) || 0;
      var val13 = parseFloat($('#profersolutions').val()) || 0;
      var val14 = parseFloat($('#comesup').val()) || 0;
      var val15 = parseFloat($('#skilsandknowledge').val()) || 0;
      var val16 = parseFloat($('#properunderstanding').val()) || 0;
      var val17 = parseFloat($('#workwell').val()) || 0;
      var val18 = parseFloat($('#willinglyaccept').val()) || 0;
      var val19 = parseFloat($('#personaldevelopment').val()) || 0;
      var val20 = parseFloat($('#motivatemembers').val()) || 0;
      var val21 = parseFloat($('#clearexpectations').val()) || 0;
      var val22 = parseFloat($('#delegateduties').val()) || 0;
      var val23 = parseFloat($('#confidentiality').val()) || 0;

      var sumallval= val1 + val2 + val3 + val4 + val5 + val6 + val7 + val8 + val9 + val10 + val11 + val12 + val13 + val14 + val15 + val16 + val17 + val18 + val19 + val20 + val21 + val22 + val23;
      $('#grandtotal').val(sumallval / 115 * 100);
      var sumallvalgrand = sumallval /115 * 100;
      document.getElementById('grandtotal').setAttribute('value', sumallvalgrand);
   });
});

