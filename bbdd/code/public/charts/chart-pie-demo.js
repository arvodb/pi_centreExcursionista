// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

axios.get("http://localhost:8000/reservaSala").then(function (response) {
  let array = new Array(2);
  let arraySalas = new Array();
  let comprobar = new Array();
  let fechaHoy = new Date;
  let fechaEntera = "";
  let numSalas = 0;

  if (fechaHoy.getDate() < 10) {
    fechaEntera = "0" + fechaHoy.getDate() + "/";
  } else {
    fechaEntera = fechaHoy.getDate() + "/";
  }

  if ((fechaHoy.getMonth() + 1) < 10) {
    fechaEntera = fechaEntera + "0" + (fechaHoy.getMonth() + 1) + "/";
  } else {
    fechaEntera = fechaEntera + (fechaHoy.getMonth() + 1) + "/";
  }
  fechaEntera = fechaEntera + fechaHoy.getFullYear();

  for (let i = 0; i < response.data[0].length; i++) {
    if (response.data[0][i].FECHA_RESERVA === fechaEntera) {
      array.push({ "numeroSala": response.data[0][i].NUMERO_SALA });
    }
  }

  array = array.filter(function (dato) {
    return dato != undefined
  });

  axios.get("http://localhost:8000/salas").then(function (response) {

    for (let j = 0; j < response.data[0].length; j++) {
      arraySalas.push({ "numeroSala": response.data[0][j].NUMERO_SALA });
      numSalas = (numSalas + 1);
    }


    const findElement = (array, salaBuscada) => {
      if(array.find(element => element.numeroSala === salaBuscada)){
        return true;
      } else{
        return false
      }
    }
    const findElement2 = (array, salaBuscada) => {
      return array.find(element => element.numeroSala === salaBuscada) ?? -1;
    }

    for (let h = 0; h < array.length; h++) {
      if (comprobar.length === 0) {
        comprobar.push({ "numeroSala": array[h].numeroSala, "cont": 1 });
      } else {
        if (findElement(comprobar, array[h].numeroSala) == true) {
          findElement2(comprobar, array[h].numeroSala).cont = 2;
          //comprobar[l].cont = 2;
        } else {
          comprobar.push({ "numeroSala": array[h].numeroSala, "cont": 1 });
        }
      }
    }
    
    let salasOcupadas = 0;
    for (let n = 0; n < comprobar.length; n++) {
      if(comprobar[n].cont === 2){
        salasOcupadas = (salasOcupadas + 1);
      }
    }

     // Pie Chart Example
  var ctx = document.getElementById("myPieChart");
  var myPieChart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: ["Libres", "Reservadas"],
      datasets: [{
        data: [(numSalas-salasOcupadas), salasOcupadas],
        backgroundColor: ['#007bff', '#dc3545'],
      }],
    },
  });
});
  });