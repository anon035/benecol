// Get current year for Footer
const getCurrentYear = document.getElementById("getCurrentYear");
getCurrentYear.innerHTML = new Date().getFullYear();

// Attendance Coach clickable rows
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function() {
        this.classList.toggle("active-col");
        var content = this.nextElementSibling;
        if (content.style.maxHeight) {
            content.style.maxHeight = null;
        } else {
            content.style.maxHeight = content.scrollHeight + 50 + "px";
        }
    });
}

//handle attendance buttons for participate, did not to participate
noParticipate = e => {
    if (e.disabled === false && e.nextElementSibling.disabled === true) {
        e.childNodes[0].style.color = "orangered";
        e.disabled = true;
        e.nextElementSibling.disabled = false;
        e.nextElementSibling.childNodes[0].style.color = "lightgray";
    } else if (e.disabled === false) {
        e.disabled = true;
        e.nextElementSibling.childNodes[0].style.color = "lightgray";
    }
};

Participate = e => {
    if (e.disabled === false && e.previousElementSibling.disabled === true) {
        e.childNodes[0].style.color = "limegreen";
        e.disabled = true;
        e.previousElementSibling.disabled = false;
        e.previousElementSibling.childNodes[0].style.color = "lightgray";
    } else if (e.disabled === false) {
        e.disabled = true;
        e.previousElementSibling.childNodes[0].style.color = "lightgray";
    }
};

// Handle select all checkbox for notifications
const selectAllCheckbox = document.querySelectorAll(".notification-select-all");
selectAllCheckbox.forEach(checkbox => {
    checkbox.addEventListener("change", e => {
        const parentDiv = checkbox.parentElement.parentElement.parentElement;
        const notificationCheckbox = parentDiv.querySelectorAll(
            ".notification-checkbox"
        );
        if (e.target.checked === true) {
            notificationCheckbox.forEach(notifCheckbox => {
                notifCheckbox.checked = true;
            });
        } else if (e.target.checked === false) {
            notificationCheckbox.forEach(notifCheckbox => {
                notifCheckbox.checked = false;
            });
        }
    });
});


