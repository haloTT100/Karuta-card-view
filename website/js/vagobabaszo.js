function copyCode(code){
    navigator.clipboard.writeText(code);
    let timer1, timer2;
    let toast = document.querySelector('.toast');
    let progress = document.querySelector('.toast .progress');
    let closeIcon = document.querySelector('.toast .close');

    toast.classList.add("active");
    progress.classList.add("active");
      
    timer1 = setTimeout(() => {
        toast.classList.remove("active");
    }, 5000); //1s = 1000 milliseconds
      
    timer2 = setTimeout(() => {
        progress.classList.remove("active");
    }, 5300);
    closeIcon.addEventListener("click", () => {
    toast.classList.remove("active");
    
    setTimeout(() => {
        progress.classList.remove("active");
    }, 300);
    
    clearTimeout(timer1);
    clearTimeout(timer2);
    });
}