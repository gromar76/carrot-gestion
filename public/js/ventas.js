const venta = {
  cliente: null,
  fecha: null,
  observaciones: "",
  productos: [],
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

  $("#producto").change(function () {
    alert("cambio el producto, poner el precio en el input");
    $("#precio").val(99999999);
  });
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
  const producto = {
    id: $("#producto").val(),
    nombre: $("#producto option:selected").text(),
    cantidad: $("#cantidad").val(),
    precioUnit: $("#precio").val(),
  };

  producto.precioUnit = producto.precioUnit || 0;

  // si seleccione algun producto y si el precio no es negativo
  if (producto.id != -1 && producto.precioUnit >= 0 && producto.cantidad >= 1) {
    venta.productos.push(producto);
    $("#form-producto-detalle")[0].reset();
    actualizarVista();
  } else {
    alert("Complete campos!!");
  }
}

function guardarVenta() {
  alert("Guardar venta");
}

function editarProductoDetalle(event) {
  console.log($(this).attr("data-id"));
  alert("Editar producto detalle fila " + $(this).attr("data-id"));
}

function eliminarProductoDetalle() {
  alert("Eliminar producto detalle fila " + $(this).attr("data-id"));
}

function actualizarVista() {
  const detalleProductosTbody = $("#detalle-venta");

  detalleProductosTbody.empty();

  let total = 0;
  let fila = 0;

  for (let { nombre, cantidad, precioUnit } of venta.productos) {
    total += cantidad * precioUnit;

    detalleProductosTbody.append(
      `<tr>
          <td>${nombre}</td>
          <td>${cantidad}</td>
          <td>$ ${precioUnit}</td>
          <td>$ ${cantidad * precioUnit}</td>
          <td>
            <button data-id="${fila}" class="btn-editar-producto-detalle">Editar</button>
            <button data-id="${fila++}" class="btn-eliminar-producto-detalle">Eliminar</button>
          </td>
       </tr>
      `
    );
  }

  $(".btn-editar-producto-detalle").click(editarProductoDetalle);
  $(".btn-eliminar-producto-detalle").click(eliminarProductoDetalle);

  $("#total-factura").html(`$ ${total}`);
}
