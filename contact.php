<?php
    define ('__mpc_connection__', '/config/'); //db connecntin define constant
    define('__MPC_GENERAL_PERMIT__', '/asset/inc-files/');
    
     require_once dirname(__FILE__) . __mpc_connection__. "conn.php";  
   // define('__MPC_GENERAL_PERMIT__', '/asset/inc-files/');
    
   // require_once dirname(__FILE__) . "/functions/mpc-func.php";
  // echo constant(__MPC_GENERAL_PERMIT__);
    require_once dirname(__FILE__) .__MPC_GENERAL_PERMIT__. "head.php";
    require_once dirname(__FILE__) . '/functions/mpc-func.php';

?>
  <style>
    body{
      background: #e3edf7;
    }
  </style>
  <div class="mpc-faqs">
    <h2 class="text-center">Contact us</h2>

    
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

print "<div class=\"mpc-aligned\">".

         __getPage__($conn, 1)[2] .

        "</div>";

if(__mpc_contact_usStatus__($conn) == 'checked'){


?>
      <!--- CONTACT US FORM SHOW START HERE --->
      <!---->
      <div class="mpc-contact-usForm">
        <h2>Send us a message</h2>
        <div class="contactUs-formWrap">
          <form action="<?php echo __mpc_root__()?>mpc-mail.php" method="post">
          <div><input type="text" name="SenderName" placeholder="Name" class="contact-user" title="NAME"><i class="fa-solid fa-user-alt"></i></div>
          <div><input type="email" name="SenderEmail" placeholder="Email" class="contact-email " title="Email"><i class="fa-solid fa-envelope"></i></div>
          <div><input type="number" name="SenderPhone" placeholder="Phone" class="contact-phone " title="Phone"><i class="fa-solid fa-mobile-alt"></i></div>
          <div><input type="text" name="SenderSubject" placeholder="Subject" class="contact-subjext " title="Subject"><i class="fas fa-hands"></i></div>

          <div>
            <textarea class="Contact-usTextArea" name="SenderMessge" cols="30" rows="10" placeholder="Enter message"></textarea>
            <i class="fas fa-edit"></i>
            <p class="rtnMsg"></p>
          </div>

            <button class="mpc-btn mpc-btn-fullWidth mpc-contact-btn" type="button" name="sender-mpc-sendButton" style="margin-top:15px;width:30%;padding:10px;">Submit</button>
        </div>
        </form>
      </div>
  </div>
  <script>
     var inp1, inp2, inp3, inp4, inp5, inp6, button, rtn;

      button = document.querySelector('.mpc-contact-btn');

      button.addEventListener('click', function(){
        rtn = document.querySelector('.rtnMsg');
        inp1 = document.querySelector('.contact-user');
        inp2 = document.querySelector('.contact-email');
        inp3 = document.querySelector('.contact-phone');
        inp4 = document.querySelector('.contact-subjext');
       // inp5 = document.querySelector('.contact-subjext');
        inp6 = document.querySelector('.Contact-usTextArea');

          if(inp1.value == ''){
            rtn.innerHTML = 'Enter your name';
            inp1.style.borderBottom = '2px solid red';
          }else if(inp2.value == ''){
            rtn.innerHTML = 'Enter Email Address';
            inp2.style.borderBottom = '2px solid red';
            inp2.placeholder = 'Pls Enter your Email address here'
          }else if(inp3.value == ''){
            rtn.innerHTML = 'Enter phone';
            inp3.style.borderBottom = '2px solid red';
          }else if(inp4.value == ''){
            rtn.innerHTML = 'Enter message subject';
            inp4.style.borderBottom = '2px solid red';
          }else if(inp6.value == ''){
            rtn.innerHTML = 'Enter message please';
            inp6.style.borderBottom = '2px solid red';
          }else if(inp1.value.search(/[0-9],_!{?}<>.@#,]/i) !== -1){
            rtn.innerHTML = 'Invalid character in name field';
            //
            
          }else if(inp6.value.length < 50){
            rtn.innerHTML = 'Invalid message, Message is too short, minimum is 50!';
          }else if(inp2.value.search(/[@.]/) == -1){
            rtn.innerHTML = 'Invalid Email address, email address is missing "@."';
      
          }else if(inp3.value.length < 11 || inp3.value.length > 11){
            rtn.innerHTML = 'Invalid phone number, number should\'nt be more or less than 11 digit';
          }else {
            //clearout red borders
            inp1.style.borderBottom = '2px solid #ffffff';
            inp2.style.borderBottom = '2px solid #ffffff';
            inp3.style.borderBottom = '2px solid #ffffff';
            inp4.style.borderBottom = '2px solid #ffffff';
            inp6.style.borderBottom = '2px solid #ffffff';

            Sendq = "PERM=MPCconTACTUSKEY&ln="+inp1.value + '&mail='+inp2.value +'&phone='+inp3.value + '&subject='+inp4.value + '&msg=' +inp6.value;
            var xhr = new XMLHttpRequest();
                xhr.open('POST', __mpc_uri__() + 'functions/mpc-ajax-action.php', true);
                xhr.onreadystatechange = function(){
                  if(this.readyState == 4 && this.status == 200){
                    if(this.response == 'ContactUs saved'){
                      rtn.innerHTML = 'Thanks for contacting us, We will get back to you within 24Hrs.';
                      rtn.style.color = '#ffffff';
                    }else {
                      rtn.innerHTML = this.response;
                      rtn.style.color = '#ffffff';
                    }
                  }
                }
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.send(Sendq);

          }

          //inp6.value.replace(/['"</?!@#{}$^%&*()_-]/g, '');
      })
  </script>
  <?php }?>
  <script>
  document.title = "CONTACT US - <?php print getSystemName($conn)[1]?>";

</script>
<?php

require_once dirname(__FILE__) .__MPC_GENERAL_PERMIT__. "foot.php";