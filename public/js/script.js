window.onload = function () {

    let xhr = new XMLHttpRequest();
    xhr.onload = function () {
        if (xhr.status === 200) {
            let json = JSON.parse(xhr.responseText);
            let vKosi = json.count;
            let num = document.getElementById("cartIndicatorNum");
            num.innerText = vKosi;

            let ind = document.getElementById("cartIndicator");
            if (vKosi == 0) {
                ind.style.visibility = "hidden";
                num.style.visibility = "hidden";
            } else {
                ind.style.visibility = "visible";
                num.style.visibility = "visible";
                if (vKosi > 9) {
                    num.style.fontSize = 11 + "px";
                    num.style.left = -30 + "px";
                    num.style.top = -15 + "px";
                }
            }
        } else {
            console.error(xhr.responseText);
        }
    }
    xhr.open("POST", "http://localhost/SP-eshop/?c=home&a=indicate", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send();
}

function add(id) {
    let xhr = new XMLHttpRequest();
    xhr.onload = function () {
        if (xhr.status === 200) {
            let json = JSON.parse(xhr.responseText);
            if (json.e) {
                console.log(json.e);
                return;
            }
            let num = document.getElementById("cartIndicatorNum");
            vKosi = json.count;
            console.log(vKosi);
            if (vKosi > 9) {
                num.style.fontSize = 11 + "px";
                num.style.left = -30 + "px";
                num.style.top = -15 + "px";
                num.innerText = vKosi;
            } else {
                num.style.fontSize = 16 + "px";
                num.style.left = -29 + "px";
                num.style.top = -13 + "px";
                num.innerText = vKosi;
            }
            let ind = document.getElementById("cartIndicator");
            if (vKosi == 0) {
                ind.style.visibility = "hidden";
                num.style.visibility = "hidden";
            } else {
                ind.style.visibility = "visible";
                num.style.visibility = "visible";
            }

        } else {
            console.error(xhr.responseText);
        }
    }

    xhr.open("POST", "http://localhost/SP-eshop/?c=orders&a=add", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send('id=' + id);
}

function emailCheck(){
    let mail = document.getElementById("email");
    let xhr = new XMLHttpRequest();
    xhr.onload = function () {
        if (xhr.status === 200) {
            let json = JSON.parse(xhr.responseText);
            if (json.duplicity == true){
                var message = document.getElementById("mailInfo");
                message.innerHTML = "Email už existuje";
            } else {
                var message = document.getElementById("mailInfo");
                message.innerHTML = "";
            }
        } else {
            console.error(xhr.responseText);
        }
    }
    var message = document.getElementById("emailInfo").value;
    xhr.open("POST", "http://localhost/SP-eshop/?c=auth&a=emailCheck", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send('message=' +message);
}

