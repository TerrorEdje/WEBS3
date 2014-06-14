//Wait for the page and all the DOM to be fully loaded.
$('body').ready(function() {

	//Add the 'hover' event listener to our dropdown class
	$('.dropdown').hover(function() {
		//When the event is triggered, grab the current element 'this' and
		//find it's children '.sub_navigation' and display/hide them
			$(this).find('.sub_navigation').toggle();
	});
});

$(document).ready(function(){
  $("#polltitle").click(function(){
    $("#poll").slideToggle();
  });
  $('#poll').hide();
});

/*function doSearch() {
    var text = document.getElementById("search-criteria");
    var v = text.value.toLowerCase();
    var rows = document.getElementsByTagName("tr");
    var on = 0;
    for ( var i = 0; i < rows.length; i++ ) {
        var fullname = rows[i].getElementsByTagName("td");
        fullname = fullname[0].innerHTML.toLowerCase();
        if ( fullname ) {
            if ( v.length == 0 || (v.length < 3 && fullname.indexOf(v) == 0) || (v.length >= 3 && fullname.indexOf(v) > -1 ) ) {
                rows[i].style.display = "";
                on++;
            } else {
                rows[i].style.display = "none";
            }
        }
    }
    var n = document.getElementById("noresults");
    if ( on == 0 && n ) {
        n.style.display = "";
        document.getElementById("searchtext").innerHTML = text.value;
    } else {
        n.style.display = "none";
    }
}*/

$(document).ready(function(){
	$("#search-criteria").on("keyup", function() {	
		var criteria = $(this).val().toLowerCase();
		$(".user").each( function() {
			console.log(criteria);
			var usertext = $(this).text().toLowerCase();
			if (usertext.search(criteria)!=-1)
			{
				$(this).show();
			}
			else
			{
				$(this).hide();
			}
		});
	});
	
});

