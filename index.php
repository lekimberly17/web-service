<html>
<head>
<title>Bond Web Service Demo</title>
<style>
body {font-family:georgia;}
  .hockey{
    border:1px solid #E77DC2;
    border-radius: 5px;
    padding: 5px;
    margin-bottom:5px;
    position:relative;   
  }
 
  .pic{
    position:absolute;
    right:10px;
    top:10px;
  }

  .pic img{
	max-width:100px;
  }

</style>
<script src="https://code.jquery.com/jquery-latest.js" type="text/javascript"></script>

<script type="text/javascript">
function hockeyTemplate(NHLs){
   return `<div class="hockey">
      <b>Team: </b> ${team.Team}<br />
      <b>Loses: </b> ${team.Loses}<br />
      <b>Wins: </b> ${team.Wins}<br />
      <b>StanleyCupWins: </b> ${team.StanleyCupWins}<br />
      <div class="pic"><img src="thumbnails/${team.Image}" /></div>
    </div>`;
}
$(document).ready(function() {  
	$('.category').click(function(e){
    e.preventDefault(); //stop default action of the link
		cat = $(this).attr("href");  //get category from URL
    var request = $.ajax({
      url: "api.php?cat=" + cat,
      method: "GET",
      dataType: "json"
    });
    request.done(function( data ) {
      console.log(data);
      $("#hockeytitle").html(data.title);
      //clears the previous films
      $("#hockeys").html("");
      //loops through films 
      $.each(data.teams,function(key,value){
      let str = hockeyTemplate(value);
      $("<div></div>").html(str).appendTo("#hockeys");
        
      });
      //Place the title of the web service on the page
      //$("#output").text(JSON.stringify(data));
      
      // let myData = JSON.stringify(data,null,4);
      // myData = "<pre>" + myData + "</pre>";
      // $("#output").html(myData);
      
      
    });
    request.fail(function(xhr, status, error) {
      //Ajax request failed.
      var errorMessage = xhr.status + ': ' + xhr.statusText
      alert('Error - ' + errorMessage);
    });
	});
});	
</script>
</head>
	<body>
	<h1>Bond Web Service</h1>
		<a href="alpha" class="category">NHL Teams</a><br />
		<a href="num" class="category">NHL Stanley Cup Wins</a>
		<h3 id="hockeytitle">Title Will Go Here</h3>
		<div id="hockeys">
			<p>League will go here</p>
		</div>
		<div id="output">Results go here</div>
	</body>
</html>