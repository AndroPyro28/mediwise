<?php
include '../connectMySQL.php';
include '../loginverification.php';
if (logged_in()) {
    $session_user_id = $_SESSION['user_id'];
    if($_SESSION['role'] === 'Admin')  {
        header("location:../admin/index.php");
      }
      if($_SESSION['role'] === 'Doctor') {
        header("location:../doctor/index.php");
      }
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">

    <title>Appointment Details</title>
    <style>
        /* Your existing styles remain the same */

        /* Additional styles for print-friendly section */
        @media print {
            body * {
                visibility: hidden;
            }
            .print-section, .print-section * {
                visibility: visible;
            }
            .print-section {
                position: absolute;
                left: 0;
                top: 0;
            }
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .appointment-container {
            background-color: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            border-radius: 10px;
            width: 400px;
            text-align: center;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        .appointment-details {
            text-align: left;
            margin-top: 20px;
        }

        .detail-label {
            font-weight: bold;
            color: #555;
        }

        p {
            margin: 5px 0;
        }

        .status {
            font-weight: bold;
            color: #4CAF50;
        }

        .back-button {
            margin-top: 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: #45a049;
        }
        .back-button,
        .print-button {
            margin-top: 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

    </style>
</head>
<body>

<?php
// Assuming you have a database connection

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT a.date, a.description, a.request_status as status, concat(d.first_name,' ', d.last_name) as doctor FROM appointment a INNER JOIN doctor d WHERE appointment_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($date, $doctor, $description, $status);

    if ($stmt->fetch()) {
        $formattedDateTime = date('F j, Y \a\t h:i A', strtotime($date));
?>

<div class="appointment-container">
    <h2>Appointment Details</h2>
  
    <div class="appointment-details">
        <p class="detail-label">Appointment Date:</p>
        <p><?php echo $formattedDateTime; ?></p>

        <p class="detail-label">Doctor:</p>
        <p>Dr. <?php echo $status;?></p>

        <p class="detail-label">Description:</p>
        <p><?php echo  $doctor;?></p>

        <p class="detail-label">Status:</p>
        <p class="font-semibold"><?php echo  $description; ?></p>
    </div>

    <button class="back-button" onclick="goBack()">Go Back</button>
    <!-- <button class="print-button" onclick="printAppointment()">Print</button> -->
</div>

<script>
    function goBack() {
        window.history.back();
    }

    function printAppointment() {
        window.print();
    }
</script>

<?php
    } else {
        echo '<p>Error: Appointment not found.</p>';
    }

    $stmt->close();
} else {
    echo '<p>Error: Missing appointment ID.</p>';
}

$conn->close();
?>

</body>
</html>