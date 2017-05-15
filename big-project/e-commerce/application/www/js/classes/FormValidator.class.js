"use-strict"

//creation d'une classe(constructor)
var FormValidator= function($form)
{
    // Propriétés
    this.$form                  =$form;
    this.$errorMessage          =$form.find('.error-message'); // la recherche de la classe aside sera plus puissante grace au find qui cherche dans tout le formulaire
    this.$totalErrorCount       =$form.find('.total-error-count');
    this.totalErrors            =null;

    /******* Gestionnaire d'evenment **********************************/

};





/******* Methode**********************************/


FormValidator.prototype.checkDataTypes=function()
{
    var errors;
    errors=[];

    // .each est l'equivalent d'un foreach. Il va s'executer dans les les balises trouver par le find ayant l'attibut definit
    this.$form.find('[data-type]').each(function()
    {

        var value;

        // .trim retrire les espace avant et apres de la chaine
        value=$(this).val().trim();


        // verfication du type de data dans le phtml
        switch($(this).data('type'))
        {
            case 'number': // voir user view data type
                if(isNumber(value)==true)
                {
                    errors.push(
                        {
                            fieldName: $(this).data('name'),
                            message: "doit être un nombre "
                        });

                }
                break;
            case 'positive-integer':
                if(isInteger(value)==false || value<=0)
                {
                    errors.push(
                        {
                            fieldName: $(this).data('name'),
                            message: "contient une erreur"
                        });
                }
                break;
        }

    }
        );


    $.merge(this.totalErrors,errors);

};


FormValidator.prototype.checkMinimumLength=function()
{
    var errors;
    errors=[];

    // .each est l'equivalent d'un foreach. Il va s'executer dans les les balises trouver par le find ayant l'attibut definit
    this.$form.find('[data-length]').each(function()
    {
        var value;
        var minLength;

        // .trim retrire les espace avant et apres de la chaine
        value=$(this).val().trim();
        minLength=$(this).data('length');

        if(value.length<minLength)
        {
            errors.push(
                {
                    fieldName:$(this).data('name'),
                    message: "doit avoir au moins " + minLength + " caractères"
                });
        }

    });


    $.merge(this.totalErrors,errors);

};


FormValidator.prototype.checkRequiredFields=function()
{
    var errors;
    errors=[];

    // .each est l'equivalent d'un foreach. Il va s'executer dans les les balises trouver par le find ayant l'attibut definit
    this.$form.find('[data-required]').each(function()
    {
        var value;

        // .trim retrire les espace avant et apres de la chaine
        value=$(this).val().trim();

        if(value.length==0)
        {
            errors.push(
                {
                    fieldName:$(this).data('name'),
                    message: "est requis"
                });
        }

    });

    $.merge(this.totalErrors,errors);

};


FormValidator.prototype.run=function()
{
    /******* Gestionnaire d'evenment **********************************/
    this.$form.on('submit',this.onSubmitForm.bind(this));

    if(this.$errorMessage.children('p').text().length>0)
    {
        this.$errorMessage.fadeIn('slow');
    }

};



FormValidator.prototype.onSubmitForm=function(event)
{
    var $errorList;
    $errorList  =this.$errorMessage.children('p');
    // refresh du tableau
    $errorList.empty();


    this.totalErrors    = [];
    this.checkRequiredFields();
    this.checkMinimumLength();
    this.checkDataTypes();



    //Est ce que des erreurs ont été trouvées ?
    if(this.totalErrors.length>0)
    {
        this.totalErrors.forEach(function(errors)
        {
            var message;

            message = "Le champ <strong><em>" + errors.fieldName + "</em></strong> " + errors.message+"</br>";

            $errorList.append(message);// inserer le message

        });

        // ajout en texte le nombre d'erreur
        this.$totalErrorCount.text(this.totalErrors.length);

        // apparition de la bulle d'erreur
        this.$errorMessage.fadeIn('slow');


        //Empêche que la soumission du formulaire se fasse
        event.preventDefault();
    }


};
