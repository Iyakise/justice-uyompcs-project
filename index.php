<?php
    define('__MPC_GENERAL_PERMIT__', '/asset/inc-files/');
    define('__mpc_connection__', '/config/conn');
    
   // require_once dirname(__FILE__) . "/functions/mpc-func.php";
  // echo constant(__MPC_GENERAL_PERMIT__);
      require_once dirname(__FILE__) .__mpc_connection__. ".php";
    require_once dirname(__FILE__) .__MPC_GENERAL_PERMIT__. "head.php";
?>

   <main class="main">
        <div class="owl-carousel owl-theme">

            <div class="mpc-wl-100 item">
                <div class="mpc-img-wrap ">
                    <img src="<?php echo __mpc_root__()?>asset/img/bg6.jpg" alt="">
                    <div class="mpc-img-top-cover">
                        

                        <!-- paste start here-->
                            <div class="content-info">
                            
                                <div class="content">
                                    <h1><?php print getSystemName($conn)[1]?>  </br>Uyo Aks.</h1>

                                    <h4>Create <span class="-mpc-item"></span> account with us</h4>
                                </div>

                                <div class="mpc-img">
                                    <a href="<?php echo __mpc_root__()?>login.php/" class="btn">Login</a>
                                </div>

                            </div>
                        <!--paste end here-->
                    </div>
                </div>
            </div>

            <div class="mpc-wl-100 item">
                <div class="mpc-img-wrap ">
                    <img src="<?php echo __mpc_root__()?>asset/img/bg7.jpg" srcset="<?php echo __mpc_root__()?>asset/img/bg7.jpg">
                    <div class="mpc-img-top-cover">
                        

                        <!-- paste start here-->
                            <div class="content-info">
                            
                                <div class="content">
                                    <h1>Promoting economic well-being</br> of members.</h1>

                                    <h4>Create<span class="-mpc-item"></span> account with us</h4>
                                </div>

                                <div class="mpc-img">
                                    <a href="<?php echo __mpc_root__()?>login.php/" class="btn">Login</a>
                                </div>

                            </div>
                        <!--paste end here-->
                    </div>
                </div>
            </div>

            <div class="mpc-wl-100 item">
                <div class="mpc-img-wrap ">
                    <img src="<?php echo __mpc_root__()?>asset/img/bg6.jpg" srcset="<?php echo __mpc_root__()?>asset/img/bg6.jpg">
                    <div class="mpc-img-top-cover">
                        

                        <!-- paste start here-->
                            <div class="content-info">
                            
                                <div class="content">
                                    <h1>Track your loan </br>application status.</h1>

                                    <h4>Create <span class="-mpc-item"></span> account with us</h4>
                                </div>

                                <div class="mpc-img">
                                    <a href="<?php echo __mpc_root__()?>login.php/" class="btn">Login</a>
                                </div>

                            </div>
                        <!--paste end here-->
                    </div>
                </div>
            </div>

            <div class="mpc-wl-100 item">
                <div class="mpc-img-wrap ">
                    <img src="<?php echo __mpc_root__()?>asset/img/ln-calc.jpg" alt="">
                    <div class="mpc-img-top-cover">
                        

                        <!-- paste start here-->
                            <div class="content-info">
                            
                                <div class="content">
                                    <h1>Get loan @ 10% </br>interest rate.</h1>

                                    <h4>We operate <span class="-mpc-item"></span></h4>
                                </div>

                                <div class="mpc-img">
                                    <a href="<?php echo __mpc_root__()?>contact.php/" class="btn">Contact us.</a>
                                </div>

                            </div>
                        <!--paste end here-->
                    </div>
                </div>
            </div>
        </div>
   </main>

   <section>
        <div class="mpc-sec1">
            <div class="div-mpc-1item mpc-min-width shadow">
                <img src="<?php echo __mpc_root__()?>asset/img/phone-r.png" title="GOODLIFE MPC UYO" alt="phone reciept" class="mpc-phon-receipt" srcset="<?php echo __mpc_root__()?>asset/img/phone-r.png">
            </div>

            <div class="div-mpc-1item mpc-big-width shadow mpc-sm-radius">
                 <h1 class="msg-abt">About <?php print getSystemName($conn)[1]?></h1>
                    <p><?php print getSystemName($conn)[1]?> was established in 2007 with the aim of: </p>
                    <p>1. Promoting the economic well-being of her members</p>
                    
                    <p>2. Encouraging and strengthening the spirit of self help and mutual help.</p>
                    <p>3. Assisting members in accuiring assets and prepare for a happy retirement.</p>

                    <!-- <h5>HOW WE OPERATE</h5> -->
                <p>Membership into the cooperative is being restricted to staff of the Ministry of Justice. However, staff of the other ministries may be admitted into the Cooperative provided he/she gets a recommendation from the Permanent Secretary to so join from his/her ministry.</p>

                <a href="<?php echo __mpc_root__()?>about.php/" class="btn">Read more</a>
            </div>
        </div>
   </section>

    <section>
        <div class="mpc-3-wrapper">

            <div class="mpc-3-inOne shadow mpc-flex">
                <div class="counter-wrap">
                    <h2 class="count mpc-counter monthlloan">0</h2>
                    <h5>Monthly loan disbursement</h5>
                </div>
            </div>

            <div class="mpc-3-inOne shadow mpc-flex">
                <div class="counter-wrap">
                    <h2 class=" mpc-counter"><span class="count total-members">0</span></h2>
                    <h5>Members</h5>

                </div>
            </div>

            <div class="mpc-3-inOne shadow mpc-flex">
                <div class="counter-wrap">
                    <h2 class="count mpc-counter special-requests">0</h2>
                    <h5>Special Requests</h5>

                </div>
            </div>

        </div>
    </section>


