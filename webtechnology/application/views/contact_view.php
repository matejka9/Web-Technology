<script type="text/javascript">
$(function(){
   $(".nav").find(".active").removeClass("active");
   $("#contact").parent().addClass("active");
});
</script>

<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">

<h1>Contact page</h1>







<script src='https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCCObpQl1lf3xSirBupKY_6tXuBrTz1r0w'></script>
<div class="contact_page">
    <div class= "wraperino first" style="max-width:520px; width:100%;">
		<div>
			<h3>Restaurant Tutorial</h3>
			<table class="first contact_menu w3-table w3-striped w3-bordered">
		        <tr>
		          <th>Location</th>
		          <td>Nedbalova 10</td>
		        </tr>
		        <tr>
		           <th></th>
		           <td>811 01</td>
		        </tr>
		        <tr>
		           <th></th>
		           <td>Bratislava 1</td>
		        </tr>
		        <tr>
		          <th>Call us</th>
		          <td>0902 222 333</td>
		        </tr>
		        <tr>
		          <th>E-mail us</th>
		          <td>tutorialFood@gmail.com</td>
		        </tr>
			</table>
		</div>
		<br>
		<div class= "second">
			<div style='overflow:hidden;height:400px;width:520px;'>
				<div id='gmap_canvas' style='height:400px;width:520px;'></div>
				<style>#gmap_canvas img{max-width:none!important;background:none!important}</style>
			</div> <a href='http://maps-website.com/'>www.Maps-website.com</a> 
		</div>
	</div>
</div>

<script type='text/javascript' src='https://embedmaps.com/google-maps-authorization/script.js?id=4c65c7bd8843a7a7357017fa4a4a65fb8506dd59'></script>
<script type='text/javascript'>function init_map(){var myOptions = {zoom:17,center:new google.maps.LatLng(48.1442093,17.11099809999996),mapTypeId: google.maps.MapTypeId.ROADMAP};map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(48.1442093,17.11099809999996)});infowindow = new google.maps.InfoWindow({content:'<strong>Tutorial Restaurant</strong><br>Nedbalova 10<br>811 01 Bratislava 1<br>'});google.maps.event.addListener(marker, 'click', function(){infowindow.open(map,marker);});infowindow.open(map,marker);}google.maps.event.addDomListener(window, 'load', init_map);</script>


<div id="map"></div>