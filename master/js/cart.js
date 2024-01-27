let cart_result = document.getElementById("cart-result");
let all_add = document.querySelectorAll(".add-btn");
let i_id = document.querySelectorAll(".i-id");
let all_added = document.querySelectorAll(".added");

for( let i = 0; i < all_add.length; i++ ){
    all_add[i].onclick = function(){
        let item_id = i_id[i].innerHTML;
        let dataRequest = new XMLHttpRequest;

        dataRequest.onreadystatechange = function(){
            if( this.readyState == 4 && this.status == 200 ){
                cart_result.innerHTML = this.responseText;
            }
        }

        dataRequest.open("GET", "add_cart.php?q="+ item_id, true);
        dataRequest.send();
        all_add[i].classList.add("h-s");
        all_added[i].classList.remove("h-s");
    }

}