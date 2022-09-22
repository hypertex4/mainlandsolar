// ************************************************
// Shopping Cart API
// ************************************************
var shoppingCart = (function() {
    // =============================
    // Private methods and properties
    // =============================
    cart = [];
    // Constructor
    function Item(id,title,slug,price,image,qty) {
        this.id = id;
        this.title = title;
        this.slug = slug;
        this.price = price;
        this.image = image;
        this.qty = qty;
    }

    // Save cart
    function saveCart() {
        localStorage.setItem('shoppingCart', JSON.stringify(cart));
    }

    // Load cart
    function loadCart() {
        cart = JSON.parse(localStorage.getItem('shoppingCart'));
    }
    if (localStorage.getItem("shoppingCart") != null) {
        loadCart();
    }

    // =============================
    // Public methods and propeties
    // =============================
    var obj = {};

    // Add to cart
    obj.addItemToCart = function(id,title,slug,price,image,qty) {
        for(var item in cart) {
            if(cart[item].id === id) {
                cart[item].qty ++;
                saveCart();
                return;
            }
        }
        var item = new Item(id,title,slug,price,image,qty);
        cart.push(item);
        saveCart();
    };
    // Set count from item
    obj.setCountForItem = function(id, qty) {
        for(var i in cart) {
            if (cart[i].id === id) {
                cart[i].qty = qty;
                break;
            }
        }
    };
    // Remove item from cart
    obj.removeItemFromCart = function(id) {
        for(var item in cart) {
            if(cart[item].id === id) {
                if(cart[item].qty <= 1)  return 1;
                else cart[item].qty --;
                break;
            }
        }
        saveCart();
    };

    // Remove all items from cart
    obj.removeItemFromCartAll = function(id) {
        for(var item in cart) {
            if(cart[item].id === id) {
                cart.splice(item, 1);
                break;
            }
        }
        saveCart();
    };

    // Clear cart
    obj.clearCart = function() {
        cart = [];
        saveCart();
    };

    // Count cart
    obj.totalCount = function() {
        var totalCount = 0;
        for(var item in cart) {
            totalCount += cart[item].qty;
        }
        return totalCount;
    };

    // Total cart
    obj.totalCart = function() {
        var totalCart = 0;
        for(var item in cart) {
            totalCart += cart[item].price * cart[item].qty;
        }
        return Number(totalCart.toFixed(2));
    };

    // List cart
    obj.listCart = function() {
        var cartCopy = [];
        for(i in cart) {
            item = cart[i];
            itemCopy = {};
            for(p in item) {
                itemCopy[p] = item[p];

            }
            itemCopy.total = Number(item.price * item.qty).toFixed(2);
            cartCopy.push(itemCopy)
        }
        return cartCopy;
    };

    // cart : Array
    // Item : Object/Class
    // addItemToCart : Function
    // removeItemFromCart : Function
    // removeItemFromCartAll : Function
    // clearCart : Function
    // countCart : Function
    // totalCart : Function
    // listCart : Function
    // saveCart : Function
    // loadCart : Function
    return obj;
})();


// *****************************************
// Triggers / Events
// *****************************************
// Add item

// $('.add-to-cart').click(function(event) {
$(".list, .product_click").on("click",".add-to-cart-2",function (event) {
    event.preventDefault();
    var id = $(this).data('id');
    var title = $(this).data('title');
    var slug = $(this).data('slug');
    var price = Number($(this).data('price'));
    var image = $(this).data('image');
    var qty = Number($(this).data('count'));

    shoppingCart.addItemToCart(id,title,slug,price,image,qty);
    displayCart();
    displayCheckout();
    toastr.options = {"closeButton": true, "positionClass": "toast-top-right"};
    toastr["success"]('Item '+title+' successfully added to cart');
});

$('.move-item-to-cart').click(function(event) {
    event.preventDefault();
    var wid = $(this).data('wlist_id');
    var id = $(this).data('id');
    var title = $(this).data('title');
    var slug = $(this).data('slug');
    var price = $(this).data('price');
    var image = $(this).data('image');
    var qty = Number($(this).data('count'));

    shoppingCart.addItemToCart(id,title,slug,price,image,qty);
    removeItemFromWishList(wid,title);
    displayCart();
    displayCheckout();
});

// Clear items
$('.clear-cart').click(function() {
    shoppingCart.clearCart();
    displayCart();
    displayCheckout();
});


