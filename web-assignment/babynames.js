

$(document).ready(function(){ initFunc()});

function initFunc(){
  $('#getNamesBtn').click (getNames);
}

function getNames(){
  var requestYear=$('#inputYear').val();
$.ajax({
  url:"/babynames.php",
  method:'GET',
  dataType:'json',
  data:{year:requestYear},
  statusCode:{

    400:function(){
      $('table').css({"display":"none"});
      $('#error').css({"display":"block"});

    },
    200:function(data){
      $('#error').css({"display":"none"});
      $('#cy').text(requestYear);
      $.each(data,function(){
        $("#"+this['gender'].toLowerCase()+this['ranking']).text(this['name']);
      });

      $('table').css({"display":"block"});
      $('#dispYear').text(requestYear);
    }
  }
});

}