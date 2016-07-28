$(document).ready(function() {

	$("#document").prop('disabled', true);
	$("#nulldocument").addClass("disabled");

	var from_date = new Date($("#fromdate").val());
	// alert(from_date)
	var to_date = new Date($("#todate").val());
	// alert(to_date)
	var oneDay = 24*60*60*1000;
	var diffDays = Math.round(Math.abs((from_date.getTime() - to_date.getTime())/(oneDay)));
	// alert(diffDays)
	$(".days").html(diffDays);

    	$('select').material_select();

    	$('.datepicker').pickadate({
	    	selectMonths: true, // Creates a dropdown to control month
	    	selectYears: 15 // Creates a dropdown of 15 years to control year
  	});

    	$("#submit").click(function(){
    		// event.preventDefault();

    		$("#mainform").submit();
    	})

    	$("#fromdate").change(function(){
    		var from_date = new Date($("#fromdate").val());
    		// alert(from_date)
    		var to_date = new Date($("#todate").val());
    		// alert(to_date)
    		var oneDay = 24*60*60*1000;
    		var diffDays = Math.round(Math.abs((from_date.getTime() - to_date.getTime())/(oneDay)));
    		// alert(diffDays)
    		$(".days").html(diffDays);

    	})

    	$("#nature").change(function(){
    		var nature = $("#nature").val();
    		if(nature == 1)
    		{
    			$("#document").prop('disabled', true);
    			$("#nulldocument").addClass("disabled");
    		}
    		else if(nature == 2)
    		{
    			$("#document").prop('disabled', false);
    			$("#nulldocument").removeClass("disabled");
    		}
    		else if(nature == 3)
    		{
    			$("#document").prop('disabled', false);
    			$("#nulldocument").removeClass("disabled");
    		}
    	})

    	$("#todate").change(function(){
    		var from_date = new Date($("#fromdate").val());
    		// alert(from_date)
    		var to_date = new Date($("#todate").val());
    		// alert(to_date)
    		var oneDay = 24*60*60*1000;
    		var diffDays = Math.round(Math.abs((from_date.getTime() - to_date.getTime())/(oneDay)));
    		// alert(diffDays)
    		$(".days").html(diffDays);

    	})

  });