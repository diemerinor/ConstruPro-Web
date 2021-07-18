class localizacion{
    
    constructor(callback){
        if(navigator.geolocation){
            console.log("hay geolocalización");
            
            navigator.geolocation.getCurrentPosition((position)=>{
                this.latitude = 0;
                this.longitude = 0;
                this.latitude = position.coords.latitude;
                this.longitude = position.coords.longitude;
                if(this.latitude == 0){
                    console.log("no hay latitud");
                }else{
                    console.log("la latitude es "+this.latitude);
                }
                callback();
                //console.log(this.latitude);
                },
                (err)=> {
                    console.warn('ERROR(' + err.code + '): ' + err.message);
                    alert("Por favor active la geolocalización");
                  }
                );
        }else{
            alert("Tu navegador no soporta geolocalizacion");
            console.log("no hay geolocalización");
        }
    }
}