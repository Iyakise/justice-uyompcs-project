<?php
    define ('__mpc_connection__', '/config/'); //db connecntin define constant
    define('__MPC_GENERAL_PERMIT__', '/asset/inc-files/');
    
     require_once dirname(__FILE__) . __mpc_connection__. "conn.php";   
   // require_once dirname(__FILE__) . "/functions/mpc-func.php";
  // echo constant(__MPC_GENERAL_PERMIT__);
    require_once dirname(__FILE__) .__MPC_GENERAL_PERMIT__. "head.php";
?>
  <style>
    body{
      background: #e3edf7;
    }
    .err{
        color: #ff0000;
        font-weight: 400;
        font-family: sans-serif;
    }
    .succ{
        color: green;
        font-weight: 800;
        font-family: sans-serif;
    }
  </style>
  <div class="mpc-loan-calculator">
    <h2 class="text-center">JUSTICE (UYO) MPCS CALCULATOR</h2>
    <div class="mpc-loan-calc-container">
        <div class="mpc-loan-calc-padd mpc-fancy-style">
            <div class="mpc-calc-top ">
                <h4>Loan calculator</h4>

                <div class="mpc-calc-input">
                    <div class="mpc-inp1">
                        <h6>Amount</h6>
                        <input type="number" placeholder="E.g &#8358; 2000" class="setStyle createLoanInput LoanType SetAmount" title="Loan Amount">
                    </div>

                    <div class="mpc-inp1">
                        <h6>Interest Rate</h6>
                        <select class="adm-select Loan-interest-rate" step=".1">
                            <option value="">----</option>
                            <?php  __mpc_get_IntrestRate__($conn, 'options');?>
                        </select>
                        <i class="mpc-rate-charge" style="display:block"></i>
                    </div>

                    <div class="mpc-inp1">
                        <h6>Loan Tenure</h6>
                        <input type="number" title="Repayment month E.G 10 " placeholder="Loan tenure" step="1" class="setStyle createLoanInput LoanType repayment">
                    </div>
                </div>
            </div>

            <div class="mpc-rtn-calc">
                <div class="mpc-cal-result1">
                    <i>Company Interest.</i>
                    <h6 class="companyIntrest"></h6>
                </div>

                <div class="mpc-cal-result1">
                    <i>Monthy repayment</i>
                    <h6 class="mpc-monthlyPayment"></h6>
                </div>

                <div class="mpc-cal-result1">
                    <i>Amount</i>
                    <h6 class="borrowedAmount"></h6>
                </div>
            </div>

            <div class="calc-button-mpc">
            <hr>
                <button class="mpc-btn calculate-loan">Calculate</button>
            </div>
        </div>
    </div>
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
//__mpc_faqs__($conn);
      ?>

      <script>
        document.title = 'Loan calculator - GOODLIFE UYO MPCS';
      </script>
  </div>


<script src="<?php echo __mpc_root__()?>script/calculator.js"></script>
<?php

require_once dirname(__FILE__) .__MPC_GENERAL_PERMIT__. "foot.php";