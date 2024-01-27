/*************************************/
let page_title = document.querySelectorAll('.page-title')[0].innerHTML;
let all_links = document.querySelectorAll('.links a');
let titles = [
    "Dashboard",
    "Sections",
    "Treatment Doctors",
    "Patients",
    // "Jobs",
    // "Departments",
    // "Employees",
    "Examinations",
    "Invoice",
    "Items",
    "Reports",
    "Slider"
];

for( let i = 0; i < titles.length; i++ ){
    if( titles[i].includes(page_title) ){
        for( let a = 0; a < all_links.length; a++ ){
            all_links[a].classList.remove("act");
            all_links[i].classList.add("act")
        }
    }
}
