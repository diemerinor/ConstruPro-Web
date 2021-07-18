$(document).ready(function(){

    $('#loshasvisto').html('wenas');
    // $('#fotitos').slideDown();

    //SI QUIERO TOMAR POR EJEMPLO 2 ELEMENTOS SERÍA SEPARADO POR UNA COMA POR EJEMPLO:
    //$('#elemento1, #elemento2').html('wenas');

    //AL HACER CLICK EN EL ELEMENTO QUE TIENE COMO ID 'img' SE LLAMA A LA FUNCION
    $('#img').on('click',function(){
        var mascotita = document.getElementById('nombrem').value;
        alert('wenas '+mascotita);
    });


    //AL HACER CLICK LE HAGO UN TOGGLE CLASS QUE ES COMO UN INTERRUPTOR, Y ESTARÍA CAMBIANDOLE LA CLASE, LO CUAL CAMBIARIA EL DISEÑO
    //POR QUE EN CSS EL DISEÑOS DE CADA CLASE ES DISTINTA
    $('#loshasvisto').on('click',function(){
        $(this).toggleClass('loshasvisto2');
        // $(this).animate({
        //     left:20
        // },'slow');
    });

        
     

    //EN EL ARCHIVO INGRESAR NUEVO, SE DETECTA EN EL INPUT DEL NOMBRE Y DEL TEXT AREA CUANDO SE INGRESA UN TEXTO
    //EL EVENTO ON KEYUP DETECTA CUANDO INGRESA UNA TECLA, POR LO QUE ES EL MÁS CONVENIENTE    

    $('#nombremascota1').on('change',function(){
        var nombre= document.getElementById('nombremascota1').value;
        console.log(nombre);
        if(nombre=='diego'){
            $('#contenido').html('dice diego');
            
        }
        if(nombre!='diego'){
            $('#contenido').html('No dice diego');
        }

    });

    $('#descripcion2').on('keyup',function(){
        var nombre2= document.getElementById('descripcion2').value;
        console.log(nombre2);
        if(nombre2=='diego'){
            $('#contenido2').html('Dice diego');
        }
        if(nombre2!='diego'){
            $('#contenido2').html('No dice diego');
        }

    });


    

    

});

