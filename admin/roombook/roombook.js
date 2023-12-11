var detailpanel = document.getElementById("guestdetailpanel");

roombookopen = () => {
    detailpanel.style.display = "flex";
}
roombookclose = () => {
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
    let tomorrow = new Date(today);
    tomorrow.setDate(today.getDate() + 1);
    let formattedDate = today.toISOString().split('T')[0];
    let formattedDate1 = tomorrow.toISOString().split('T')[0];
    document.getElementById("hiddenDateInput").value = formattedDate;
    document.getElementById("checkinday").value = formattedDate;
    document.getElementById("checkoutday").value = formattedDate1;
}

let hide_rooms = [];

const search_room_type = () => {
    room_type = document.getElementById('room-type-selected');
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
    
    hide_rooms.forEach(function (room_num) {
        hide_room1 = document.getElementById('cbroom' + room_num);
        hide_room2 = document.getElementById('lbroom' + room_num);
        hide_room1.style.display = "none";
        hide_room2.style.display = "none";
    });
}

const search_room = () => {
    room_type = document.getElementById('room-type-selected');
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

    let ele = document.querySelectorAll('[id^="cbroom"]');
    ele.forEach(function (element) {
        element.checked = false;
    });
    
    hide_rooms = [];
    let check_in_day = document.getElementById("checkinday").value;
    let check_out_day = document.getElementById("checkoutday").value;
    check_in_day = new Date(check_in_day);
    check_out_day = new Date(check_out_day);

    let xhr = new XMLHttpRequest();
    xhr.open('GET', '../api/searchRoom.php', true);
    xhr.setRequestHeader('content-type', 'application/json');
    xhr.send();

    xhr.onload = () => {
        let message = JSON.parse(xhr.response);
        // console.log(message);
        mlen = message.length;
        for (let i = 0; i < mlen; i++) {
            let room_number = message[i]['room_id'];
            let ch_in = message[i]['echeckinday'];
            let ch_out = message[i]['echeckoutday'];
            ch_in = new Date(ch_in);
            ch_out = new Date(ch_out);
            if (ch_in >= check_out_day || ch_out <= check_in_day) {
            } else {
                hide_rooms.push(room_number);
            }
        }
        // console.log(hide_rooms);
        hide_rooms.forEach(function (room_num) {
            hide_room1 = document.getElementById('cbroom' + room_num);
            hide_room2 = document.getElementById('lbroom' + room_num);
            hide_room1.style.display = "none";
            hide_room2.style.display = "none";
            // console.log(hide_room1);
            // console.log(hide_room2);
        });
    }
}

const auto_run = () => {
    add_booking_day();
    search_room();
}

auto_run();
