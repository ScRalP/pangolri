//Script pour avoir un ajout dynamique d'images pour un produit

var $collectionHolder;

var $addNewItem = $('<a class="btn btn-primary m-2 col-12">Add new image</a>')

$(document).ready( function(){
    //Recuperer le collectionHolder
    $collectionHolder = $('#img_list')

    $('#list_holder').append($addNewItem)

    $collectionHolder.data( 'index', $collectionHolder.find('.list-group-item').length )

    //Ajouter un bouton de suppression aux elements existants
    $collectionHolder.find('.list-group-item').each(function(item){
        addRemoveButton($(this))
    })

    //Gerer le click du bouton ajouter
    $addNewItem.click(function(e){
        e.preventDefault()
        //Add new field and append it to collectionHolder
        addNewForm()
    })
})

//Ajouter un champ
function addNewForm(){
    //Create the form
    var prototype = '<li class="list-group-item" id="image___name__"><div class="row"><div class="col-7"><input type="text" id="product_images___name__" name="product[images][__name__]" class="form-control" /></div></div></li>'

    var index = $collectionHolder.data('index')
    
    //remplacer les __name__ par la valeur actuelle
    var form = prototype.replace(/__name__/g, index)

    //transforme la chaine en objet jquery
    var newForm = $(form)

    $collectionHolder.data('index', index++)
    addRemoveButton(newForm)

    $collectionHolder.append(newForm)
}

//Retirer un champ
function addRemoveButton($panel){
    //Créer le bouton de suppression
    var $removeButton = $('<a class="btn btn-danger offset-4"><i class="fas fa-minus-circle"></i></a>')

    //Gerer le click du bouton supprimer
    $removeButton.click(function(e){
        e.preventDefault()
        $(e.target).parents('.list-group-item').remove()
    })

    //Ajouter le bouton à notre row
    $panel.children().append($removeButton)
}