"use-strict"

var World=function()
{
    this.offsetX=0;
    this.offsetY=0;



    /******* Gestionnaire d'evenment **********************************/


};








/******* Methode**********************************/

World.prototype.getTileAt=function(x,y)
{
    return dataWorld[this.offsetY+y][this.offsetX+x];
};

World.prototype.scroll=function(direction)
{

    switch(direction)
    {
        case DIRECTION_EAST:
            if(this.offsetX<WORLD_WIDTH-MAP_WIDTH)
            {
                this.offsetX++;
            }
            break;
        case DIRECTION_WEST:
            if(this.offsetX>0)
            {
                this.offsetX--;
            }
            break;
    }
};

World.prototype.canEntityMoveAt=function(x,y)
{
    var tile;

   if( x >= WORLD_WIDTH || x<0)
   {
       return false;
   }


    if(y >= WORLD_HEIGHT || y<0)
    {
        return false;
    }

    tile=dataWorld[y][x];

    return dataTiles[tile].walkable==true;

   /* OU if(dataTiles[tile].wakable== true)
    {
        return true;
    }
    else
    {
        return false;
    }*/

};