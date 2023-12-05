var detailpanel = document.getElementById("guestdetailpanel");

adduseropen = () => {
    detailpanel.style.display = "flex";
}
adduserclose = () => {
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

const searchCMND = async () => {
    var cmnd = document.getElementById("seachcmnd").value;
    try {
        // Gửi yêu cầu tới file PHP để lấy thông tin theo CMND
        const response = await fetch('./api/getCustomerbyCMND.php?id=' + cmnd);
        console.log("Error Here")
        const data = await response.json();

        if (data.error) {
            // Hiển thị thông báo nếu không tìm thấy dữ liệu
            document.getElementById("display-result").innerHTML = `<p>${data.error}</p>`;
        } else {
            // Hiển thị kết quả
            document.getElementById("display-result").innerHTML = data.name;
            // resultContainer.innerHTML = `
            //     <p>Name: ${data.name}</p>
            //     <p>Age: ${data.Age}</p>
            //     <p>Address: ${data.Address}</p>
            // `;
        }
    } catch (error) {
        console.error(error);
        document.getElementById("display-result").innerHTML = '<p>Error fetching data.</p>';

    }
    // let xhr = new XMLHttpRequest();
    // xhr.open('GET', './api/getCustomerbyCMND.php?id=' + cmnd, true);
    // xhr.send();
    // xhr.onload = () => {
    //     let message = xhr.response;
    //     console.log(typeof message);
    //     document.getElementById("display-result").innerHTML = message;
    // }
}
