let all_div_row = document.querySelectorAll(".a");
let old_pass_inp = document.getElementById('old-pass');
old_pass_inp.onkeyup = function(){
    let currentPass = old_pass_inp.value;
    let dataRequest = new XMLHttpRequest;
    dataRequest.onreadystatechange = function(){
        if( this.readyState == 4 && this.status == 200 ){
            let json_data = this.responseText;
            let js_obj = JSON.parse(json_data);
            let u_pass = js_obj[0];
            if( currentPass == u_pass ){
                for( let i = 0; i < all_div_row.length; i++ ){
                    all_div_row[i].classList.remove("h-s")
                }
            }
            else{
                for( let i = 0; i < all_div_row.length; i++ ){
                    all_div_row[i].classList.add("h-s")
                }
            }
            
        }
    }
    dataRequest.open("GET", "user_pass.json", true);
    dataRequest.send();
}

let inp1 = document.getElementById('inp-pass1');
let inp2 = document.getElementById('inp-pass2');
let result = document.getElementById('result');
let btn = document.getElementById('btn-run');
inp2.onkeyup = function(){
    let val1 = inp1.value;
    let val2 = inp2.value;
    if( val1 == val2 ){
        result.innerHTML = "Matched";
        result.style.color = "green";
        btn.classList.remove("h-s");
    }
    else{
        result.innerHTML = "not matched";
        result.style.color = "red";
        btn.classList.add("h-s");
    }
}