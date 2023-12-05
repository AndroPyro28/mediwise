
<?php
include '../connectMySQL.php';
include '../loginverification.php';
if (!logged_in()) {
    header('location:../index.php');
} else {
    $session_user_id = $_SESSION['user_id'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FullCalendar with PHP</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <link rel="stylesheet" href="./schedule.css">
</head>
<body>
    <?php
        echo "<input type='hidden' id='user_id' value='$session_user_id' />"
    ?>
<input type="hidden">
<div id="calendar"></div>

<script>
    $(document).ready(async function  () {
        const user_id = document.querySelector('#user_id').value;
        const result = await fetch(`http://localhost:3001/work-schedules/getWorkSchedules`, { // sending data to the server
        method: 'GET',
        headers: {
            'Content-type': 'application/json; charset=UTF-8',
            doctor_id: user_id
        }
    })
    let data = []
    const response = await result.json()
    if(!response.success) {

    }
    else {
        data = response.data.map((work) => {
          return {
            id: work?.work_schedule_id,
            title: work?.title,
            start: new Date(work?.start),
            end: new Date(work?.end),
            allDay: work?.allDay,
          };
        })
    }

        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            events: data, // PHP script to fetch events
            eventDrop: function (event, delta, revertFunc) {
                // Handle the event drop
                const {start, end, allDay, id} = event
                const eventData = {
                        id,
                        title: 'Working Schedule',
                        start: start?.format(),
                        end: end?.format(),
                        allDay:allDay
                    };
                    console.log(eventData)


                // handleEventDrop(event);
            },
            selectable: true,
            selectHelper: true,
            editable:true,
            select: function (start, end, _, eventInfo, ) {
                // Handle the selection of a date range
                const isConfirm = confirm('create a schedule?')
                
                if (isConfirm) {
                    const eventData = {
                        title: 'Working Schedule',
                        start: start.format(),
                        end: end.format(),
                        allDay: eventInfo.name === 'month'
                    };

                    // Add the new event to the calendar
                    $('#calendar').fullCalendar('renderEvent', eventData);

                    // Save the new event to the database (you need to implement this part)
                    saveEventToDatabase(eventData);
                }

                // Clear the date selection
                $('#calendar').fullCalendar('unselect');
            }
        });
    });

    async function saveEventToDatabase(eventData) {
        const user_id = document.querySelector('#user_id').value;
        const result = await fetch('http://localhost:3001/work-schedules', { // sending data to the server
        method: 'POST',
        body: JSON.stringify({
            work: eventData,
        }),
        headers: {
            'Content-type': 'application/json; charset=UTF-8',
            doctor_id: user_id
        }
    })

        // Implement your logic to save the event to the database using AJAX or other methods
        // Example: Use jQuery.ajax to send the eventData to a PHP script for database insertion
        // $.ajax({
        //     url: 'save_event.php',
        //     type: 'POST',
        //     data: eventData,
        //     success: function (response) {
        //         console.log('Event saved successfully');
        //     },
        //     error: function (error) {
        //         console.error('Error saving event:', error);
        //     }
        // });

        console.log(eventData)
    }
</script>

</body>
</html>