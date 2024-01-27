let pat_select = document.getElementById('pat-select');
let invoice_date = document.getElementById('inv-date');
let invoice_time = document.getElementById('inv-time');
let phoneTD = document.getElementById('td-phone');
let ageTD = document.getElementById('td-age');
let treatTD = document.getElementById('td-treat');

// insert date & time now
let now = new Date();
invoice_date.value = `${now.getFullYear()}-${now.getMonth() + 1}-${now.getDate()}`;
invoice_time.value = `${now.getHours()}:${now.getMinutes()}:${now.getSeconds()}`;

// // get phone
// function getPhone(){
//     let patID = pat_select.value;
//     if( patID == 'start' ){
//         phoneTD.innerHTML = "";
//     }
//     else{
//         let dataRequest = new XMLHttpRequest;
//         dataRequest.onreadystatechange = function(){
//             if( this.readyState == 4 && this.status == 200 ){
//                 phoneTD.innerHTML = this.responseText;
//             }
//         }
//         dataRequest.open("GET", "get_phone.php?q=" + patID, true);
//         dataRequest.send();
//     }
// }

// // get age
// function getAge(){
//     let patID = pat_select.value;
//     if( patID == 'start' ){
//         ageTD.innerHTML = "";
//     }
//     else{
//         let dataRequest = new XMLHttpRequest;
//         dataRequest.onreadystatechange = function(){
//             if( this.readyState == 4 && this.status == 200 ){
//                 ageTD.innerHTML = this.responseText;
//             }
//         }
//         dataRequest.open("GET", "get_age.php?q=" + patID, true);
//         dataRequest.send();
//     }
// }

// // get treat
// function getTreat(){
//     let patID = pat_select.value;
//     if( patID == 'start' ){
//         treatTD.innerHTML = "";
//     }
//     else{
//         let dataRequest = new XMLHttpRequest;
//         dataRequest.onreadystatechange = function(){
//             if( this.readyState == 4 && this.status == 200 ){
//                 treatTD.innerHTML = this.responseText;
//             }
//         }
//         dataRequest.open("GET", "get_treat.php?q=" + patID, true);
//         dataRequest.send();
//     }
// }

// pat_select.addEventListener("change", getPhone);
// pat_select.addEventListener("change", getAge);
// pat_select.addEventListener("change", getTreat);

function pat_info(){
    let patID = pat_select.value;
    if( patID == 'start' ){
        phoneTD.innerHTML = "";
        ageTD.innerHTML = "";
        treatTD.innerHTML = "";
    }
    else{
        let dataRequest = new XMLHttpRequest;
        dataRequest.onreadystatechange = function(){
            if( this.readyState == 4 && this.status == 200 ){
                let json_data = this.responseText;
                let pat_obj = JSON.parse(json_data);
                phoneTD.innerHTML = pat_obj[patID]["pat_phone"];
                ageTD.innerHTML = pat_obj[patID]["pat_age"];
                treatTD.innerHTML = pat_obj[patID]["treat_name"];
                
            }
        }
        dataRequest.open("GET", "pat.json" , true);
        dataRequest.send();
    }
}
pat_select.addEventListener("change", pat_info);
/*******************************************************************/

let all_exam = document.querySelectorAll('tbody select');
let all_price = document.querySelectorAll('.p');
let all_discount = document.querySelectorAll('.d');
let all_amount = document.querySelectorAll('.a');
let inp_total = document.getElementById('inp-total');

for( let i = 0;  i < all_exam.length; i++){
    all_exam[i].onchange = function(){
        let examID = all_exam[i].value;
        if( examID == 'start' ){
            all_price[i].value = 0;
            all_discount[i].value = 0;
            all_amount[i].value = 0;
        }
        else{
            let dataRequest = new XMLHttpRequest;
            dataRequest.onreadystatechange = function(){
                if( this.readyState == 4 && this.status == 200){
                    all_price[i].value = this.responseText;
                    all_discount[i].value = 0;
                    all_amount[i].value = parseFloat(all_price[i].value);

                    let total = 0;
                    for( let a = 0; a < all_amount.length; a++ ){
                        total += parseFloat(all_amount[a].value);
                    }
                    inp_total.value = total;
                }
            }
            dataRequest.open("GET", "get_price.php?q=" + examID, true);
            dataRequest.send();
        }
    } 
}

for( let i = 0; i < all_discount.length; i++ ){
    all_discount[i].onkeyup = function(){
        all_amount[i].value = parseFloat(all_price[i].value) - parseFloat(all_discount[i].value);
        let total = 0;
        for( let a = 0; a < all_amount.length; a++ ){
            total += parseFloat(all_amount[a].value);
        }
        inp_total.value = total;
    }
}
document.getElementById('inp-print').onclick = function(){
    window.print();
}