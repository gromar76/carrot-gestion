
// escuchar al boton
$("#btn-agrega").click(agregaProducto);

function agregaProducto(){
    //alert($("#nombreProd").val());

    productos.push( {codigo: "3", nombre: "Grip Unidad", precio: 250});
    mostrar(productos);
    mostrar(clientes);

}



let nombre='Nicolas'

let productos =[
    {
      "codigo": 1,
      "nombre": "Pelotas en tubo x3",
      "precio": 900,
     
    },
    {
        "codigo": 2,
        "nombre": "Caja de pelotas x 24",
        "precio": 20400,
       
      }
  ]


  let clientes =[
    {
      "codigo": 1,
      "nombre": "Nicolas",
      "telefono": "1544115511",
     
    },
    {
        "codigo": 2,
        "nombre": "Marcelo",
        "telefono": "1587885236",
       
      },
      {
        "codigo": 3,
        "nombre": "Jose",
        "telefono": "1547859634",
       
      }
  ]



function mostrar(objeto){
    for (let i=0; i<objeto.length; i++){    
    $("#contenido").append(objeto[i].nombre);    
}
}
