<?php
function checkDeviceCompatibility() {
    echo "
    <script>
        if (window.innerWidth < 1080) {
            window.location.href = '../../index.php';
        }
        
        window.addEventListener('resize', function() {
            if (window.innerWidth < 1080) {
                window.location.href = '../../index.php';
            }
        });
    </script>
    ";
}

// Call this function at the beginning of your pages
checkDeviceCompatibility();
?>