$(document).ready(function () {
    $('.menu-btn').on('click', function () {
        _go.ToggleMenu();
    });
    $(document).on('click','.category-tile', function () {
        var id = $(this).attr('data-catId');
        _go.CurrentCatId = id;
        _go.LoadCategory(id);
    });
    
    $(document).on('CategorySet', function (event) {
        _go.LoadCategories(event.category);
        _go.setTimer();
    });
    _catOp.setCategories();
    _go.SetMenuVerticalLine();
    
});

function GlobalOps() {
    this.CurrentCatId = '';
    this.setTimer = function () {
        window.setInterval(
            function () {
                var id = _go.CurrentCatId;
				$.ajax({
					type: 'Get',
					url: 'http://www.fashiontrendguru.com/api/refreshList',
					success: function (data) {
						if(data.refresh){
							_go.LoadCategory(id);
						}
					},
					fail: function (err) {
						console.log(err);
					}
				});
            },
            10000);
    }
    this.ToggleMenu = function () {
        if ($('.main-menu-vbar').is(':visible')) {
            $('.main-menu-vbar').animate({ 'width': '0px' }, 'slow', function () {
                $('.main-menu-vbar').hide();
            });
        } else {
            $('.main-menu-vbar').show();
            $('.main-menu-vbar').animate({ 'width': '150px' }, 'slow');
        }
    };

    this.SetMenuVerticalLine = function () {
        var height = window.outerHeight - 235;
        $('.menu-container').css('height', height);
    };

    this.LoadCategories = function (Categories) {
        var str = '';
        $.each(Categories, function (i, obj) {
            str += '<div class="category-tile hover" data-catId="' + obj.id + '">' + obj.name + '</div>';
        });
        $('.category-box').html(str);

        //Display the first category
        var id = Categories[0].id;
        _go.CurrentCatId = id; // set current category
        _go.LoadCategory(id);
    };

    this.LoadCategory = function (id) {
        var Cat = _catOp.getCategory(id);

        $.ajax({
            type: 'POST',
			data:{catId:id},
            url: 'http://www.fashiontrendguru.com/api/getCategory',
            success: function (data) {
				var model = {
					catname: Cat.name,
					category:data.products,
					twitterData:data.twitter.map(function(x){
						return parseInt(x,10);
					}),
					redditData:data.reddit
				};
                barChart(model);
            },
            fail: function (err) {
                console.log(err);
            }
        });
    };
}

var _go = new GlobalOps();
