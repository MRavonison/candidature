"use-strict"// Ne pas  oublier de charger dans le html <script>

var Game=function()
{
    this.player=null;
    this.dragon=null;
    this.difficulty=null;
    this.state=null;
    this.map=new Map();
    this.world=new World();
    this.statusBar= new StatusBar();

/******* Gestionnaire d'evenment **********************************/

    $(document).on('game:start',this.onGameStart.bind(this)); // on a fait en sorte  qu'on a créeée une un evenement independant voir menu.class.js
    $(document).on('game:change-state',this.onGameChangeState.bind(this));

};


/******* Methode**********************************/

Game.prototype.setup=function()
{
    var menu;
    menu= new Menu();

    menu.refresh();

    var messagePanel;
    messagePanel= new MessagePanel();
    messagePanel.clear();

};

Game.prototype.onGameStart=function(event,menuData)// une fois toute les infos recuperer on peut commentcer le jeu
{
    this.difficulty=menuData.difficulty; // on recupere dans le menuData la valeurs de difficulty

    // creation du joueur
    var player;
    this.player= new Player(menuData.nickName,menuData.agility,menuData.strength);

    // Faire attention au chemin entre chaque fichier afin d'appeler un fonction
    this.player.entity.moveTo(16,23);

    // message de bienvenue
    $(document).trigger('message:add',[ 'Bienvenu(e) <em>' + this.player.nickName + '</em> ;-)','info']);

    $('#interface-menu').fadeOut(1000,function()
    {
        $('main').fadeIn(1500,function()
        {
            $('h1').removeClass('animate-fire');
            $(document).trigger('game:change-state',GAME_STATE_PLAY_START);
        });
    });



};
/*

autre possibilité de code pour la disparition du menu et apparation de la boite de  dialogue
VERSION 1 :
==========
*  // On cache le menu de démarrage...
 $('#interface-menu').fadeOut(1000, function()
 {
 // ...Puis on affiche le jeu.
 $('main').fadeIn(1500, function()
 {
 // Suppression de l'animation sur le titre du jeu.
 $('h1').removeClass('animate-fire');
 });
 });


 VERSION 2 :
 ===========
 // On cache le menu de démarrage...
 $('#interface-menu').fadeOut(1000);

 // ...Puis on affiche le jeu.
 $('main').delay(1000).fadeIn(1500, function()
 {
 // Suppression de l'animation sur le titre du jeu.
 $('h1').removeClass('animate-fire');
 });



 VERSION 3 :
 =========
 // On cache le menu de démarrage...
 $('#interface-menu').fadeOut(1000);

 // ...Puis on affiche le jeu.
 $('main').delay(1000).fadeIn(1500);

 // Suppression de l'animation sur le titre du jeu.
 $('h1').delay(2500).removeClass('animate-fire');

 * */

Game.prototype.onGameChangeState=function(event,state)
{
    this.state=state;

    $(document).off('keydown'); //  ce qui indique : désintallation de tous les gestionnaire de clavier

    switch(state)
    {
        case GAME_STATE_END:
        {
            // si dragon est mort
            if(this.dragon.isDead() == true)
            {
                $(document).trigger('message:add', [
                    'Le cadavre du dragon noir fumant gît à vos pieds, ' +
                    '<strong>victoire</strong> ! :-)',
                    'important']);
                break;
            }
            // sinon (si joueur est mort) voir dragon.class.js
            else
            {
                $(document).trigger('message:add', [
                    'Vous avez été <strong>carbonisé</strong> par le dragon, ' +
                    'pas de chance :-(',
                    'important']);


            }

            $(document).trigger('message:add', [
                '<a href="index.html">Cliquez sur le titre</a> pour relancer le jeu !',
                'info']);

            break;
        }



        case GAME_STATE_FIGHT:
            // Envoi message dans la boite de  dialogue
            $(document).trigger('message:add',[
                "Tu as découvert la grotte d'un dragon, le combat s'engage" +
                '(<strong>touche F</strong>!)',
                'important']);
            $(document).on('keydown',this.onKeyDownGameFight.bind(this));
            break;



        case GAME_STATE_PLAY:
        case GAME_STATE_PLAY_START:

            // Lien avec la méthode ci-dessous
            $(document).on('keydown',this.onKeyDownGamePlay.bind(this));

            // Envoi message dans la boite de  dialogue
            $(document).trigger('message:add',[
                'Trouve et détruis le <strong>DRAGON NOIR</strong> pour gagner ' +
                'la partie&nbsp;! Que la FORCE soit avec toi&nbsp!',
                'info']);

            if(state==GAME_STATE_PLAY_START)
            {
                this.statusBar.setup();
                this.refreshLoop(); // affichage initial du jeu
            }
            break;

    }
};



