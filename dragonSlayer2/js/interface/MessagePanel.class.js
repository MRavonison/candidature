"use-strict"

// voir traversing dans dev docs (jQuery)
var MessagePanel=function()
{
    this.$messagePanel=$('#interface-message-panel').children('ul');



    /******* Gestionnaire d'evenment **********************************/
    $(document).on('message:add',this.onMessageAdd.bind(this))
};





/******* Méthode**********************************/

MessagePanel.prototype.clear=function()
{
  this.$messagePanel.empty();
};

MessagePanel.prototype.onMessageAdd=function(event,message,category)
{
    var $messageItem;
    // ajout d'une balise li à la fin du panneau message
    $messageItem=$('<li>').hide().addClass('message-' + category).html(message);
    // creation d'une balise li avec le message
    this.$messagePanel.append($messageItem);
    $messageItem.fadeIn(2500);

    if(category==undefined)
    {
        category=='.message-normal';
    }
    if(this.$messagePanel.height>570)
    {
        this.$messagePanel.children().first().remove();
    }

};
