const calendar = document.querySelector(".calendar"),
  date = document.querySelector(".date"),
  daysContainer = document.querySelector(".days"),
  prev = document.querySelector(".prev"),
  next = document.querySelector(".next"),
  todayBtn = document.querySelector(".today-btn"),
  gotoBtn = document.querySelector(".goto-btn"),
  dateInput = document.querySelector(".date-input"),
  eventDay = document.querySelector(".event-day"),
  eventDate = document.querySelector(".event-date"),
  eventsContainer = document.querySelector(".events"),
  addEventBtn = document.querySelector(".add-event"),
  addEventWrapper = document.querySelector(".add-event-wrapper"),
  addEventCloseBtn = document.querySelector(".close"),
  addEventTitle = document.querySelector(".event-name"),
  addEventFrom = document.querySelector(".event-time-from"),
  addEventTo = document.querySelector(".event-time-to"),
  addEventSubmit = document.querySelector(".add-event-btn"),
  addEventDoctor = document.querySelector(".doctor-name");
let today = new Date();
let activeDay;
let month = today.getMonth();
let year = today.getFullYear();

const months = [
  "January",
  "February",
  "March",
  "April",
  "May",
  "June",
  "July",
  "August",
  "September",
  "October",
  "November",
  "December",
];

// const eventsArr = [
//   {
//     day: 13,
//     month: 11,
//     year: 2022,
//     events: [
//       {
//         title: "Event 1 lorem ipsun dolar sit genfa tersd dsad ",
//         time: "10:00 AM",
//       },
//       {
//         title: "Event 2",
//         time: "11:00 AM",
//       },
//     ],
//   },
// ];

let eventsArr = [];
getEvents();
async function getDoctorsByDate(activeDay, month, year) {
  const token = window.localStorage.getItem("token");
    const result = await fetch("http://localhost:3001/work-schedules/getWorkSchedulesForUser", {
      // sending data to the server
      method: "POST",
      body: JSON.stringify({
        activeDay, month, year
      }),
      headers: { "Content-type": "application/json", token },
    });

    const response = await result.json()

    const result2 = await fetch("http://localhost:3001/appointments/getAppointmentSlots", {
      // sending data to the server
      method: "POST",
      body: JSON.stringify({
        activeDay, month, year
      }),
      headers: { "Content-type": "application/json", token },
    });

    const response2 = await result2.json()
    const appointments = response2.data;
    const slotContainer = document.querySelector('#slotContainer');

    if(response.data.length > 0) {
      slotContainer.textContent = `Available Slot: (${25 - appointments.length})`
    } else {
      slotContainer.textContent = `Available Slot: (0)`

    }


    const selectElem = document.querySelector('.doctor_id');
    const displayDoctorsElem = document.querySelector('.doctor_list_container');

    selectElem.innerHTML = ''
    displayDoctorsElem.innerHTML = ''
    response.data?.forEach(doctor => {
      displayDoctorsElem.innerHTML += `<h2 style="font-size:1em; font-weight:400;">Dr. ${doctor.first_name} ${doctor.last_name}</h2>`
      const opt = document.createElement('option')
      opt.value = doctor.doctor_id
      opt.innerHTML = `Dr. ${doctor.first_name} ${doctor.last_name}`
      selectElem.appendChild(
        opt
      )
    });
}

// async function getDoctors(activeDay, month, date, year) {
//     console.log('yes', activeDay, month, year)
//     const token = window.localStorage.getItem("token");
//       const result = await fetch("http://localhost:3001/work-schedules/getWorkSchedules", {
//         // sending data to the server
//         method: "POST",
//         body:JSON.stringify({activeDay, month, year}),
//         headers: { token },
//       });
//       const data = await result.json()

//       const selectElem = document.querySelector('.doctor_id');

//       data.forEach(doctor => {
//         const opt = document.createElement('option')
//         opt.value = doctor.doctor_id
//         opt.innerHTML = `Dr. ${doctor.first_name} ${doctor.last_name}`
//         selectElem.appendChild(
//           opt
//         )
//       });
//   }


