const $ = require('jquery');

var $collectionHolder;

var $addNewItem = $('<a href="#" class="btn btn-info">Add new category</a>');

$(document).ready(function(){
    //get the collection holder
    $collectionHolder = $('#category_list')

    //add remove button to existing items
    $collectionHolder.find('.panel').each(function(item){
        addRemoveButton(item);
    });

});

function addRemoveButton($panel){
    var $removeButton = $('<a href="#" class="btn btn-danger">Remove</a>');

    //Ajouter le bouton au footer
    var $panelFooter = $('<div class="panel-footer"></div>').append($removeButton);

    //Gerer le click du bouton
    $removeButton.click(function(e){
        
    });

    //Ajouter le footer au panel
    $panel.append($panelFooter);
}