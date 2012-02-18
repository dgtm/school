//This function will trigger the browsers print method for the specified URL
////----------
//uniqueId: unique id for this method. Can be anything as long as it's unique to the page
//urlToPrint: the url that you want to print
function printUrl(uniqueId, urlToPrint) {
    $('body:first').append('<iframe style="position:fixed;top:100;left:100;height:1px;width:1px;border:none;" id="' + uniqueId + '" name="' + uniqueId + '" src="' + urlToPrint + '" onload="frames[\'' + uniqueId + '\'].focus();frames[\'' + uniqueId + '\'].window.print();"></iframe>');
}

//function printUrl(uniqueId, urlToPrint) {
//    $('<iframe id="myframe" name="nameframe" src="http://www.google.com/"></iframe>').appendTo('body');
//}
$(function() {		
$('#button').click(function(){
	//$('#container iframe').attr('src','printerpage.php');	
	//$('#button').attr('value','printerpage.php');
	//$('#frame-area').append('hhhhjjj');
									//  printUrl(1, "index.html");
									});
				});