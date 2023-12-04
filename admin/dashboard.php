<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pie Chart Example</title>
    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body style="display:flex; flex-direction:column; height:100vh; width:100vw; justify-content:center; align-items:center;">
    <h1>Patients per barangay</h1>
    <div style="width: 30%;">
        <!-- Create a canvas element to render the pie chart -->
        <canvas id="myPieChart"></canvas>
    </div>

    <script>

        (async () => {
            const result = await fetch(`http://localhost:3001/patients/getDataForDashboard`, {
                method: "GET",
            });

            const dataJson = await result.json()

            const barangay = dataJson.data;
            console.log(barangay)

            var data = {
                labels: barangay.map((barangay) => `Brgy. ${barangay.name}`),
                datasets: [{
                    data: barangay.map((barangay) => barangay.count),
                    backgroundColor: ["#FF6384", "#36A2EB", "#FFCE56", "#4CAF50", "#9966FF"],
                }]
            };

            // Get the canvas element
            var ctx = document.getElementById('myPieChart').getContext('2d');

            // Create a new pie chart using Chart.js
            var myPieChart = new Chart(ctx, {
                type: 'pie',
                data: data,
            });

        })()
        
        // Sample data for the pie chart

        
    </script>
</body>

</html>