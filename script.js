document.getElementById('languageSwitcher').addEventListener('change', function (){
    const selectedLang = this.value;;

    const texts = {
        title: document.getElementById('title').innerText,
        description: document.getElementById('description').innerText
    };

    for (let key in texts) {
        fetch('translate.php?lang=${selectedLang}&text=${encodeURIComponent(texts[key])}')
        .then(response => response.json())
        .then(data => {
            if(data.translations) {
                document.getElementById(key).innerText = data.translations[0].translatedText;
            } else {
                console.error('Translation error:', data.error);
            }
        })
        .catch(error => console.error('Error:' ,error));
    }
});