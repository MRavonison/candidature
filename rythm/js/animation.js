/**
 * Created by miharizoravonison on 16/12/16.
 */
'use strict';

var video = $('#bgvid');
var pauseButton = $('#description button');

$.fn.extend({
    animateCss: function (animationName) {
        var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
        this.addClass('animated ' + animationName).one(animationEnd, function() {
            $(this).removeClass('animated ' + animationName);
        });
    }
});

function onBounceSquare()
{
    $('.square').animateCss('bounce');
}

function onFlipSquare()
{
    $('.square').animateCss('flip');
}

function onSlideAnimation()
{
    $('#poster-first').parallax("center", 0, 0.1, true);
    $('#poster-second').parallax("center", 900, 0.1, true);
    $('#poster-third').parallax("center", 2900, 0.1, true);
    $('#poster-fourth').parallax("center", 4900, 0.1, true);
}

function vidFade()
{
    $('#bgvid').classList.add("stopfade");
}

function endendVideo()
{
    $('#bgvid').pause();

    vidFade();
}

function onClickPause()
{
    video.toggle("stopfade");

    if(video.paused)
    {
        video.play;
        pauseButton.innerHTML = "Pause";
    }
    else
    {
        video.pause;
        pauseButton.innerHTML = "Paused";
    }
}