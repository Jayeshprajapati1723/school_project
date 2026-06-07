let fees = [
    '11500',
'12000',
'12000',
'12500',
'12500',
'13000',
'13000',
'13000',
'13500',
'13500',
'13500',
'14000',
'15000',

]
function selectclass() {
    let class_picked = document.querySelector('#class_picker').value ;


if(class_picked) { 
console.log(class_picked) ;
   let classes = ['Nursery', 'kg1', 'kg2', "1", '2nd', '3rd', '4th', '5th', '6th', '7th', '8th', '9th', '10th'];
let indexforfees = classes.indexOf(class_picked) ;
console.log(indexforfees) ;
let finalpay= fees[indexforfees] ;

document.querySelector("#standardfees").value = finalpay ;
console.log(finalpay) ;

 }
}
/* Nursery	11500
KG1	12000
KG2	12000
1st	12500
2nd	12500
3rd	13000
4th	13000
5th	13000
6th	13500
7th	13500
8th	13500
9th	14000
10th	15000

*/ 




/* --- Admission Type Change Logic (RTE vs Normal) --- */
function handleAdmissionTypeChange() {
    const admissionType = document.querySelector('input[name="admission_type"]:checked').value;
    
    if (admissionType === 'RTE') {
        setFeesToZero();
        document.getElementById('discount_box').readOnly = true;
    } else {
        document.getElementById('discount_box').readOnly = false;
        applyMasterFees(); 
    }
}

// Helper function to reset all fee fields to zero
function setFeesToZero() {
    document.getElementById('display_std').innerText = "0";
    document.getElementById('hidden_std_fees').value = 0;
    document.getElementById('discount_box').value = 0;
    document.getElementById('display_final').innerText = "0";
    document.getElementById('hidden_final_fees').value = 0;
}

// /* --- Image preview logic --- */
// function previewImage() {
//     const file = document.getElementById('photoInput').files[0];
//     const preview = document.getElementById('imagePreview');
//     if (file) {
//         const reader = new FileReader();
//         reader.onload = function(e) {
//             preview.src = e.target.result;
//             preview.style.display = 'block';
//         }
//         reader.readAsDataURL(file);
//     }
// }

/* --- DOB Figure to Words Logic --- */
function convertDateToWords() {
    const dateInput = document.getElementById('dob_fig').value;
    if (!dateInput) return;

    const parts = dateInput.split('-');
    const year = parseInt(parts[0]);
    const monthIndex = parseInt(parts[1]) - 1;
    const day = parseInt(parts[2]);

    const date = new Date(year, monthIndex, day);
    const monthName = date.toLocaleString('default', { month: 'long' });

    const dayOnes = ['', 'First', 'Second', 'Third', 'Fourth', 'Fifth', 'Sixth', 'Seventh', 'Eighth', 'Ninth', 'Tenth', 
                     'Eleventh', 'Twelfth', 'Thirteenth', 'Fourteenth', 'Fifteenth', 'Sixteenth', 'Seventeenth', 'Eighteenth', 'Nineteenth'];
    const dayTens = ['', '', 'Twenty', 'Thirty'];

    const yearWords = ['', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten', 
                       'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'];

    let dayWord = (day < 20) ? dayOnes[day] : dayTens[Math.floor(day / 10)] + (day % 10 !== 0 ? " " + dayOnes[day % 10] : "");

    let lastTwo = year % 100;
    let yearPart = "";

    if (lastTwo > 0 && lastTwo < 20) {
        yearPart = yearWords[lastTwo];
    } else if (lastTwo >= 20) {
        const yearTensMap = ['', '', 'Twenty', 'Thirty'];
        yearPart = yearTensMap[Math.floor(lastTwo / 10)] + (lastTwo % 10 !== 0 ? " " + yearWords[lastTwo % 10] : "");
    }

    const result = `${dayWord} ${monthName} Two Thousand ${yearPart}`.trim();
    document.getElementById('dob_words').value = result;
}



function syncAddress() {
    const permAddr = document.getElementById('perm_addr');
    const currAddr = document.getElementById('curr_addr');
    const checkbox = document.getElementById('same_as_perm');

    if (checkbox.checked) {
        // Copy value and make readOnly so user doesn't type wrong
        currAddr.value = permAddr.value;
        currAddr.readOnly = true; 
        currAddr.style.background = "#f1f5f9"; // Thoda grey look taaki pata chale locked hai
    } else {
        // Unlock and clear if unchecked (optional clear)
        currAddr.readOnly = false;
        currAddr.style.background = "#ffffff";
    }
}





// /* Fee Calculation logic */
// function applyMasterFees() {
//     let select = document.getElementById('class_picker');
//     let fees = select.options[select.selectedIndex].getAttribute('data-fees') || 0;
//     document.getElementById('display_std').innerText = fees;
//     document.getElementById('hidden_std_fees').value = fees;
//     calculateFinal();
// }

// function calculateFinal() {
//     let stdFees = parseFloat(document.getElementById('hidden_std_fees').value) || 0;
//     let discount = parseFloat(document.getElementById('discount_box').value) || 0;
//     let final = stdFees - discount;
//     document.getElementById('display_final').innerText = final;
//     document.getElementById('hidden_final_fees').value = final;
// }

// /* Image preview logic */
// function previewImage() {
//     const file = document.getElementById('photoInput').files[0];
//     const preview = document.getElementById('imagePreview');
//     if (file) {
//         const reader = new FileReader();
//         reader.onload = function(e) {
//             preview.src = e.target.result;
//             preview.style.display = 'block';
//         }
//         reader.readAsDataURL(file);
//     }
// }

