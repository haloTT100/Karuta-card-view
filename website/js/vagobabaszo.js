

function copyCode(text) {
    // Az elem létrehozása és a szöveg beállítása
    var tempInput = document.createElement("input");
    tempInput.value = text;
  
    // Az elem hozzáadása az oldalhoz
    document.body.appendChild(tempInput);
  
    // Az elem kijelölése és a másolás elvégzése
    var range = document.createRange();
    range.selectNode(tempInput);
    window.getSelection().removeAllRanges();
    window.getSelection().addRange(range);
    document.execCommand("copy");
  
    // Az ideiglenes elem eltávolítása
    document.body.removeChild(tempInput);

    const toastLiveExample = document.getElementById('copyToast')

    const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
    toastBootstrap.show()
  }
  