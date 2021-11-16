$(document).ready(function() {
    // // Load total no.of items added in the cart and display in the navbar
    load_cart_item_number();

    function load_cart_item_number() {
    $.ajax({
        url: 'includes/action.inc.php',
        method: 'get',
        data: {
        shoppingCart: "shopping_cart"
        },
        success: function(response) {
        $("#cart-item").html(response);
        }
    });
    }
            
    /*UNDER CONSTRUCTION*/

    function emptycart() {
        $.ajax({
            url: 'includes/action.inc.php',
            method: 'get',
            data: {
            emptycart: "empty_cart"
            }
        });
    }

    /*UNDER CONSTRUCTION*/
    window.onunload = function () {
        emptycart();
    };
});