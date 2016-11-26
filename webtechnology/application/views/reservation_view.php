

<script type="text/javascript" src="<?= base_url()?>assets/bootstrap-master/js/transition.js"></script>
<script type="text/javascript" src="<?= base_url()?>assets/bootstrap-master/js/collapse.js"></script>
<script type="text/javascript" src="<?= base_url()?>assets/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?= base_url()?>assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

<script type="text/javascript" src="<?= base_url()?>assets/moment/js/moment.min.js"></script>
<script type="text/javascript" src="<?= base_url()?>assets/bootstrap-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

<script type="text/javascript">

var headerWindowHeight= 50;
var headerWindowSpaceHeight= 25;
var footerWindowSpaceHeight= 25;

$(function(){
   $(".nav").find(".active").removeClass("active");
   $("#reservation").parent().addClass("active");

   var date = new Date();
   date.setDate(date.getDate() + 7);
   $('.myDateTimePicker').datepicker({
      todayHighlight: true,
      startDate: new Date(),
      endDate: date
    });

   $('#time').bootstrapMaterialDatePicker({ date: false , format : 'HH:mm'});

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

function goBack() {
  iteration--;
  adaptWebPage();
  adaptLayoutNext(false);
  console.log('go back');

  document.getElementById("next").onclick = function() { return true; } 
    $("html, body").animate({ scrollTop: $(document).height() }, 1000 , function() {
      document.getElementById("next").onclick = function() { showNext()} 
    });
}

function showNext(){
  if (iteration == 5){
    window.location.href = "<?php echo site_url('home'); ?>";
    return;
  }
	iteration++;
	adaptWebPage();
  adaptLayoutNext(true);

  document.getElementById("next").onclick = function() { return true; } 
    $("html, body").animate({ scrollTop: $(document).height() }, 700 , function() {
      document.getElementById("next").onclick = function() { showNext()} 
  });
}

function adaptLayoutNext(next){
  console.log(next);
  if (next){   
    switch (iteration) {
      case 3:
        $("#page_4").slideDown(700);
      case 2:
        $("#page_3").slideDown(700);
      case 1:
        $("#page_2").slideDown(700);
      case 0:
        $("#page_1").slideDown(700);
        $("footer").show();
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
        checkTables(next);
        break;
      case 5:
        $("#loading").slideUp(700);
        $("#page_5").slideDown(700);
        $(".round-div").slideDown(700);
        $("footer").slideDown(700);
        break;
      default:
        break;
    }
  } else {
    switch (iteration) {
      case 0:
        $("#page_2").slideUp(700);
      case 1:
        $("#page_3").slideUp(700);
      case 2:
        $("#page_4").slideUp(700);
        $("#page_1").show();
        $("footer").show();
        $(".round-div").show();
        $("#loading").hide();
        break;
      case 3:
        $("#page_1").show();
        $("#page_2").show();
        $("#page_3").show();
        $("footer").show();
        $(".round-div").show();
        $("#loading").slideUp(700);
        $("#page_4").slideDown(700);
        break;
      case 4:
        $("#page_1").hide();
        $("#page_2").hide();
        $("#page_3").hide();
        $("#page_5").hide();
        $("footer").hide();
        $(".round-div").hide();
        $("#loading").slideDown(700);
        $("#page_5").slideUp(700);
        checkTables(next);
        break;
      default:
        break;
    }
  }
  if (iteration == 0) $("#back").hide();
}

function checkTables(next){
	$.ajax({
        type:"POST",
        url:"<?php echo base_url(); ?>reservation/objednaj",
        data:"",

        success:function (data) {
        	if (data){
        		data = JSON.parse(data);
        		switch (data.result){
        			case 1:
        				window.setTimeout(next? showNext : goBack, 2000);
        				return;
        			default:
        				break;
        		}
			}
			window.alert("Something went wrong");
			goBack();   		
		}
   	});
}

</script>


<div class="reservation_page" id="page_1" style='width: 100%;text-align:center;'>
  <div class ="wraperino">
	  <div class="myDateTimePicker first">
    
    </div>
    <div class="second">
      <input type='text' id='time' style="position: relative; text-align: center;" >
    </div>
  </div>
</div>

<div class="reservation_page" id="page_2" style="display: none;">
	<select>
    <option value="v1">1</option>
    <option value="v2">2</option>
    <option value="v3">3</option>
    <option value="v4">4</option>
    <option value="v5">5</option>
    <option value="v6">6</option>
    <option value="v7">7</option>
    <option value="v8">8</option>
</select>
</div>

<div class="reservation_page" id="page_3" style="display: none;">
  <input type="checkbox" name="vehicle" value="Bike"> I have a bike<br>
  <input type="checkbox" name="vehicle" value="Car" checked> I have a car<br>
</form>
</div>

<div class="reservation_page" id="page_4" style="display: none;">
	<label for="pwd">Text:</label>
  <input type="text" class="form-control" id="pwd">
</div>

<div class="reservation_page loading" id="loading" style="display: none;">
</div>

<div class="reservation_page" id="page_5" style="display: none;">
	sdgsdg
</div>






<div class="round-div button left button-nav" onclick="goBack();" id="back" style="display: none;">
    <span style="display: block;">
        Back
    </span>
</div>

<div class="round-div button right button-nav" onclick="showNext();" id="next">
    <span style="display: block;">
        Next
    </span>
</div>

<div class="round-div" id="center-div">
  <span style="display: block;" id="step">
        Krok
  </span>
</div>
