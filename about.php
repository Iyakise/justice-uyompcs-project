<?php
    define ('__mpc_connection__', '/config/'); //db connecntin define constant
    define('__MPC_GENERAL_PERMIT__', '/asset/inc-files/');
    
     require_once dirname(__FILE__) . __mpc_connection__. "conn.php";  
   // define('__MPC_GENERAL_PERMIT__', '/asset/inc-files/');
    
   // require_once dirname(__FILE__) . "/functions/mpc-func.php";
  // echo constant(__MPC_GENERAL_PERMIT__);
    require_once dirname(__FILE__) .__MPC_GENERAL_PERMIT__. "head.php";


   
?>
  <style>
    body{
      background: #e3edf7;
    }
  </style>
  <div class="mpc-faqs">
    <h2 class="text-center">About us - <?php print getSystemName($conn)[1]?></h2>
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
          __getPage__($conn, 3)[2] .
      "</div>";
?>
  </div>
  <script>
  document.title = "ABOUT US - <?php print getSystemName($conn)[1]?>";
</script>
<?php
require_once dirname(__FILE__) .__MPC_GENERAL_PERMIT__. "foot.php";
