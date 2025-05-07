document.addEventListener("DOMContentLoaded", function () {
    const tipoSelect = document.getElementById("tipo");
    const selectorPadre = document.getElementById("selector-evento-padre");
    const ayudaSemanal = document.getElementById("ayuda-semanal");
    const fechaInput = document.getElementById("fecha");
    const eventoPadre = document.getElementById("evento_padre");
    const infoFechasSemana = document.getElementById("info-fechas-semana");
    const horaContainer = document.getElementById('hora-container');
    const horaInput = document.getElementById('hora');
    
  
    let flatpickrInstance = flatpickr(fechaInput, {
      dateFormat: "Y-m-d"
    });
  
    tipoSelect.addEventListener("change", function () {
      const tipo = this.value;
  
      if (tipo === "diario") {
        selectorPadre.style.display = "block";
        ayudaSemanal.style.display = "none";
        infoFechasSemana.style.display = "none";
  
        if (!eventoPadre.value) {
          flatpickrInstance.destroy();
          flatpickrInstance = flatpickr(fechaInput, {
            dateFormat: "Y-m-d"
          });
        }
  
      } else if (tipo === "semanal") {
        selectorPadre.style.display = "none";
        eventoPadre.value = "";
        ayudaSemanal.style.display = "block";
        infoFechasSemana.style.display = "none";
  
        flatpickrInstance.destroy();
        flatpickrInstance = flatpickr(fechaInput, {
          dateFormat: "Y-m-d",
          enable: [date => date.getDay() === 1]
        });
      }
    });
  
    eventoPadre.addEventListener("change", function () {
      const idPadre = this.value;
      if (!idPadre) return;
  
      fetch(`../../php/dias_ocupados.php?evento_padre=${idPadre}`)
        .then(res => res.json())
        .then(data => {
          if (data.error) {
            alert("Error: " + data.error);
            return;
          }
  
          const ocupados = data.ocupados;
          const inicio = data.inicio;
          const fin = data.fin;
  
          infoFechasSemana.innerHTML = `Fechas disponibles: <strong>${inicio}</strong> al <strong>${fin}</strong>`;
          infoFechasSemana.style.display = "block";
  
          flatpickrInstance.destroy();
          flatpickrInstance = flatpickr(fechaInput, {
            dateFormat: "Y-m-d",
            minDate: inicio,
            maxDate: fin,
            disable: ocupados
          });
        });
    });

    tipoSelect.addEventListener("change", function () {
        const tipo = this.value;
      
        if (tipo === "semanal") {
          horaContainer.style.display = "none";
          horaInput.removeAttribute("required");
          horaInput.value = ""; // asegúrate de que no se envíe valor
        } else {
          horaContainer.style.display = "block";
          horaInput.setAttribute("required", "required");
        }
      });
    
  
    // Activar comportamiento al cargar la página
    tipoSelect.dispatchEvent(new Event("change"));

  });