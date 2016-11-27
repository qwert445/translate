$( document ).ready(function() {
	$("#search").click(function(){
		var value = $("#text").val();
		$.post( "xuly.php",{ text: value }, function( data ) {
			$( "#content" ).html( data );
		});
	});
});