document.addEventListener("DOMContentLoaded", e=>{
    const form = document.querySelector("#frmConversores");
    form.addEventListener("submit", event=>{
        event.preventDefault();
  
        let de = document.querySelector("#cboDe").value,
            a = document.querySelector("#cboA").value,
            cantidad = document.querySelector("#txtCantidadConversor").value,
            opcion = document.getElementById('cboConvertir');
  
        let monedas = {
            "dolar":1,
            "Colones":8.75,
            "Yanes":111.27,
            "Rupia":69.75,
            "Lempiras":24.36,
            "Pesos":19.36,
            "Bitcoin":0.00026},

            almacenamiento = {
            "Megabyte":1,
            "Bit":8.388608,
            "Byte":1.048576,
            "Kilobyte":1.024,
            "Gigabyte":0.0009765625,
            "Terabyte":0.00000095367431660625},
            

            longitud = {
            "Metro":1,
            "Cm":100,
            "Pulgada":39.3701,
            "Pie ":3.28084,
            "Varas  ":1.1963081929167,
            "Yardas ":1.09361,
            " Km":0.001,
            "Millas ":0.000621371}



        let $res = document.querySelector("#lblRespuesta");
        if(opcion.value == "moneda"){
        $res.innerHTML = `Respuesta: ${ (monedas[a]/monedas[de]*cantidad).toFixed(2) }`;
        } else if(opcion.value == "almacenamiento"){
        $res.innerHTML = `Respuesta: ${ (almacenamiento[a]/almacenamiento[de]*cantidad) }`;
        } else if(opcion.value == "longitud"){
        $res.innerHTML = `Respuesta: ${ (longitud[a]/longitud[de]*cantidad).toFixed(2) }`;
        };
    });
  });
  
  function seleccionar() {
    let opcion = document.getElementById('cboConvertir'),
    de1 = document.getElementById('cboDe'),
    a1 = document.getElementById('cboA');
    de1.value="";
    a1.value="";
    de1.innerHTML="";
    a1.innerHTML="";
  
    if(opcion.value == "moneda"){
      var  array = ["dolar!Dolar","euro!Euro","quetzal!Quetzal","lempira!Lempira","cordoba!Cordoba"];
    } else if(opcion.value == "almacenamiento"){
        var array = ["bit!Bit","byte!Byte","kb!Kilobyte","mb!Megabyte","gb!Gigabyte"]; 
    } else if(opcion.value == "longitud"){
      var array = ["mm!Milimetros","cm!Centimetros","mt!Metros","km!Kilometros","milla!Millas"];
    };
  
    for(var i=0;i<array.length;i++){ 
      var repair = array[i].split("!");
      var newop = document.createElement("option");
      newop.value = repair[0]
      newop.innerHTML = repair[1];
      de1.options.add(newop);
    };
    for(var i=0;i<array.length;i++){ 
      var repair = array[i].split("!");
      var newop = document.createElement("option");
      newop.value = repair[0]
      newop.innerHTML = repair[1];
      a1.options.add(newop);
    };
   }
   