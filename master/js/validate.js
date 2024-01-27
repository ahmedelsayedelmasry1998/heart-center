let all_inp = document.querySelectorAll('.b');
let all_res = document.querySelectorAll('.res');

document.forms[0].onsubmit = function(event){
    for( let i = 0; i < all_inp.length; i++ ){
        if(all_inp[i].value == ""){
            event.preventDefault();
            all_res[i].classList.remove("h-s");
            all_res[i].style.color = "red";
            all_inp[i].style.border = "2px solid brown";
        }
        else{
            all_res[i].classList.add("h-s")
        }
    }
    let upload_val = document.forms[0].upload_image.value;
    let dot = upload_val.lastIndexOf(".");
    let image_extension = upload_val.slice(dot+1, upload_val.length);
    let extension = ['jpg', "jpeg", "gif", "png"];
    if(image_extension == ""){
        document.getElementById('res2').classList.add("h-s");
    }
    else if( !extension.includes(image_extension) ){
        event.preventDefault();
        document.getElementById('res2').classList.remove("h-s");
        console.log(typeof image_extension)
    }

}