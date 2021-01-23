let $medico, $date, $especialidad, $hours;
let iRadio;

const noHoursAlert = `<div class="alert alert-danger" role="alert">
    <strong>Lo sentimos!</strong> No se encontraron horas disponibles para el médico en el día seleccionado.
</div>`;

$(function () {
  $especialidad = $('#especialidad');
  $medico = $('#medico');
  $date = $('#date');
  $hours = $('#hours');

  $especialidad.change(() => {
    const idEspecialidad = $especialidad.val();
    const url = `/api/especialidad/medico/${idEspecialidad}`;
    $.getJSON(url, onMedicoLoad);
  });

 $medico.change(loadHours);
  $date.change(loadHours);
});    

function onMedicoLoad(medicos) {
  let htmlOptions = '';
  medicos.forEach(medico => {
    htmlOptions += `<option value="${medico.id}">${medico.name}</option>`;
  });
  $medico.html(htmlOptions);
  loadHours(); // side-effect
}

function loadHours() {
	const selectedDate = $date.val();
	const medicoId = $medico.val();
	const url = `/api/diastrabajo/hours?date=${selectedDate}&idMedico=${medicoId}`;
    $.getJSON(url, displayHours);
}

function displayHours(data) {
	if (!data.turno1 && !data.turno2 || 
		data.turno1.length===0 && data.turno2.length===0) {

		$hours.html(noHoursAlert);
		return;
	}

	let htmlHours = '';
	iRadio = 0;

	if (data.turno1) {
		const intervaloTurno1 = data.turno1;
		intervaloTurno1.forEach(interval => {
			htmlHours += getRadioIntervalHtml(interval);
		});
	}
	if (data.turno2) {
		const intervaloTurno2 = data.turno2;
		intervaloTurno2.forEach(interval => {
			htmlHours += getRadioIntervalHtml(interval);
		});
	}
	$hours.html(htmlHours);
}

function getRadioIntervalHtml(intervalo) {
	const text = `${intervalo.inicio} - ${intervalo.fin}`;

	return `<div class="custom-control custom-radio mb-3">
  <input name="horaConsulta" value="${intervalo.inicio}" class="custom-control-input" id="interval${iRadio}" type="radio" required>
  <label class="custom-control-label" for="interval${iRadio++}">${text}</label>
</div>`;
}