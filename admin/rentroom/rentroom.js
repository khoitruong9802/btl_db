var detailpanel = document.getElementById("rentroomdetailpanel");

adduseropen = () => {
    detailpanel.style.display = "flex";
}
adduserclose = () => {
    detailpanel.style.display = "none";
}

rentDetailOpen = () => {
    detailpanel.style.display = "flex";
}

rentDetailClose = () => {
    detailpanel.style.display = "none";
}

//search bar logic using js
const searchFun = () => {
    let filter = document.getElementById('search_bar').value.toUpperCase();

    let myTable = document.getElementById("table-data");

    let tr = myTable.getElementsByTagName('tr');

    for (var i = 0; i < tr.length; i++) {
        let td = tr[i].getElementsByTagName('td')[1];

        if (td) {
            let textvalue = td.textContent || td.innerHTML;

            if (textvalue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }

}

const add_booking_day = () => {
    let today = new Date();
    let formattedDate = today.toISOString().split('T')[0];
    document.getElementById("hiddenDateInput").value = formattedDate;
}
add_booking_day();

const search_room = (room_type) => {
    if (room_type.value == "-1") {
        let elements = document.querySelectorAll("#display-list-room *");
        // console.log(elements);
        elements.forEach(element => {
            element.style.display = "";
        });
    } else {
        let hide_room = document.querySelectorAll(".hideroom");
        hide_room.forEach(element => {
            element.style.display = "none";
        });
        let elements = document.querySelectorAll(".type" + room_type.value);
        // console.log(elements);
        elements.forEach(element => {
            element.style.display = "";
        });
    }
}


