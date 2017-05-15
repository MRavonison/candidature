"use-strict"

var Player=function(nickName,agility,strength)
{
    if(nickName.trim().length==0)
    {
        nickName='Petit Jedi'; // Nom par default si nom =0
    }

    this.nickName   =nickName.toLowerCase();
    this.hp         =getRandomInteger(150,250);
    this.agility    =agility;
    this.strength   =strength;
    this.entity     = new Entity('images/link.png',32,12);
    this.attackLevel  = 1;              // Niveau d'attaque minimum
    this.defenseLevel = 1;              // Niveau de défense minimum


    /******* Gestionnaire d'evenment **********************************/



};



/******* Méthode**********************************/


Player.prototype.giveHp=function(healthPoints)
{
    this.hp = healthPoints ++;
};
Player.prototype.isDead=function()
{
    if (this.hp<=0)
    {
        return true;
    }
    return false;

    /* OU tout simplement return this.hp<=0; */
};

Player.prototype.takeHp=function(healthPoints)
{
    this.hp = healthPoints --;
};

Player.prototype.tryMove=function(direction,world)
{
    if(this.entity.tryMove(direction,world)==true)
    {
        world.scroll(direction);
    }
};
Player.prototype.attack=function(dragon)
{
    var damagePoints;
    damagePoints=rollDice()*4;
    damagePoints-= dragon.defenseLevel;
    damagePoints += this.getAttackLevel();

    if(damagePoints<=0)
    {
        damagePoints=5;
    }
    dragon.takeHp(damagePoints);

    $(document).trigger('message:add',
        [
            'Vous avez infligé ' + damagePoints + ' dégâts au dragon !',
            'important'
        ]);
};

Player.prototype.getAttackLevel = function()
{
    return rollDice() * this.attackLevel + this.strength;
};

