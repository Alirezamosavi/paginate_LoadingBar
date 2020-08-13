<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paginate in Laravel using Ajax with Loadbar</title>

    <link href="{{mix('css/app.css')}}" rel='stylesheet'> 

    <script type="text/javascript" src="{{ mix('js/app.js') }}" ></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

</head>
<body>
<div id='clear'>
    <h1 >Its Work</h1>


    <input type="button" class='button btn btn-primary ' onclick="move()" value="Change" data-id="Submit">

    <script>
    
    $(document).ready(function(){
    var loading = false; 
       $('.button').click(function(event){
	   event.preventDefault();  
	if (loading){
     return ;
    };
	    var date = $(this).attr("data-id");
        // this is for loadingBar
        $({property: 0}).animate({property: 105}, {
            duration: 4000,
            step: function() {
            var _percent = Math.round(this.property);

            $('#progress').css('width',  _percent+"%");
              if(_percent == 105) {
                $("#progress").addClass("done");
              }
    },
    complete: function() {

    }
  });
    
    
    $.ajax({
    	url: '/ajax/GetContent/'+date,
	    data: {
            date: date
        },
		
        type: "GET", 
        success: function(data){
	    loading = false;	
        $data = $(data); 
	    $('#clear').hide().html($data).fadeIn(); 
	   window.history.pushState('', '', '/ajax/GetContent/'+date);

	     
      }
  });
 });
});
    
    </script>


      
<script>
var i = 0;
function move() {
  if (i == 0) {
    i = 1;
    var elem = document.getElementById("myBar");
    var width = 1;
    var id = setInterval(frame, 10);
    function frame() {
      if (width >= 100) {
        clearInterval(id);
        i = 0;
      } else {
        width++;
        elem.style.width = width + "1%";
      }
    }
  }
}
</script>


<style>
#myProgress {
  width: 100%;
  background-color: white;
}

#myBar {
  position: fixed;
  z-index: 2147483647;
  top: 0;
  left: -6px;
  width: 0%;
  height: 2px;
  width: 0;
  height: 3px;
  background-color: red;
}
</style>
<div id="myProgress">
  <div id="myBar"></div>
</div>


</div>
</body>
</html>