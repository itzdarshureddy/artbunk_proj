function getNames(){
  var requestYear=$('#inputYear').val();
$.ajax({
  url:"/babynames.php",
  method:'GET',
  dataType:'json',
  data:{year:requestYear},
  statusCode:{

    400:function(){
      alert('enter correct Year and try again');
    },
    200:function(data){
      $('#cy').text(requestYear);
      $.each(data,function(){
        $("#"+this['gender'].toLowerCase()+this['ranking']).text(this['name']);
      });
    }
  }
});

}

$(document).ready = initFunc;

function initFunc(){
  alert("hi");
}