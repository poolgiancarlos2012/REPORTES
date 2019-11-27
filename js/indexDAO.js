var indexDAO={
  url:'../controller/ControllerAlfa.php',
  hide_message:function(){
  	$('#'+indexDAO.idLayerMessage).effect('blind',{direction:'vertical'},'slow',function(){ $(this).empty().css('display','block'); });		
  },
  setTimeOut_hide_message:function(){
  	setTimeout("indexDAO.hide_message()",2000);
  }
}