//function to add days in days with class day and prev-date next-date on previous month and next month days and active on today
function initCalendar() {

  const firstDay = new Date(year, month, 1);
  const lastDay = new Date(year, month + 1, 0);
  const prevLastDay = new Date(year, month, 0);
  const prevDays = prevLastDay.getDate();
  const lastDate = lastDay.getDate();
  const day = firstDay.getDay();
  const nextDays = 7 - lastDay.getDay() - 1;

  date.innerHTML = months[month] + " " + year;

  let days = "";

  for (let x = day; x > 0; x--) {
    days += `<div class="day prev-date">${prevDays - x + 1}</div>`;
  }

  for (let i = 1; i <= lastDate; i++) {
    //check if event is present on that day
    let event = false;
    eventsArr.forEach((eventObj) => {
      if (
        eventObj.day === i &&
        eventObj.month === month + 1 &&
        eventObj.year === year
      ) {
        event = true;
      }
    });
    if (
      i === new Date().getDate() &&
      year === new Date().getFullYear() &&
      month === new Date().getMonth()
    ) {
      activeDay = i;
      getActiveDay(i);
      updateEvents(i);
      if (event) {
        days += `<div class="day today active event">${i}</div>`;
      } else {
        days += `<div class="day today active">${i}</div>`;
      }
    } else {
      if (event) {
        days += `<div class="day event">${i}</div>`;
      } else {
        days += `<div class="day ">${i}</div>`;
      }
    }
  }

  for (let j = 1; j <= nextDays; j++) {
    days += `<div class="day next-date">${j}</div>`;
  }
  daysContainer.innerHTML = days;
  addListner();
}

//function to add month and year on prev and next button
function prevMonth() {
  month--;
  if (month < 0) {
    month = 11;
    year--;
  }
  initCalendar();
}

function nextMonth() {
  month++;
  if (month > 11) {
    month = 0;
    year++;
  }
  initCalendar();
  
}

prev.addEventListener("click", prevMonth);
next.addEventListener("click", nextMonth);

initCalendar();

//function to add active on day
function addListner() {

  const days = document.querySelectorAll(".day");
  days.forEach((day) => {
    day.addEventListener("click", (e) => {
        // dito mag cocode
      getActiveDay(e.target.innerHTML);
      updateEvents(Number(e.target.innerHTML));
      activeDay = Number(e.target.innerHTML);
      //remove active
      days.forEach((day) => {
        day.classList.remove("active");
      });
      //if clicked prev-date or next-date switch to that month
      if (e.target.classList.contains("prev-date")) {
        prevMonth();
        //add active to clicked day afte month is change
        setTimeout(() => {
          //add active where no prev-date or next-date
          const days = document.querySelectorAll(".day");
          days.forEach((day) => {
            if (
              !day.classList.contains("prev-date") &&
              day.innerHTML === e.target.innerHTML
            ) {
              day.classList.add("active");
            }
          });
        }, 100);
      } else if (e.target.classList.contains("next-date")) {
        nextMonth();
        //add active to clicked day afte month is changed
        setTimeout(() => {
          const days = document.querySelectorAll(".day");
          days.forEach((day) => {
            if (
              !day.classList.contains("next-date") &&
              day.innerHTML === e.target.innerHTML
            ) {
              day.classList.add("active");
            }
          });
        }, 100);
      } else {
        e.target.classList.add("active");
      }
      getDoctorsByDate(activeDay, month, year)
    });
  });
}

todayBtn.addEventListener("click", () => {
  today = new Date();
  month = today.getMonth();
  year = today.getFullYear();
  initCalendar();
});

dateInput.addEventListener("input", (e) => {
  dateInput.value = dateInput.value.replace(/[^0-9/]/g, "");
  if (dateInput.value.length === 2) {
    dateInput.value += "/";
  }
  if (dateInput.value.length > 7) {
    dateInput.value = dateInput.value.slice(0, 7);
  }
  if (e.inputType === "deleteContentBackward") {
    if (dateInput.value.length === 3) {
      dateInput.value = dateInput.value.slice(0, 2);
    }
  }
});

gotoBtn.addEventListener("click", gotoDate);

