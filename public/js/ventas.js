const venta = {
  cliente: null,
  fecha: null,
  observaciones: "",
  productos: [
    { id: 1, nombre: "Monitor", precioUnit: 10000, cantidad: 2 },
    { id: 2, nombre: "Teclado", precioUnit: 20000, cantidad: 1 },
  ],
};

$(document).ready(function () {
  // cuando se carga el documento....convierto la clase TABLA a datatable...
  $("#tabla").DataTable({
    columnDefs: [
      {
        // por cada fila tengo el row, entonces en la posicion 0 es el codigo
        // por eso se lo paso al data-id para que sepa que id de categoria es cuando hago click
        // guardo en data-id el id del producto.... y lo puedo usar luego como en la funcion editar()
        render: (data, type, row) => {
          console.log(row);
          return `  
                    <button class="btn btn-success btn-sm btn-editar" data-id=${row[0]} data-toggle="tooltip" data-placement="top" title="Editar">
                      <i class="fas fa-edit"></i>
                    </button>                                 
                  `;
        },

        targets: 4,
      },
    ],
    order: [[1, "asc"]],
    language: {
      url: `${URL_BASE}/public/js/datatable/es_es.json`,
    },
  });

  // si hago click en btn-editar ir a funcion editar
  $("body").on("click", ".btn-editar", editar);

  //cuando hago click en boton de cancelar
  $("#btn-atras").click(atras);

  $("#btn-agregar-detalle").click(agregarProductoDetalle);

  $("#btn-guardar").click(guardarVenta);
});

function atras() {
  history.back();
}

// hice click en editar
function editar() {
  //console.log("editar", $(this).attr("data-id"));
  // guardo en id el valor del atributo data-id del boton que pulse, eso es el id de la venta
  const id = $(this).attr("data-id");
  window.location = `${URL_BASE}/index.php?m=ventas&a=editar&id=${id}`;
  //console.log("editando", $(this).attr("data-id"));
}

const idVentaSeleccionada = $("#venta").attr("data-id-original");

function cargarVenta(id) {
  // alert("hola");
}

function agregarProductoDetalle() {
  alert("Agregar producto al detalle");
  actualizarVista();
}

function guardarVenta() {
  alert("Guardar venta");
}

function actualizarVista() {
  alert("Actualizo la vista");
}