function displayCart() {
    $('.cust-badge').show();
    var cartArray = shoppingCart.listCart();
    var output = "";
    if (cartArray.length < 1 ){
        output +=" <section class='col-12 col-md-5 pt-5' style='margin: 0 auto;'>"
            +"<div class='container'><div class='text-center'><div class='m-auto'>"
            +"<div><img src='assets/images/cart.svg'  style='border-radius: 50%; border:1px solid #ccc;padding: 20px;width: 150px'></div>"
            +"</div>"
            +"<h5 class='mt-4 mb-4'>Your cart is empty!</h5>"
            +"<a href='./product/' class='dark-link'>Continue Shopping</a></div></div></section>";
        $(".show_empty").html(output);
        $('.cust-badge').hide();
    } else {
        for (var i in cartArray) {
            output += "<div class='item-row'><div class='item-image-col'><div class='item-image-wrapper'>";
            output += "<img src='admin/"+cartArray[i].image+"' alt='' class='img-fluid'></div></div><div class='item-name-col'>";
            output += "<div class='py-2 item-name-wrapper'><div class='item-name'>"+cartArray[i].title+"</div>";
            output += "<a href='product/details/"+cartArray[i].slug+"' class='view-item'>Quick view</a></div><div class='action'>";
            output += "<button class='btn px-0 remove-item-btn delete-item' data-id="+cartArray[i].id+">";
            output += "<svg width='15' height='16' viewBox='0 0 15 16' fill='none' xmlns='http://www.w3.org/2000/svg'>";
            output += "<path d='M13.6741 1.14844H10.058L9.77477 0.600591C9.71477 0.483466 9.62234 0.384943 9.50788 0.316106C9.39343 0.247269 9.26148 0.210849 9.1269 0.210943H5.68259C5.54831 0.210441 5.41659 0.246725 5.30254 0.315639C5.18849 0.384553 5.09671 0.483308 5.03772 0.600591L4.75446 1.14844H1.13839C1.01052 1.14844 0.887886 1.19783 0.797466 1.28574C0.707047 1.37364 0.65625 1.49287 0.65625 1.61719L0.65625 2.55469C0.65625 2.67901 0.707047 2.79824 0.797466 2.88615C0.887886 2.97406 1.01052 3.02344 1.13839 3.02344H13.6741C13.802 3.02344 13.9246 2.97406 14.015 2.88615C14.1055 2.79824 14.1562 2.67901 14.1562 2.55469V1.61719C14.1562 1.49287 14.1055 1.37364 14.015 1.28574C13.9246 1.19783 13.802 1.14844 13.6741 1.14844V1.14844ZM2.25937 13.8926C2.28237 14.2496 2.44445 14.5847 2.71261 14.8296C2.98077 15.0745 3.33485 15.2109 3.70279 15.2109H11.1097C11.4776 15.2109 11.8317 15.0745 12.0999 14.8296C12.3681 14.5847 12.5301 14.2496 12.5531 13.8926L13.192 3.96094H1.62054L2.25937 13.8926Z' fill='#EA4B4B' />";
            output += "</svg>Remove</button><button class='btn px-0 save-item-btn move_to_wlist' data-id="+cartArray[i].id+">";
            output += "<svg width='19' height='16' viewBox='0 0 19 16' fill='none' xmlns='http://www.w3.org/2000/svg'>";
            output += "<path d='M16.4086 1.23658C14.5738 -0.327004 11.8451 -0.0457587 10.161 1.69193L9.50137 2.37161L8.84179 1.69193C7.16101 -0.0457587 4.42892 -0.327004 2.59413 1.23658C0.49149 3.03119 0.381001 6.25212 2.26266 8.19739L8.74134 14.887C9.15986 15.3189 9.83954 15.3189 10.2581 14.887L16.7367 8.19739C18.6217 6.25212 18.5113 3.03119 16.4086 1.23658V1.23658Z' fill='#F7B710' />";
            output += "</svg>Save Item</button></div></div>";
            output += "<div class='item-quantity-col'><div class='inner qty-ctrl'>";
            output += "<button class='btn btn-sm decreament-btn minus-item' data-id=" + cartArray[i].id + ">-</button>";
            output += "<div class='count item-count' data-id="+cartArray[i].id+">" + cartArray[i].qty +"</div>";
            output += "<button class='btn btn-sm increament-btn plus-item' data-id=" + cartArray[i].id + ">+</button>";
            output += "</div></div><div class='item-price-col'><span>₦</span>&nbsp;"+numberWithCommas(cartArray[i].price)+"</div>";
            output += "<div class='item-sub-total-col'><span>₦</span>&nbsp;"+numberWithCommas(cartArray[i].price * cartArray[i].qty)+"</div></div>";
        }

        $('.show-cart').html(output);
    }

    const X = Number(shoppingCart.totalCart()).toFixed(2);

    if($('select#state').val() === 'Lagos') {var amount1=4000; }
    if($('select#state').val() !== 'Lagos') {var amount1=10000; }
    $('.sub-total-cart').html(numberWithCommas(X));
    $('.total-cart').html(numberWithCommas((Number(shoppingCart.totalCart())+amount1).toFixed(2)));
    $('.total-count').html(shoppingCart.totalCount());
    $('.total-shipping').html(numberWithCommas((amount1).toFixed(2)));

    //for checkout input
    $("#total_amount").val(Number(shoppingCart.totalCart())+amount1);
    $("#total_qty").val(shoppingCart.totalCount());
    $("#amount_transferred").val(Number(shoppingCart.totalCart())+amount1);
    $("#order_shipping").val((0));

    $('.VAT').html(numberWithCommas(0.075* Number($("#total_amount").val())));
}

