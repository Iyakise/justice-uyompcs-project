//scroll effect
window.addEventListener('scroll', function(){
    var returnToTop = this.document.querySelector('.mpc-toTop-wrap');
//930
    var height = this.scrollY;

    if(height >= 930){
        returnToTop.style.display = 'block';

        __toTop__(); //scroll back to top
    }else{
        returnToTop.style.display = 'none';
    }
})

function __toTop__(){
    var returnToTop = this.document.querySelector('.mpc-toTop-wrap');
    returnToTop.addEventListener('click', function() {
        
        window.scrollTo(0, 0);
    })
}