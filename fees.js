const depoInput = document.getElementById('depo');
const discInput = document.getElementById('disc');
const totalInput = document.getElementById('final_p');
const dueInput = document.getElementById('due') ;



function calculateTotal() {
    // Number() use karna zaruri hai warna ye 10+10 ko 1010 bana dega
    let depo = Number(depoInput.value) || 0;
    let disc = Number(discInput.value) || 0;
    let due = Number(dueInput.value) ;
    if(depo <= due && disc <= due ) { 
    totalInput.value = depo + disc;
    }else{
    totalInput.value =0;
depoInput.value = 0; 
discInput.value = 0 ; 
alert('check discout and deposite amount ') ;
      alert ('INCORRECT ENTERED AMOUNT  PLEASE CHECK') ;
      alert('DEPOSITE AMOUNT IS ALWAYS LESS THAN OR EQUAL TO DEU AMOUNT ') ;
depoInput.focus() ; //CURSROSR WHI A JATA H IS FUNCTION SE 
    }
}



// Dono inputs par 'input' event listener laga do
depoInput.addEventListener('input', calculateTotal);
discInput.addEventListener('input', calculateTotal);
let form = document.querySelector('.form') ;
let submit = document.querySelector('.btn') ;

// form.addEventListener("submit",()=> {
//     alert('submited sucessfully');
// submit.ariaDisabled = 'true' ;
// submit.innerText = "Processing...";
// })

window.addEventListener('pageshow', (event) => {
    // Agar page cache (history) se load ho raha hai
    if (event.persisted) {
        window.location.reload();
        if (window.location.pathname.includes('fees.php')) {
            window.location.replace("dash.php");}
    }
});
// yha pr back dbane pr sidha dash.php pr le jayega apna page or vo bhi nhi to ye hoga ki page fees ka refresh ho jaye 
