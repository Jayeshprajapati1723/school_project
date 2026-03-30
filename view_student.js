/* LOGIC UPDATED: 24-03-2026 */
console.log("Student Profile Loaded Successfully!");

// Example: Print confirmation or highlighting balance
window.addEventListener('load', () => {
    const balance = document.querySelector('.status-red');
    if(balance && parseInt(balance.innerText.replace('₹', '')) > 0) {
        console.log("Fees Pending for this student.");
    }
});