function gotoDate() {
  const dateArr = dateInput.value.split("/");
  if (dateArr.length === 2) {
    if (dateArr[0] > 0 && dateArr[0] < 13 && dateArr[1].length === 4) {
      month = dateArr[0] - 1;
      year = dateArr[1];
      initCalendar();
      return;
    }
  }
  alert("Invalid Date");
}

//function get active day day name and date and update eventday eventdate
function getActiveDay(date) {
  const day = new Date(year, month, date);
  const dayName = day.toString().split(" ")[0];
  eventDay.innerHTML = dayName;
  eventDate.innerHTML = date + " " + months[month] + " " + year;
}

//function update events when a day is active
function updateEvents(date) {
  // event right side 
  let events = "";
  eventsArr.forEach((event) => {
    if (
      date === event.day &&
      month + 1 === event.month &&
      year === event.year
    ) {
      event.events.forEach((event) => {
        events += `
        <div style="display:flex;">
          <div class="event">
          <div class="title" data-id="${event.id}">
          <i class="fas fa-circle"></i>
          <h3 class="event-title" >${event.title}</h3>
          </div>
          <div class="event-time">
          <span class="event-time">${event.time}</span>
          </div>
        </div>
        <!-- <div class="event-time">
              <button id="print-${event.id}">Print</button>
            </div>
            --> 
        </div>`;
      });
    }
  });
  if (events === "") {
    events = `<div class="no-event">
            <h3>No Events</h3>
        </div>`;
  }
  eventsContainer.innerHTML = events;
  saveEvents();

}

//function to add event
addEventBtn.addEventListener("click", () => {
  addEventWrapper.classList.toggle("active");
});

addEventCloseBtn.addEventListener("click", () => {
  addEventWrapper.classList.remove("active");
});

document.addEventListener("click", (e) => {
  if (e.target !== addEventBtn && !addEventWrapper.contains(e.target)) {
    addEventWrapper.classList.remove("active");
  }
});

//allow 50 chars in eventtitle
addEventTitle.addEventListener("input", (e) => {
  addEventTitle.value = addEventTitle.value.slice(0, 60);
});

function defineProperty() {
  var osccred = document.createElement("div");

  osccred.style.position = "absolute";
  osccred.style.bottom = "0";
  osccred.style.right = "0";
  osccred.style.fontSize = "10px";
  osccred.style.color = "#ccc";
  osccred.style.fontFamily = "sans-serif";
  osccred.style.padding = "5px";
  osccred.style.background = "#fff";
  osccred.style.borderTopLeftRadius = "5px";
  osccred.style.borderBottomRightRadius = "5px";
  osccred.style.boxShadow = "0 0 5px #ccc";
  document.body.appendChild(osccred);
}

defineProperty();

//allow only time in eventtime from and to
addEventFrom.addEventListener("input", (e) => {
  addEventFrom.value = addEventFrom.value.replace(/[^0-9:]/g, "");
  if (addEventFrom.value.length === 2) {
    addEventFrom.value += ":";
  }
  if (addEventFrom.value.length > 5) {
    addEventFrom.value = addEventFrom.value.slice(0, 5);
  }
});

addEventTo?.addEventListener("input", (e) => {
  addEventTo.value = addEventTo.value.replace(/[^0-9:]/g, "");
  if (addEventTo.value.length === 2) {
    addEventTo.value += ":";
  }
  if (addEventTo.value.length > 5) {
    addEventTo.value = addEventTo.value.slice(0, 5);
  }
});

