"use-strict"

var Entity=function(fileName, height, animationFrameCount)
{
    this.sprite=new Sprite(fileName, height, animationFrameCount);
    this.x=null;
    this.y=null;

    /******* Gestionnaire d'evenment **********************************/
};






/******* Methode**********************************/
Entity.prototype.moveTo=function(x,y)
{
  this.x=x;
    this.y=y;
};
Entity.prototype.refresh=function(canvasContext,world)
{
    var x;
    var y;

    x=this.x-world.offsetX;
    y=this.y-world.offsetY;

    canvasContext.drawImage
    (
        this.sprite.image,
        this.sprite.sx,
        this.sprite.sy,
        TILESET_PIXEL_SIZE,
        TILESET_PIXEL_SIZE,
        TILESET_PIXEL_SIZE*x,
        TILESET_PIXEL_SIZE*y,
        TILESET_PIXEL_SIZE,
        TILESET_PIXEL_SIZE
    );

};

Entity.prototype.tryMove=function(direction,world)
{
    var x;
    var y;
    x=this.x;
    y=this.y;

    this.sprite.setDirection(direction);

    switch(direction)
    {
        case DIRECTION_EAST:
            x++;
            break;
        case DIRECTION_WEST:
            x--;
            break;
        case DIRECTION_NORTH:
            y--;
            break;
        case DIRECTION_SOUTH:
            y++;
            break;
    }

    if(world.canEntityMoveAt(x,y)==true)
    {
        this.x=x;
        this.y=y;
        return true;
    }
    return false;


};


