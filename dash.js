let select = document.querySelector("#allcheckbox") ;
// abhi hmne selectall id se use pkda h jo header  k check box h 
let selectall = document.querySelectorAll(".dataselector") ;
// let checked = 1 ; let unchecked = 0 ;
select.addEventListener("click",()=>{
let isChecked = select.checked ;

selectall.forEach(checkbox => {
checkbox.checked = isChecked ;
})
})