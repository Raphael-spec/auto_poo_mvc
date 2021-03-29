$(document).ready(function(){
    // $('.fa-search').on('cursor', 'pointer');
    $('.fa-search').on('click', function(e){
        e.preventDefault();
        let mcle = $('#search').val();
        console.log(mcle)
    });

});