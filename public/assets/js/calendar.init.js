/*========Calender Js=========*/
/*==========================*/
async function getEvents() {
    const endpoint = 'calendar';
    try {
        const response = await fetch(endpoint);
        return await response.json();
    } catch (e) {
        console.error(e);
    }
}


document.addEventListener("DOMContentLoaded", async function () {
    /*=================*/
    //  Calender Date letiable
    /*=================*/
    let newDate = new Date();

    function getDynamicMonth() {
        getMonthValue = newDate.getMonth();
        _getUpdatedMonthValue = getMonthValue + 1;
        if (_getUpdatedMonthValue < 10) {
            return `0${_getUpdatedMonthValue}`;
        } else {
            return `${_getUpdatedMonthValue}`;
        }
    }

    /*=================*/
    // Calender Modal Elements
    /*=================*/
    let getModalTitleEl = document.querySelector("#event-title");
    let getModalStartDateEl = document.querySelector("#event-start-date");
    let calendarsEvents = {
        Danger: "danger",
        Success: "success",
        Primary: "primary",
        Warning: "warning",
    };
    /*=====================*/
    // Calendar Elements and options
    /*=====================*/
    let calendarEl = document.querySelector("#calendar");
    let checkWidowWidth = function () {
        if (window.innerWidth <= 1199) {
            return true;
        } else {
            return false;
        }
    };

    let calendarHeaderToolbar = {
        left: "prev next",
        center: "title",
        right: ""
    };

    let calendarEventsList = [];

    let data = await getEvents();


    data.forEach(event => {
        let calendarEvent = {
            id: event.id,
            title: event.home_team.name + " vs " + event.away_team.name,
            start: event.match_date,
            extendedProps: {calendar: "Success"},
        };
        calendarEventsList.push(calendarEvent);
    });


    /*=====================*/
    // Calendar Select fn.
    /*=====================*/
    let calendarSelect = function (info) {
        getModalAddBtnEl.style.display = "block";
        getModalUpdateBtnEl.style.display = "none";
        myModal.show();
        getModalStartDateEl.value = info.startStr;
    };

    /*=====================*/
    // Calender Event Function
    /*=====================*/
    let calendarEventClick = function (info) {
        let eventObj = info.event;

        if (eventObj.url) {
            window.open(eventObj.url);

            info.jsEvent.preventDefault();
        } else {
            let getModalEventId = eventObj._def.publicId;
            let getModalEventLevel = eventObj._def.extendedProps["calendar"];
            let getModalCheckedRadioBtnEl = document.querySelector(
                `input[value="${getModalEventLevel}"]`
            );

            getModalTitleEl.value = eventObj.title;
            getModalStartDateEl.value = eventObj.startStr.slice(0, 10);
            myModal.show();
        }
    };

    /*=====================*/
    // Active Calender
    /*=====================*/
    let calendar = new FullCalendar.Calendar(calendarEl, {
        selectable: true,
        height: checkWidowWidth() ? 900 : 1052,
        initialView: checkWidowWidth() ? "listWeek" : "dayGridMonth",
        initialDate: `${newDate.getFullYear()}-${getDynamicMonth()}-07`,
        headerToolbar: calendarHeaderToolbar,
        events: calendarEventsList || [],
        select: calendarSelect,
        unselect: function () {
            console.log("unselected");
        },
        eventClassNames: function ({event: calendarEvent}) {
            const getColorValue =
                calendarsEvents[calendarEvent._def.extendedProps.calendar];
            return ["event-fc-color fc-bg-" + getColorValue];
        },
        eventClick: calendarEventClick,
        locale: "es"
    });

    /*=====================*/
    // Calendar Init
    /*=====================*/
    calendar.render();
    let myModal = new bootstrap.Modal(document.getElementById("eventModal"));
    let modalToggle = document.querySelector(".fc-addEventButton-button ");
    document
        .getElementById("eventModal")
        .addEventListener("hidden.bs.modal", function (event) {
            getModalTitleEl.value = "";
            getModalStartDateEl.value = "";
        });
});
