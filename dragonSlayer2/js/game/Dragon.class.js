"use-strict"

var Dragon=function(type)
{
    this.type=type;
    this.attackLevel=dataDragons[type].attackLevel;
    this.defenseLevel=dataDragons[type].defenseLevel;
    this.agility=dataDragons[type].agility;
    this.hp=dataDragons[type].hp;
    this.strength=dataDragons[type].strength;
    /******* Gestionnaire d'evenment **********************************/


};



/******* Méthode**********************************/


Dragon.prototype.giveHp=function(healthPoints)
{
    this.hp += healthPoints;
};
Dragon.prototype.isDead=function()
{
    return this.hp<=0;
};
Dragon.prototype.takeHp=function(healthPoints)
{
    this.hp -= healthPoints;
};

Dragon.prototype.attack=function(player)
{
    var damagePoints;
    damagePoints=rollDice()*2;
    damagePoints -= player.defenseLevel;
    damagePoints += this.getAttackLevel();

    if(damagePoints<=0)
    {
        damagePoints=5;
    }
    player.takeHp(damagePoints);

    $(document).trigger('message:add',
        [
            'Le dragon vous inflige ' + damagePoints + ' dégâts !',
            'important'
        ]);
};

Dragon.prototype.getAttackLevel = function()
{
    return rollDice() * this.attackLevel + this.strength;
};