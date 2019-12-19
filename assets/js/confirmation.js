$('.btn-danger').click(function(e) {
    if( !confirm('Are you sure you want to do this?') ){
        e.preventDefault();
        e.stopPropagation();
    }
})