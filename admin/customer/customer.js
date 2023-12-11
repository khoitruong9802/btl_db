var detailpanel = document.getElementById("customerdetailpanel");

addcustomeropen = () => {
    detailpanel.style.display = "flex";
}
addcustomerclose = () => {
    detailpanel.style.display = "none";
}

//search bar logic using js
const searchFun = () =>{
    let filter = document.getElementById('search_bar').value.toUpperCase();

    let myTable = document.getElementById("table-data");

    let tr = myTable.getElementsByTagName('tr');

    for(var i = 0; i< tr.length;i++){
        let td = tr[i].getElementsByTagName('td')[1];

        if(td){
            let textvalue = td.textContent || td.innerHTML;

            if(textvalue.toUpperCase().indexOf(filter) > -1){
                tr[i].style.display = "";
            }else{
                tr[i].style.display = "none";
            }
        }
    }

}



function validateForm() {

    console.log("Hello");

    var nameInput = document.getElementById("nameInput").value;


    var flag = true;
    // Kiểm tra tính hợp lệ
    if (/^[a-zA-Z\s]+$/.test(nameInput)) {
        // Nếu hợp lệ, ẩn thông báo lỗi và thực hiện các thao tác khác nếu cần
        document.getElementById("nameerror").style.display = "none";
    } else {
        // Nếu không hợp lệ, hiển thị thông báo lỗi và không submit form
        document.getElementById("nameerror").style.display = "block";
        flag = false;
    }
    // Lấy giá trị từ trường input
    var cmndInput = document.getElementById("inputcmnd").value;

    // Kiểm tra tính hợp lệ
    if (/^[0-9]{12}$/.test(cmndInput)) {
        // Nếu hợp lệ, submit form
        document.getElementById("cmnderror").style.display = "none";
    } else {
        console.log(cmndInput);
        // Nếu không hợp lệ, hiển thị thông báo lỗi và không submit form
        document.getElementById("cmnderror").style.display = "block";
        flag = false;
    }

    return flag;
}