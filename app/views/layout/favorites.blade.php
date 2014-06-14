<script type="text/javascript">
	var categorys = new Array();

	if (typeof JSON.parse($.cookie('favorites') === 'undefined')
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
				return true;
			}
		}
	}

	function showCategorys()
	{
		var objUl = $('<ul></ul>');
		for (i = 0; i < favorites.length; i++)
		{
			var objLi = $('<li></li>');
			objLi.text(favorites[i].name);
			objUl.append(objLi);
		}
		$('.favorites').append(objUl);
	}

</script>