/**
 * Created by miharizoravonison on 16/12/16.
 */
'use strict';
$(function()
{
    $('.click-button').on('click', onBounceSquare);
    $('.click-a').on('click', onFlipSquare);
    $(document).ready('scroll',onSlideAnimation);
    $('#bgvid').on('ended', endendVideo);
    $('#description button').on('click', onClickPause);
}
);
