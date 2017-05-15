"use-strict"

function runFormValidation()
{
    var $form ;
    var formValidator;

    $form=$('form:not([data-no-validation=true])');

    if($form.length>0)
    {
        formValidator = new FormValidator($form);
        formValidator.run();
    }

};



$(function()
    {
        var orderForm;

        //le flashbag disparaît lentement AU BOUT DE trois secondes
        $('#notice').delay(3000).fadeOut('slow');
        // On appel la methode run
        runFormValidation();

        // gestion du formulaire de commande si l'utilisateur est sur la page en question.
        if(typeof OrderForm != 'undefined')
        {
            orderForm= new OrderForm();
            orderForm.run();
        }

    }
);