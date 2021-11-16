$(document).ready(function() {
    
//Empty cart
    function emptycart() {
        $.ajax({
            url: 'includes/action.inc.php',
            method: 'get',
            data: {
            emptycart: "empty_cart"
            }
        });
    }

    //If page unloads
     window.onunload = function () {
        emptycart();
    };
});