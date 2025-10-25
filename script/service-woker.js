/**GOOD LIFE MPCS SERVICE WORKER FILE START */
if('serviceWorker' in navigator){
    window.addEventListener('load', function(){
        this.navigator.serviceWorker.register(__mpc_uri() + '/script/worker.js').then()
    })
}