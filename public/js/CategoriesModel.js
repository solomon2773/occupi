function CategoriesModel(categories) {
    this.Categories = [];
    this.setCategories = function () {

        $.ajax({
            type: 'Get',
            url: 'http://www.fashiontrendguru.com/api/Categories',
            success: function (cats) {
				$.each(cats,function(i,cat){
					_catOp.Categories.push(
						new Category(cat.id, cat.name)
					);
				});
                
                var event = $.Event("CategorySet");
                event.category = _catOp.Categories;
                $(document).trigger(event);
            },
            fail: function (err) {
                console.log(err);
            }
        });
        

    };

    this.getCategory = function (id) {
        var Cat = new Category('','');
        $.each(_catOp.Categories, function (i, obj) {
            if (obj.id == id) {
                Cat = obj;
            }
        });

        return Cat;
    };
}

function Category(id, name) {
    this.id = id;
    this.name = name;
}
var _catOp = new CategoriesModel();