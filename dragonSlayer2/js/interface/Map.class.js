"use-strict"

var Map=function()
{
    var canvas;
    canvas=document.querySelector('#interface-map'); // Voir html

    this.context=canvas.getContext("2d");
    this.tileset= new Image();
    //chargement du fichier image contenant les petits carreaux
    this.tileset.src='images/tileset.png';




    /******* Gestionnaire d'evenment **********************************/



};


/******* Methode**********************************/

Map.prototype.refresh=function(world)
{


    var x;
    var y;

    for(y=0;y<MAP_HEIGHT;y++)
    {
        for(x=0;x<MAP_WIDTH;x++)
        {
            var tile = world.getTileAt(x,y);
            this.context.drawImage
            (
                this.tileset,
                dataTiles[tile].sx,
                dataTiles[tile].sy,
                TILESET_PIXEL_SIZE,
                TILESET_PIXEL_SIZE,
                TILESET_PIXEL_SIZE*x,
                TILESET_PIXEL_SIZE*y,
                TILESET_PIXEL_SIZE,
                TILESET_PIXEL_SIZE

            );

            //this.context.fillRect(x*TILESET_PIXEL_SIZE,y*TILESET_PIXEL_SIZE,TILESET_PIXEL_SIZE,TILESET_PIXEL_SIZE);

        }
    }
};