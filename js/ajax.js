// XMLHttpRequest
function ajax(url, method, functionName, dataArray) {
    let xhttp = new XMLHttpRequest();
    xhttp.open(method, url, true);
    xhttp.send(dataArray);

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            functionName(this.response);
        }
    }
}

function requestData(dataArr) {
    let out = '';
    for (let key in dataArr) {
        out += `${key}=${dataArr[key]}&`;
    }
    return out;
}