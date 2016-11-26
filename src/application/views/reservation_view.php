

<script type="text/javascript">

var headerWindowHeight= 50;
var headerWindowSpaceHeight= 25;
var footerWindowSpaceHeight= 25;

$(function(){
   $(".nav").find(".active").removeClass("active");
   $("#reservation").parent().addClass("active");

   adaptWebPage();

   $(window).resize(function() {
        resizeContent();
    });
   
});

var iteration = 0;

function adaptWebPage() {
   resizeContent();
   renameStep();
}

function resizeContent(){
   	var windowHeight =$(window).height();
   	var soloPageHeight = windowHeight - headerWindowHeight - headerWindowSpaceHeight - footerWindowSpaceHeight ;
   	var topPageHeight = windowHeight - headerWindowHeight - headerWindowSpaceHeight;
   	var midPageHeight = windowHeight - headerWindowHeight ;
   	var buttomPageHeight = topPageHeight;
   	
    $('.round-div').css({'bottom': windowHeight / 8});

    var width = $("#center-div").width();
    var windowWidth =$(".container").width();
    $('#center-div').css({'left': ((windowWidth / 2) - (width / 2))});

   	switch (iteration) {
   		case 0:
   			$('#page_1').css({'height': soloPageHeight});
   			break;
   		case 1:
   			$('#page_1').css({'height': topPageHeight});
   			$('#page_2').css({'height': buttomPageHeight});
   			break;
   		case 2:
   			$('#page_1').css({'height': topPageHeight});
   			$('#page_2').css({'height': midPageHeight});
   			$('#page_3').css({'height': buttomPageHeight});
   			break;
   		case 3:
   			$('#page_1').css({'height': topPageHeight});
   			$('#page_2').css({'height': midPageHeight});
   			$('#page_3').css({'height': midPageHeight});
   			$('#page_4').css({'height': buttomPageHeight});
   			break;
   		case 4:
   			$('#loading').css({'height': soloPageHeight});
   			break;
   		case 5:
   			$('#page_5').css({'height': soloPageHeight});
   		default:
   			break;
   	}
};

function renameStep(){
  var text = (iteration + 1) + ' / 4';
  if (iteration > 4){
    text = 'Done'
  }
  $('#step').text(text);
}

function showNext(){
	iteration++;
	adaptWebPage();

	switch (iteration) {
   		case 1:
   			$("#page_1").show();
   			$("#page_2").show();
   			break;
   		case 2:
   			$("#page_1").show();
   			$("#page_2").show();
   			$("#page_3").show();
   			break;
   		case 3:
   			$("#page_1").show();
   			$("#page_2").show();
   			$("#page_4").show();
			  $(".round-div").show();
   			$("#loading").hide();
   			break;
   		case 4:
   			$("#page_1").hide();
   			$("#page_2").hide();
   			$("#page_3").hide();
   			$("#page_5").hide();
   			$("footer").hide();
   			$(".round-div").hide();
   			$("#page_4").slideUp(700);
   			$("#loading").slideDown(700);
   			checkTables();
   			return;
   		case 5:
        	$("#loading").slideUp(700);
   			  $("#page_5").slideDown(700);
        	$(".round-div").slideDown(700);
        	$("footer").slideDown(700);
        	return
   		default:
   			break;
   	}
   	
   	document.getElementById("next").onclick = function() { return true; } 
   	$("html, body").animate({ scrollTop: $(document).height() }, 1000 , function() {
    	document.getElementById("next").onclick = function() { showNext()} 
  	});

   	
}

function checkTables(){
	$.ajax({
        type:"POST",
        url:"<?php echo base_url(); ?>reservation/objednaj",
        data:"",

        success:function (data) {
        	if (data){
        		data = JSON.parse(data);
        		switch (data.result){
        			case 1:
        				window.setTimeout(showNext, 2000);
        				return;
        			default:
        				break;
        		}
			}
			window.alert("Something went wrong");
			iteration = 2;
			showNext();    		
		}
   	});
}

</script>


<div class="reservation_page" id="page_1">
	afasfas
</div>

<div class="reservation_page" id="page_2" style="display: none;">
	asgasg
</div>

<div class="reservation_page" id="page_3" style="display: none;">
	sdgsdg
</div>

<div class="reservation_page" id="page_4" style="display: none;">
	sdgsdg
</div>

<div class="reservation_page loading" id="loading" style="display: none;">
</div>

<div class="reservation_page" id="page_5" style="display: none;">
	sdgsdg
</div>






<div class="round-div button button_absolute left button-nav">
    <!-- <span style="display: block;"> -->
        Back
    <!-- </span> -->
</div>

<div class="round-div button button_absolute right button-nav" onclick="showNext();" id="next">
    <!-- <span style="display: block;"> -->
        Next
    <!-- </span> -->
</div>

<div class="round-div" id="center-div">
  <span style="display: block;" id="step">
        Krok
  </span>
</div>
