function copyCode(code){
    navigator.clipboard.writeText(code);
    const toastLiveExample = document.getElementById('copyToast')

    const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
    toastBootstrap.show()

    
}