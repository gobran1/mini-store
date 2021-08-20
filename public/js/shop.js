var page = 0;
var searchDelay = 1000;
var searchTimeout = 0;
var finish = false;
var loadItem = function () {
    $.ajax({
        method: 'get',
        url: shopIndexUrl + '/' + page,
        data: {}
    })
        .always(function () {
            $('#saleProducts').append('<h4 id="load-flag" class="text-center">loading...</h4>');
        })
        .done(function (result) {

            $('#load-flag').remove();
            var saleProducts = $('#saleProducts');

            if (result.length === 0) {
                finish = true;
                $('.sale-content').append('<h4 class="text-center alert-warning">____________________End Page____________________</h4>');
            } else {
                $.each(result, function (index, item) {
                    var html = '<div class="col-md-4 col-sm-6 col-xs-12" data-productId=';
                    html += item.id;
                    html += '> <div class="thumbnail" data-productId="'+item.id+'"> <div class="thumbnail-img"> <img src=';
                    html += item.url;
                    html += ' class="img-responsive img-rounded">  </div> <div class="caption"> <h3>';
                    html += item.title;
                    html += '</h3> <p>';
                    html += item.description;
                    html += '</p> </div> <div class="clearfix">  ' +
                        ' <h4 class="pull-left">price : <span class="price">';
                    html += item.price;
                    html += '</span>$</h4><div class="btn-group pull-right">\n' +
                        '        <button class="btn btn-danger disabled removeFromCart">Remove From Cart</button>\n' +
                        '    <button class="btn btn-success addToCart ">Add To Cart</button>\n' +
                        '    </div> </div><span class="qty-badge badge"></span> </div>    \n </div>';
                    saleProducts.append(html);
                });
                page++;
            }
        });




};

var checkPageEnd = function () {
    var wind = Math.round($(window).height()),
        doc = Math.round($('body').height()),
        scrollPos = Math.round($(window).scrollTop());


    if (doc - 20 <= wind + scrollPos) {
        loadItem();
    }
};

$(window).scroll(function () {
    if (!finish) {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(checkPageEnd, searchDelay)
    }
}).trigger('scroll');





$(document).on('click','.addToCart',function(event){

    $this = $(event.target);


    var $product =  $this.parent().parent().parent();
    var productId = $product.attr('data-productId');
    //
       $.ajax({
        'method' : 'post',
        'url' : addToCartUrl,
        'data' : {
            _token : token,
            productId : productId,
        },

    }).done(function(response){
        var qty = response.qty,
            totalPrice = response.totalPrice;

        $('#total-price h4').text(totalPrice);
        //$product.find('.removeFromCart').prop('disabled' , false);
        $product.find('.qty-badge').text(qty);
    });

});
