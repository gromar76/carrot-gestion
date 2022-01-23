$(document).ready(function () {
  $("#tabla").DataTable({
    columnDefs: [
      {
        // por cada fila tengo el row, entonces en la posicion 0 es el codigo
        // por eso se lo paso al data-id para que sepa que id de categoria es cuando hago click
        render: (data, type, row) => {
          console.log(row);
          return `<button class="btn-editar" data-id=${row[0]}>Editar</button>
                    <button class="btn-eliminar" data-id=${row[0]}>Eliminar</button>
                  `;
        },
        targets: 2,
      },
    ],
  });

  // si hago click en btn-editar ir a funcion editar
  $(".btn-editar").click(editar);
  // si hago click en btn-eliminar ir a funcion eliminar
  $(".btn-eliminar").click(eliminar);
});

function editar() {
  //console.log("editar", $(this).attr("data-id"));
  // guardo en id el valor del atributo data-id del boton que pulse, eso es el id de la categoria
  const id = $(this).attr("data-id");
  //window.location = `http://localhost/index.php?m=provincias&a=editar&id=${id}`;
  console.log("editando", $(this).attr("data-id"));
}

function eliminar() {
  console.log("eliminar", $(this).attr("data-id"));
}
