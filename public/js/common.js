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

function atras() {
  history.back();
}

function dameOpcionesDelSelect(
  registros,
  idSeleccionado = null,
  campoId = "id",
  campoLeyenda = "nombre"
) {
  // variables $campoId y $campoLeyenda son opcionales y por default les pongo yo id y nombre

  let opcionesSelect = '<option value="-1">Seleccione...</option>';

  for (let registro of registros) {
    selected =
      idSeleccionado == registro[campoId] || registros.length === 1
        ? "selected"
        : "";

    opcionesSelect += `<option value="${registro[campoId]}" ${selected}>${registro[campoLeyenda]}</option>`;
  }

  return opcionesSelect;
}
