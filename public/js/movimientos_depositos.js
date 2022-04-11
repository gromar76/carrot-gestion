let idMovimientoDeposito = null;

const COLUMNAS = {
  ID_MOVIMIENTO_DEPOSITO: 0,
  FECHA: 1,
  ORIGEN: 2,
  DESTINO: 3,
  DETALLE: 4,
  USUARIO: 5,
  POR_CONFIRMAR: 6,
  ACCIONES: 7,
};

const params = new URLSearchParams(window.location.search);

// armo la estructura del movimiento entre depositos
let movimientoDeposito = {
  fecha: dateFechaDeHoyParaInputDate(),
  origen: null,
  destino: null,
  detalle: [],
  usuario: null,
};

// con esto manejo la fila al hacer click en editar o eliminar
let numFilaEditar;

$(document).ready(async function () {
  // obtengo en params todos los parametros de la url pasados....
  // luego puedo preguntar por ellos....

  //compra.deposito = params.get("id") ? null : $("#deposito").val();

  const targets = [COLUMNAS.ID_MOVIMIENTO_DEPOSITO];

  // cuando se carga el documento....convierto la clase TABLA a datatable...
  $("#tabla").DataTable({
    columnDefs: [
      {
        targets,
        visible: false,
        searchable: false,
      },

      {
        // por cada fila tengo el row, entonces en la posicion 0 es el codigo
        // por eso se lo paso al data-id para que sepa que id de categoria es cuando hago click
        // guardo en data-id el id de la compra.... y lo puedo usar luego como en la funcion editar()
        render: (data, type, row) => {
          const btnEditar = `<button class="btn btn-success btn-sm btn-editar" data-id=${
            row[COLUMNAS.ID_MOVIMIENTO_DEPOSITO]
          } data-toggle="tooltip" data-placement="top" title="Editar">
                                <i class="fas fa-edit"></i>
                              </button>`;

          const btnVer = `<button class="btn btn-info btn-sm btn-ver" data-id=${
            row[COLUMNAS.ID_MOVIMIENTO_DEPOSITO]
          } data-toggle="tooltip" data-placement="top" title="Ver detalle">
                            <i class="fas fa-eye"></i>
                           </button>`;

          const btnEliminar = `<button class="btn btn-danger btn-sm btn-eliminar-movimiento-deposito" data-id=${
            row[COLUMNAS.ID_MOVIMIENTO_DEPOSITO]
          } data-toggle="tooltip" data-placement="top" title="Eliminar">
                                <i class="fas fa-trash"></i>
                              </button> `;

          console.log("FILA...", row);

          const btnConfirmaciones =
            row[COLUMNAS.POR_CONFIRMAR] > 0
              ? `<button class="btn btn-warning btn-sm btn-confirmar-producto-movimiento-deposito" data-id=${
                  row[COLUMNAS.ID_MOVIMIENTO_DEPOSITO]
                } data-toggle="tooltip" data-placement="top" title="Confirmaciones">
                                <i class="fas fa-check"></i>
                              </button> `
              : "";

          return `${btnEditar} 
                  ${btnVer}
                  ${btnEliminar}
                  ${btnConfirmaciones}
                  `;
        },

        targets: COLUMNAS.ACCIONES,
      },
    ],
    order: [[COLUMNAS.FECHA, "desc"]],
    language: {
      url: `${URL_BASE}/public/js/datatable/es_es.json`,
    },
  });

  /*
  // si hago click en btn-editar ir a funcion editar
  $("body").on("click", ".btn-editar", editar);

  // si hago click en btn-editar ir a funcion editar
  $("body").on("click", ".btn-ver", ver);
*/

  $("body").on(
    "click",
    ".btn-confirmar-producto-movimiento-deposito",
    mostrarModalConfirmaciones
  );

  $("body").on("click", "#btn-guardar-confirmaciones", guardarConfirmaciones);

  //cuando hago click en boton de cancelar
  $("#btn-atras").click(atras);

  $("#btn-agregar-detalle").click(guardarProductoDetalle);

  $("#btn-guardar").click(guardarMovimientoDeposito);

  $("#origen").change(function () {
    movimientoDeposito.origen = $(this).val();
  });

  $("#destino").change(function () {
    movimientoDeposito.destino = $(this).val();
  });

  $("#fecha").change(function () {
    movimientoDeposito.fecha = $(this).val();
  });

  $("#observaciones").change(function () {
    movimientoDeposito.observaciones = $(this).val();
  });

  $("#btn-modal-agregar-producto").click(mostrarModalAgregarProducto);

  /* 
  idCompra = params.get("id");

  if (idCompra) {
    await cargarDetalleCompra(idCompra);
  } else {
    if (idProveedor) {
      compra.proveedor = idProveedor;

      const response = await fetch(
        `${URL_BASE}/index.php?m=proveedor&a=dameNombreAjax&id=${idProveedor}`
      );

      const data = await response.json();

      $("#inputpicker-1").val(data.nombre_completo);
    } else {
      $("#inputpicker-1").val("");
    }
*/
  actualizarVista();
  /*}

  if (params.get("a") && params.get("a") === "ver") {
    $("#inputpicker-1").attr("disabled", "disabled");
  }
});
*/
});

