const getAppointments = async () => {
  console.log('hello')
  const token = localStorage.getItem("token");
  const result = await fetch("http://localhost:3001/appointments", {
    // sending data to the server
    method: "GET",
    headers: { "Content-type": "application/json", token },
  });

  const notificationList = document.querySelector("#notification-list");
  const response = await result.json();
  const notificationCircle = document.querySelector('notificationCircle')
  console.log(response.data)
  response.data.forEach((appointment) => {
    if (appointment?.request_status !== "PENDING") {
      const { date:dateCreatedAt, time:timeCreatedAt } = dateAndTimeParser(appointment.createdAt);
      const { date:dateUpdatedAt, time:timeUpdatedAt} = dateAndTimeParser(appointment.updatedAt);

      notificationList.innerHTML += `<div class="notification-item" style="flex flex-direction:column; gap:10px">
      <a href="appointment-details.php?id=${appointment.appointment_id}">
      <div class="notification-title">Appointment has been ${appointment.request_status.toLowerCase()}</div>
      <div class="notification-content" style="display:flex; flex-direction:column; gap:5px">
      <div>
      <strong> Description:</strong> ${appointment.description}
      </div>
      <div>
      <strong> Date submitted:</strong> ${dateCreatedAt} ${timeCreatedAt}
      </div>
      <div>
      <strong> Date updated:</strong> ${dateUpdatedAt} ${timeUpdatedAt}
      </div>
      </div>
      </div>
      </a>`
    }
  });
  console.log(data);
};

getAppointments();

function toggleNotificationList() {
  var notificationList = document.getElementById("notification-list");
  notificationList.style.display =
    notificationList.style.display === "none" ||
    notificationList.style.display === ""
      ? "block"
      : "none";
}

const dateAndTimeParser = (dateTimeLocal) => {
  const date = new Date(dateTimeLocal)?.toISOString().slice(0, 10);

  const time = new Date(dateTimeLocal)?.toLocaleString("en-US", {
    timeZone: "Asia/Manila",
    hour: "numeric",
    minute: "numeric",
    hour12: true,
  });

  return {
    date,
    time,
  };
};
