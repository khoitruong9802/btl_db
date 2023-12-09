const add_booking_day = () => {
    document.getElementById("hiddenDateInput").value = old_book_day;
    document.getElementById("checkinday").value = old_checkin_day;
    document.getElementById("checkoutday").value = old_checkout_day;
}

const room_checked = () => {
    let xhr = new XMLHttpRequest();
    xhr.open('GET', '../api/searchCheckedroom.php?id=' + order_id, true);
    xhr.setRequestHeader('content-type', 'application/json');
    xhr.send();
    xhr.onload = () => {
        let message = JSON.parse(xhr.response);
        // console.log(message);
        mlen = message.length;
        for (let i = 0; i < mlen; i++) {
            let room_number = message[i]['room_id'];
            // console.log(room_number);
            document.getElementById("cbroom" + room_number).checked = true;
        }
    }
}

let hide_rooms = [];

const search_room_type_edit = () => {
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

const search_room_edit = () => {
    // console.log(order_id);
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
    // console.log(check_in_day);
    // console.log(check_out_day);
    if (check_in_day >= check_out_day) {
        let elements = document.querySelectorAll("#display-list-room *");
        // console.log(elements);
        elements.forEach(element => {
            element.style.display = "none";
        });
        return;
    }

    let xhr = new XMLHttpRequest();
    xhr.open('GET', '../api/searchRoomedit.php?id=' + order_id, true);
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
    search_room_edit();
    room_checked();
}

document.addEventListener('DOMContentLoaded', function() {
    auto_run();
});
