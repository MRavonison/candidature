$(function() {
    $(".mon-navbar").slideDown(1000);
    //$(".mon-container").hide().delay(800).animate({width: '500px'});
    $(".mon-container").delay(500).fadeIn(1000);
    //$(".HomeView").delay(800).fadeIn(1500);
});

function ajoutingre(event) {

    //permet de ne pas déclencher le formulaire au clique du bouton ajouté
    event.preventDefault();

    //contenu à dupliquer
    var html = "<br /><br /><div class=\'form-group\'>" +
        "<label class=\'control-label col-sm-4\' for=\'nom_ingre\'>Nom ingrédient:</label>" +
        "<div class=\'col-sm-8 col-\'>" +
        "<input type=\'text\' class=\'form-control\' id=\'nom_ingre\' placeholder=\'Entrer nom ingrédient\' maxlength=\'50\'>" +
        "</div>" +
        "</div>" +
        "<div class=\'form-group\'>" +
        "<label class=\'control-label col-sm-4\' for=\'unite\'>Unité:</label>" +
        "<div class=\'col-sm-8 col-\'>" +
        "<input type=\'text\' class=\'form-control\' id=\'unite\' placeholder=\'Entrer une unité\' maxlength=\'50\'>" +
        "</div>" +
        "</div>" +
        "<div class=\'form-group\'>" +
        "<label class=\'control-label col-sm-4\' for=\'poid\'>Poids/volume:</label>" +
        "<div class=\'col-sm-8\'>" +
        "<input type=\'number\' class=\'form-control\' id=\'poid\' placeholder=\'Entrer le poids/volume\' maxlength=\'5\'>" +
        "</div>" +
        "</div>";

    //permet de sauvegarder le bouton ajouté
    var bouton = document.getElementById("repaire");

    //permet de sauvegarder le bouton crée
    var bouton1 = document.getElementById("repaire1");

    //permet d'ajouté le html au clique
    $(".form-horizontal").append(html);

    //permet de deplacer le bouton ajouté au clique
    $(".form-horizontal").append(bouton);

    //permet de deplacer le bouton crée au clique
    $(".form-horizontal").append(bouton1);

}