function login()
{

  $.ajax({
  type: 'POST',
  url: config.web_url+'cpanel/login/auth',
  data: { postVar1: 'theValue1', postVar2: 'theValue2' },
  beforeSend:function(){

  },
  success:function(data){

  },
  error:function(){

  }
  });

}