Game.prototype.refreshLoop=function()
{
    // Affichage de la carte.
    this.map.refresh(this.world);

    // Affichage des barres
    this.statusBar.refresh();

    if (this.state==GAME_STATE_PLAY || this.state==GAME_STATE_PLAY_START )
         {
             // Affichage du joueur sur la carte.
             this.player.entity.refresh(this.map.context,this.world);
         }


    // Mise à jour de l'animation des sprites.
    this.player.entity.sprite.update();


    // On se réinstalle pour dessiner à la prochaine image (60 fps)
    window.requestAnimationFrame(this.refreshLoop.bind(this));
};

Game.prototype.onKeyDownGamePlay=function(event)
{
    var index;
    switch(event.keyCode)  // event = objet
    {
        case KEY_DOWN_ARROW:
            this.player.tryMove(DIRECTION_SOUTH,this.world);
            break;
        case KEY_LEFT_ARROW:
            this.player.tryMove(DIRECTION_WEST,this.world);
            break;
        case KEY_RIGHT_ARROW:
            this.player.tryMove(DIRECTION_EAST,this.world);
            break;
        case KEY_UP_ARROW:
            this.player.tryMove(DIRECTION_NORTH,this.world);
            break;
        default:
            // Lorsqu'on appui sur une autre touche du clavier , il sera peut etre géré pour une autre action
            return false;
    }
    // Verification que le joueur ne c'est pas placer sur carreau relié à un evenement sur la carte
    for(index=0;index<dataWorldEvents.length;index++)
    {
        // est ce que l'evenement ne c'est pas deja produit? réponse non
        if(dataWorldEvents[index].done==false)
        {
            // est ce que les coordonnée x/y correspondent aux coordonnés du joueur
           if(dataWorldEvents[index].x==this.player.entity.x &&
            dataWorldEvents[index].y==this.player.entity.y)
           {
               // Oui , quels types d'evenement faut-il declencher
               switch(dataWorldEvents[index].what)
               {
                   case 'dragon-1':
                       this.dragon= new Dragon(DRAGON_TYPE_GREEN);
                       $(document).trigger('game:change-state',GAME_STATE_FIGHT);
                       break;
                   case 'treasure-2':
                       break;
                   case 'treasure-1':
                       break;
                   case 'dragon-2':
                       break;
               }
               dataWorldEvents[index].done=true;
           }
        }
    }

};

Game.prototype.onKeyDownGameFight=function(event)
{
    var dragonspeed;
    var playerspeed;

    dragonspeed=rollDice();
    playerspeed=rollDice();

// Est ce que le joueur appui sur une touche que l'on gére
    if(event.keyCode != KEY_F)
    {
        // Non, le joueur appui sur une touche qu'on ne gere pas
            return false;
    }

    if(dragonspeed>playerspeed)
    {
        this.dragon.attack(this.player);
    }
    else
    {
        this.player.attack(this.dragon);
    }

// Si le dragon est mort
    if(this.dragon.isDead()==true)
    {
        if(this.dragon.type==DRAGON_TYPE_BLACK) // il faut trouver le type du dragon
        {
            $(document).trigger('game:change-state',GAME_STATE_END);
        }
        else
        {
            this.dragon=null;
            $(document).trigger('message:add',[
                "Le dragon est mort, mais ce n'est pas un dragon noir, " +
                '<strong>continuez</strong> ! :-)','important']);
            $(document).trigger('game:change-state',GAME_STATE_PLAY);
        }
    }

    // si le player est mort
    if(this.player.isDead()==true)
    {
        $(document).trigger('game:change-state',GAME_STATE_END);
        //Game over
    }
};
