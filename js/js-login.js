$(document).ready(function () {

	// PARA LOS EFECTOS DEL LOGIN
	// $("#user_login").on('keyup click',function(event){
//        if (event.type == 'keyup') {
//            var dtr=$("#user_password").val();
//            if(dtr.trim().length==0){
//                $("#idplhpass").css({'display':'block'});
//            }else{
//                $("#idplhpass").css({'display':'none'});
//            }            
//        } else if (event.type == 'click') {
//            var dtr=$("#user_password").val();
//            if(dtr.trim().length==0){
//                $("#idplhpass").css({'display':'block'});
//            }else{
//                $("#idplhpass").css({'display':'none'});
//            }
//        }   
//    });

//    $("#user_password").on('keyup click',function(event){
//        if (event.type == 'keyup') {
//            var dtr=$("#user_login").val();
//            if(dtr.trim().length==0){
//                $("#idplhusu").css({'display':'block'});
//            }else{
//                $("#idplhusu").css({'display':'none'});
//            }
//        } else if (event.type == 'click') {
//            var dtr=$("#user_login").val();
//            if(dtr.trim().length==0){
//                $("#idplhusu").css({'display':'block'});
//            }else{
//                $("#idplhusu").css({'display':'none'});
//            }
//        }   
//    });

	$("html").click(function() {
	    var pdtr=$("#user_password").val();
        if(pdtr.trim().length==0){
            $("#idplhpass").css({'display':'block'});
        }else{
            $("#idplhpass").css({'display':'none'});
        }
        var udtr=$("#user_login").val();
        if(udtr.trim().length==0){
            $("#idplhusu").css({'display':'block'});
        }else{
            $("#idplhusu").css({'display':'none'});
        }
	});

    logeo = function () {
        loginDAO.checkUser();
    }

    $('#user_login').keypress(function(e){
		if (e.keyCode == 13) {
			$('#user_password').focus();
		}
	});

	$('#user_password').keypress(function(e){
		if (e.keyCode == 13) {
			logeo();
		}
	});

});