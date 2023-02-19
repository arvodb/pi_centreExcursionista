// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

let array = new Array(2);

axios.get("http://localhost:8000/totalReservados").then(function (response) {

  for (let i = 0; i < response.data[0].length; i++) {
    array.push({"nombre": response.data[0][i].NOMBRE, "total": response.data[0][i].TOTAL});
  }

  array = array.filter(function (dato) {
    return dato != undefined
  });

  array.sort(function (a, b) {
    if (b.total > a.total) {
      return 1;
    }
    if (b.total < a.total) {
      return -1;
    }
    // a must be equal to b
    return 0;
  });
  
  // Bar Chart Example
var ctx = document.getElementById("myBarChart");
var myLineChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: [array[0].nombre, array[1].nombre, array[2].nombre, array[3].nombre, array[4].nombre, array[5].nombre],
    datasets: [{
      backgroundColor: "rgba(2,117,216,1)",
      borderColor: "rgba(2,117,216,1)",
      data: [array[0].total, array[1].total, array[2].total, array[3].total, array[4].total, array[5].total],
    }],
  },
  options: {
    scales: {
      xAxes: [{
        gridLines: {
          display: false
        },
        ticks: {
          maxTicksLimit: 6
        }
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: 500,
          maxTicksLimit: 5
        },
        gridLines: {
          display: true
        }
      }],
    },
    legend: {
      display: false
    }
  }
});
});


