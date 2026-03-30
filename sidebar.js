/* Sidebar Responsiveness Logic */
function setSidebarLayout() {
    var sidebar = document.getElementById("mySidebar");
    var main = document.getElementById("main");

    if (sidebar && main) {
        if (window.innerWidth > 768) {
            sidebar.style.width = "250px";
            main.style.marginLeft = "250px";
        } else {
            sidebar.style.width = "0";
            main.style.marginLeft = "0";
        }
    }
}

window.addEventListener('load', setSidebarLayout);
window.addEventListener('resize', setSidebarLayout);

/* Dropdown Toggle Logic */
var dropdown = document.getElementsByClassName("dropdown-btn");
for (var i = 0; i < dropdown.length; i++) {
    dropdown[i].addEventListener("click", function() {
        this.classList.toggle("active-dropdown");
        var dropdownContent = this.nextElementSibling;
        if (dropdownContent.style.display === "block") {
            dropdownContent.style.display = "none";
        } else {
            dropdownContent.style.display = "block";
        }
    });
}
