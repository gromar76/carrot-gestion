// armo la estructura de la venta
const venta = {
  cliente: null,
  fecha: null,
  observaciones: "",
  productos: [],
};

// con esto manejo la fila al hacer click en editar o eliminar
let numFilaEditar;

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

  $("#btn-agregar-detalle").click(guardarProductoDetalle);

  $("#btn-guardar").click(guardarVenta);

  $("#producto").change(async function () {
    // guardo el id del producto del selector de productos, el VALUE
    const idProducto = $(this).val();

    // pongo en el input de precio el valor
    $("#precio").val(await obtenerPrecioProducto(idProducto));
  });

  $("#btn-modal-agregar-producto").click(mostrarModalAgregarProducto);
});

function mostrarModalAgregarProducto() {
  numFilaEditar = null;

  $("#titulo-modal-agregar-producto").html("Agregar producto");

  $("#modal-agregar-producto").modal("show");
}

function mostrarModalEditarProducto() {
  numFilaEditar = $(this).attr("data-id");

  // traigo los datos de la fila a editar en id, cantidad y precio
  const { id, cantidad, precioUnit } = venta.productos[numFilaEditar];

  $("#producto").val(id);
  $("#cantidad").val(cantidad);
  $("#precio").val(precioUnit);

  $("#titulo-modal-agregar-producto").html("Editar producto");

  $("#modal-agregar-producto").modal("show");
}

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

async function obtenerPrecioProducto(id) {
  const url = `${URL_BASE}/index.php?m=productos&a=obtenerPrecio&id=${id}`;

  const response = await fetch(url);
  const precio = await response.json();

  return precio;
}

function guardarProductoDetalle() {
  const producto = {
    id: $("#producto").val(),
    nombre: $("#producto option:selected").text(),
    cantidad: $("#cantidad").val(),
    precioUnit: $("#precio").val(),
  };

  producto.precioUnit = producto.precioUnit || 0;

  // si seleccione algun producto y si el precio no es negativo
  if (producto.id != -1 && producto.precioUnit >= 0 && producto.cantidad >= 1) {
    if (!numFilaEditar) {
      //agrego el producto si no hay nro de fila...vengo por agregar
      venta.productos.push(producto);
    } else {
      // edito el producto y pego el nuevo "producto"
      venta.productos[numFilaEditar] = producto;
      $("#modal-agregar-producto").modal("hide");
    }

    $("#form-producto-detalle")[0].reset();
    actualizarVista();
  } else {
    alert("Complete campos!!");
  }
}

async function guardarVenta() {
  venta.cliente = $("#cliente").val();
  venta.fecha = $("#fecha").val();
  venta.observaciones = $("#observaciones").val();

  const url = `${URL_BASE}/index.php?m=ventas&a=agregar`;

  // aqui paso la venta por el body con el metodo post
  // pongo el header y le digo que va como json para que sepa cuando recibe
  // credentials lo pongo porque sino no toma la cookie y se pierde....
  const response = await fetch(url, {
    method: "POST",
    body: JSON.stringify(venta),
    headers: { "Content-Type": "application/json" },
    credentials: "include",
  });

  const data = await response.json();

  if (data.status === "OK") {
    Swal.fire({
      text: data.message,
      icon: "success",
    }).then(() => {
      window.location = "index.php?m=ventas&a=listado";
    });
  } else {
    Swal.fire({
      text: data.message,
      icon: "error",
    });
  }
}

function eliminarProductoDetalle() {
  // click en eliminar
  const idFilaEliminar = parseInt($(this).attr("data-id"));

  Swal.fire({
    text: "¿Confirma la baja?",
    icon: "question",
    showCancelButton: true,
    confirmButtonText: "Aceptar",
    cancelButtonText: "Cancelar",
    confirmButtonColor: "red",
  }).then((result) => {
    if (result.isConfirmed) {
      // aqui quiero eliminar la fila idFilaEliminar
      // filter lo que hace es filtrar los que son distintos a esa fila, entonces
      // me elimina de venta.productos la fila que es igual a ifFilaEliminar
      venta.productos = venta.productos.filter(
        (item, i) => i !== idFilaEliminar
      );

      actualizarVista();
    }
  });
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

  $(".btn-editar-producto-detalle").click(mostrarModalEditarProducto);
  $(".btn-eliminar-producto-detalle").click(eliminarProductoDetalle);

  $("#total-factura").html(`$ ${total}`);
}
