// $(document).ready(function(){
//     const search = $('.fa-search');
//     // $('.fa-search').on('cursor', 'pointer');
//     const url_v = "http://localhost:8080/php/poo/app/auto/index.php?action=list_v";
//     search.on('click', function(e){
//         e.preventDefault();
//         let mcle = $('#search').val();
//         console.log(mcle)

//         $.ajax({
//             url: url_v,
//             data: {search: mcle},
//             type:'POST',
//             success: function(data){
//                 $('#search').val("");
//                 console.log(data);
//             }

//         })
//     });

// });