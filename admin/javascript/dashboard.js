const add_day = () => {
    let begin_date = new Date();
    let end_date = new Date(begin_date);
    end_date.setDate(begin_date.getDate() - 30);
    let formattedDate = begin_date.toISOString().split('T')[0];
    let formattedDate1 = end_date.toISOString().split('T')[0];
    document.getElementById("begin-date").value = formattedDate1;
    document.getElementById("end-date").value = formattedDate;
}
add_day();


const search_number_service = () => {
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'api/getNumberofService.php', true);
    xhr.setRequestHeader('content-type', 'application/json');
    let obj = {
        begin_date: document.getElementById('begin-date').value,
        end_date: document.getElementById('end-date').value,
    }
    xhr.send(JSON.stringify(obj));
    xhr.onload = () => {
        let message = JSON.parse(xhr.response);
        console.log(message);

        htmls = ``;
        for (let key in message) {
            htmls = htmls + `
            <tr>
                <td>${message[key]['name']}</td>
                <td>${message[key]['total_use']}</td>
            </tr>    
            `;
        }
        document.getElementById('display-service-num').innerHTML = htmls;
    }
}
search_number_service();