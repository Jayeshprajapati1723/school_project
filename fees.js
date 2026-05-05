const depoInput = document.getElementById('depo');
const discInput = document.getElementById('disc');
const totalInput = document.getElementById('final_p');
const dueInput = document.getElementById('due') ;



function calculateTotal() {
    // Number() use karna zaruri hai warna ye 10+10 ko 1010 bana dega
    let depo = Number(depoInput.value) || 0;
    let disc = Number(discInput.value) || 0;
    
    totalInput.value = depo + disc;
}


// Dono inputs par 'input' event listener laga do
depoInput.addEventListener('input', calculateTotal);
discInput.addEventListener('input', calculateTotal);