<script type="module">
    import {  getTotalMembersAndLoan, selector } from '<?php echo __mpc_root__()?>script/api.js';


    const totalMembersElement = selector('.total-members');
    const totalLoansElement = selector('.monthlloan');
    const totalSpecialLoansElement = selector('.special-requests');
    let data = await getTotalMembersAndLoan();

    console.log(totalMembersElement, totalLoansElement, totalSpecialLoansElement);

    if(data.status){
        totalMembersElement.innerHTML = data.total_members;
        totalLoansElement.innerHTML = data.total_loans;
        totalSpecialLoansElement.innerHTML = data.total_special_loans;
        // console.log(data);
    } else {
        totalMembersElement.textContent = '0';
        totalLoansElement.textContent = '0';
        totalSpecialLoansElement.textContent = '0';
    }

</script>
    <section>
        <!--h3 class="mpc-happy-client">Happy customer</h3-->

        <!--start here-->
    
        <!--end here-->
        <!--div class="mpc-testimonies-wrapper">
            <div class="mpc-test-wrap-inner mpc-go-flex owl-carousel">
                <div class="mpc-testi item">
                    <i class="fa-quote-left fas fa-3x"></i>

                    <p>
                        Our weight management programme is unique to suit your workers who are most times involved in sitting down for longer period to do their work, which in the long run increase weight indiscriminately and impact health negatively.
                    </p>

                    <span class="mpc-testifierName">Mighty R. Asuquo, CEO FIRST-RATE DEV</span>
                </div>

                <div class="mpc-testi item">
                    <i class="fa-quote-left fas fa-3x"></i>

                    <p>
                        Our weight management programme is unique to suit your workers who are most times involved in sitting down for longer period to do their work, which in the long run increase weight indiscriminately and impact health negatively.
                    </p>

                    <span class="mpc-testifierName">shedrach R. Meshack, CEO FIRST-RATE DEV</span>
                </div>

                <div class="mpc-testi item">
                    <i class="fa-quote-left fas fa-3x"></i>

                    <p>
                        Our weight management programme is unique to suit your workers who are most times involved in sitting down for longer period to do their work, which in the long run increase weight indiscriminately and impact health negatively.
                    </p>

                    <span class="mpc-testifierName">Paul R. Asuquo, CEO FIRST-RATE DEV</span>
                </div>

                <div class="mpc-testi item">
                    <i class="fa-quote-left fas fa-3x"></i>

                    <p>
                        Our weight management programme is unique to suit your workers who are most times involved in sitting down for longer period to do their work, which in the long run increase weight indiscriminately and impact health negatively.
                    </p>

                    <span class="mpc-testifierName">Iyakise R. ETIM, CEO FIRST-RATE DEV</span>
                </div>
            </div>
        </div-->
    </section>

   <script src="https://unpkg.com/typed.js@2.0.132/dist/typed.umd.js"></script>
   

   
    <script>
        // $(document).ready(function(){
        //     $('.count').each(function(){
        //         $(this).prop('counter', 0).animate({
        //             counter: $(this).text()
        //         }, {
        //             duration:60000,
        //             //easing: swing,
        //             step: function(now){
        //                 $(this).text(Math.ceil(now));
        //             }
        //             });
        //         });
        // })
        
        var img, txt, x, txtr;
        img = document.getElementsByClassName('testi-IMG');
        txt = document.getElementsByClassName('user-text');
        


var typed = new Typed('.-mpc-item', {
    strings: ['1 Percent intrest rate', 'thrift savings', 'welfare savings', 'fixed deposit account'],
    typeSpeed: 100,
    backSpeed:100,
    loop: true
});
    </script>

<?php
    require_once dirname(__FILE__) .__MPC_GENERAL_PERMIT__. "foot.php";
?>