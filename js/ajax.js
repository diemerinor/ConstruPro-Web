$(document).ready(function(){

    // $('#mapita').on('click',function(){
        $.ajax('index.php').done(function(response){
            console.log('se cargó');
            $('#ajax1').text('se cargó');
            });
        
});