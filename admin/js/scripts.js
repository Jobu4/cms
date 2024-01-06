
  $(document).ready(function(){
    $('#selectAllboxes').click(function(event){
        if(this.checked){
            $('.checkboxes').each(function(){
                this.checked = true;

            });
        
        }else{
            $('.checkboxes').each(function(){
                this.checked = false;

            });
        }
    });
  });

  $(document).ready(function() {
    //the function below is for page loader
var div_box = "<div id='load-screen'><div id='loading'></div></div>";
$("body").prepend(div_box);
$('#load-screen').delay(700).fadeOut(600, function(){
    $(this).remove();
});
  });

 $(document).ready(function() {
    $('#summernote').summernote({
        height: 200
    });
  });


function loadUsersOnline(){
$.get("functions.php?onlineusers=result",function(data){
$(".usersonline").text(data);
}).fail(function(){
    console.log("Error loading users online.");
}).always(function(){
    console.log("Request complete.");
});
}
    setInterval(function(){
        loadUsersOnline();
    }, 500);


