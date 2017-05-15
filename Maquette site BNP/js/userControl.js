/**
 * Created by miharizoravonison on 25/11/16.
 */
'use strict';


var $errorConnexion = document.getElementById('error-connexion');
var $verif = false;


/*console.log($emailCustomer);
console.log($passwordCustomer);*/
function onControlInfoCustomer(){
    var $emailCustomer = document.getElementById('inputEmail3').value;
    var $passwordCustomer = document.getElementById('inputPassword3').value;
    var $emailControl = 'marc.landers@gmail.com';
    var $passwordControl = 'papa';

    if ($emailCustomer.localeCompare($emailControl) == 0 && $passwordCustomer.localeCompare($passwordControl) == 0)
    {
        window.location.href='user.html';
        $verif = true;

        return $verif;
    }
    else
    {
        alert($emailCustomer);
    }
}

function onModifInfoCustomer(){
    var $lastNameValue = document.getElementById('lastName').value;
    var $firstNameValue= document.getElementById('firstName').value;
    var $addressValue= document.getElementById('address').value;
    var $cityValue= document.getElementById('city').value;
    var $zipCodeValue= document.getElementById('zipCode').value;
    var $emailValue= document.getElementById('inputEmail3').value;
    var $phoneValue= document.getElementById('phone').value;

    $('.lastName-tab').html($lastNameValue);
    $('.firstName-tab').html($firstNameValue);
    $('#address-tab').html($addressValue);
    $('#city-tab').html($cityValue);
    $('#zipCode-tab').html($zipCodeValue);
    $('#email-tab').html($emailValue);
    $('#phone-tab').html($phoneValue);

    $('#lastName').val("");
    $('#firstName').val("");
    $('#address').val("");
    $('#city').val("");
    $('#zipCode').val("");
    $('#inputEmail13').val("");
    $('#phone').val("");

    alert('Sauvegardé');
}

function onModifRights(){
    var $birthdayValue = document.getElementById('birthday').value;
    var $LiaisonSocialValue = document.getElementById('family').value

    $('#birthday-tab').html($birthdayValue);
    $('#family-tab').html($LiaisonSocialValue);

    $('#birthday').val("");
    $('#family').val("");
}