async function mostrarModalConfirmaciones() {
  idMovimientoDeposito = parseInt($(this).attr("data-id"));

  const response = await fetch(
    `${URL_BASE}/index.php?m=movimientos_depositos&a=detalleMovimientoDepositoAjax&id=${idMovimientoDeposito}`
  );

  const data = await response.json();

  generarTableDeConfirmaciones(data);

  $("#modal-confirmaciones").modal("show");
}

function generarTableDeConfirmaciones(productos) {
  $("#body-confirmaciones").empty();

  productos.forEach(({ id_producto: id, producto, cantidad, confirmado }) => {
    $("#body-confirmaciones").append(`<tr>
                                        <td>${producto}</td>
                                        <td>${cantidad}</td>
                                        <td>${
                                          confirmado == 0
                                            ? `<input data-id="${id}" class="chk-confirmacion" type="checkbox"/>`
                                            : ""
                                        }</td>
                                      </tr>`);
  });
}

function actualizarVista() {
  $("#fecha").val(movimientoDeposito.fecha);
  $("#observaciones").val(movimientoDeposito.observaciones);
  $("#origen").val(movimientoDeposito.origen);
  $("#destino").val(movimientoDeposito.destino);

  const detalleProductosTbody = $("#detalle-movimiento-deposito");

  detalleProductosTbody.empty();

  let fila = 0;

  const params = new URLSearchParams(window.location.search);

  let colAcciones = "";

  for (let { nombre, cantidad } of movimientoDeposito.detalle) {
    if (params.get("a") && params.get("a") !== "ver") {
      colAcciones = `<td>           
                              <button class="btn btn-success btn-sm btn-editar-producto-detalle" data-id="${fila}" data-toggle="tooltip" data-placement="top" title="Editar">
                              <i class="fas fa-edit"></i>
                             </button>
                             <button class="btn btn-danger btn-sm btn-eliminar-producto-detalle" data-id="${fila++}" data-toggle="tooltip" data-placement="top" title="Eliminar">
                               <i class="fas fa-trash"></i>
                             </button>
                           </td>`;
    }

    detalleProductosTbody.append(
      `<tr>
            <td>${nombre}</td>
            <td>${cantidad}</td>
            ${colAcciones}
         </tr>
        `
    );
  }

  $(".btn-editar-producto-detalle").click(mostrarModalEditarProducto);
  $(".btn-eliminar-producto-detalle").click(eliminarProductoDetalle);

  /*$(".btn-eliminar-compra").click(eliminarCompra);*/
}

