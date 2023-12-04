<?php
include '../connectMySQL.php';
include '../loginverification.php';
if(logged_in()){
    $session_user_id = $_SESSION['user_id'];
    $session_username = $_SESSION['username'];
    $session_first_name = $_SESSION['first_name'];
    $session_middle_name = $_SESSION['middle_name'];
    $session_last_name = $_SESSION['last_name'];
    $role = $_SESSION['role'];

    if($role !== 'Doctor') {
      header('location:../index.php');
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="../user/123.css">


    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        h2 {
            color: #333;
        }
        #historyTable {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>

<body>
    <main>


<h2>History Page</h2>

<!-- History Table -->
<table id="historyTable">
    <thead>
        <tr>
            <th>Date</th>
            <th>Patients name</th>
            <th>Description</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <!-- Data will be populated dynamically using JavaScript -->
    </tbody>
    
</table>

<?php
    echo "<input type='hidden' id='user_id' value='$session_user_id' />"
?>

<div class="no_data" style="text-align: center;"></div>
</main>
<script>
// Use JavaScript to fetch and populate data here
// Get the table body
const main = async () => {
    const user_id = document.querySelector('#user_id').value
    
    const result = await fetch(`http://localhost:3001/appointments/get-history-doctor/${user_id}`, {
      method: "GET",
    });
    const data = await result.json();

    const {data: history} = data

    const tableBody = document.querySelector('#historyTable tbody');

// Populate the table with data
if(history.length > 0) {
    history.forEach(entry => {
    const row = document.createElement('tr');
    // const {first_name,last_name, middle_name} = entry?.patient
    row.innerHTML = `
        <td>${entry.date}</td>
        <td>${entry?.patient ? `${entry?.patient?.first_name} ${ entry?.patient?.middle_name} ${entry?.patient?.last_name}` : '-'}</td>
        <td>${entry.description}</td>
        <td>${entry.request_status}</td>
    `;
    tableBody.appendChild(row);

  })
} else {
    const divMessageContainer = document.querySelector('.no_data');
    divMessageContainer.innerHTML += `<h2>No past appointment found!</h2>`
}

}
window.addEventListener('load', main)

</script>

</body>
</html>