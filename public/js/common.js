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
