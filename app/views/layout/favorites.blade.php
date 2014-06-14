<script type="text/javascript">
	function Category(id, name, description)
	{
		this.id = id;
		this.name = name;
		this.description = description
	}

	var categorys = new Array();

	var favorites = new Array();

	@foreach ($fsubcategorys as $fsubcategory)
		categorys.push(new Category("{{$fsubcategory['id']}}","{{$fsubcategory['name']}}","{{$fsubcategory['description']}}"))
	@endforeach
</script>