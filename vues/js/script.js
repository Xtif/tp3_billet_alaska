
/******************Google Chart********************************/
google.charts.load("current", {packages:["corechart"]});
  google.charts.setOnLoadCallback(drawChart);
  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Task', 'Hours per Day'],
      ['Commentaires',     67],
      ['Commentaires abusifs',      6]
    ]);
    var options = {
      title: "Suivi des commentaires",
      pieHole: 0.4,
      slices: {  
        1: {offset: 0.1},        
      },
      colors: [
        '#28a745',
        '#dc3545'
      ],
    };
    var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
    chart.draw(data, options);
}
