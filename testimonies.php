<?php
    define ('__mpc_connection__', '/config/'); //db connecntin define constant
    
    define('__MPC_GENERAL_PERMIT__', '/asset/inc-files/');
    
   // require_once dirname(__FILE__) . "/functions/mpc-func.php";
  // echo constant(__MPC_GENERAL_PERMIT__);
  require_once dirname(__FILE__) . __mpc_connection__. "conn.php";  
    require_once dirname(__FILE__) .__MPC_GENERAL_PERMIT__. "head.php";
?>

<style>
    body{
      background: #e3edf7;
    }
  </style>
  <div class="mpc-faqs">
    <h2 class="text-center">Testimony</h2>

    
      <?php 
/**GOOD LIFE ACCORDION HERE WITH CSS NO JAVASCRIPT
 * FOR GOOD LIFE FREQUENTLY ASK QUESTION
 * IYAKISE RAPHAEL ETIM IS MY NAME
 * GOD BLESS IYAKISE RAPHAEL ETIM
 * I THANK GOD ALMIGHTY FOR GIVING ME THE IDEA TO DO THIS UP TO 
 * THIS POINT, FOR ME IT WAS'NT EASY
 * SOME POINT I WANTED TO LEAVE THE PROJECT AND RUN AWAYY THAT I COULD'NT DO IT
 * BUT NOW, SMALL, SMALL GOD IS DIRECTIING ME WHAT TO DO
 */


?>
      <!--- CONTACT US FORM SHOW START HERE --->
      <div class="mpc-contact-usForm">
        <h6>Send us a message</h6>
        <div class="contactUs-formWrap">
          <section class="testy">
            <div><input type="text"  placeholder="Name" class="contact-user testifier-name" title="NAME"><i class="fa-solid fa-user-alt"></i></div>
            <!--div><input type="email" name="SenderEmail" placeholder="Email" class="contact-email " title="Email"><i class="fa-solid fa-envelope"></i></div>
            <div><input type="number" name="SenderPhone" placeholder="Phone" class="contact-phone " title="Phone"><i class="fa-solid fa-mobile-alt"></i></div>
            <div><input type="text" name="SenderSubject" placeholder="Subject" class="contact-subjext " title="Subject"><i class="fas fa-hands"></i></div-->

            <div>
              <textarea class="Contact-usTextArea testifier-message"  cols="30" rows="10" placeholder="Enter message"></textarea>
              <i class="fas fa-edit"></i>
              <p class="rtnMsg"></p>
            </div>

              <button class="mpc-btn mpc-btn-fullWidth testimony-sender" name="sender-mpc-sendButton" style="margin-top:15px;width:30%;padding:10px;">Submit</button>
          </section>
          <h6 class="mpc-testMsg"></h6>
        </div>

      </div>
<?php 
if(__mpc_self_check__($conn) === 1){
?>
      <div class="mpc-testimony-load">
      <div class="mpc-testimonies-wrapper">
            <div class="mpc-test-wrap-inner mpc-go-flex owl-carousel">
              
            <?php __getTestimony__($conn)?>
        </div>
      </div>
      </div>

<?php
}
?>
  </div>

<script>
  var testimonyButton = document.querySelector('.testimony-sender');
      testimonyButton.addEventListener('click', function(){
        let testifierName, testifierMsg, xhr, testMsg;
            testifierName = document.querySelector('.testifier-name');
            testifierMsg = document.querySelector('.testifier-message');
            testMsg = document.querySelector('.mpc-testMsg');

            if(testifierName.value.search(/[0-9!@#$%^+&*()-?><:"'|{}]/) !== -1){
              testMsg.innerHTML = 'Invalid character in name field';
              testMsg.style.color ='red';

            }else if(testifierMsg.value.search(/[0-9!@#$%^+&*()-?><:"'|{}]/) !== -1){
              testMsg.innerHTML = 'Invalid character, your message field contains invalid character';
              testMsg.style.color ='red'
            }else if(testifierName.value === ''){
              testMsg.innerHTML = 'Please enter your name!';
              testMsg.style.color ='red'

            }else if(testifierMsg.value.length < 70){
              testMsg.innerHTML = 'Message too shot please!';
              testMsg.style.color ='red'
            }else{
              this.disabled = true;
              xhr = new XMLHttpRequest();
              xhr.open('GET', __mpc_uri__() + 'functions/mpc-ajax-action.php?PERM=mpcTestimony&k='+testifierName.value + '&k1='+testifierMsg.value, true);
              xhr.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                  if(this.response == 'Testimony saved'){
                      testMsg.innerHTML = 'Thanks for having confidents in us!'
                  }else{
                    testMsg.innerHTML = this.response;
                    testimonyButton.disabled = false;
                  }
                }
              }
              xhr.send();
            }

      })

      document.title = 'TESTIMOIES - GOODLIFE MPCS UYO';
</script>

  <?php
    require_once dirname(__FILE__) .__MPC_GENERAL_PERMIT__. "foot.php";
?>

