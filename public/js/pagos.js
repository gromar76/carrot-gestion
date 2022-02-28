const COLUMNAS = {
  ID_PAGO: 0,
  FECHA: 1,
  IMPORTE: 2,
  OBSERVACIONES: 3,
  ACCIONES: 4,
};

//formateo la fecha para mostrar en el input date  ---> REFACTOR
function dateFechaDeHoyParaInputDate() {
  const hoy = new Date();

  const dia = hoy.getDate() > 9 ? hoy.getDate() : "0" + hoy.getDate();
  const anio = hoy.getFullYear();
  const mes =
    hoy.getMonth() + 1 > 9 ? hoy.getMonth() + 1 : "0" + (hoy.getMonth() + 1);

  const fechaHoyParaInputDate = `${anio}-${mes}-${dia}`;

  return fechaHoyParaInputDate;
}

venta = {
  id: null,
  cliente: null,
  total: 0,
  pagado: 0,
  fecha: dateFechaDeHoyParaInputDate(),
  usuario_id: userId,
};

/*
// con esto manejo la fila al hacer click en editar o eliminar
let numFilaEditar;
 */

$(document).ready(async function () {
  const params = new URLSearchParams(window.location.search);

  const targets = [COLUMNAS.ID_PAGO];

  idVenta = params.get("id");

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
        // guardo en data-id el id del pago.... y lo puedo usar luego como en la funcion editar()
        render: (data, type, row) => {
          const btnVer = `<button class="btn btn-info btn-sm btn-ver" data-id=${
            row[COLUMNAS.ID_PAGO]
          } data-toggle="tooltip" data-placement="top" title="Ver detalle">
                                <i class="fas fa-eye"></i>
                              </button>`;

          const btnEditar = `<button class="btn btn-success btn-sm btn-editar" data-id=${
            row[COLUMNAS.ID_PAGO]
          } data-toggle="tooltip" data-placement="top" title="Editar">
                                <i class="fas fa-edit"></i>
                              </button>`;

          const btnEliminar = `<button class="btn btn-danger btn-sm btn-eliminar" data-id=${
            row[COLUMNAS.ID_PAGO]
          } data-toggle="tooltip" data-placement="top" title="Eliminar">
                                <i class="fas fa-trash"></i>
                              </button> `;

          return `${btnVer}
                  ${idUsuarioVenta === userId ? btnEditar : ""}    
                  ${idUsuarioVenta === userId ? btnEliminar : ""}  
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

  // si hago click en btn-ver ir a funcion ver
  $("body").on("click", ".btn-ver", ver);

  // si hago click en btn-editar ir a funcion editar
  $("body").on("click", ".btn-editar", editar);

  // si hago click en btn-eliminar ir a funcion eliminar
  $("body").on("click", ".btn-eliminar", eliminar);

  //cuando hago click en boton de cancelar
  $("#btn-atras").click(atras);
});

function editar() {
  const id = $(this).attr("data-id");

  window.location = `${URL_BASE}/index.php?m=pagos&a=editar&id=${id}&idVenta=${idVenta}`;
}

function eliminar() {
  const idEliminar = $(this).attr("data-id");

  Swal.fire({
    text: "¿Confirma la baja?",
    icon: "question",
    showCancelButton: true,
    confirmButtonText: "Aceptar",
    cancelButtonText: "Cancelar",
    confirmButtonColor: "red",
  }).then((result) => {
    if (result.isConfirmed) {
      window.location = `${URL_BASE}/index.php?m=pagos&a=eliminar&id=${idEliminar}&idVenta=${idVenta}`;
    }
  });
}

function ver() {
  const idPago = $(this).attr("data-id");
  window.location = `${URL_BASE}/index.php?m=pagos&a=ver&id=${idPago}&idVenta=${idVenta}`;
}

function atras() {
  history.back();
}
