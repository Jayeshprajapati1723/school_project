</div> <footer style="text-align: center; padding: 20px; color: #888; font-size: 13px;">
        &copy; 2026 Rainbow Kids Admin | JS Coder Special
    </footer>

    <!-- <script>
    function toggleNav() {
        var sidebar = document.getElementById("mySidebar");
        var main = document.getElementById("main");
        
        // Agar sidebar khula hai toh band karein, nahi toh kholiye
        if (sidebar.style.width === "250px") {
            sidebar.style.width = "0";
            main.style.marginLeft = "0";
        } else {
            sidebar.style.width = "250px";
            if(window.innerWidth > 768) {
                main.style.marginLeft = "250px";
            }
        }
    }
    </script> -->
    <script>
function toggleNav() {
    var sidebar = document.getElementById("mySidebar");
    var main = document.getElementById("main");
    
    // getComputedStyle asali width check karta hai jo screen par dikh rahi hai
    var currentWidth = window.getComputedStyle(sidebar).width;

    if (currentWidth === "250px") {
        sidebar.style.width = "0";
        if(window.innerWidth > 768) {
            main.style.marginLeft = "0";
        }
    } else {
        sidebar.style.width = "250px";
        if(window.innerWidth > 768) {
            main.style.marginLeft = "250px";
        }
    }
}
</script>
</body>
</html>
