<?php
	//TRYING TO PROTECT THIS HEADER FILE
	if(!defined('__MPC_GENERAL_PERMIT__')) {
		die("<h1> Access denied.</h1>");
	}


    $socialLink = new SocialLink;
?>

<footer>
        <div class="mpc-main-footer">
            <div class="foot-section1 footsection">
                <div class="mpc-cmp-logo">
                    <div class="img-logo">
                        <img class="dboard-img" title="<?php echo getSystemName($conn)[0]?> LOGO" alt="<?php echo getSystemName($conn)[1]?> Logo" src="<?php echo __mpc_root__()?>asset/img/<?php echo $systemLogo->getSystemLogo($conn)[0]?>" srcset="<?php echo __mpc_root__()?>asset/img/<?php echo $systemLogo->getSystemLogo($conn)[0]?>">
                    </div>
                    <div class="mpc-abt-us">
                        <h4>Company Profile</h4>
                        <p>The Cooperative Society was established on 11<sup>th</sup> May, 2007 and began operations in July 2007 with 54 members. The Cooperative Society's activities are piloted by an elected management Committee and Council-of-inspection.</p>
                        <p>Justice (UYO) MPCS is under the supervision of the Akwa Ibom State Ministry of Justice.</p>

                       
                    </div>
                </div>
            </div>

            <div class="foot-section2 footsection">
            <ul>
                    <li style="--i:6;--clr:#1877f2;">
                        <a href="<?php echo __mpc_root__()?>contact" class="mpc-link">
                            <span><i class="far fa-comment-alt"></i></span> Contact
                        </a>
                    </li>

                    <li style="--i:5;--clr:#25d366;">
                        <a href="<?php echo __mpc_root__()?>about" class="mpc-link">
                            <span><i class="fas fa-user"></i></span> About us
                        </a>
                    </li>

                    <li style="--i:4;--clr:#c32aa3;">
                        <a href="#" class="mpc-link">
                            <span><i class="fas fa-blog"></i></span> Our blog
                        </a>
                    </li>

                    <li style="--i:3;--clr:#1da1f2;">
                        <a href="<?php echo __mpc_root__()?>testimonies" class="mpc-link">
                            <span><i class="fas fa-code"></i></span> Testimonies
                        </a>
                    </li>

                    <li style="--i:1;--clr:#0a66c2;">
                        <a href="<?php echo __mpc_root__()?>calculator" class="mpc-link">
                            <span><i class="fas fa-calculator"></i></span> Loan calculator
                        </a>
                    </li>

                    <li style="--i:2;--clr:#ff0000;">
                        <a href="<?php echo __mpc_root__()?>faqs" class="mpc-link">
                            <span><i class="fas fa-question"></i></span> faqs
                        </a>
                    </li>
                    
                    <li style="--i:2;--clr:#ff0000;">
                        <a href="<?php echo __mpc_root__()?>user/" class="mpc-link">
                            <span><i class="fas fa-user-group"></i></span> admin dashboard
                        </a>
                    </li>

                </ul>
            </div>

            <div class="foot-section3 footsection socialLinks">
                <ul>
                    <li style="--i:6;--clr:#1877f2;--m:Facebook;">
                        <a href="<?php print $socialLink->getSocialLinks($conn)[0]?>" class="mpc-link">
                            <span><i class="fa-brands fa-facebook-f"></i></span> Facebook
                        </a>
                    </li>

                    <li style="--i:5;--clr:#25d366;--m:Whatsapp;">
                        <a href="<?php print $socialLink->getSocialLinks($conn)[1]?>" class="mpc-link">
                            <span><i class="fa-brands fa-whatsapp"></i></span> Whatsapp
                        </a>
                    </li>

                    <li style="--i:4;--clr:#c32aa3;--m:Instagram;" class="instaG">
                        <a href="<?php print $socialLink->getSocialLinks($conn)[2]?>" class="mpc-link">
                            <span><i class="fa-brands fa-instagram"></i></span> instagram
                        </a>
                    </li>

                    <li style="--i:3;--clr:#1da1f2;--m:Twitter;">
                        <a href="<?php print $socialLink->getSocialLinks($conn)[3]?>" class="mpc-link">
                            <span><i class="fa-brands fa-twitter"></i></span> Twitter
                        </a>
                    </li>

                    <li style="--i:2;--clr:#ff0000;--m:Youtube;">
                        <a href="<?php print $socialLink->getSocialLinks($conn)[4]?>" class="mpc-link">
                            <span><i class="fa-brands fa-youtube"></i></span> Youtube
                        </a>
                    </li>

                    <li style="--i:1;--clr:#0a66c2;--m:LinkedIn;">
                        <a href="<?php print $socialLink->getSocialLinks($conn)[5]?>" class="mpc-link">
                            <span><i class="fa-brands fa-linkedin"></i></span> Linkedin
                        </a>
                    </li>

                </ul>
            </div>

        </div>
        Tr#h673@8o74
        <p class="mpc-foot-last">&copy; All right Reserved <?php echo getSystemName($conn)[0]?> <?php echo date('Y')?>.</p>
   </footer>

   <script src="<?php echo __mpc_root__()?>script/jquery.min.js" type="text/javascript"></script>
	<script src="<?php echo __mpc_root__()?>script/all.min.js" type="text/javascript"></script>
	<script src="<?php echo __mpc_root__()?>script/owl.carousel.js" type="text/javascript"></script>
	<script src="<?php echo __mpc_root__()?>script/owl.navigation.js" type="text/javascript"></script>
	<script src="<?php echo __mpc_root__()?>script/owl.autoplay.js" type="text/javascript"></script>
	<script src="<?php echo __mpc_root__()?>script/owl.animate.js" type="text/javascript"></script>
	<script src="<?php echo __mpc_root__()?>script/owl.video.js" type="text/javascript"></script>
	<script src="<?php echo __mpc_root__()?>script/owl.lazyload.js" type="text/javascript"></script>
	<script src="<?php echo __mpc_root__()?>script/owl.autorefresh.js" type="text/javascript"></script>
	<script src="<?php echo __mpc_root__()?>script/mpc-memb-script.min.js?v=0.0.1"></script>


        <script type="text/javascript">
            var clickBar, change, item1;

            clickBar = document.querySelector('.mpc-toggler');
            clickBar.addEventListener('click', () => {

                change = document.querySelector('.mpc-toggler svg');
                item1 = document.querySelector('.header ul');
                if(change.classList.contains('fa-bars')){
                    change.classList.remove('fa-bars');
                    change.classList.add('fa-xmark');

                    item1.style.display = 'flex';
                }else {
                    change.classList.remove('fa-xmarks');
                    change.classList.add('fa-bars');

                    item1.style.display = 'none';
                }   
            })
        </script>
    </body>
</html>
