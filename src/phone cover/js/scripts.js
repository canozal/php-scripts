$(function () {
    $("#image-preview,#imageText").draggable({

        cursor: 'move',
        opacity: 0.9
    });

    $("#nameID").keyup(function(){
        var name = $("#nameID").val();
        $("#text").text(name);

    });




});

$("#fonts").change(function() {
    //alert($(this).val());
    $('#text').css("font-family", $(this).val());

});

$( "#textButton" ).click(function() {
    $( "#imageText" ).toggle();
});


$('#sigdir').click(function () {

    //köşede çıkan kırmızı çerçeveyi yok etmek için %100 yerine %99 verdik.

    $("#image-preview").height("100%");
    $("#image-preview").width("100%");
    $('#image-preview').css({top: "0"});
    $('#image-preview').css({left: "0"});
    $('#image-preview').css({bottom: "0"});
    $('#image-preview').css({right: "0"});


});


$('#buyut').click(function () {

    var resim_genislik = $("#image-preview").width();
    var resim_uzunluk = $("#image-preview").height();
    var yeni_genislik = resim_genislik + 10;
    var yeni_uzunluk = resim_uzunluk + 10;

    $("#image-preview").width(yeni_genislik + "px");
    $("#image-preview").height(yeni_uzunluk + "px");

});

$('#kucult').click(function () {

    var resim_genislik = $("#image-preview").width();
    var resim_uzunluk = $("#image-preview").height();
    var yeni_genislik = resim_genislik - 10;
    var yeni_uzunluk = resim_uzunluk - 10;

    $("#image-preview").width(yeni_genislik + "px");
    $("#image-preview").height(yeni_uzunluk + "px");

});


var derece = 0;
var sayac = 0;
$("#cevir").click(function () {


    sayac += 1;
    if (sayac % 4 == 1) {
        derece = 90;
    }
    if (sayac % 4 == 2) {
        derece = 180;
    }
    if (sayac % 4 == 3) {
        derece = 270;
    }
    if (sayac % 4 == 0) {
        derece = 0;
    }
    $('#image-preview').css({transform: "rotate(" + derece + "deg)"});

});


function doCapture() {

    window.scrollTo(0, 0);

    html2canvas(document.getElementById("containerImage")).then(function (canvas) {
        /*console.log(canvas.toDataURL("image/jpeg", 0.9));*/

        var ajax = new XMLHttpRequest();

        // Setting method, server file name, and asynchronous
        ajax.open("POST", "save-capture.php", true);

        // Setting headers for POST method
        ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        // Sending image data to server
        ajax.send("image=" + canvas.toDataURL("image/jpeg", 1));

        // Receiving response from server
        // This function will be called multiple times
        ajax.onreadystatechange = function () {

            // Check when the requested is completed
            if (this.readyState == 4 && this.status == 200) {

                // Displaying response from server
                console.log(this.responseText);
            }
        };
    });
}


function fotografsec() {


    var fd = new FormData();
    var files = $('#dosya')[0].files[0];
    fd.append('file', files);

    var marka = $('#marka').val();
    var model = $('#model').val();

    fd.append('marka', marka);
    fd.append('model', model);

    $.ajax({
        url: 'fotografyukle.php',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function (response) {
            if (response != 0) {
                $('#kisiyeozelicerik').html(response);


            } else {
                alert('dosya yüklenemedi.');

            }
        },
    });

};


function downloadtable() {

    var node = document.getElementById('containerImage');

    domtoimage.toPng(node)
        .then(function (dataUrl) {
            var img = new Image();
            img.src = dataUrl;
            downloadURI(dataUrl, "records.png")
        })
        .catch(function (error) {
            console.error('oops, something went wrong!', error);
        });

}


function downloadURI(uri, name) {
    var link = document.createElement("a");
    link.download = name;
    link.href = uri;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    delete link;
}


function previewImage() {
    document.getElementById("image-preview").style.display = "block";
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("image-source").files[0]);

    oFReader.onload = function (oFREvent) {
        document.getElementById("image-preview").src = oFREvent.target.result;
    };
};