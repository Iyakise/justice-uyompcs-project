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
	.mt-gly{
		margin-top: 7em;
	}
	._mpc-glry{
		width: 100%;
		height: auto;
	}

	.img-wrapper img{
		width: 100%;
		height: 100%;
		position: relative;
		border-radius: 10px;
	}
	.mpc-main-img{
		margin: 0 auto;
		width: 90%;
		height: 100%;
	}
	.img-wrapper{
		width: 100%;
		margin: 0 10px;
		height: 80vh;
	}

	.mpc-someText{
		top: 90%;
		position: absolute;
		z-index: 10;
		width: inherit;
		height: 15%;
		border-bottom-left-radius: 10px;
		border-bottom-right-radius: 10px;
		opacity: 0;
		transition: 0.5s linear;
	}

	.mpc-someText h3{
		font-size: 23px;
	}

	.mpc-main-img:hover .mpc-someText{
		opacity: 1;
	}
</style>

<div class="_mpc-glry mt-gly">
	<h2 class="text-center"><?php print ucwords(getSystemName($conn)[1])?> 2023 Annual general meeting</h2>

	<div class="owl-carousel owl-theme owl-default">
		<div class="item img-wrapper">
			<div class="mpc-main-img mpc-fancy-style">
					<img src="<?php echo __mpc_root__()?>asset/img/just1.jpg" srcset="<?php echo __mpc_root__()?>asset/img/just1.jpg">
					<div class="mpc-someText alert-success p-2">
						<h3>2023 Annual General meeting of the cooperative</h3>
					</div>
			</div>
		</div>

		<div class="item img-wrapper">
			<div class="mpc-main-img mpc-fancy-style">
					<img src="<?php echo __mpc_root__()?>asset/img/just2.jpg" srcset="<?php echo __mpc_root__()?>asset/img/just2.jpg">
					<div class="mpc-someText alert-success p-2">
						<h3>2023 Annual General meeting of the cooperative</h3>
					</div>
			</div>
		</div>

		<div class="item img-wrapper">
			<div class="mpc-main-img mpc-fancy-style">
					<img src="<?php echo __mpc_root__()?>asset/img/just3.jpg" srcset="<?php echo __mpc_root__()?>asset/img/just3.jpg">
					<div class="mpc-someText alert-success p-2">
						<h3>2023 Annual General meeting of the cooperative</h3>
					</div>
			</div>
		</div>

		<div class="item img-wrapper">
			<div class="mpc-main-img mpc-fancy-style">
					<img src="<?php echo __mpc_root__()?>asset/img/just4.jpg" srcset="<?php echo __mpc_root__()?>asset/img/just4.jpg">
					<div class="mpc-someText alert-success p-2">
						<h3>2023 Annual General meeting of the cooperative</h3>
					</div>
			</div>
		</div>

		<div class="item img-wrapper">
			<div class="mpc-main-img mpc-fancy-style">
					<img src="<?php echo __mpc_root__()?>asset/img/just5.jpg" srcset="<?php echo __mpc_root__()?>asset/img/just5.jpg">
					<div class="mpc-someText alert-success p-2">
						<h3>2023 Annual General meeting of the cooperative</h3>
					</div>
			</div>
		</div>

		<div class="item img-wrapper">
			<div class="mpc-main-img mpc-fancy-style">
					<img src="<?php echo __mpc_root__()?>asset/img/just7.jpg" srcset="<?php echo __mpc_root__()?>asset/img/just7.jpg">
					<div class="mpc-someText alert-success p-2">
						<h3>2023 Annual General meeting of the cooperative</h3>
					</div>
			</div>
		</div>

		<div class="item img-wrapper">
			<div class="mpc-main-img mpc-fancy-style">
					<img src="<?php echo __mpc_root__()?>asset/img/just8.jpg" srcset="<?php echo __mpc_root__()?>asset/img/just8.jpg">
					<div class="mpc-someText alert-success p-2">
						<h3>2023 Annual General meeting of the cooperative</h3>
					</div>
			</div>
		</div>

		<div class="item img-wrapper">
			<div class="mpc-main-img mpc-fancy-style">
					<img src="<?php echo __mpc_root__()?>asset/img/just9.jpg" srcset="<?php echo __mpc_root__()?>asset/img/just9.jpg">
					<div class="mpc-someText alert-success p-2">
						<h3>2023 Annual General meeting of the cooperative</h3>
					</div>
			</div>
		</div>

		<div class="item img-wrapper">
			<div class="mpc-main-img mpc-fancy-style">
					<img src="<?php echo __mpc_root__()?>asset/img/just10.jpg" srcset="<?php echo __mpc_root__()?>asset/img/just10.jpg">
					<div class="mpc-someText alert-success p-2">
						<h3>2023 Annual General meeting of the cooperative</h3>
					</div>
			</div>
		</div>

		<div class="item img-wrapper">
			<div class="mpc-main-img mpc-fancy-style">
					<img src="<?php echo __mpc_root__()?>asset/img/just11.jpg" srcset="<?php echo __mpc_root__()?>asset/img/just11.jpg">
					<div class="mpc-someText alert-success p-2">
						<h3>2023 Annual General meeting of the cooperative</h3>
					</div>
			</div>
		</div>

		<div class="item img-wrapper">
			<div class="mpc-main-img mpc-fancy-style">
					<img src="<?php echo __mpc_root__()?>asset/img/just12.jpg" srcset="<?php echo __mpc_root__()?>asset/img/just12.jpg">
					<div class="mpc-someText alert-success p-2">
						<h3>2023 Annual General meeting of the cooperative</h3>
					</div>
			</div>
		</div>

		<div class="item img-wrapper">
			<div class="mpc-main-img mpc-fancy-style">
					<img src="<?php echo __mpc_root__()?>asset/img/just13.jpg" srcset="<?php echo __mpc_root__()?>asset/img/just13.jpg">
					<div class="mpc-someText alert-success p-2">
						<h3>2023 Annual General meeting of the cooperative</h3>
					</div>
			</div>
		</div>

		<div class="item img-wrapper">
			<div class="mpc-main-img mpc-fancy-style">
					<img src="<?php echo __mpc_root__()?>asset/img/just14.jpg" srcset="<?php echo __mpc_root__()?>asset/img/just14.jpg">
					<div class="mpc-someText alert-success p-2">
						<h3>2023 Annual General meeting of the cooperative</h3>
					</div>
			</div>
		</div>

		<div class="item img-wrapper">
			<div class="mpc-main-img mpc-fancy-style">
					<img src="<?php echo __mpc_root__()?>asset/img/just15.jpg" srcset="<?php echo __mpc_root__()?>asset/img/just15.jpg">
					<div class="mpc-someText alert-success p-2">
						<h3>2023 Annual General meeting of the cooperative</h3>
					</div>
			</div>
		</div>

		<div class="item img-wrapper">
			<div class="mpc-main-img mpc-fancy-style">
					<img src="<?php echo __mpc_root__()?>asset/img/just16.jpg" srcset="<?php echo __mpc_root__()?>asset/img/just16.jpg">
					<div class="mpc-someText alert-success p-2">
						<h3>2023 Annual General meeting of the cooperative</h3>
					</div>
			</div>
		</div>

		<div class="item img-wrapper">
			<div class="mpc-main-img mpc-fancy-style">
					<img src="<?php echo __mpc_root__()?>asset/img/just17.jpg" srcset="<?php echo __mpc_root__()?>asset/img/just17.jpg">
					<div class="mpc-someText alert-success p-2">
						<h3>2023 Annual General meeting of the cooperative</h3>
					</div>
			</div>
		</div>




	</div>
</div>
<script>
	$(document).ready(function(){
		let itm;
		if(window.innerWidth <= 700){
		 itm = 1

	}else{
		 itm = 2;
	}
		$('.owl-carousel').owlCarousel({
			items: itm,
			loop: true,
			hoverpause: true,
			lazyload: true,
			autoplayTimeout:2000,
		})
	})

  document.title = "Gallery";

</script>
<?php 
    require_once dirname(__FILE__) .__MPC_GENERAL_PERMIT__. "foot.php";
?>