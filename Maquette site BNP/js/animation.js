/**
 * Created by miharizoravonison on 23/11/16.
 */


function onSlider(){
    $('.carousel').carousel({
        interval:5000
    })
}

function onSliderPrev(){
    $('.carousel').carousel('prev');
}

function onSliderNext(){
    $('.carousel').carousel('next');
}

function onClickBlockContact(){
    $('#myModal').modal('show');
}

function onClickBlockConnexion(){
    $('#myModal-connect').modal('show');
}

function onClickBlockCount(){
    $('#myModal-count').modal('show');
}

function onClickBlockNotification(){
    $('#myModal-notification').modal('show');
}

function onClickBlockLegal(){
    $('#myModal-legal').modal('show');
}

function onClickBlockModifInfo(){
    $('myModal-modif-info').modal('show')
}

function onClickBlockModifRights(){
    $('myModal-modif-rights').modal('show')
}

function onClickBlockModifBank(){
    $('modif-bankz').modal('show')
}

function onShowTab(){
    e.preventDefault();
    $('#myTabs a[href="#info-customer"]').tab('show');
    $('#myTabs a[href="#rights-customer"]').tab('show');
    $('#myTabs a[href="#messages"]').tab('show');
}
