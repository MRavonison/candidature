"user-strict"

var BasketSession= function()
{
    // Propriétés
    this.basketItems=[];

    this.load();
};


/******* Methode**********************************/

BasketSession.prototype.add=function(mealId,name,quantity,salePrice)
{
    quantity=parseInt(quantity);
    mealId= parseInt(mealId);
    salePrice=parseFloat(salePrice);


    var index;
    for(index=0;index<this.basketItems.length; index++)
    {
        // Si l'index  de mealID correspond a un meal Id stocker
        if(this.basketItems[index].mealId == mealId)
        {
            //On ajoute le nombre de quantité dans le mealId trouver
            this.basketItems[index].quantity += quantity;

            this.save();

            return;
        }
    }

    //la propriété basketItems un OBJET contenant les 4 arguments
    // attention au push voir ci-dessous ajout d'un article

    this.basketItems.push({
        mealId :mealId,
        name:name,
        quantity:quantity,
        salePrice:salePrice
    });

    //Appel de la méthode save
    this.save();

};

BasketSession.prototype.clear=function()
{
    saveDataToDomStorage('Panier',null);
};

BasketSession.prototype.save=function()
{
    //Appel de  saveDataToDomStorage() pour enregistrer la propriété basketItems
    saveDataToDomStorage('Panier',this.basketItems);
};

BasketSession.prototype.load=function()
{
    // chargement Le locale storage
   var basketItems=loadDataFromDomStorage('Panier');

    if(basketItems==null)
    {
         basketItems=[];
    }

    this.basketItems=basketItems;
};


