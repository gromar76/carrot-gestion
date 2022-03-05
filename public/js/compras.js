let idVenta = null;

const COLUMNAS = {
  ID_COMPRA: 0,
  PROVEEDOR: 1,
  FECHA: 2,
  IMPORTE_TOTAL: 3,
  IMPORTE_PAGADO: 4,
  PENDIENTE: 5,
  ACCIONES: 6,
};

//formateo la fecha para mostrar en el input date
function dateFechaDeHoyParaInputDate() {
  const hoy = new Date();

  const dia = hoy.getDate() > 9 ? hoy.getDate() : "0" + hoy.getDate();
  const anio = hoy.getFullYear();
  const mes =
    hoy.getMonth() + 1 > 9 ? hoy.getMonth() + 1 : "0" + (hoy.getMonth() + 1);

  const fechaHoyParaInputDate = `${anio}-${mes}-${dia}`;
  return fechaHoyParaInputDate;
}

// armo la estructura de la venta
let compra = {
  proveedor: null,
  fecha: dateFechaDeHoyParaInputDate(),
  observaciones: "",
  productos: [],
};

// con esto manejo la fila al hacer click en editar o eliminar
let numFilaEditar;

$(document).ready(async function () {
  // obtengo en params todos los parametros de la url pasados....
  // luego puedo preguntar por ellos....
  const params = new URLSearchParams(window.location.search);
  const targets = [COLUMNAS.ID_COMPRA];

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
            row[COLUMNAS.ID_COMPRA]
          } data-toggle="tooltip" data-placement="top" title="Editar">
                                <i class="fas fa-edit"></i>
                              </button>`;

          const btnVer = `<button class="btn btn-info btn-sm btn-ver" data-id=${
            row[COLUMNAS.ID_COMPRA]
          } data-toggle="tooltip" data-placement="top" title="Ver detalle">
                            <i class="fas fa-eye"></i>
                           </button>`;

          const btnEliminar = `<button class="btn btn-danger btn-sm btn-eliminar-compra" data-id=${
            row[COLUMNAS.ID_COMPRA]
          } data-toggle="tooltip" data-placement="top" title="Eliminar">
                                <i class="fas fa-trash"></i>
                              </button> `;

          const btnPagos = `<button class="btn btn-secondary btn-sm btn-pagos-compra" data-id=${
            row[COLUMNAS.ID_COMPRA]
          } data-toggle="tooltip" data-placement="top" title="Pagos">
                                                    <i class="fas fa-dollar-sign"></i>
                                                  </button> `;

          return `${btnEditar} 
                  ${btnVer}
                  ${btnPagos}
                  ${btnEliminar}
                  `;
        },

        targets: COLUMNAS.ACCIONES,
      },
      {
        render: (data, type, row) => {
          console.log(row);

          const style =
            // transformo a entero
            parseInt(row[COLUMNAS.PENDIENTE]) === 0
              ? "color: black"
              : "color: red";

          return `<span style="${style}">$ ${row[COLUMNAS.PENDIENTE]}</span>`;
        },
        targets: COLUMNAS.PENDIENTE,
      },
    ],
    order: [[COLUMNAS.FECHA, "desc"]],
    language: {
      url: `${URL_BASE}/public/js/datatable/es_es.json`,
    },
  });

  // si hago click en btn-editar ir a funcion editar
  $("body").on("click", ".btn-editar", editar);

  // si hago click en btn-editar ir a funcion editar
  $("body").on("click", ".btn-ver", ver);

  //cuando hago click en boton de cancelar
  $("#btn-atras").click(atras);

  $("#btn-agregar-detalle").click(guardarProductoDetalle);

  $("#btn-guardar").click(mostrarModalPrimerPago);

  $(".btn-pagos-compra").click(editarPagos);

  $("#proveedor").change(function () {
    console.log($(this).val());
    compra.proveedor = $(this).val();
  });

  $("#fecha").change(function () {
    compra.fecha = $(this).val();
  });

  $("#observaciones").change(function () {
    compra.observaciones = $(this).val();
  });

  $("#producto").change(async function () {
    // guardo el id del producto del selector de productos, el VALUE
    const idProducto = $(this).val();

    // pongo en el input de precio el valor
    $("#precio").val(await obtenerPrecioProducto(idProducto));
  });

  $("#btn-modal-agregar-producto").click(mostrarModalAgregarProducto);
  const proveedoresParaSelect = await obteneProveedoresParaSelect();

  $("#proveedor").inputpicker({
    data: proveedoresParaSelect,
    fields: [
      { name: "id", text: "Codigo" },
      { name: "nombre_empresa", text: "Empresa" },
      { name: "nombre_contacto", text: "Contacto" },
      { name: "whatsapp_contacto", text: "WhatsApp" },
    ],
    headShow: true,
    fieldValue: "id",
    fieldText: "nombre_empresa",
    filterOpen: true,
    autoOpen: true,
    highlightResult: true,
    pagination: true,

    /*listBackgroundColor: "orange",
    listBorderColor: "red",
    rowSelectedBackgroundColor: "green",
    rowSelectedFontColor: "white",*/
  });

  idCompra = params.get("id");
  idProveedor = params.get("idProveedor");

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

    actualizarVista();
  }

  if (params.get("a") && params.get("a") === "ver") {
    $("#inputpicker-1").attr("disabled", "disabled");
  }
});

async function cargarDetalleCompra(id) {
  const { compra: compraBd, productos } = await obtenerDetalleCompra(id);

  $("#inputpicker-1").val(compraBd.nombre_empresa); //FIX para que aparezca seleccionado el nombre

  compra = {
    proveedor: compraBd.id_proveedor,
    fecha: compraBd.fecha,
    observaciones: compraBd.observaciones,
    productos,
  };

  actualizarVista();
}

async function obtenerDetalleCompra(id) {
  const url = `${URL_BASE}/index.php?m=compras&a=detalleCompraAjax&id=${id}`;

  const response = await fetch(url);
  const detalleCompra = await response.json();

  return detalleCompra;
}

async function obteneProveedoresParaSelect() {
  const url = `${URL_BASE}/index.php?m=proveedores&a=listadoAjax`;

  const response = await fetch(url);
  const proveedores = await response.json();

  //alert(proveedores[0].id);

  return proveedores;
}

function editarPagos() {
  // traigo en id el codigo de la venta
  const id = $(this).attr("data-id");

  window.location = `${URL_BASE}/index.php?m=pagos_compras&a=listado&id=${id}`;
}

function mostrarModalAgregarProducto() {
  numFilaEditar = null;
  $("#producto").val(-1);
  $("#cantidad").val(1);
  $("#precio").val("");

  $("#titulo-modal-agregar-producto").html("Agregar producto");

  $("#modal-agregar-producto").modal("show");
}

function mostrarModalEditarProducto() {
  numFilaEditar = $(this).attr("data-id");

  // traigo los datos de la fila a editar en id, cantidad y precio
  const { id, cantidad, precioUnit } = compra.productos[numFilaEditar];

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
  window.location = `${URL_BASE}/index.php?m=compras&a=editar&id=${id}`;
  //console.log("editando", $(this).attr("data-id"));
}

// hice click en ver
function ver() {
  // guardo en id el valor del atributo data-id del boton que pulse, eso es el id de la venta
  const id = $(this).attr("data-id");
  window.location = `${URL_BASE}/index.php?m=compras&a=ver&id=${id}`;
  //console.log("editando", $(this).attr("data-id"));
}

const idCompraSeleccionada = $("#compra").attr("data-id-original");

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
      compra.productos.push(producto);
    } else {
      // edito el producto y pego el nuevo "producto"
      compra.productos[numFilaEditar] = producto;
      $("#modal-agregar-producto").modal("hide");
    }

    $("#form-producto-detalle")[0].reset();
    $("#cantidad").val(1);
    actualizarVista();
  } else {
    alert("Complete campos!!");
  }
}

async function mostrarModalPrimerPago() {
  // si estoy editando no hacer esto
  // si no hay id es porque no estoy editando la compra
  const params = new URLSearchParams(window.location.search);

  if (params.get("id")) {
    guardarCompra();
  } else {
    const showModalPrimerPago = new Promise((resolve, reject) => {
      const total = compra.productos.reduce(
        (acumulado, { cantidad, precioUnit }) =>
          acumulado + cantidad * precioUnit,
        0
      );

      $("#importe-primer-pago").val(total);

      $("#modal-primer-pago").modal("show");

      $("#btn-aceptar-primer-pago").click(() => {
        resolve();
      });

      $("#btn-cancelar-primer-pago").click(() => {
        reject();
      });
    });

    showModalPrimerPago
      .then(() => {
        compra.primerPago = $("#importe-primer-pago").val();
        compra.observacionesPrimerPago = $("#observaciones-primer-pago").val();
      })
      .catch(() => {
        compra.primerPago = 0;
        compra.observacionesPrimerPago = "";
      })
      .finally(() => {
        $("#modal-primer-pago").modal("hide");
        guardarCompra();
      });
  }
}

async function guardarCompra() {
  console.log(compra);

  let accion = "agregar";
  let metodo = "POST";

  if (idCompra) {
    accion = `editarAjax&id=${idCompra}`;
    metodo = "PUT";
  }
  compra.proveedor = $("#proveedor").val();

  compra.fecha = $("#fecha").val();
  compra.observaciones = $("#observaciones").val();

  const url = `${URL_BASE}/index.php?m=compras&a=${accion}`;

  // aqui paso la venta por el body con el metodo post
  // pongo el header y le digo que va como json para que sepa cuando recibe
  // credentials lo pongo porque sino no toma la cookie y se pierde....
  const response = await fetch(url, {
    method: metodo,
    body: JSON.stringify(compra),
    headers: { "Content-Type": "application/json" },
    credentials: "include",
  });

  const data = await response.json();

  if (data.status === "OK") {
    Swal.fire({
      text: data.message,
      icon: "success",
    }).then(() => {
      window.location = "index.php?m=compras&a=listado";
    });
  } else {
    Swal.fire({
      text: data.message,
      icon: "error",
    });
  }
}

function eliminarCompra() {
  // click en eliminar
  const idCompraEliminar = parseInt($(this).attr("data-id"));

  Swal.fire({
    text: "¿Confirma la baja?",
    icon: "question",
    showCancelButton: true,
    confirmButtonText: "Aceptar",
    cancelButtonText: "Cancelar",
    confirmButtonColor: "red",
  }).then(async (result) => {
    if (result.isConfirmed) {
      // aqui quiero eliminar la fila idFilaEliminar
      // filter lo que hace es filtrar los que son distintos a esa fila, entonces
      // me elimina de venta.productos la fila que es igual a ifFilaEliminar

      const url = `${URL_BASE}/index.php?m=compras&a=eliminar&id=${idCompraEliminar}`;

      const response = await fetch(url);
      const data = await response.json();

      if (data.status === "OK") {
        window.location =
          "index.php?m=compras&a=listado&mensaje=La compra se ha eliminado correctamente&tipoMensaje=danger";
      } else {
        Swal.fire({
          text: data.message,
          icon: "error",
        });
      }
    }
  });
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
      compra.productos = compra.productos.filter(
        (item, i) => i !== idFilaEliminar
      );

      actualizarVista();
    }
  });
}

function actualizarVista() {
  console.log(compra.proveedor);

  console.log($("#proveedor").val());

  $("#proveedor").val(compra.proveedor);
  $("#fecha").val(compra.fecha);
  $("#observaciones").val(compra.observaciones);

  const detalleProductosTbody = $("#detalle-compra");

  detalleProductosTbody.empty();

  let total = 0;
  let fila = 0;

  const params = new URLSearchParams(window.location.search);

  let colAcciones = "";

  for (let { nombre, cantidad, precioUnit } of compra.productos) {
    total += cantidad * precioUnit;

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
          <td>$ ${precioUnit}</td>
          <td>$ ${cantidad * precioUnit}</td>
          ${colAcciones}
       </tr>
      `
    );
  }

  $(".btn-editar-producto-detalle").click(mostrarModalEditarProducto);
  $(".btn-eliminar-producto-detalle").click(eliminarProductoDetalle);

  $(".btn-eliminar-compra").click(eliminarCompra);

  $("#total-compra").html(`$ ${total}`);
}
