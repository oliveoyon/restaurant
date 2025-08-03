
    //Word Count

    var myText = document.getElementById("witness_name");
    var wordCount = document.getElementById("wordCount");
    
    myText.addEventListener("keyup",function(){
      var characters = myText.value.split('');
      wordCount.innerText = characters.length;
      if(characters.length > 25){
        myText.value = myText.value.substring(0,25);
        wordCount.innerText = 'limit exceed';
      }
    });

    //Word count end
   
    //Add more activity
    
    $(".add_details").click(function(){
        //the below code will append a new user_data div inside user-details container
          $(".user-details").append(" <div class='user_data' style=' padding:5px; margin-top:5px; border:2px solid #ebf0f0;'><div class='form-group row'><label for='Witness Name' class='col-sm-4 control-label'>সাক্ষীর নাম <span style='color:red'>*</span></label><div class='col-sm-8'><input pattern='.{2,25}' title='2 to 25 Char' maxlength='25' minlength='2' class='form-control witness_name' id='witness_name' name='witness_name[]' required placeholder='সাক্ষীর নাম লিখুন' type='text' value=''></div></div><div class='form-group row'><label for='Phone No' class='col-sm-4 control-label'>ফোন নাম্বার<span style='color:red'>*</span></label><div class='col-sm-8'><div class='input-group'><div class='input-group-prepend'><span class='input-group-text'>+88</span></div><input type='text' class='form-control'  name='phone_no[]' required placeholder='ফোন নাম্বার লিখুন' type='text' value='' maxlength='11' minlength='11' onkeypress='validate(event)'></div></div></div><button class='remove-btn' data-toggle='tooltip' data-placement='top' title='Delete'><i style='color:red' class='fas fa-trash' aria-hidden='true'></i></button></div>");  
    });

    $("body").on("click",".remove-btn",function(e){
         $(this).parents('.user_data').remove();
        //the above method will remove the user_data div
    });

    //Add more end

    
var url = window.location;
$('ul.treeview-menu a').filter(function () {
   return this.href == url;
}).parents('li').addClass('active');

$('.datepicker').datepicker({
  autoclose: true,
  orientation: 'bottom',
  format : "dd-mm-yyyy",
  todayHighlight: true,
  
})

$('.abc').datepicker({
  orientation: 'bottom'
})





$('.timepicker').timepicker({
  minuteStep: 5,
  showSeconds: false,
  showMeridian: true,
  defaultTime: '9:00',
  showInputs: false
})

$('.datepicker1').datepicker({
  autoclose: true,
  format : "yyyy-mm-dd",
})



function validate(evt) {
  var theEvent = evt || window.event;

  // Handle paste
  if (theEvent.type === 'paste') {
      key = event.clipboardData.getData('text/plain');
  } else {
  // Handle key press
      var key = theEvent.keyCode || theEvent.which;
      key = String.fromCharCode(key);
  }
  var regex = /[0-9]|\./;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    alert('Please Type English Number');
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}



  
  $(function () {
        $(".chkPassport").click(function () {
            if ($(this).is(":checked")) {
                $("#dvPassport").show();
                $("#AddPassport").hide();
            } else {
                $("#dvPassport").hide();
                $("#AddPassport").show();
            }
        });
    });





var onoff = $('.chkPassport').val();
var x=$(".chkPassport").is(":checked");
var finalEnlishToBanglaNumber={'0':'০','1':'১','2':'২','3':'৩','4':'৪','5':'৫','6':'৬','7':'৭','8':'৮','9':'৯'};
 
String.prototype.getDigitBanglaFromEnglish = function() {
    var retStr = this;
    for (var x in finalEnlishToBanglaNumber) {
         retStr = retStr.replace(new RegExp(x, 'g'), finalEnlishToBanglaNumber[x]);
    }
    return retStr;
};
 
var english_number="123456";
 
var bangla_converted_number=english_number.getDigitBanglaFromEnglish();

$( ".witness_name" )
  .keyup(function() {
    var value = $( this ).val();
    $( ".test" ).text( value );

    //var st = $('.witness_name').val();
    var xx=$(".chkPassport").is(":checked");
    //alert(xx);
    
    if((/^[a-zA-Z0-9- ]*$/.test(value) == false) && xx == true) {
      witness_name.value = witness_name.value.substring(0,0);
      alert('Witness name should be in english.');

     }
     //else if((/^[a-zA-Z0-9- ]*$/.test(value) == true) && xx == false) {
     //   alert('Witness name should be in Bangla.');
     // }



  })
  .keyup();

  $( ".start_date" )
  .mouseout(function() {
    var value = $( this ).val();
    var bndate=value.getDigitBanglaFromEnglish();
    $( ".test1" ).text( value );
    $( ".test1bn" ).text( bndate );
  })
  .mouseout();

  $( ".case_no" )
  .keyup(function() {
    var value = $( this ).val();
    var bncase=value.getDigitBanglaFromEnglish();
    $( ".test3" ).text( value );
    $( ".test3bn" ).text( bncase );
  })
  .keyup();

  $( ".times" )
  .mouseout(function() {
    var value = $( this ).val();
    var bntime=value.getDigitBanglaFromEnglish();
    $( ".test2" ).text( value );
    $( ".test2bn" ).text( bntime );
    
  })
  .mouseout();



