$(document).ready(function() {
$('[data-toggle=tooltip]').tooltip();

$(".navbar-toggle").click(function() {
  $('.navbar').show();
  setTimeout(function(){
    $('.navbar').addClass('menu-open');
  },5);
});

$(".close-menu").click(function(){
    $('.navbar').removeClass('menu-open');
    setTimeout(function(){
      $('.navbar').hide();
    },200);
});


var time = 7; // time in seconds

var $progressBar,
$bar, 
$elem, 
isPause, 
tick,
percentTime;

  //Init the carousel
  $("#owl-demo").owlCarousel({
    slideSpeed : 500,
    paginationSpeed : 500,
    singleItem : true,
    afterInit : progressBar,
    afterMove : moved,
    startDragging : pauseOnDragging
  });

  var owl = $("#client-review");

  owl.owlCarousel({
    itemsCustom : [
    [0, 1], 
    [767, 2],
    [1030, 3]
    ],
    slideSpeed : 500,
    items : 3,
    navigation : true
  });

  $("#client-review").owlCarousel({

  });

  //Init progressBar where elem is $("#owl-demo")
  function progressBar(elem){
    $elem = elem;
    //build progress bar elements
    buildProgressBar();
    //start counting
    start();
  }

  //create div#progressBar and div#bar then prepend to $("#owl-demo")
  function buildProgressBar(){
    $progressBar = $("<div>",{
      id:"progressBar"
    });
    $bar = $("<div>",{
      id:"bar"
    });
    $progressBar.append($bar).prependTo($elem);
  }

  function start() {
    //reset timer
    percentTime = 0;
    isPause = false;
    //run interval every 0.01 second
    tick = setInterval(interval, 10);
  };

  function interval() {
    if(isPause === false){
      percentTime += 1 / time;
      $bar.css({
       width: percentTime+"%"
     });
      //if percentTime is equal or greater than 100
      if(percentTime >= 100){
        //slide to next item 
        $elem.trigger('owl.next')
      }
    }
  }

  //pause while dragging 
  function pauseOnDragging(){
    isPause = true;
  }

  //moved callback
  function moved(){
    //clear interval
    clearTimeout(tick);
    //start again
    start();
  }
  $('#personal-info a').click(function (e) {
    e.preventDefault()
    $(this).tab('show')
  });
  $('input, textarea').placeholder();
  $( "#datepicker" ).datepicker({dateFormat: "yy-mm-dd", minDate: 0 });
  $( "#start-date" ).datepicker({dateFormat: "yy-mm-dd", minDate: 0 });
  $( "#end-date" ).datepicker({dateFormat: "yy-mm-dd", minDate: 0 });
  
  $('.datepick').each(function(){
      $(this).datepicker({dateFormat: "yy-mm-dd", minDate: 0 });
  });
  
  //Google Maps
  
  geocoder = new google.maps.Geocoder();
  
  $('#upi-form-user #send-upi-form-user').on('click', function(e){
		e.preventDefault();
		geocoder.geocode( { 'address': $('#address').val()+','+$('#city').val()+','+$('#zipcode').val()}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				$('#googleCoords').val(results[0].geometry.location.toString());
				$('#upi-form-user').submit();
			} else {
				alert('Invalid address reason: ' + status);
			}
		});
  });
  
  $('#proyect-upload #upload-proyect-action').on('click', function(e){
		e.preventDefault();
		if($('#newDir').is(':checked')){
			geocoder.geocode( { 'address': $('#newstreet').val()+','+$('#newcity').val()+','+$('#newzip').val()}, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					var input = $("<input>")
								   .attr("type", "hidden")
								   .attr("name", "googleCoords").val(results[0].geometry.location.toString());
					$('#proyect-upload').append($(input));
					$('#proyect-upload').submit();
				} else {
					alert('Invalid address reason: ' + status);
				}
			});
		}else{
			$('#proyect-upload').submit();
		}
  });
  
});
