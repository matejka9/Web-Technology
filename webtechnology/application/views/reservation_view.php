

<script type="text/javascript" src="<?= base_url()?>assets/bootstrap-master/js/transition.js"></script>
<script type="text/javascript" src="<?= base_url()?>assets/bootstrap-master/js/collapse.js"></script>
<script type="text/javascript" src="<?= base_url()?>assets/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?= base_url()?>assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

<script type="text/javascript" src="<?= base_url()?>assets/moment/js/moment.min.js"></script>
<script type="text/javascript" src="<?= base_url()?>assets/bootstrap-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">

<script type="text/javascript">

//Sizing
var headerWindowHeight= 50;
var headerWindowSpaceHeight= 25;
var footerWindowSpaceHeight= 25+ 41;

//Steping
var iteration = 0;

//Persons
var numberOfPersons = 1;

//Date and time
var datum;
var cas;

//isSmoking, nearWindow, sitAlone
var nearWindow;
var isSmoking;
var sitAlone;


//Name
var name;


//Persons
function selectetNumber(object){
  var id = object.id;
  if (!id){
    id = object.attr('id');
  }
  var cislo = -(0 - id);
  numberOfPersons = cislo;

  $(".cell").css('background-color', '#fff');
  $(".cell").css('color', '#000');

  var idcko = "#" + id;
  $(idcko).css('background-color', '#FF7856');
  $(idcko).css('color', '#fff');
}

//UI
function adaptWebPage() {
   resizeContent();
   rename();
}

//Sizing
function resizeContent(){
    var windowHeight =$(window).height();
    var soloPageHeight = windowHeight - headerWindowHeight - headerWindowSpaceHeight - footerWindowSpaceHeight ;
    var topPageHeight = windowHeight - headerWindowHeight - headerWindowSpaceHeight;
    var midPageHeight = windowHeight - headerWindowHeight ;
    var buttomPageHeight = topPageHeight;
    
    var height = windowHeight / 12;
    height = height < 50 ? 31 : height;
    $('.button-slide').css({'bottom': height});

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
}

function rename(){
  renameStep();
  renameNext();
  renameBack();
  renameSuhrn();
}


function renameSuhrn(){
  var sprava = "Your table ";
  if (nearWindow){
     sprava += "is near window, "
  }
  if(isSmoking){
    sprava += "is in smoking area, "
  }
  if(sitAlone){
    sprava += "will not be shared with other customers."
  }
  if (!nearWindow && !isSmoking && !sitAlone){
    sprava = "You have not selected any additional options.";
  }


  renameObject($('#date2'), null, null, datum);
  renameObject($('#number2'),null,null, numberOfPersons);
  renameObject($('#time2'),null,null, cas);
  renameObject($('#addOpt2'),null,null, sprava);
  renameObject($('#name2'),null,null, name);
}

function renameStep(){
  renameObject($('#step'), (iteration + 1) + ' / 4', (iteration + 1) + ' / 4', 'Done');
}

function renameNext(){
  renameObject($('#next'), 'Next', 'Next', 'Home');
}

function renameBack(){
  renameObject($('#back'), null, 'Back', 'Delete');
}

function renameObject(object, start, during, end){
  var text;
  switch (iteration){
    case 0:
      text = start;
      break;
    case 5:
      text = end;
      break;
    default:
      text = during;
      break;
  }
  object.text(text);
}







function goBack() {
  iteration--;
  adaptWebPage();
  adaptLayout(false);
  console.log('go back');

  // document.getElementById("next").onclick = function() { return true; } 
  $("html, body").animate({ scrollTop: $(document).height() }, 700 , function() {
      // document.getElementById("next").onclick = function() { goNext()} 
  });
}

function goNext(){
  if (iteration == 5){
    window.location.href = "<?php echo site_url('home'); ?>";
    return;
  }
  if (!everythingIsGood()) return;
  iteration++;
  adaptWebPage();
  adaptLayout(true);

  // document.getElementById("next").onclick = function() { return true; } 
  $("html, body").animate({ scrollTop: $(document).height() }, 700 , function() {
      // document.getElementById("next").onclick = function() { goNext()} 
  });
}

