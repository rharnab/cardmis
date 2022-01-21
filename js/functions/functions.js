/*
	Jquery customization datepicker function
	dateFormat: 'D, d-m-yy'=>result example "Mon,20-04-2018"
*/
function jsDatePicker(dateId){
	$( "#"+dateId).datepicker({ 
        dateFormat: 'd-m-yy',
        showAnim: "fold",
        showMonthAfterYear: true,
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        todayBtn: true
    });
}

/*
	// number and digit checking function //
*/
function checkNumberWithDigit(valueId,digit,errorId){
	var recVal = $("#"+valueId).val();
	var trimVal = recVal.trim();
	if(trimVal==''){
		$("#"+errorId).addClass("errorClass").text("Please provide card number!").fadeIn(100);
		$("#"+errorId).removeClass("errorClass").fadeOut(2000);
	}else{
		if(Number(trimVal)){
			if(trimVal.toString().length==digit){
				/*console.log("thanks");*/
			}else{
				$("#"+errorId).addClass("errorClass").text("Please provide actual number").fadeIn(100).css('color','red');
				$("#"+errorId).removeClass("errorClass").fadeOut(3000);
			}
		}else{
			$("#"+errorId).addClass("errorClass").text("It's take only number").fadeIn(100).css('color','red');
			$("#"+errorId).removeClass("errorClass").fadeOut(3000);
		}
	}
	
}



/*
	Email Validations function
*/
function emailValidations(email,errorId) {
	var recvEmail = $("#"+email).val();
    var rexg = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    var validEmail = rexg.test(String(recvEmail).toLowerCase());
    if(!validEmail){
    	$("#"+errorId).addClass("errorClass").text("Please enter valid email!").fadeIn(100).css('color','red');
		$("#"+errorId).removeClass("errorClass").fadeOut(4000);	
    }
}

/*
	Phone number Validations function
*/
function phoneValidation(valueId,errorId){
	var phone = $("#"+valueId).val();
    var rexg = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{5}$/;
    var result = rexg.test(phone);
    if(result){
    }else{
    	$("#"+errorId).addClass("errorClass").text("Please provide 11 digit phone number!").fadeIn(100).css('color','red');
		$("#"+errorId).removeClass("errorClass").fadeOut(4000);
    }
}

/*
	character counting functions
*/
charCounter = function() {
    var value = $('#camMessage').val();
    if (value.length == 0) {
        $('#totalChars').html(0);
        $('#wordCount').html(0);
        return;
    }
    var regex = /\s+/gi;
    var totalChars = value.length;
    var wordCount = value.trim().replace(regex, ' ').split(' ').length;

    $('#totalChars').html(totalChars).css({'color':'red','font-weight':'bold','font-size':'15px'});
    $('#wordCount').html(wordCount).css({'color':'red','font-weight':'bold','font-size':'15px'});
    if(totalChars>160){
        $("#charMsg").text("you can only put maximum 160 characters").css('color','red').fadeIn('slow');
    }else{
        $("#charMsg").fadeOut('fast'); 
    }
};