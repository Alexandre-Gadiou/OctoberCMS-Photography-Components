// create a photoplayer with jquery magnific popup plugin
var createMagnificPopupPlayer = function ($element) {
    var photoplayerID = $element.attr('id');
    var $photoplayer = $('#' + photoplayerID);

    $photoplayer.magnificPopup({
        delegate: 'a',
        type: 'image',
        mainClass: 'mfp-fade',
        gallery: {
            enabled: true,
            tCounter: '%curr% sur %total%',
        }
    });

    $('figure:visible', $photoplayer).last().addClass('last');

    $('figcaption', $photoplayer).on('click', function () {
        var currentFigureIndex = $(this).closest("figure").index();
        $photoplayer.magnificPopup('open', currentFigureIndex);
    });
};


$(document).ready(function () {

    $('.album.magnific-popup-player').each(function () {
        var $element = $(this);
        createMagnificPopupPlayer($element);
    });

});