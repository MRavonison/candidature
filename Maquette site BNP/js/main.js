/**
 * Created by miharizoravonison on 23/11/16.
 */
'use strict';

$(function(){
    /* Animation */

    $('#myCarousel').on('slide.bs.carousel',onSlider);
    $('#blog-logoOne').on('click',onClickBlockContact);
    $('#customer-connect').on('click',onClickBlockConnexion);
    $('#create-count').on('click',onClickBlockCount);
    $('#notification').on('click',onClickBlockNotification);
    $('#blog-logoFour').on('click',onClickBlockLegal);
    $('#modif-btn').on('click',onClickBlockModifInfo);
    $('#btn-rights').on('click',onClickBlockModifRights);
    $('#btn-bank').on('click',onClickBlockModifBank);
    $('.left').on('click',onSliderPrev);
    $('.right').on('click',onSliderNext);
    $('#myTabs a').on('e',onShowTab);

    /* UserControl */

    $('#sign-in').on('click',onControlInfoCustomer);
    $('#save-btn').on('click',onModifInfoCustomer);
    $('#save-btn-rights').on('click',onModifRights);

});