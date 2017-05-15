"use-strict"

var OrderForm= function()
{
    //$form pointe sur le <form>
    this.$form          = $('#order-form');
    //$meal  pointe sur le <select>
    this.$meal          = this.$form.find('#meal');
    // $mealDetails pointe sur le <article>
    this.$mealDetails   = this.$form.find('#meal-details');

    this.basketSession  = new BasketSession();
    this.orderId=null;

    this.$orderSummary  = this.$form.find('#order-summary');
};


/******* Methode**********************************/


// Au chargement de la requette apres la requete en php voir MealController,MealModel
OrderForm.prototype.onAjaxChangeMeal=function(meal)
{

   //$meal['Description'] (php) ->meal.Description (jquery);

    this.$mealDetails.children('p').text(meal.Description);
    // Voir utilities.js
    this.$mealDetails.find('strong').text(formatMoneyAmount(meal.SalePrice));
    //affichage de la photo
    this.$mealDetails.children('img').attr("src", getWwwUrl() + '/images/meals/' + meal.Photo);
    //  Dans la balise input hidden on trouvera la valeur (voir inspecteur element)
    this.$form.find('input[name=salePrice]').val(meal.SalePrice);


};


OrderForm.prototype.onAjaxRefreshSummary=function(basketViewHtml)
{
    this.$orderSummary.html(basketViewHtml);

    if(this.basketSession.basketItems.length>0)
    {
        $('#validate-order').attr('disabled',false);
    }
    else
    {
        $('#validate-order').attr('disabled',true);
    }

    this.orderId=this.$orderSummary.find('[data-order-id]').data('order-Id');

};

OrderForm.prototype.onAjaxClickValidateOrder=function()
{
    // redirection http en javascript
    window.location.assign(getRequestUrl() + "/order/payment?id=" + this.orderId);
};


// Au demarrage de la requete Http
OrderForm.prototype.onChangeMeal=function()
{
    // Creation d'une  variable locale mealId qui contiendra l'id de l'aliment sélectionné
    var mealId;
    mealId=this.$meal.val();

    //Déclenchement d'une requête HTTP pour obtenir en JSON les informations sur l'aliment sélectionné
    //voir MealModel.class
    $.getJSON
    (
        // GetRequestURl ce trouve dans utilities.js
        getRequestUrl() + "/meal?id=" + mealId,
        this.onAjaxChangeMeal.bind(this)
    )

};


OrderForm.prototype.onClickRemoveBasketItems=function(event)
{
    console.log('delete');

    event.preventDefault();
};


OrderForm.prototype.onClickValidateOrder=function()
{
    var form;
    //initialisation de la variable
    form =
    {
        basketItems: this.basketSession.basketItems,
        orderId: this.orderId
    };

    $.post
    (
        getRequestUrl() + "/order/validation",
        form,
        this.onAjaxClickValidateOrder.bind(this)
    );

};

OrderForm.prototype.onSubmitForm=function(event)
{
    this.basketSession.add
    (
        //on récupère l'Id
        this.$meal.val(),
        // on récupère le name
        this.$meal.find('option:selected').text(),
        this.$form.find('input[name=quantity]').val(),
        this.$form.find('input[name=salePrice]').val()
    );

    // s'incronisation de l'affichage

    this.refreshOrderSummary();
    event.preventDefault();
};


OrderForm.prototype.refreshOrderSummary=function()
{

    /*Objectif : construire une requête HTTP POST vers /basket pour informer le serveur du contenu du panier et récupérer le HTML de BasketView
     *
      *  Préparation d'une requête HTTP POST, construction d'un objet représentant
     * les données de formulaire.
     *
     * Par exemple form.orderId donnera du côté du serveur en PHP $formFields['orderId']
     */

    var form;
    //initialisation de la variable
    form =
    {
        basketItems: this.basketSession.basketItems,
        orderId: this.orderId
    };

    $.post
    (
        getRequestUrl() + "/basket",
        form,
        this.onAjaxRefreshSummary.bind(this)
    );
    // renvoi à basketcontroller


};


OrderForm.prototype.run=function()
{
    /******* Gestionnaire d'evenment **********************************/

    //Installation d'un gestionnaire d'évènement 'change' sur le <select>
    this.$meal.on('change',this.onChangeMeal.bind(this));

    //declenchement manuel de l'évènement de la liste déroulante afin d'afficher les éléments
    this.$meal.trigger('change');

    this.$form.on('submit',this.onSubmitForm.bind(this));

    $('#validate-order').on('click',this.onClickValidateOrder.bind(this));

    this.$orderSummary.on('click','button',this.onClickRemoveBasketItems.bind(this));

    this.refreshOrderSummary();

};