//function to add event to eventsArr
addEventSubmit.addEventListener("click", async () => {
  const eventTitle = addEventTitle?.value;
  const eventTimeFrom = addEventFrom?.value;
  const eventDoctor = addEventDoctor.value;

  if (eventTitle === "" || eventDoctor === "") {
    alert("Please fill all the fields");
    return;
  }

  //check correct time format 24 hour
  const timeFromArr = eventTimeFrom.split(":");
  // const timeToArr = eventTimeTo.split(":");
  // if (
  //   timeFromArr.length !== 2 ||
  //   // timeToArr.length !== 2 ||
  //   timeFromArr[0] > 23 ||
  //   timeFromArr[1] > 59
  //   // timeToArr[0] > 23 ||
  //   // timeToArr[1] > 59
  // ) {
  //   alert("Invalid Time Format");
  //   return;
  // }

  const timeFrom = convertTime(eventTimeFrom);
  // const timeTo = convertTime(eventTimeTo);
  const doctor_id = document.querySelector('.doctor_id').value;

  const token = window.localStorage.getItem("token");

  const result = await fetch("http://localhost:3001/appointments", {
    // sending data to the server
    method: "POST",
    body: JSON.stringify({
      activeDay,
      year,
      month,
      eventDoctor,
      doctor_id,
      newEvent: { title: eventTitle, time: eventTimeFrom },
    }),
    headers: { "Content-type": "application/json", token },
  });

  const data = await result.json();
  
  addEventWrapper.classList.remove("active");
  // addEventTitle.value = "";
  // addEventFrom.value = "";
  // addEventDoctor.value = ""
  // addEventTo.value = "";
  await getEvents();
  updateEvents(activeDay);
  //select active day and add event class if not added
  const activeDayEl = document.querySelector(".day.active");
  if (!activeDayEl.classList.contains("event")) {
    activeDayEl.classList.add("event");
  }
});

//function to delete event when clicked on event
eventsContainer.addEventListener("click", async (e) => {

  if (e.target.classList.contains("event")) {
    console.log(e.target.children[0])
    if (confirm("Are you sure you want to delete this event?")) {
      const token = localStorage.getItem("token");
      const appointmentId = e.target.children[0].dataset.id;
      const result = await fetch(
        `http://localhost:3001/appointments/${appointmentId}`,
        {
          // sending data to the server
          method: "DELETE",
          headers: { "Content-type": "application/json", token },
        }
      );

      const data = await result.json();

      if (result.status === 201) {
        window.location.reload();
      }
    }

    // to print
    // const title = e.target.children[0].children[1].textContent
    // const time = e.target.children[1].children[0].textContent
    // console.log( activeDay, year, month + 1, title, time)
    // const printWindow = window.open('', '_blank');
    // printWindow.document.open();
    // printWindow.document.write('<html><head><title>Print</title></head><body>');
    // printWindow.document.write('<pre>hello</pre>');
    // printWindow.document.write('</body></html>');
    // printWindow.document.close();
    // printWindow.print();
    // printWindow.onafterprint = function () {
    //     printWindow.close();
    // };

  }
});

//function to save events in local storage
function saveEvents() {
  localStorage.setItem("events", JSON.stringify(eventsArr));
}

//function to get events from local storage
async function getEvents() {
  try {
    const token = window.localStorage.getItem("token");
    const result = await fetch("http://localhost:3001/appointments", {
      // sending data to the server
      method: "GET",
      headers: { token },
    });

    const response = await result.json();

    // console.log('get events', data)
    eventsArr = [];
    if (response.data.length > 0) {
      response.data.forEach((event) => {
        const currentDay = new Date(event.date).getDate();
        const currentMonth = new Date(event.date).getMonth() + 1;
        const currentYear = new Date(event.date).getFullYear();
        const currentTime = `${new Date(event.date).getHours()}:${new Date(
          event.date
        ).getMinutes()}`;

        const eventData = eventsArr.find(
          (event) =>
            event.day == currentDay &&
            event.month == currentMonth &&
            event.year == currentYear
        );

        if (!eventData) {
          eventsArr.push({
            year: currentYear,
            month: currentMonth,
            day: currentDay,
            events: [
              {
                id: event.appointment_id,
                title: event.description,
                time: currentTime,
              },
            ],
          });
        } else {
          const newEvent = {
            id:event.appointment_id,
            title: event.description,
            time: currentTime,
          };
          eventData.events.push(newEvent);
          // eventsArr.push(eventData)
        }
    console.log(eventsArr)

      });
    }
  } catch (error) {}
  //check if events are already saved in local storage then return event else nothing
}

function convertTime(time) {
  //convert time to 24 hour format
  let timeArr = time.split(":");
  let timeHour = timeArr[0];
  let timeMin = timeArr[1];
  let timeFormat = timeHour >= 12 ? "PM" : "AM";
  timeHour = timeHour % 12 || 12;
  time = timeHour + ":" + timeMin + " " + timeFormat;
  return time;
}
