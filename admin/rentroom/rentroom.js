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

const add_day = () => {
    let today = new Date();
    let formattedDate = today.toISOString().split('T')[0];
    document.getElementById("checkoutday").value = formattedDate;
}
add_day();

const caculate_total_cost = () => {
    let extra_cost = document.getElementById("extra-cost").value;
    let vat_cost = document.getElementById("vat-cost").value;
    let subtotal_payment = document.getElementById("subtotal-payment").value;
    // let discount = document.getElementById("").value;
    
    
    if (isNaN(parseInt(extra_cost, 10))) {
        extra_cost = 0;
    } else {
        extra_cost = parseInt(extra_cost, 10);
    }
    if (isNaN(parseInt(vat_cost, 10))) {
        vat_cost = 0;
    } else {
        vat_cost = parseInt(vat_cost, 10);
    }

    document.getElementById("total-payment").value = parseInt(subtotal_payment, 10) + extra_cost + vat_cost;
}

