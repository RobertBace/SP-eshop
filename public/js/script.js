window.onload = function () {
    let pokracuj = true;
    let poc = 0;
    let vKosi = 0;
    while(pokracuj) {
        poc ++;
        if (document.getElementById("kosButton"+ poc) != null) {
            let tlacitko = document.getElementById("kosButton"+ poc);

            tlacitko.onclick = function () {
                let num = document.getElementById("cartIndicatorNum");
                vKosi ++;
                if(vKosi > 9){
                    num.style.fontSize = 11+"px";
                    num.style.left = -37+"px";
                    num.style.top = 2+"px";
                    num.innerText = vKosi;
                } else {
                    num.innerText = vKosi;
                }
                let ind = document.getElementById("cartIndicator");
                ind.style.visibility = "visible";
                num.style.visibility = "visible";
            }
        } else {
            pokracuj = false;
        }
    }

    document.getElementById("cart").onclick = function (){
        vKosi = 0;
        document.getElementById("cartIndicator").style.visibility = "hidden";
        document.getElementById("cartIndicatorNum").style.visibility = "hidden";
    }


}