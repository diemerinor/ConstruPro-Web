//Variables



let nav = document.getElementById('nav');
let menu = document.getElementById('enlaces');

let abrir = document.getElementById('open');
let botones = document.getElementsByClassName('btn-header');
let cerrado = true;


/*OPCIONES MAPA */

/*EN WINDOW.ADDEVENTLISTENER, ES DONDE AL HACER SCROLL VA A LA FUNCIÓN MENU Y LE DICE LA POSICION EN Y
Y EN CUANTO SEA 300, SE VA A HACER UN CAMBIO DE NAV, EL CUAL PUEDE CAMBIAR DE COLOR, SEGUN LO PUESTO
EN EL CSS */

function menus(){
    let Desplazamiento_Actual = window.pageYOffset;
    
    if(Desplazamiento_Actual <= $('#equipos').offset().top){
        nav.classList.remove('nav2');
        nav.className = ('nav1');
        nav.style.transition = '1s';
        menu.style.top='80px';
        abrir.style.color= '#fff'
    }else{
        nav.classList.remove('nav1');
        nav.className = ('nav2');
        nav.style.transition = '1s';
        menu.style.top='100px';
        abrir.style.color ='#000'
    }

}



window.addEventListener('scroll',function(){
    //console.log(this.window.pageYOffset);
    menus();
});




window.addEventListener('load',function(){
    $('#onload').fadeOut();
    $('body').removeClass('hidden');
    menus();   

});



window.addEventListener('click',function(e){
    if(cerrado==false){
        let span = document.querySelector('span');
        if(e.target !==span && e.target !== abrir){
            menu.style.width= '0%';
            menu.style.overflow = 'hidden';
            cerrado = 'true';
        }
    }
});


abrir.addEventListener('click',function(){
    apertura();
});

function apertura(){
    if(cerrado){
        menu.style.width = '40vw';
        cerrado = false;
    }else{
        menu.style.width = '0%';
        menu.style.overflow='scroll';
        cerrado = true;;
    }
}