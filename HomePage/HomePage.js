$(document).ready(function(){
    $("#post").click(function(){
		var title = document.getElementById("titleinput").value;
		var text = $('textarea').val();
		var d = new Date();
    $.post("AddPost.php",
    {title:title,text:text,date:d.getFullYear()+"-"+(d.getMonth()+1)+"-"+d.getDate()});
    setTimeout(function(){ window.location.reload(); }, 500);
	});
});

function addpost(header,text,username,date,postid,userid)
{
	$(document).ready(function(){
		$("#header").after(
			'<div class="row container">'+
			'<div class="col container m6">'+
			'<h2 id="title" class="distext" data-value="'+postid+'" onclick=topost(this)>'+header+'</h2>'+
			'<p class="distext">'+text+'</p>'+
			'</div>'+
			'<div class="col container m1 center">'+
			'<input type="image" class="round" src="head.png" height="30" width="30" data-value="'+userid+'"onclick=toprofile(this)>'+
      '<p class="id" style="margin: 0;font-size:10px;">'+username+'</p>'+
			'<p class="id" style="margin: 0;font-size:10px;">'+date+'</p>'+
			'</div>'+
			'</div>'
		);
	});
}

function backHome(){
  window.location.replace("../LogInPage.php");
}

function toprofile(e){
  var id = document.getElementById("userid").value;
  $.post("AddGuestID.php",
  {guestid:e.dataset.value}
  );
  if(id==e.dataset.value){
    $(document).ready(function(){
  		$("#box").append(
        '<script> window.location.replace("../UserProfile/UserProfile.php");'+
        '</script>";'
  		);
  	});
  }
  else{
    $(document).ready(function(){
  		$("#box").append(
        '<script> window.location.replace("../VisitProfile/VisitProfile.php");'+
        '</script>";'
  		);
  	});
  }
}

function topost(e){
  $.post("AddPostID.php",
  {postid:e.dataset.value}
  );
  $(document).ready(function(){
		$("#box").append(
      '<script> window.location.replace("../Post/Post.php");'+
      '</script>";'
		);
	});
}
