$(document).ready(function () {
  // cuando se carga el documento....convierto la clase TABLA a datatable...
  $("#tabla").DataTable({
    columnDefs: [
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
                  <button class="btn btn-danger btn-sm btn-eliminar" data-id=${row[0]} data-toggle="tooltip" data-placement="top" title="Eliminar">
                    <i class="fas fa-trash"></i>
                  </button>                 
                `;
        },

        targets: 5,
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

  //cuando hago click en boton de cancelar
  $("#btn-atras").click(atras);

  //cuando carga la pagina (el documento esta ready) entonces.....

  //Me fijo si hay un pais para seleccionar
  const idPaisSeleccionado = $("#pais").attr("data-id-original");

  cargarPaises(idPaisSeleccionado);

  //cuando cambie algo en el select de pais llamar a cargarProvincias
  $("#pais").change(cargarProvincias);

  // cuando cambie algo en el select de provincias llamar a cargarLocalidades
  $("#provincia").change(cargarLocalidades);
});

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
    console.log(localidad);

    $("#localidad").append(
      `<option value="${localidad.id}" ${
        idLocalidadSeleccionada === localidad.id ? "selected" : ""
      }>${localidad.nombre}</option>`
    );
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
    text: "¿Confirma la eliminación del cliente?",
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