function mostrarModalAgregarProducto() {
  numFilaEditar = null;
  $("#producto").val(-1);
  $("#cantidad").val(1);

  $("#titulo-modal-agregar-producto").html("Agregar producto");

  $("#modal-agregar-producto").modal("show");
}

function guardarProductoDetalle() {
  const producto = {
    id: $("#producto").val(),
    nombre: $("#producto option:selected").text(),
    cantidad: $("#cantidad").val(),
  };

  // si seleccione algun producto y si el precio no es negativo
  if (producto.id != -1 && producto.cantidad >= 1) {
    if (!numFilaEditar) {
      //agrego el producto si no hay nro de fila...vengo por agregar
      movimientoDeposito.detalle.push(producto);
    } else {
      // edito el producto y pego el nuevo "producto"
      movimientoDeposito.detalle[numFilaEditar] = producto;
      $("#modal-agregar-producto").modal("hide");
    }

    $("#form-producto-detalle")[0].reset();
    $("#cantidad").val(1);
    actualizarVista();
  } else {
    alert("Complete campos!!");
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
      movimientoDeposito.detalle = movimientoDeposito.detalle.filter(
        (item, i) => i !== idFilaEliminar
      );

      actualizarVista();
    }
  });
}

function mostrarModalEditarProducto() {
  numFilaEditar = $(this).attr("data-id");

  // traigo los datos de la fila a editar en id, cantidad
  const { id, cantidad } = movimientoDeposito.detalle[numFilaEditar];

  $("#producto").val(id);
  $("#cantidad").val(cantidad);

  $("#titulo-modal-agregar-producto").html("Editar producto");

  $("#modal-agregar-producto").modal("show");
}

async function guardarMovimientoDeposito() {
  console.log(movimientoDeposito);

  let accion = "agregar";
  let metodo = "POST";

  if (idMovimientoDeposito) {
    accion = `editarAjax&id=${idMovimientoDeposito}`;
    metodo = "PUT";
  }

  const url = `${URL_BASE}/index.php?m=movimientos_depositos&a=${accion}`;

  movimientoDeposito.observaciones = $("#observaciones").val();

  // aqui paso la venta por el body con el metodo post
  // pongo el header y le digo que va como json para que sepa cuando recibe
  // credentials lo pongo porque sino no toma la cookie y se pierde....
  const response = await fetch(url, {
    method: metodo,
    body: JSON.stringify(movimientoDeposito),
    headers: { "Content-Type": "application/json" },
    credentials: "include",
  });

  const data = await response.json();

  if (data.status === "OK") {
    Swal.fire({
      text: data.message,
      icon: "success",
    }).then(() => {
      window.location = "index.php?m=movimientos_depositos&a=listado";
    });
  } else {
    Swal.fire({
      text: data.message,
      icon: "error",
    });
  }
}

async function guardarConfirmaciones() {
  console.log("Guardar...");

  // me traigo solo los confirmados con el checked
  const productosConfirmados = $(".chk-confirmacion:checked");

  const idsProductosConfirmados = [];

  productosConfirmados.each(function () {
    idsProductosConfirmados.push($(this).attr("data-id"));
  });

  console.log(idMovimientoDeposito, idsProductosConfirmados);

  const url = `${URL_BASE}/index.php?m=movimientos_depositos&a=confirmarAjax&id=${idMovimientoDeposito}`;

  const response = await fetch(url, {
    method: "PUT",
    body: JSON.stringify(idsProductosConfirmados),
    headers: { "Content-Type": "application/json" },
    credentials: "include",
  });

  const data = await response.json();

  /*  if (data.status === "OK") {
    Swal.fire({
      text: data.message,
      icon: "success",
    }).then(() => {
      window.location = "index.php?m=movimientos_depositos&a=listado";
    });
  } else {
    Swal.fire({
      text: data.message,
      icon: "error",
    });
  } */
}
