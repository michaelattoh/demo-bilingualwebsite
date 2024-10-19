document.addEventListener('DOMContentLoaded', function () {
    const languageSelector = document.getElementById('language-selector');
    
    if (languageSelector) {
        languageSelector.addEventListener('change', function () {
            const selectedLanguage = this.value;
            const textToTranslate = document.getElementById('content').innerText;

            fetch('translate.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    text: textToTranslate,
                    target: selectedLanguage
                }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.translatedText) {
                    document.getElementById('content').innerText = data.translatedText;
                } else {
                    console.error('Translation error:', data);
                }
            })
            .catch(error => console.error('Error:', error));
        });
    } else {
        console.error("Language selector element not found!");
    }
});