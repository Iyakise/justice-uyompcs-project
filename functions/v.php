<?php

if(isset($_GET['checkLoginCookie']) && $_GET['checkLoginCookie'] !== '' && $_GET['checkLoginCookie'] == 'Admlogin') {
    if(isset($_COOKIE['__MPC_LOGIN__'])) {
        
        echo json_encode($_COOKIE['__MPC_LOGIN__']); //cookie value return to json
    }else {
        echo json_encode ('sessionXPIRES');
    }

}

if(isset($_GET['AdmIp']) && !empty($_GET['AdmIp']) && $_GET['AdmIp'] == '') {
    session_start(); //we are starting session here to get admin session login ip address
    $sessionIp = $_SESSION['MPC_ADMIN_LOGIN_IP_AS'];
    $cookieIp = $_COOKIE['__MPC-ADM-IP__']; //getting admin login ip address

    if($sessionIp !== $cookieIp) {
        echo json_encode('IP CHANGE');
    }else {
        echo json_encode('IP NOT CHANGE');
    }
}

  //function that check admin query what admin is trying to do
  if(isset($_GET['q']) && $_GET['q'] !== '') {
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant
    /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once dirname(__DIR__) ."/functions/mpc-func.php";

    if($_GET['q'] == 'profile') {
      session_start(); // try to get the information of current user trying to access this page
      $id = $_SESSION['MPC_ADMIN_LOGIN_ID_AS'];

      $usrname = $_SESSION['MPC_ADMIN_LOGIN_USR_AS'];
      $prev = $_SESSION['MPC_ADMIN_LOGIN_PRV_AS'];
      $sq = $_SESSION['MPC_ADMIN_LOGIN_SQ_AS'];

        //$q = $_GET['q']; //query string from admin data

        $sql = "SELECT * FROM mpc_user WHERE user_id=? /*&& user_username=?*/";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
          $Err = 'Unexpected error, while loading admin information, if this error persist too long please contact system developer...';
          $Err.= __mpcDeveloper__()[0];
          $Err.= __mpcDeveloper__()[1];
          $Err.= __mpcDeveloper__()[2];
          $Err.= __mpcDeveloper__()[3];
          $Err.= __mpcDeveloper__()[4];
          echo $Err;
          exit();
        }
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $d = mysqli_stmt_get_result($stmt);
        $data = mysqli_fetch_array($d); //bind all result to this variable
        if($data['user_previllege'] == 1){
          $n = 'Super Admin';
        }else if($data['user_previllege'] == 2){
          $n = 'Admin';
        }else if($data['user_previllege'] == 3){
          $n = 'Editor';
        }else {
          $n = 'Pending';
        }
        ?>
          <div class="table-responsive">
            <table class="table table-bordered table-striped table-hovered">
              <tr>
                <td>#</td>
                <td>Firstname</td>
                <td>Lastname</td>
                <td>username</td>
                <td>previllege</td>
                <td>profile</td>
              </tr>
              <tr>
                <td><?php echo $data['user_id']?></td>
                <td><?php echo $data['user_fname']?></td>
                <td><?php echo $data['user_lname']?></td>
                <td><?php echo $data['user_username']?></td>
                <td><?php echo $n ?></td>
                <td><img class="dboard-img" src="<?php echo __mpc_root__()?>asset/img/<?php echo $data['user_profile']?>" srcset="<?php echo __mpc_root__()?>asset/img/<?php echo $data['user_profile']?>" alt="" title="<?php echo $data['user_fname']. ' '. $data['user_lname'];?>"></td>

                
              </tr>
            </table>
          </div>
        <?php
    }
  }
