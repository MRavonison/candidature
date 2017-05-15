"use-strict"

var StatusBar = function()
{
    this.$statusBar=$('#interface-status-bar');



    /******* Gestionnaire d'evenment **********************************/
};




/******* Méthode**********************************/

StatusBar.prototype.setup=function()
{
    this.$statusBar.find('th:first-child').text('PV Dragon');
    this.$statusBar.find('th:nth-child(2)').text('PV Joueur');
    this.$statusBar.find('th:nth-child(3)').text('Armure');
    this.$statusBar.find('th:nth-child(4)').text('Epée');
};
StatusBar.prototype.refresh=function()
{

};