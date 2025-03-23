<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Screen Size Warning</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Modal for screen size warning -->
    <div class="modal fade" id="screenWarningModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <span class="en">Device Compatibility Warning</span>
                        <span class="fr">Avertissement de Compatibilité</span>
                    </h5>
                    <div class="language-switch ms-3">
                        <button class="btn btn-sm btn-outline-secondary" onclick="toggleLanguage('en')">EN</button>
                        <button class="btn btn-sm btn-outline-secondary" onclick="toggleLanguage('fr')">FR</button>
                    </div>
                </div>
                <div class="modal-body">
                    <p class="mb-0 en">This website is optimized for desktop viewing (minimum width: 1080px).</p>
                    <p class="en">Please access this site from a device with a larger screen for the best experience.</p>
                    
                    <p class="mb-0 fr">Ce site web est optimisé pour un affichage sur ordinateur (largeur minimum : 1080px).</p>
                    <p class="fr">Veuillez accéder à ce site depuis un appareil avec un écran plus large pour une meilleure expérience.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" onclick="closeWindow()">
                        <span class="en">Close Window</span>
                        <span class="fr">Fermer la Fenêtre</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        .fr { display: none; }
        .language-switch button {
            margin: 0 2px;
            padding: 2px 8px;
        }
        .language-switch button.active {
            background-color: #6c757d;
            color: white;
        }
    </style>

    <script>
        function closeWindow() {
            // Essayer différentes méthodes de fermeture
            try {
                window.close(); // Pour les fenêtres ouvertes par JavaScript
                window.location.href = 'about:blank'; // Alternative
                window.top.close(); // Pour les fenêtres principales
            } catch (e) {
                // Si rien ne fonctionne, afficher un message
                alert('Please close this tab manually');
            }
        }

        function toggleLanguage(lang) {
            const elements = {
                en: document.querySelectorAll('.en'),
                fr: document.querySelectorAll('.fr')
            };
            
            // Hide all language elements
            elements.en.forEach(el => el.style.display = 'none');
            elements.fr.forEach(el => el.style.display = 'none');
            
            // Show selected language elements
            elements[lang].forEach(el => el.style.display = 'inline');
            
            // Update button states
            document.querySelectorAll('.language-switch button').forEach(btn => {
                btn.classList.remove('active');
                if (btn.innerText.toLowerCase() === lang.toUpperCase()) {
                    btn.classList.add('active');
                }
            });

            // Save language preference
            localStorage.setItem('preferredLanguage', lang);
        }

        document.addEventListener('DOMContentLoaded', function() {
            if (window.innerWidth < 1080) {
                // Show modal for mobile devices
                var modal = new bootstrap.Modal(document.getElementById('screenWarningModal'));
                modal.show();
                
                // Set initial language based on browser or saved preference
                const savedLang = localStorage.getItem('preferredLanguage');
                const browserLang = navigator.language.startsWith('fr') ? 'fr' : 'en';
                toggleLanguage(savedLang || browserLang);
            } else {
                // Redirect to main page for desktop devices
                window.location.href = "./views/standard_main.php";
            }
        });
    </script>
</body>
</html>