// // Function for Figure to Words DOB
// function convertDateToWords() {
//     const dateInput = document.getElementById('dob_fig').value;
//     if (!dateInput) return;

//     // Date ko split karke correctly read karna
//     const parts = dateInput.split('-');
//     const year = parseInt(parts[0]);
//     const monthIndex = parseInt(parts[1]) - 1;
//     const day = parseInt(parts[2]);

//     const date = new Date(year, monthIndex, day);
//     const monthName = date.toLocaleString('default', { month: 'long' });

//     // Day Mapping (Ordinal: First, Second...)
//     const dayOnes = ['', 'First', 'Second', 'Third', 'Fourth', 'Fifth', 'Sixth', 'Seventh', 'Eighth', 'Ninth', 'Tenth', 
//                      'Eleventh', 'Twelfth', 'Thirteenth', 'Fourteenth', 'Fifteenth', 'Sixteenth', 'Seventeenth', 'Eighteenth', 'Nineteenth'];
//     const dayTens = ['', '', 'Twenty', 'Thirty'];

//     // Year Mapping (Cardinal: One, Two, Three...)
//     const yearWords = ['', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten', 
//                        'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'];

//     // --- DAY LOGIC ---
//     let dayWord = (day < 20) ? dayOnes[day] : dayTens[Math.floor(day / 10)] + (day % 10 !== 0 ? " " + dayOnes[day % 10] : "");

//     // --- YEAR LOGIC (Fixing the "5" vs "Five" issue) ---
//     let lastTwo = year % 100;
//     let yearPart = "";

//     if (lastTwo > 0 && lastTwo < 20) {
//         yearPart = yearWords[lastTwo]; // 5 becomes "Five"
//     } else if (lastTwo >= 20) {
//         const yearTensMap = ['', '', 'Twenty', 'Thirty'];
//         yearPart = yearTensMap[Math.floor(lastTwo / 10)] + (lastTwo % 10 !== 0 ? " " + yearWords[lastTwo % 10] : "");
//     }

//     // Final output formation
//     const result = `${dayWord} ${monthName} Two Thousand ${yearPart}`.trim();
//     document.getElementById('dob_words').value = result;
// }

// function handleAdmissionTypeChange() {
//     const admissionType = document.querySelector('input[name="admission_type"]:checked').value;
    
//     if (admissionType === 'RTE') {
//         // Agar RTE hai toh sab zero kar do
//         document.getElementById('display_std').innerText = "0";
//         document.getElementById('hidden_std_fees').value = 0;
//         document.getElementById('discount_box').value = 0;
//         document.getElementById('display_final').innerText = "0";
//         document.getElementById('hidden_final_fees').value = 0;
        
//         // Discount box ko disable kar do taaki koi kuch likh na sake
//         document.getElementById('discount_box').readOnly = true;
//     } else {
//         // Agar wapas Normal par aaye toh fir se class ki fees load karo
//         document.getElementById('discount_box').readOnly = false;
//         applyMasterFees(); 
//     }
// }
// function applyMasterFees() {
//     const admissionType = document.querySelector('input[name="admission_type"]:checked').value;
//     if (admissionType === 'RTE') return; // RTE mein class badalne par bhi fees nahi badlegi

//     let select = document.getElementById('class_picker');
//     // ... baki aapka purana fees wala code ...
// }


// // // functionn for figure to words dob
// // function convertDateToWords() {
// //     const dateInput = document.getElementById('dob_fig').value;
// //     if (!dateInput) return;

// //     const parts = dateInput.split('-');
// //     const year = parseInt(parts[0]);
// //     const monthIndex = parseInt(parts[1]) - 1;
// //     const day = parseInt(parts[2]);

// //     const date = new Date(year, monthIndex, day);
// //     const monthName = date.toLocaleString('default', { month: 'long' });

// //     // Day Mapping (Ordinal)
// //     const dayOnes = ['', 'First', 'Second', 'Third', 'Fourth', 'Fifth', 'Sixth', 'Seventh', 'Eighth', 'Ninth', 'Tenth', 'Eleventh', 'Twelfth', 'Thirteenth', 'Fourteenth', 'Fifteenth', 'Sixteenth', 'Seventeenth', 'Eighteenth', 'Nineteenth'];
// //     const dayTens = ['', '', 'Twenty', 'Thirty'];

// //     // Year Mapping (Cardinal - Number to Word)
// //     const yearWords = ['', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen', 'Twenty'];

// //     // Day Logic
// //     let dayWord = (day < 20) ? dayOnes[day] : dayTens[Math.floor(day / 10)] + (day % 10 !== 0 ? " " + dayOnes[day % 10] : "");

// //     // Year Logic (Ab 5 ki jagah "Five" aayega)
// //     let lastTwo = year % 100;
// //     let yearPart = "";

// //     if (lastTwo > 0 && lastTwo <= 20) {
// //         yearPart = yearWords[lastTwo]; 
// //     } else if (lastTwo > 20) {
// //         yearPart = "Twenty " + yearWords[lastTwo % 10];
// //     }

// //     // Final Output: "Twenty-third February Two Thousand Five"
// //     const result = dayWord + " " + monthName + " Two Thousand " + yearPart;
// //     document.getElementById('dob_words').value = result.trim();
// // }

// // Function jo check karega ki Normal select hai ya RTE