function displayCheckout(){
    var cartArray = shoppingCart.listCart();
    var output = "";

    for (var i in cartArray) {
        output += "<tr><th scope='row'>"+cartArray[i].title+" * " + cartArray[i].qty +"</th>";
        output += "<td>₦&nbsp;"+numberWithCommas(cartArray[i].price)+"</td></tr>";
    }
    $('.show_checkout_data').html(output);
}

function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

// Delete item button
$('.show-cart').on("click", ".delete-item", function(event) {
    var id = $(this).data('id');
    shoppingCart.removeItemFromCartAll(id);
    displayCart();
    toastr.options = {"closeButton": true, "positionClass": "toast-top-right"};
    toastr["success"]('Item removed successfully');
});

$('.show-cart').on("click", ".move_to_wlist", function(event) {
    var product_id = $(this).data('id');
    $.ajax({
        url: "controllers/v6/create-user-wishlist.php",
        type : "POST",
        contentType : 'application/json',
        data : JSON.stringify({product_id:product_id}),
        success: function(data) {
            shoppingCart.removeItemFromCartAll(product_id);
            displayCart();
            toastr.options = {"closeButton": true};
            toastr["success"]('Item saved to your WishList');
        },
        error: function(errData){
            $.confirm({
                icon: 'fa fa-exclamation-triangle',closeIcon: true, title: "Error!",typeAnimated: true, content: errData.responseJSON.message,
                type: 'red',buttons: {tryAgain: {text: 'Login', btnClass: 'btn-red', action: function(){window.location.replace('login')} }}
            });
        }
    });
});

$(document).on('click', '.wishlist_remove', function() {
    var wList_id = $(this).data('id');
    removeItemFromWishList(wList_id,'r');
});

function removeItemFromWishList(id,title){
    if (id==="") {
        toastr.error('Invalid product');
    } else {
        $.ajax({
            url: "controllers/v6/delete-wishlist.php",
            type : "POST",
            contentType : 'application/json',
            data : JSON.stringify({wList_id:id}),
            success: function(data) {
                toastr.options = {"closeButton": true, "positionClass": "toast-top-right"};
                if (title !=='r') toastr["success"]("Item "+title+" added to cart successfully");
                else toastr["success"](data.message);
                setTimeout(function () {window.location.reload();}, 1000);
            },
            error: function(errData){
                toastr.options = {"closeButton": true, "positionClass": "toast-bottom-right"};
                toastr["error"](errData.responseJSON.message);
            }
        });
    }
}

// -1
$('.show-cart').on("click", ".minus-item", function(event) {
    var id = $(this).data('id');
    shoppingCart.removeItemFromCart(id);
    displayCart();
    displayCheckout();
});
// +1
$('.show-cart').on("click", ".plus-item", function(event) {
    var id = $(this).data('id');
    shoppingCart.addItemToCart(id);
    displayCart();
    displayCheckout();
});

// Item count input
$('.show-cart').on("change", ".item-count", function(event) {
    var id = $(this).data('id');
    var count = Number($(this).val());
    shoppingCart.setCountForItem(id, count);
    displayCart();
    displayCheckout();
});

displayCart();
displayCheckout();

$('select#state').on("change",function (e) {
    if(this.value === 'Lagos') {var amount=4000; }
    if(this.value !== 'Lagos') {var amount=10000; }

    $('.total-cart').html(numberWithCommas((Number(shoppingCart.totalCart())+amount).toFixed(2)));
    $('.total-shipping').html(numberWithCommas((amount).toFixed(2)));

    $("#total_amount").val((Number(shoppingCart.totalCart())+amount));
    $("#amount_transferred").val((Number(shoppingCart.totalCart())+amount));
    $("#order_shipping").val((amount));
});

