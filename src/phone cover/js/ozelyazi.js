

$("#asagi").on("click",function () {

    var konum=$("#text").css("top");
    konum=konum.replace("px", "");
    konum=parseInt(konum)+parseInt(5);
    $("#text").css("top",konum);

});

$("#yukari").on("click",function () {

    var konum=$("#text").css("top");
    konum=konum.replace("px", "");
    konum=parseInt(konum)-parseInt(5);
    $("#text").css("top",konum);

});


$("#sol").on("click",function () {

    var konum=$("#text").css("left");
    konum=konum.replace("px", "");
    konum=parseInt(konum)-parseInt(5);
    $("#text").css("left",konum);

});

$("#sag").on("click",function () {

    var konum=$("#text").css("left");
    konum=konum.replace("px", "");
    konum=parseInt(konum)+parseInt(5);
    $("#text").css("left",konum);

});


$("#yazibuyut").on("click",function () {

    var size=$("#text").css("font-size");
    size=size.replace("px", "");
    size=parseInt(size)+parseInt(1);
    $("#text").css("font-size",size);

});

$("#yazikucult").on("click",function () {

    var size=$("#text").css("font-size");
    size=size.replace("px", "");
    size=parseInt(size)-parseInt(1);
    $("#text").css("font-size",size);

});



var rotation = 0;

jQuery.fn.rotate = function(degrees) {
    $(this).css({'-webkit-transform' : 'rotate('+ degrees +'deg)',
                 '-moz-transform' : 'rotate('+ degrees +'deg)',
                 '-ms-transform' : 'rotate('+ degrees +'deg)',
                 'transform' : 'rotate('+ degrees +'deg)'});
};

$('#sagadondur').click(function() {
    rotation += 45;
    $('#text').rotate(rotation);
});

$('#soladondur').click(function() {
    rotation -= 45;
    $('#text').rotate(rotation);
});

  
    $("#dondurmeson").click(function() {
     $('#text').css({transform: "rotate(360deg)"});
  });