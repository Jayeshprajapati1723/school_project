let theme = document.querySelector('.thbtn') ;
let istrue = 1 ;
theme.addEventListener("click",()=> {  
if(istrue==1) {
    document.body.style.backgroundColor = "black" ;
    document.body.style.color = "blue" ;
    istrue =0 
} else {
        document.body.style.backgroundColor = "white" ;
    document.body.style.color ="black"
    istrue=1 ;
}
}
) ;