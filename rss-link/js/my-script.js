// $(document).ready(function(){
//     // $("#my-title").load("test.html");
//     $("#box-gold").load("box-gold.php");
//     $("#box-coin").load("box-coin.php");
// })

// waiting page finish loading then load what we need
$(window).on('load',function(){
    $("#box-gold").load("box-gold.php");
    $("#box-coin").load("box-coin.php");
})