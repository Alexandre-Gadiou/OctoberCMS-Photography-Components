var createGalleriaPhotosPlayer = function ($element) {
    var size = $(window).width() * 0.68;
    var photoplayerID = $element.attr('id');
    var $photoplayer = $('#' + photoplayerID);
    var photosInfo = $photoplayer.data('photos-info');

    Galleria.run('#' + photoplayerID, {showInfo: photosInfo, maxScaleRatio: 1, height: size});
    $photoplayer.css("display", "block");

};

$(document).ready(function () {

    $('.album.galleria').each(function ()
    {
        var $element = $(this);
        createGalleriaPhotosPlayer($element);
    });

});