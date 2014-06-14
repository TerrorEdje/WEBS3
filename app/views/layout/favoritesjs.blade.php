<script type="text/javascript">
	var categorys = new Array();

	if (!$.cookie('favorites'))
	{
		var favorites = new Array();
	}
	else
	{
		var favorites = JSON.parse($.cookie('favorites'));
	}

	function Category(id, name, description)
	{
		this.id = id;
		this.name = name;
		this.description = description
	}

	@foreach ($fsubcategorys as $fsubcategory)
		categorys.push(new Category("{{$fsubcategory['id']}}","{{$fsubcategory['name']}}","{{$fsubcategory['description']}}"))
	@endforeach

	function addToFavorites(id)
	{
		if (favorites == null)
		{
			favorites = new Array();
		}
		for (var i = 0; i < categorys.length; i++)
		{
			if(categorys[i].id == id)
			{
				favorites.push(categorys[i]);
				$.cookie('favorites', JSON.stringify(favorites));
				showCategorys();
				return true;
			}
		}

	}

	function deleteFromFavorites(id)
	{
		if (favorites == null)
		{
			return "Can't delete what's not there";
		}
		for (var i = 0; i < favorites.length; i++)
		{
			if(favorites[i].id == id)
			{
				favorites.splice(i,i+1);
				$.cookie('favorites', JSON.stringify(favorites));
				showCategorys();
				return true;
			}
		}
	}

	function deleteAllFromFavorites(id)
	{
		if (favorites == null)
		{
			return "Can't delete what's not there";
		}
		favorites.splice(0,favorites.length);
		$.cookie('favorites', JSON.stringify(favorites));
		showCategorys();
	}

	function showCategorys()
	{
		var myNode = document.getElementById("favorites")
		while (myNode.firstChild) {
   		 	myNode.removeChild(myNode.firstChild);
		}
		if (favorites.length > 0)
		{
			var divFavo = $('<div></div>');
			divFavo.addClass("col-md-11");

			var divDelete = $('<div></div>');
			divDelete.addClass("col-md-1");

			var aDelete = $('<a></a>');
			aDelete.text("Delete all favorites");
			aDelete.attr("onClick","deleteAllFromFavorites()");
			aDelete.attr("href","#");
			divDelete.append(aDelete);

			var objUl = $('<ul></ul>');
			objUl.addClass("nav nav-tabs");
			for (i = 0; i < favorites.length; i++)
			{
				var objLi = $('<li></li>');
				var objA = $('<a></a>');
				objA.text(favorites[i].name);
				objA.attr("href","{{ URL::route('forum-category-js') }}/" + favorites[i].id);
				objLi.append(objA);
				objUl.append(objLi);
			}

			divFavo.append(objUl);
			$('#favorites').append(divFavo);
			$('#favorites').append(divDelete);
		}
	}

</script>