function everythingIsGood(){
  switch (iteration){
    case 3:
      name = $('#name').val();
      console.log(name);
      if (!name || name == "") {
        window.alert("Choose name for order");
        return false;
    }
    case 2:
      nearWindow = $("#window").is(":checked");
      isSmoking = $("#smoking").is(":checked");
      sitAlone = $("#alone").is(":checked");
      console.log(nearWindow);
      console.log(isSmoking);
      console.log(sitAlone);
    case 1:
      //Nic toto sa robi pri klikani rovno, bydefault je vybrate 1
      console.log(numberOfPersons);
    case 0:
      cas = $('#time').val();
      console.log(datum);
      console.log(cas);
      if (!cas || !datum) {
        return false;
      }
      var a = cas.split(':'); // split it at the colons
      var milisec = (+a[0]) * 60 * 60 * 1000 + (+a[1]) * 60 * 1000;
      cas = milisec;
      console.log(cas);
    default:
      return true;
  }
  return true;
}
function adaptLayout(next){
  if (next){   
    adaptLayoutNext();
  } else {
    adaptLayoutBack();
  }
  if (iteration == 0) {
    $("#back").hide();
    $("#help-box").show();
  }else {
    $("#help-box").hide();
  }
}

function adaptLayoutNext(){
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
        $(".box").show();
        $("#loading").hide();
        break;
      case 4:
        $("#page_1").hide();
        $("#page_2").hide();
        $("#page_3").hide();
        $("#page_5").hide();
        $("footer").hide();
        $(".box").hide();
        $("#page_4").slideUp(700);
        $("#loading").slideDown(700);
        reserveTable(true);
        break;
      case 5:
        $("#loading").slideUp(700);
        $("#page_5").slideDown(700);
        $(".box").slideDown(700);
        $("footer").slideDown(700);
        break;
      default:
        break;
    }
}

function adaptLayoutBack() {
  switch (iteration) {
      case 0:
        $("#page_2").hide();
      case 1:
        $("#page_3").hide();
      case 2:
        $("#page_4").hide();
        $("#page_1").show();
        $("footer").show();
        $(".box").show();
        $("#loading").hide();
        break;
      case 3:
        $("#page_1").show();
        $("#page_2").show();
        $("#page_3").show();
        $("footer").show();
        $(".box").show();
        $("#loading").hide();
        $("#page_4").show();
        break;
      case 4:
        $("#page_1").hide();
        $("#page_2").hide();
        $("#page_3").hide();
        $("#page_5").hide();
        $("footer").hide();
        $(".box").hide();
        $("#loading").show();
        $("#page_5").hide();
        reserveTable(false);
        break;
      default:
        break;
    }
}
//Persons
var numberOfPersons = 1;

//Date and time
var datum;
var cas;

//isSmoking, nearWindow, sitAlone
var nearWindow;
var isSmoking;
var sitAlone;


//Name
var name;

//Reservation
var reservationTableId;

function reserveTable(next){
  $.ajax({
        type:"POST",
        url: next? "<?php echo base_url(); ?>reservation/rezervuj" : "<?php echo base_url(); ?>reservation/zrusRezervaciu",
        data: next? {"numberOfPersons": numberOfPersons, "datum": datum, "cas": cas, "nearWindow": nearWindow, "isSmoking": isSmoking, "sitAlone": sitAlone, "name" : name} : {"reservationTableId" : reservationTableId},

        success:function (data) {
          if (data){
            data = JSON.parse(data);
            console.log(data.result);
            if (data.result > 0){
              reservationTableId = +data.result;
              window.setTimeout(next? goNext : goBack, 2000);
              return;
            }
          }
        window.alert("Something went wrong");
        goBack();       
      }
    });
}



//Start up

