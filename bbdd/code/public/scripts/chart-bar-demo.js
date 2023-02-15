// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

var requestOptions = {
  method: 'GET',
  redirect: 'follow'
};

let array = [];
fetch("http://localhost:8000/reservaMaterial", requestOptions)
  .then(response => response.text())
  .then(result => array = result)
  .catch(error => console.log('error', error));

  for (let i = 0; i < array.length; i++) {
    console.log(array[i]);
  }

// Bar Chart Example
var ctx = document.getElementById("myBarChart");
var myLineChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ["Cuerda", "Pico", "Caso", "Mosqueton", "Arnes", "Asegurador"],
    datasets: [{
      backgroundColor: "rgba(2,117,216,1)",
      borderColor: "rgba(2,117,216,1)",
      data: [123, 23, 34, 234, 45, 67],
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
          max: 300,
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
