$(document).ready(function () {
  // cuando se carga el documento....convierto la clase TABLA a datatable...
  $("#tabla").DataTable({
    columnDefs: [
      {
        targets: [0],
        visible: false,
        searchable: false,
      },
      {
        // por cada fila tengo el row, entonces en la posicion 0 es el codigo
        // por eso se lo paso al data-id para que sepa que id de categoria es cuando hago click
        render: (data, type, row) => {
          return `<button class="btn btn-info btn-sm btn-ver" data-id=${row[0]} data-toggle="tooltip" data-placement="top" title="Ver detalle">
                    <i class="fas fa-eye"></i>
                  </button>                
                  <button class="btn btn-success btn-sm btn-editar" data-id=${row[0]} data-toggle="tooltip" data-placement="top" title="Editar">
                    <i class="fas fa-edit"></i>
                  </button>
                  <button class="btn btn-secondary btn-sm btn-ir-venta" data-id=${row[0]} data-toggle="tooltip" data-placement="top" title="Realizar Venta">
                  <i class="fas fa-list"></i>
                </button> 
                `;

          {
            /* <button class="btn btn-danger btn-sm btn-eliminar" data-id=${row[0]} data-toggle="tooltip" data-placement="top" title="Eliminar">
                      <i class="fas fa-trash"></i>
                    </button>     */
          }
        },

        targets: 6,
      },
    ],
    order: [[1, "asc"]],
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

  $("body").on("click", ".btn-ir-venta", generarVenta);

  //cuando hago click en boton de cancelar
  $("#btn-atras").click(atras);

  $("#btn-mostrar-agregar-localidad").click(mostrarAgregarLocalidad);

  $("#btn-guardar-localidad").click(guardarLocalidad);

  //cuando carga la pagina (el documento esta ready) entonces.....

  //Me fijo si hay un pais para seleccionar
  const idPaisSeleccionado = $("#pais").attr("data-id-original");

  cargarPaises(idPaisSeleccionado);

  //cuando cambie algo en el select de pais llamar a cargarProvincias
  $("#pais").change(cargarProvincias);

  // cuando cambie algo en el select de provincias llamar a cargarLocalidades
  $("#provincia").change(cargarLocalidades);
});

$("#cliente-de-usuario").change(cargarClientes);
$("#actividad").change(cargarClientes);

async function guardarLocalidad() {
  const localidad = $("#nuevaLocalidad").val();

  if (localidad.length >= 2) {
    const idProvincia = $("#provincia").val();

    const url = `${URL_BASE}/index.php?m=localidades&a=agregarAjax&nombreLocalidad=${localidad}&idProvincia=${idProvincia}`;

    const response = await fetch(url);
    const idNuevaLocalidad = "" + (await response.json());

    cargarLocalidades(idNuevaLocalidad);

    $("#modal-agregar-localidad").modal("hide");

    $("#nuevaLocalidad").val("");
  } else {
    Swal.fire({
      icon: "error",
      text: "El nombre de la localidad es obligatorio",
    });
  }
}

function mostrarAgregarLocalidad(event) {
  //que hacia el preventDefault?
  event.preventDefault();

  $("#modal-agregar-localidad").modal("show");
}

function generarVenta() {
  // guardo el id de cliente
  const idCliente = $(this).attr("data-id");
  window.location = `${URL_BASE}/index.php?m=ventas&a=agregar&idCliente=${idCliente}`;
}

function cargarClientes() {
  const id = $("#cliente-de-usuario").val();
  const actividad = $("#actividad").val();

  window.location = `${URL_BASE}/index.php?m=clientes&u=${id}&actividad=${actividad}`;
}

function cargarPaises(idPaisSeleccionado) {
  const url = `${URL_BASE}/index.php?m=paises&a=listadoAjax`;

  $.get(url, function (paises) {
    mostrarPaisesEnSelect(paises, idPaisSeleccionado);
  });
}

function cargarProvincias(idProvinciaSeleccionada) {
  //primero lo que voy a hacer es borrar provincias y localidades

  $("#provincia").empty();
  $("#localidad").empty();

  const idPais = $("#pais").val();

  const url = `${URL_BASE}/index.php?m=provincias&a=listadoAjax&id=${idPais}`;

  $.get(url, function (provincias) {
    mostrarProvinciasEnSelect(provincias, idProvinciaSeleccionada);
  });
}

function cargarLocalidades(idLocalidadSeleccionada) {
  // saco del select de provincia el valor....es el id de la provincia
  const idProvincia = $("#provincia").val();
  // tengo el id de la provincia

  const url = `${URL_BASE}/index.php?m=localidades&a=listadoAjax&id=${idProvincia}`;

  $.get(url, function (localidades) {
    mostrarLocalidadesEnSelect(localidades, idLocalidadSeleccionada);
  });
}

function mostrarLocalidadesEnSelect(localidades, idLocalidadSeleccionada) {
  $("#localidad").empty();

  $("#localidad").append(
    `<option value="-1">Seleccionar localidad....</option>`
  );

  for (let localidad of localidades) {
    $("#localidad").append(
      `<option value="${localidad.id}" ${
        idLocalidadSeleccionada === localidad.id ? "selected" : ""
      }>${localidad.nombre}</option>`
    );
  }

  const params = new URLSearchParams(window.location.search);
  modoEditor = params.get("a");

  console.log({ modoEditor });

  if ($("#provincia").val() != "-1" && modoEditor !== "ver") {
    $("#btn-mostrar-agregar-localidad").removeAttr("disabled");
  } else {
    $("#btn-mostrar-agregar-localidad").attr("disabled", "disabled");
  }
}

function mostrarProvinciasEnSelect(provincias, idProvinciaSeleccionada) {
  $("#provincia").empty();

  $("#provincia").append(
    `<option value="-1">Seleccionar provincia....</option>`
  );

  for (let provincia of provincias) {
    $("#provincia").append(
      `<option value="${provincia.id}" ${
        idProvinciaSeleccionada === provincia.id ? "selected" : "23232"
      }>${provincia.nombre}</option>`
    );
  }

  //Me fijo si hay una localidad para seleccionar
  const idLocalidadSeleccionada = $("#localidad").attr("data-id-original");

  cargarLocalidades(idLocalidadSeleccionada);
}

function mostrarPaisesEnSelect(paises, idPaisSeleccionado) {
  $("#pais").empty();

  for (let pais of paises) {
    $("#pais").append(
      `<option value="${pais.id}"  ${
        idPaisSeleccionado === pais.id ? "selected" : ""
      } >${pais.nombre}</option>`
    );
  }

  //Me fijo si hay una provincia para seleccionar
  const idProvinciaSeleccionada = $("#provincia").attr("data-id-original");

  cargarProvincias(idProvinciaSeleccionada);
}

function atras() {
  history.back();
}

// click en boton ver
function ver() {
  const id = $(this).attr("data-id");
  window.location = `${URL_BASE}/index.php?m=clientes&a=ver&id=${id}`;
}

// hice click en editar
function editar() {
  //console.log("editar", $(this).attr("data-id"));
  // guardo en id el valor del atributo data-id del boton que pulse, eso es el id de la categoria
  const id = $(this).attr("data-id");
  window.location = `${URL_BASE}/index.php?m=clientes&a=editar&id=${id}`;
  //console.log("editando", $(this).attr("data-id"));
}

// click en eliminar
function eliminar() {
  const id = $(this).attr("data-id");

  Swal.fire({
    text: "??Confirma la eliminaci??n del cliente?",
    icon: "question",
    showCancelButton: true,
    confirmButtonText: "Aceptar",
    cancelButtonText: "Cancelar",
    confirmButtonColor: "red",
  }).then((result) => {
    if (result.isConfirmed) {
      window.location = `${URL_BASE}/index.php?m=clientes&a=eliminar&id=${id}`;
    }
  });
}