$(function(){
  $(".nav").find(".active").removeClass("active");
  $("#reservation").parent().addClass("active");

  var date = new Date();
  date.setDate(date.getDate() + 7);
  $('.myDateTimePicker').datepicker({
    todayHighlight: true,
    startDate: new Date(),
    endDate: date
  }).on('changeDate', function(e){
    datum = e.date.getTime();
  });

  $('#time').bootstrapMaterialDatePicker({ date: false , format : 'HH:mm'});
  
  adaptWebPage();

  $(window).resize(function() {
    resizeContent();
  });

  selectetNumber($('#1'));
   
});

</script>



<div class="reservation_page" id="page_1" style='width: 100%;text-align:center;'>
  <div class ="wraperino">
	  <div class="myDateTimePicker first" id="myDateTimePicker">
    
    </div>
    <div class="wraperino">
      <div class="second" id="timeBox">
        <label>Time</label>
        <input type='text' id='time' style="position: relative; text-align: center;" >
      </div>
    </div>
  </div>
</div>

<div class="reservation_page" id="page_2" style="display: none;">
	<div class="table">
    <div class="row">
        <div class="cell button" onclick="selectetNumber(this)" id="1">1</div>
        <div class="cell button" onclick="selectetNumber(this)" id="2">2</div>
        <div class="cell button" onclick="selectetNumber(this)" id="3">3</div>
    </div>
    <div class="row">
        <div class="cell button" onclick="selectetNumber(this)" id="4">4</div>
        <div class="cell button" onclick="selectetNumber(this)" id="5">5</div>
        <div class="cell button" onclick="selectetNumber(this)" id="6">6</div>
    </div>
    <div class="row">
        <div class="cell button" onclick="selectetNumber(this)" id="7">7</div>
        <div class="cell button" onclick="selectetNumber(this)" id="8">8</div>
        <div class="cell button" onclick="selectetNumber(this)" id="9">9</div>
    </div>
</div>
</div>

<div class="reservation_page" id="page_3" style="display: none;">
  <div class="wraperino">
    <table class="additional_options w3-table w3-striped w3-bordered">
      <caption>Additional Options</caption>
      <form>
        <tr>
          <th><label for="smoking">Smoking</label></th>
          <td><input type="checkbox" name="vehicle" value="Bike" id="smoking"><br></td>
        </tr>
        <tr>
          <th><label for="alone">Alone</label></th>
          <td><input type="checkbox" name="vehicle" value="Car" id="alone"><br></td>
        </tr>
        <tr>
          <th><label for="window">Window</label></th>
          <td><input type="checkbox" name="vehicle" value="Bike" id="window"><br></td>
        </tr>
      </form> 
     </table>
  </div>
</div>

<div class="reservation_page" id="page_4" style="display: none;">
	<label for="pwd">Text:</label>
  <input type="text" class="form-control" id="name">
</div>

<div class="reservation_page loading" id="loading" style="display: none;">
</div>

<div class="reservation_page" id="page_5" style="display: none;">
	<div class="wrapperino">
    <table class="suhrn w3-table w3-striped w3-bordered">
      <caption>Suhrn</caption>
        <tr>
          <th>Name</th>
          <td><label id="name2"></label></td>
        </tr>
        <tr>
          <th>Date</th>
          <td><label id="date2"></label></td>
        </tr>
        <tr>
          <th>Time</th>
          <td><label id="time2"></label></td>
        </tr>
        <tr>
          <th>Number of people</th>
          <td><label id="number2"></label></td>
        </tr>
        <tr>
          <th>Additional options</th>
          <td><label id="addOpt2"></label></td>
        </tr>
     </table>
  </div>
</div>




<div class="button-slide">
  <div class="box">
  </div>

  <div class="box" id='help-box'>
  </div>

  <!-- <div class="round-div button left button-nav" onclick="goBack();" id="back" style="display: none;"> -->
  <div class="round-div button button-nav box" onclick="goBack();" id="back" style="display: none;">  
      <span style="display: block;">
          Back
      </span>
  </div>

  <!--  <div class="round-div" id="center-div"> -->
  <div class="round-div box">
    <span style="display: block;" id="step">
          Krok
    </span>
  </div>

  <div class="round-div button right button-nav box" onclick="goNext();" id="next">
      <span style="display: block;">
          Next
      </span>
  </div>

  <div class="box">
  </div>

</div>
