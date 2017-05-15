"use-strict";// Ne pas  oublier de charger dans le html <script>

var Menu = function()
{
    this.$menu=$('#interface-menu');
    this.remainingPoints= 3;

/******* Gestionnaire d'evenment **********************************/

    this.$menu.find('.meter-control').on('click',this.onClickMeterButton.bind(this));
    this.$menu.find('.start').on('click',this.onClickStarButton.bind(this));
    // le bind relis le this du constructeur au gestionnaire d'evenement

};



/******* Méthode**********************************/

Menu.prototype.refresh=function()
{
    // mise à jour de l'affichage des points restant à répartir
    this.$menu.find('.remaining-point').text(this.remainingPoints);
};

Menu.prototype.onClickStarButton=function(event)
{
    // Creation d'un objet avec  recherche des valeurs
    var menuData={
        nickName:this.$menu.find('#nickName').val(),
        agility:this.$menu.find('#agility').val(),
        strength:this.$menu.find('#strength').val(),
        difficulty:this.$menu.find('[name= difficulty]:checked').val()
    };

    $(document).trigger('game:start',menuData); // relier à Game.class.js pour le gestionnaire d'evenement et la methode on game start // funciton independant des autres


    event.preventDefault();

};

Menu.prototype.onClickMeterButton=function(event)
{
   var $button;
    var meter;

    // Récupération de l'objet jQuery du bouton qui a déclenché l'évènement.
        $button=$(event.currentTarget);

    /*
     * Récupération de l'objet DOM de la jauge reliée au bouton.
     *
     * On utilise l'objet DOM natif et pas jQuery car on a besoin de tester
     * plusieurs attributs HTML de la balise <meter> que jQuery ne supporte pas
     * directement (à part en utilisant la méthode .attr() ).
     */
        meter=document.getElementById($button.data('meter'));

    if($button.data('action')=='decrease')
    {
        // clic sur bouton
        if(meter.value>meter.min)
        {
            meter.value--;
            this.remainingPoints++;
        }
    }
    else
    {
        // clic sur bouton ++
        if(meter.value<meter.max && this.remainingPoints>0)
        {
           /* OU if(this.remainingPoints>0)
            {
                meter.value++;
                this.remainingPoints--
            }*/

            meter.value++;
            this.remainingPoints--;
        }
    }

    this.refresh();
    event.preventDefault();
};















