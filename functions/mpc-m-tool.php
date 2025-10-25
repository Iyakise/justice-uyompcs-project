<?php
if(!defined('MPC-AUTORIZE-CALL')) {
    die("<h1>ACCESS DENIED</h1>");
}
?>
<!-- <script type="module">


    
</script> -->
<style>
    .iyakise-2025{
        background:transparent !important;
    }
</style>

<?php
if(isset($_GET['action']) && !empty($_GET['action'])){
    //define('__mpc_connection__', '');
    require_once dirname(__DIR__). "/config/conn.php";
    if($_GET['action'] === 'dashboard'){
        ?>
            <i class="mpcMsg">Welcome <?php echo $uidName?></i>
            <hr class="mpcHr">
            <div class="mpc-dashboard-data-wrap">
                <div class="mpc-db-data-one shadow">
                    <div class="db-iconsWrap">
                        <i class="fas fa-money-check fa-3x"></i>
                    </div>
                    <div class="db-title" title="SHARES ACCOUNT ">
                        <h6>SHARES: &#8358; <?php //echo __mpc_getMember_balance__($conn, $uidId, $uidPhone, 'mpc_account_shares', 'shares_member_id', 'shares_member_phone')[2]?>
                        <?php echo __mpcMemberAccountBal__($conn, 'mpc_account_shares', $uidId, $uidPhone, 'shares_member_id', 'shares_member_phone', 'shares_id')[2]?>
                        </h6>
                        
                    </div>
                </div>

                <div class="mpc-db-data-one shadow">
                    <div class="db-iconsWrap">
                        <i class="fas fa-money-check fa-3x"></i>
                    </div>
                    <div class="db-title" title="THRIFT SAVING">
                        <h6>THRIFT: &#8358; <?php echo __mpc_getMember_balance__($conn, $uidId, $uidPhone, 'mpc_thrift_saving', 'thrift_mem_id	', 'thrift_mem_phone')[2]?></h6>
                        
                    </div>
                </div>

                <div class="mpc-db-data-one shadow">
                    <div class="db-iconsWrap">
                        <i class="fas fa-money-check fa-3x"></i>
                    </div>
                    <div class="db-title" title="SPECIAL SAVING">
                        <h6>SPECIAL: &#8358; <?php echo __mpc_getMember_balance__($conn, $uidId, $uidPhone, 'mpc_special_saving', 'mem_id', 'mem_phone')[2]?></h6>
                        
                    </div>    
                </div>

                <!-- PASTE START HERE-->
                <div class="mpc-db-data-one shadow">
                    <div class="db-iconsWrap">
                        <i class="fas fa-money-check fa-3x"></i>
                    </div>
                    <div class="db-title" title="WELFARE CONTRIBUTIONS">
                        <h6>WELFARE: &#8358; <?php echo __mpc_getMember_balance__($conn, $uidId, $uidPhone, 'mpc_welfare_contribution', 'welfare_mem_id', 'welfare_mem_phone')[2]?></h6>
                        
                    </div>
                </div>

                <div class="mpc-db-data-one shadow">
                    <div class="db-iconsWrap">
                        <i class="fas fa-money-check fa-3x"></i>
                    </div>
                    <div class="db-title" title="FIXED DEPOSIT ACCOUNT">
                        <h6>FIXED DEPOSIT: &#8358; <?php echo __mpc_getMember_balance__($conn, $uidId, $uidPhone, 'mpc_fixed_deposit', 'fixed_mem_id', 'fixed_mem_phone')[2]?></h6>
                        
                    </div>
                </div>

                <div class="mpc-db-data-one shadow">
                    <div class="db-iconsWrap">
                        <i class="fas fa-balance-scale fa-3x"></i>
                    </div>
                    <div class="db-title" title="LOAN">
                        <h6>LOAN BALANCE: &#8358; <strong class="__xcessData">0.00</strong></h6>
                        
                    </div>    
                </div>
                <!--PASTE END HERE -->

                <div class="mpc-db-data-one shadow">
                    <div class="db-iconsWrap">
                        <i class="fas fa-right-left fa-3x"></i>
                    </div>
                    <div class="db-title" title="Transfer cash to Member">
                        <h6><a href="<?php echo __mpc_root__()?>dashboard.php/?action=transfer" style="color:rgb(225, 145, 24);text-decoration:none;">Transfer cash</a></h6>
                    </div>
                </div>

                <div class="mpc-db-data-one shadow">
                    <div class="db-iconsWrap">
                        <i class="fas fa-money-bill fa-3x"></i>
                    </div>
                    <div class="db-title" title="Repay Loan">
                        <h6>Repay Loan</h6>
                    </div>
                </div>

                <div class="mpc-db-data-one shadow">
                    <div class="db-iconsWrap">
                        <i class="fas fa-money-bill fa-3x"></i>
                    </div>
                    <div class="db-title _invoker_xdc" title="Repay Loan" style="cursor:pointer;">
                        <h6>Loan Transactions</h6>
                    </div>
                </div>
            </div>

            <!-- <div class="mpc-mem-transaction-history">
                <div class="transactionHistory-top">
                    <h5 class="mpc-t-history">Transactions History</h5>
                    <select class="adm-select LoanType member-select mpc-MemDisabled ttrans-type-mpc" title="CHECK TRANSACTION TYPE">
                        <option value="">----</option>
                        <option value="CR">Credit</option>
                        <option value="DR">Debit</option>
                    </select>
                </div> -->

                <div class="mpc-m-transList table-responsive dasdasd dasdadfffsa">
                    <div class="recent-transactionss ss">

                        <h3>Recent Transactions</h3>

                        <!-- Shares -->
                        <div class="transaction-card">
                            <h4><i class="icon">💰</i> Account Shares</h4>
                            <div class="transaction-list" id="shares-list">
                            <!-- JS will inject 5 recent shares transactions here -->
                            <div class="transaction-item">
                                <span class="type credit">+ ₦2,000</span>
                                <span class="balance">Bal: ₦5,000</span>
                                <span class="date">2025-10-19</span>
                            </div>
                            </div>
                        </div>

                        <!-- Thrift -->
                        <div class="transaction-card">
                            <h4><i class="icon">🏦</i> Thrift Savings</h4>
                            <div class="transaction-list" id="thrift-list">
                            <!-- JS will inject thrift transactions -->
                            </div>
                        </div>

                        <!-- Special Savings -->
                        <div class="transaction-card">
                            <h4><i class="icon">⭐</i> Special Savings</h4>
                            <div class="transaction-list" id="special-list">
                            <!-- JS will inject special transactions -->
                            </div>
                        </div>
            <script type="module">
                const id = "<?=$uidId?>";
                const ph = "<?=$uidPhone?>";
                var shares = document.querySelector('#shares-list');
                var thrifts = document.querySelector('#thrift-list');
                var special = document.querySelector('#special-list');


                import * as api from "../script/api.js";
                
                let recent5 = await api.recent5each(__mpc_uri__(), id, ph);
                let lastTransactions = recent5.recent_transactions;
                let signA, signB, signC;

                if(!'shares' in lastTransactions && lastTransactions.shares.length === 0){
                    shares.innerHTML = 'No recents shares transaction';
                }else{
                    shares.innerHTML = ''; //Clearout recent data
                    lastTransactions.shares.forEach((share, i) => {
                        if(share.credit > share.debit){
                            signA = 'credit';
                            signB = '+';
                            signC = share.credit;
                        }else {
                            signA = 'debit';
                            signB = '-';
                            signC = share.debit;
                        }
                        let wraper = document.createElement('div');
                            wraper.className = 'transaction-item';
                            wraper.innerHTML =  `
                                <span class="type ${signA}">${signB} ₦${signC}</span>
                                <span class="balance">Bal: ₦${share.balance}</span>
                                <span class="date">${share.date_time}</span>
                            `;
                        shares.appendChild(wraper);
                    })
                }

                //trift savings
                if(!'thrift' in lastTransactions && lastTransactions.thrift.length === 0){
                    special.innerHTML = 'No recents Thrift transaction';
                }else{
                    special.innerHTML = ''; //Clearout recent data
                    lastTransactions.special.forEach((share, i) => {
                        if(share.credit > share.debit){
                            signA = 'credit';
                            signB = '+';
                            signC = share.credit;
                        }else {
                            signA = 'debit';
                            signB = '-';
                            signC = share.debit;
                        }
                        let wraper = document.createElement('div');
                            wraper.className = 'transaction-item';
                            wraper.innerHTML =  `
                                <span class="type ${signA}">${signB} ₦${signC}</span>
                                <span class="balance">Bal: ₦${share.balance}</span>
                                <span class="date">${share.date_time}</span>
                            `;
                        special.appendChild(wraper);
                    })
                }


                 //special savings
                if(!'special' in lastTransactions && lastTransactions.special.length === 0){
                    thrifts.innerHTML = 'No recents special transaction';
                }else{
                    thrifts.innerHTML = ''; //Clearout recent data
                    lastTransactions.thrift.forEach((share, i) => {
                        if(share.credit > share.debit){
                            signA = 'credit';
                            signB = '+';
                            signC = share.credit;
                        }else {
                            signA = 'debit';
                            signB = '-';
                            signC = share.debit;
                        }
                        let wraper = document.createElement('div');
                            wraper.className = 'transaction-item';
                            wraper.innerHTML =  `
                                <span class="type ${signA}">${signB} ₦${signC}</span>
                                <span class="balance">Bal: ₦${share.balance}</span>
                                <span class="date">${share.date_time}</span>
                            `;
                        thrifts.appendChild(wraper);
                    })
                }

            </script>

<style>
.recent-transactionss {
  max-width: 650px;
  margin: 20px auto;
  background: #fff;
  border-radius: 16px;
  padding: 20px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.08);
  font-family: 'Segoe UI', Tahoma, sans-serif;
}

.recent-transactionss h3 {
  text-align: center;
  color: #333;
  font-weight: 600;
  margin-bottom: 15px;
}

.transaction-card {
  border: 1px solid #f1f1f1;
  border-radius: 12px;
  padding: 15px;
  margin-bottom: 15px;
  background: #fafafa;
  transition: all 0.3s ease;
}

.transaction-card:hover {
  background: #fefefe;
  box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

.transaction-card h4 {
  display: flex;
  align-items: center;
  font-size: 16px;
  color: #444;
  margin-bottom: 10px;
}

.transaction-card .icon {
  margin-right: 8px;
  font-size: 18px;
}

.transaction-list {
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.transaction-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background: #fff;
  border-radius: 10px;
  padding: 8px 12px;
  border: 1px solid #eee;
  transition: background 0.3s;
}

.transaction-item:hover {
  background: #f9f9f9;
}

.transaction-item .type {
  font-weight: 600;
}

.transaction-item .credit {
  color: #00a65a;
}

.transaction-item .debit {
  color: #e74c3c;
}

.transaction-item .balance {
  color: #555;
  font-size: 14px;
}

.transaction-item .date {
  color: #999;
  font-size: 13px;
}

</style>
                    </div>
                </div>
            </div>
            <script>
                // var transtype, rtnTable, val, xhr, ph, id, cnt;

                    // transtype = document.querySelector('.ttrans-type-mpc');
                    // transtype.addEventListener('change', function(){
                    // rtnTable = document.querySelector('.mpc-m-transList');
                    // cnt = document.querySelector('.Usr-rtn'); //getting member phone numbeerr and id
                    // id = cnt.getAttribute('mpcmemberid');
                    // ph = cnt.getAttribute('mpcmemberphone');
                        
                    //     if(this.value !== ''){
                    //         val = this.value;
                    //         //send ajax request
                    //         xhr = new XMLHttpRequest();
                    //         xhr.open('GET', __mpc_uri__() + 'functions/mpc-mem-ajax.php?Tperm=MpcYakise&val=' +val+'&phone='+ph + '&id='+id, true);
                    //         xhr.onreadystatechange = function(){
                    //             if(this.readyState == 4 && this.status == 200){
                    //                 rtnTable.innerHTML = this.response;
                    //             }
                    //         }
                    //         xhr.send();
                    //     }
                    // })
                    
            </script>

            <script type="module">
                const id = "<?=$uidId?>";
                const ph = "<?=$uidPhone?>";
                var updater = document.querySelector('.__xcessData');
                import * as api from "../script/api.js";
                
                let ddata = await api.getLoanTransaction(__mpc_uri__(), id, ph);

                    if(ddata.data.current_balance !== null){
                        updater.innerHTML = ddata.data.current_balance;
                    }else{
                        updater.innerHTML = '0.00';
                    }

                document.querySelector('._invoker_xdc').addEventListener('click', function(){
                    let style = {
                        width:'50%',
                        height:'70%',
                        overflowY: 'auto',
                        background:'#fff'
                    };
                    api.newPopup('', style, async ()=>{
                        let memberSecret = await api.getLoanTransaction(__mpc_uri__(), id, ph);
                        let recentData   = await api.getRecent(__mpc_uri__(), id, ph);
                       
                        let dwrap = document.querySelector('.popContentWrap');
                            // console.log(memberSecret);
                               dwrap.innerHTML = `
                                    <h2 class="sticky-top bg-white p-2">Loan Balance: &#8358; ${memberSecret.data.current_balance}</h2>
                                    <hr class="mpcHr">

    <div class="_dtn_wraper">
        <div class="recent-transactions">
            <div class="transaction-card">
                <h3>Transaction #1012</h3>
                <p class="amount debit">Debit: ₦2,000</p>
                <p class="amount credit">Credit: ₦0</p>
                <p class="amount balance">Balance: ₦3,000</p>
                <p class="date">Date: 2025-10-20</p>
            </div>
            <!-- repeat for others -->


        </div>

    </div>
<style>
.recent-transactions {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
  gap: 1.2rem;
  padding: 1.2rem;
  background: #f8f9fa;
  border-radius: 12px;
}

.transaction-card {
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
  padding: 1rem 1.2rem;
  transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.transaction-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 6px 14px rgba(0, 0, 0, 0.1);
}

.transaction-card h3 {
  font-size: 1.1rem;
  color: #222;
  margin-bottom: 0.3rem;
}

.transaction-card .amount {
  font-weight: 600;
  font-size: 1.2rem;
}

.transaction-card .debit {
  color: #e74c3c;
}

.transaction-card .credit {
  color: #27ae60;
}

.transaction-card .balance {
  color: #2980b9;
}

.transaction-card .date {
  font-size: 0.85rem;
  color: #666;
  margin-top: 0.5rem;
}
@media (max-width:768px){
    .popContentWrap {
        width:90% !important;
    }
}
@media (max-width: 600px) {
  .recent-transactions {
    grid-template-columns: 1fr;
    padding: 0.8rem;
  }
  .transaction-card {
    padding: 1rem;
  }
}

</style>
`;

        
let cencet = document.querySelector('.recent-transactions');     
if('data' in recentData && recentData.data.length !== 0){
    cencet.innerHTML = '';
    
    recentData.data.forEach((data, i) => {
        let wrapper = document.createElement('div');
            wrapper.className = 'recent-transactions';

            wrapper.innerHTML = `
                <div class="transaction-card">
                    <h3>Transaction #000${data.id}</h3>
                    <p class="amount debit">Debit: ₦${data.debit}</p>
                    <p class="amount credit">Credit: ₦${data.credit}</p>
                    <p class="amount balance">Balance: ₦${data.balance}</p>
                    <p class="date">Date: ${data.trans_date}</p>
                </div>
            `;
        cencet.appendChild(wrapper);
    })
}else{
        cencet.innerHTML = '<strong>No data found.</strong>';
}                              
                    });
                });

            </script>


        <?php
    }else if($_GET['action'] == 'transfer'){
        ?>
            <i class="mpcMsg">Make Transfer, <?php echo $uidName?></i>
            <hr class="mpcHr">
            <select class="LoanType adm-select mpc-TransferType member-select mpc-MemDisabled mpc-disabled" title="Transaction type" mpcMemTransId="<?php echo $uidId?>" mpcMemTransPh="<?php echo $uidPhone?>">
                <option value="">----</option>
                <option value="mpc-self">Transfer to Self</option>
                <option value="mpc-member">MPCS Member</option>
            </select>

            <select class="LoanType adm-select mpc-TransferType-account member-select mpc-MemDisabled mpc-disabled" title="TRANSFERED ACCOUNT" id="">
                <option value="">----</option>
        <?php
                /**MPC MEMBER ACCOUNT FETCH */
                __mpc_getAccountBalance__($conn, $uidId, $uidPhone);
        ?>
            </select>
            <span class="mpcMemberAvailableBalance" title="AVAILABLE BALANCE">
                &#8358;<i class="mpcMainBal">0</i>
            </span>


            <div class="mpc-memberAccountBalance">
                <div class="rtnData">
                    <input type="text" title="ENTER ACCOUNT NUMBER" placeholder="Account Number" class="createLoanInput MemberAccountNumber mpc-MemberShop mpc-disabled">
                    <select class="mpc-disabled adm-select LoanType mpc-MemDisabled creditAccountType" title="SELECT DESTINATION ACCOUNT TYPE">
                        <option value="">----</option>
                        <option value="SHARES">SHARES ACCOUNT</option>
                        <option value="FIXED">FIXED DEPOSIT</option>
                        <option value="SPECIAL">SPECIAL SAVING</option>
                        <option value="THRIFT">THRIFT SAVING</option>
                        <option value="WELFARE">WELFARE CONTRIBUTIONS</option>
                    </select>
                    <div class="mpc-dataRtn">
                        <i class="rtnAccountName" style="display:block;"></i>
                    </div>
                </div>
                
                <div class="trnsferAmount">
                    <input type="text" placeholder="Amount" class="createLoanInput trans-amount mpc-MemberShop mpc-disabled">

                    <div class="mpcMemberTransferButton-wrap">
                        <button class="mpcMemberTransferButton verifyTransferToMpcMEmber mpc-btn mpc-disabled">Continue</button>
                    </div>
                </div>
            </div>

            <script>
                var AccountSearch, searchAccount, xhr, rtnMatchName, data, transType, transAccount, txt;


                    /**SEARCHING FOR MEMBERS ACCOUNT START HERE */
                    AccountSearch = document.querySelector('.MemberAccountNumber'); //live search input/acccount number

                    transType = document.querySelector('.mpc-TransferType'); //mpc-transfer type
                    transAccount = document.querySelector('.mpc-TransferType-account'); //mpc-transfer account
                    txt = document.querySelector('.Usr-rtn');

                    AccountSearch.addEventListener('input', function(){
                        rtnMatchName = document.querySelector('.mpc-dataRtn');
                        
                        
                        //check if member has select which account to transfer to
                        if(transType.value == '') {
                            transType.style.border = '2px solid #ff0000';
                            txt.innerHTML = 'Please select transaction type.';
                            txt.classList.add('toErr');

                            this.value = '';
                            __clearOutMemberNotice__('Usr-rtn', 3000)
                        }else if(transAccount.value == ''){
                            transAccount.style.border = '2px solid #ff0000';
                            txt.innerHTML = 'Please select transaction account.';
                            txt.classList.add('toErr');
                            this.value = '';

                            transType.style.border = 'none'; //when this code runs it means that user/member has already select transaction type, so we change it back to nothing

                            __clearOutMemberNotice__('Usr-rtn', 3000)
                        }else {
                            transAccount.style.border = 'none'; //remove red outline/border
                            searchAccount = this.value;
                            txt.innerHTML = '';

                            //let check immediately member/user tries to return the input empty
                            if(this.value == '' || this.value.length < 3) {
                                rtnMatchName.innerHTML = ''; //we re setting any text that was written during member query back to empty
                            }
                            
                            if(searchAccount.length >= 3){
                                //disabled login button at first
                                document.querySelector('.verifyTransferToMpcMEmber').disabled = true;

                                
                                txt.innerHTML = 'Please wait. Lookup in progress...';
                                data = "PERM=MPCmemASKPERM&Query=" + searchAccount;

                                

                                xhr = new XMLHttpRequest();
                                xhr.open('POST',  __mpc_uri__() + 'functions/mpc-ajax-action.php', true);
                                xhr.onreadystatechange = function(){
                                    if(this.readyState == 4 && this.status == 200){
                                        //re-enable login button aagain
                                document.querySelector('.verifyTransferToMpcMEmber').disabled = false; //re-enable button
                                        txt.innerHTML = 'Lookup finished!';
                                        rtnMatchName.innerHTML = this.response;
                                        // console.log(this.status);

                                        __mpcValidate_transfer(); //trying to validate transaction

                                        
                                    }
                                }
                                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                                xhr.send(data)
                            }
                        }
                    })

                //account type check, check if it admin or
                var listen = document.querySelector('.mpc-TransferType');

                    listen.addEventListener('change', function(){
                        if(this.value == 'mpc-self'){
                            document.querySelector('.MemberAccountNumber').style.display = 'none';
                        }else {
                            document.querySelector('.MemberAccountNumber').style.display = 'inline-block';
                        }
                    })

function __mpcMemberTransfer__(){
    var selectChange, Transtype, amount;

        selectChange = document.querySelector('.mpc-TransferType-account');
        amount = document.querySelector('.mpcMainBal');
        selectChange.addEventListener('change', function(){
            const AvailBalance = this.value;

           // alert(this.value)

            amount.innerText = AvailBalance;
        })
}

__mpcMemberTransfer__();

//disabled input prevent member from transfering cash here
let disabledInput = document.querySelectorAll('.mpc-disabled');
    disabledInput.forEach((ele) => {
        ele.disabled = true;
        ele.title = __mpc_companyName__() + ' DO WANT YOU TO PERFORM THIS ACTION ANYMORE, THANK YOU FOR YOUR UNDERSTANDING!';
    })
            </script>
        <?php
    }else if($_GET['action'] === 'MyNotifications'){
        ?>
        <i class="mpcMsg"> <?php print getSystemName($conn)[1]?> Members Notifications</i>
        <hr class="mpcHr">
        <h4><?php echo $uidName?>, You have <?php echo __mpcTotalMemberNotificationCount__($conn, $uidId, $uidPhone)?> onread Notification</h4>

        <div class="table-responsive">
            <table class="table table-bordered border-dark">
                <tr>
                    <td>#</td>
                    <td>Sender</td>
                    <td>Message</td>
                    <td>Time</td>
                    <td>Action</td>
                </tr>
                <?php
                __mpcDisplayNotificationShort__($conn, $uidId, $uidPhone);
                ?>
            </table>
        </div>
        <?php

if(isset($_GET['Read']) && !empty($_GET['Read']) && $_GET['Read'] == 'readSingle'){
    ?>
    <div class="Mpc-dbPop" title="DOUBLE CLICK HERE TO CLOSE">
        <div class="mpc-member-popup-wrap">
            <div class="innerNoti-content">
                <?php echo __mpcAllowedMemberReadNotification__($conn, $_GET['Key'])[0]?>
            </div>
            <div class="innerNoti-time">
                <h6>Time:
                    <?php echo __mpcAllowedMemberReadNotification__($conn, $_GET['Key'])[1]?>
                </h6>

                <h6>Sender:
                    <?php echo __mpcAllowedMemberReadNotification__($conn, $_GET['Key'])[2]?>
                </h6>
                
            </div>
        </div> 
    </div>
    <Script>
        var rmv = document.querySelector('.Mpc-dbPop');
            rmv.addEventListener('dblclick', function(){

                this.remove();
                window.location.replace(__mpc_uri__() + 'dashboard.php/?action=MyNotifications');
                console.log('Notification popup close')
            })
    </Script>
    <?php
}

    }else if($_GET['action'] == 'uidMemberSettings'){
        ?>
        <i class="mpcMsg"><?php print getSystemName($conn)[1]?> Member setting</i>
        <hr class="mpcHr">
        <div class="mpc-all-settings">
            <!--member db tool start here-->
            <div class="mpc-set-in shadow dsh-board-light-mode mpc-db-one">
                <i class="fas fa-user-alt fa-2x"></i>
                <a href="<?php echo __mpc_root__()?>dashboard.php/?action=uidMemberSettings&Read=profile" class="Setting-link">Profile</a>
            </div>
            <!--member db tool end here-->

            <!--member db tool start here-->
            <div class="mpc-set-in shadow dsh-board-light-mode mpc-db-one">
                <i class="fas fa-edit fa-2x"></i>
                <a href="<?php echo __mpc_root__()?>dashboard.php/?action=uidMemberSettings&Read=EditInfo" class="Setting-link">Edit Info</a>
            </div>
            <!--member db tool end here-->

            <!--member db tool start here-->
            <div class="mpc-set-in shadow dsh-board-light-mode mpc-db-one">
                <i class="fas fa-phone fa-2x"></i>
                <a href="<?php echo __mpc_root__()?>dashboard.php/?action=uidMemberSettings&Read=VerifyPhone" class="Setting-link">Verify-phone</a>
            </div>
            <!--member db tool end here-->
            
            <!--member db tool start here-->
            <div class="mpc-set-in shadow dsh-board-light-mode mpc-db-one">
                <i class="fas fa-blind fa-2x"></i>
                <a style="position: relative;" href="<?php echo __mpc_root__()?>dashboard.php/?action=uidMemberSettings&Read=retirement" class="Setting-link">Retirement Status
                    <span class="fa-shake __mpcnew_">New</span>
                </a>


            </div>
            <!--member db tool end here-->

            <!--member db tool start here-->
            <div class="mpc-set-in shadow dsh-board-light-mode mpc-db-one" style="margin-top:25px;">
                <i class="fas fa-sign-out fa-2x"></i>
                <a href="<?php echo __mpc_root__()?>dashboard.php/?action=uidMemberSettings&Read=MemberLogout" class="Setting-link">Logout</a>
            </div>
            <!--member db tool end here-->

            
        </div>

        <div class="mpc-ads" title="GOOD-LIFE UYO MPCS ADS">
            <div class="mpc-ads-show" >
                
            </div>
        </div>
        <?php

        if(isset($_GET['Read']) && !empty($_GET['Read'])){
            if($_GET['Read'] == 'profile'){
            ?>
            <div class="Mpc-dbPop" title="DOUBLE CLICK HERE TO CLOSE">
                <div class="mpc-member-popup-wrap">
                    <div class="innerNoti-content">
                        <img class="mpc-upload-profile memProfileUpload shadow"src="<?php echo __mpc_root__()?>asset/img/avartar1.png" alt="" srcset="<?php echo __mpc_root__()?>asset/img/avartar1.png">
                    </div>

                    <div class="memberProfileUPload">
                        <input type="file" class="MemberUPload" id="memberUpload" accept="image/*">
                        <label for="memberUpload" class="imge-upload-lable mpc-btn">Upload-image</label>
                    </div>

                    <p class="rtnMsg" style="text-align:center;margin-top:20px;color:black;font-weight:bold;"></p>
                </div>
            </div>

            <script>
                var uploada, a, memId, memPh, c, label, xhr, url, data, formdata, memPlaceholder, rtn;
                uploada = document.querySelector('.MemberUPload');
                uploada.addEventListener('change', function(){
                    a = document.querySelector('.rtnMsg'); //communication rtn
                    c = document.querySelector('.memProfileUpload'); //image preview
                    label = document.querySelector('.imge-upload-lable');
                    memPlaceholder = document.querySelector('.Usr-rtn');
                    memId = memPlaceholder.getAttribute('mpcmemberphone');
                    memPh = memPlaceholder.getAttribute('mpcmemberid');
                    a.textContent = 'Processing... please wait'; //show some preview data here
                    data = this.files[0];
                    formdata = new FormData();
                    url =  __mpc_uri__() + 'functions/mpc-mem-ajax.php';

                    //try tying to disable image upload interface
                    this.disabled = true;
                    this.value = '';
                    this.title = "SORRY I WAS TOLD TO DISABLED MY SELF AND GO TO SLEEP, AM SLEEPING, PLEASE COMEBACK LATER!";
                    label.title = "SORRY I WAS TOLD TO DISABLED MY SELF AND GO TO SLEEP, AM SLEEPING, PLEASE COMEBACK LATER!";

                    //appending data to form
                    formdata.append('uploadPic', data);
                    xhr = new XMLHttpRequest();
                    xhr.open('POST', url, true);
                    xhr.onreadystatechange = function(){
                        if(this.readyState == 4 && this.status == 200){
                            a.textContent = 'Almost Done... wait.'
                            rtn = this.response; //server response data
                            if(rtn == 'files size error'){
                                a.innerHTML = 'Sorry our server experience some errors while processing image upload...';
                            }else {
                                a.textContent == 'Done showing preview';
                                c.src = __mpc_uri__() + 'asset/img/' + rtn;
                                c.srcset = __mpc_uri__() + 'asset/img/' + rtn;
                                c.title = "NEWLY UPLOADED IMAGE";
                            }
                        }
                    }
                    xhr.send(formdata);






                })

            </script>
            <?php
        }else if($_GET['Read'] == 'EditInfo'){
           // echo $uidPhone, $uidId
             if(getStatus($conn, $uidPhone, $uidId)[1] != 1 && getStatus($conn, $uidPhone, $uidId)[3] != 1){
                $type = "<span style=\"font-weight:bolder;color:red;\">Not verified " ."<i class=\"fas fa-times fa-2x\"></i></span>";
             }else{
                $type = "<span style=\"font-weight:bolder;color:mediumseagreen;\">Verified " ."<i class=\"fas fa-stamp\"></i></span>";
             }
               //echo getStatus($conn, $uidPhone, $uidId)[1]; //== 1 && getStatus($conn, $uidPhone, $uidId)[1] == 1;
           // if(){}
        
            ?>
                <div class="Mpc-dbPop" title="DOUBLE CLICK HERE TO CLOSE">
                <div class="mpc-member-popup-wrap">
                    <h4><?php echo __mpcReturnByPhoneMember($conn, $uidPhone)[4]?> Edit Account Info</h4>
                    <div class="innerNoti-content table-responsive">
                        <table class="table table-striped table-hovered table-bordered border-dark">
                            <tr>
                                <td>Name</td>
                                <td>
                                    <span class="mpc-bolder"><?php echo __mpcReturnByPhoneMember($conn, $uidPhone)[4]?></span>
                                </td>
                            </tr>
                            <tr>
                                <td>Title</td>
                                <td><span class="mpc-bolder"><?php  echo __mpcReturnByPhoneMember($conn, $uidPhone)[1]?></span></td>
                            </tr>
                            <tr>
                                <td>Gender</td>
                                <td><span class="mpc-bolder"><?php  echo __mpcReturnByPhoneMember($conn, $uidPhone)[2]?></span></td>
                            </tr>
                            <tr>
                                <td>Date of Birth</td>
                                <td><span class="mpc-bolder"><?php  echo __mpcReturnByPhoneMember($conn, $uidPhone)[3]?></span></td>
                            </tr>

                            <tr>
                                <td>Phone</td>
                                <td><span class="mpc-bolder"><?php  echo __mpcReturnByPhoneMember($conn, $uidPhone)[5]?></span></td>
                            </tr>
                            <tr>
                                <td>Contact Addr.</td>
                                <td><span class="mpc-bolder"><?php echo __mpcReturnByPhoneMember($conn, $uidPhone)[6]?></span></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td><span class="mpc-bolder"><?php echo __mpcReturnByPhoneMember($conn, $uidPhone)[8]?></span></td>
                            </tr>
                            <tr>
                                <td>Occupation</td>
                                <td><span class="mpc-bolder"> <?php echo __mpcReturnByPhoneMember($conn, $uidPhone)[9]?></span></td>
                            </tr>
                            <tr>
                                <td>Account No.</td>
                               <td><span class="mpc-bolder"><?php echo __mpcReturnByPhoneMember($conn, $uidPhone)[10]?></span></td>
                            </tr>

                            <tr>
                                <td>Current group</td>
                                <td><span class="mpc-bolder"><?php  echo __mpcReturnByPhoneMember($conn, $uidPhone)[11]?></td>
                            </tr>
                            <tr>
                                <td>Acct. creation date</td>
                                <td><span class="mpc-bolder"><?php  echo __mpcReturnByPhoneMember($conn, $uidPhone)[12]?></span></td>
                            </tr>
                            <tr>
                                <td>Account status</td>
                                <td><?php echo $type?></td>
                            </tr>
                            <tr>
                                <td>Declaration</td>
                                <td><p class="usr-declaration"><?php  echo __mpcReturnByPhoneMember($conn, $uidPhone)[24]?></p></td>
                            </tr>
                            
                            <!--tr>
                                
                                <td>
                                    <button class="Account-InfoSaved ">Submit</button>
                                </td>
                            </tr-->
                        </table>
                    </div>
                </div>
            </div>
            <?php
            }else if($_GET['Read'] == 'VerifyPhone'){
                $phone = substr(__mpcReturnByPhoneMember($conn, $uidPhone)[5], 0, -5) . 'XXXXX';
                $ph = substr(__mpcReturnByPhoneMember($conn, $uidPhone)[5], 0, -5);
?>

            <div class="Mpc-dbPop" title="DOUBLE CLICK HERE TO CLOSE">
                <div class="mpc-member-popup-wrap">
<?php 
/**what i HAVE INSIDE THE IF STATEMENT IS
 * TO CHECK WHETHER MEMBERS PHONE NUMBER IS ALEADY VERIFIED
 * THIS IS IYAKISE RAPHAEL HANDWORK
 */

    if(getStatus($conn, $uidPhone, $uidId)[1] == 1){
        
        $name = __mpcReturnByPhoneMember($conn, $uidPhone)[4];
        $Err = "<h4 class=\"text-center p-5\">$name, Your phone number is already verified <i class=\"fas fa-check fa-2x\" style=\"color:green;\"></i></h4>";
        print $Err;
        //exit();

    }else {

?>
                    <h4>Member Phone number verification</h4>
                    <div class="innerNoti-content dVerifyOne">


                        <h5 class="">Member Phone number verification</h5>
                        <h6><?php echo __mpcReturnByPhoneMember($conn, $uidPhone)[4]?>, We belive that "<?php echo $phone?>" is your verified phone number... </h6>
                        <h6>We will send Pass code to this Phone number! </h6>
                        
                        <div class="phoneVerify">
                            <h6>Complete this phone Number <?php echo $phone?></h6>

                            <input type="text" placeholder="<?php echo $phone?>" class="v-Member loanInput createLoanInput mpc-MemberShop">
                            <button class="mpc-btn click-confirmPhone">Send code</button>
                            <p class="Err-rtn" style="font-weight:600;transition:0.5s;"></p>
                        </div>
                        
                </div>

                
            </div>
            <script>
                var PhonePart1, Remain, Whole, clck, input, Err;
                PhonePart1 = "<?php echo $ph?>";
                Whole = "<?php echo $uidPhone?>";

                clck = document.querySelector('.click-confirmPhone');
                clck.addEventListener('click', function(){
                    this.disabled = true;
                    input = document.querySelector('.v-Member');
                    Err = document.querySelector('.Err-rtn');
                    
                    if(input.value == ''){
                        Err.innerHTML = "Enter Last 5 numbers please...";
                        this.disabled = false;
                    }else if(input.value.length > 5){
                        Err.innerHTML = "Enter Last 5 numbers...";
                        this.disabled = false;
                    }else if(input.value.length < 5){
                        Err.innerHTML = "Enter Last 5 numbers...";
                        this.disabled = false;
                    }else{
                        var checkNumber = PhonePart1 + input.value;
                        Err.innerHTML = '';
                        
                        //check and compare phone number
                        if(checkNumber !== Whole){
                            Err.innerHTML = "Phone number verification Error";
                            this.disabled = false;
                        }else {
                            var xhr, newDiv;

                            xhr = new XMLHttpRequest();
                            xhr.open('GET',  __mpc_uri__() + '/functions/mpc-mem-ajax.php?PERM=memVPERM&ph=' + Whole, true);
                            xhr.onreadystatechange = function(){
                                if(this.status == 200 && this.readyState == 4){
                                    if(this.response == 'OKAY'){
                                        //show box where user can
                                        //type and confirmed password
                                        window.location.replace(__mpc_uri__() + 'dashboard.php/?action=uidMemberSettings&Read=EnterCode');
                                    }else {
                                        Err.innerHTML = this.response;
                                    }
                                }
                            }
                            xhr.send();
                        }
                    }
                })
            </script>
            
<?php
    }
            }else if($_GET['Read'] == 'EnterCode'){
                ?>
                    <div class="Mpc-dbPop" title="DOUBLE CLICK HERE TO CLOSE">
                        <div class="mpc-member-popup-wrap">
                        <h4>Member Phone number verification</h4>
                            <div class="innerNoti-content dVerifyOne">
                                <div class="mpc-cPhone dVerifyTwo">
                                    <h4>Enter the code sent to <?php echo $uidPhone?>!</h4>

                                    <div class="phoneVerify">
                                        <input type="text" placeholder="Enter code" class="v-Member-code loanInput createLoanInput mpc-MemberShop">
                                        <button class="mpc-btn click-meCp">Confirm</button>
                                        <p class="Err-rtn" style="font-weight:600;transition:0.5s;"></p>

                                    </div>
                                    <div class="success"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        var butt, code, xhr, rtnDiv, rtnErr;

                        butt = document.querySelector('.click-meCp');
                        butt.addEventListener('click', function(){
                            code = document.querySelector('.v-Member-code');
                            rtnDiv = document.querySelector('.success');
                            rtnErr = document.querySelector('.Err-rtn');


                            alert('You click');
                        })
                    </script>
                <?php
            }else if($_GET['Read'] === 'retirement'){
              ?>
              
                    <div class="Mpc-dbPop" title="DOUBLE CLICK HERE TO CLOSE">
                        <div class="mpc-member-popup-wrap">
                        <h4 class="sticky-top shadow p-1"><?php echo $uidName?>, Check Retirement Status</h4>
                            <div class="innerNoti-content dVerifyOne">
                                <div class="mpc-cPhone dVerifyTwo">
                                    <h2 class="rtnifdueforretirement p-1"><?php echo $uidName?> You are not Due for retirement</h2>

                                    <div class="phoneVerify">
                                        <h5 class="numberof"></h5>
                                    </div>
                                    <div class="success"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                <script>
                                        let Name = "<?php echo $uidName?>";
                    let txt = "<?php echo __mpcReturnByPhoneMember($conn, $uidPhone)[21]?>";
                    let splt = txt.split('/');
                   
                    let day = splt[0];
                    let month = splt[1];
                    let year = splt[2];
                    let yearTxt = `${year}-${month}-${day} 00:00:00`;

                    let dateOfAppointment = new Date(yearTxt);
                    let dateOfRetirement = new Date();
                    let rxtx = document.querySelector('.rtnifdueforretirement');


                    /** ------------------------------------------------------------------------------------------------
                     *                                                                                                 |
                     *                                                                                                 |
                     *                                                                                                 |
                     *                YAKISE RAPHAEL THIS ONE OF THE THOUGHEST CODE TO I HAVE EVER WRiTtEn               |
                     *                                                                                                 |
                     *                                                                                                 |
                     *                                                                                                 |
                     *                                                                                                 |
                     *                                                                                                 |
                     *------------------------------------------------------------------------------------------------- 
                    **/
                    let dateworkFor = calculateTotalYearsOfWork(dateOfAppointment, dateOfRetirement);
                    document.querySelector('.numberof').innerHTML = dateworkFor;
                    if(returnOnlyYearsWorkedFor(dateOfAppointment, dateOfRetirement) >= 10){
                        rxtx.innerHTML = Name + ' You are due for retirement, it has been a great Journey!';
                        rxtx.classList.add('alert-danger');
                    }else {
                        rxtx.innerHTML = Name + ` you are not yet due for retirement, You still have  ${45 -returnOnlyYearsWorkedFor(dateOfAppointment, dateOfRetirement)} years to work` ;
                        rxtx.classList.add('alert-success');
                    }

                </script>
              <?php  
            }else if($_GET['Read'] === 'MemberLogout'){

               // require_once dirname(__DIR__) ."/config/conn.php";
                $from = 'mpc_members'; 
                $type = 'SignOut'; //typeof action executed
                $redirect = __mpc_root__() . 'dashboard.php/?action=dashboard';
                $prev = 5;
                
                // print_r(__mpcConn__());
                __logoutMpc_admin($uidId, $from, $prev, $redirect, $type, __mpcConn__());
            }

            ?>
<script>
            var rmv = document.querySelector('.Mpc-dbPop');
                 rmv.addEventListener('dblclick', function(){

                    this.remove();
                   // window.location.replace(__mpc_uri__() + 'dashboard.php/?action=MyNotifications');
                    console.log('Notification popup close')
                })
</script>
            <?php
        }
    }else if ($_GET['action'] == 'transactions') {
        ?>
        <i class="mpcMsg">Transactions</i>
        <hr class="mpcHr">
        
        <h5><?php echo $uidName?>, account statement</h5>

        <div class="mpc-mem-transactions">
            <!--div class="table-responsive">
                <table class="table table-striped table-hovered table-bordered dark-border">
                    <tr>
                        <th>#</th>

                    </tr>
                </table>
            </div-->

            <div class="sect-mpc-trans-one mpc-fancy-style">
                

                <div class="table-responsive">
                <span class="accountType">Shares account</span>
                    <table class="table table-bordered table-hovered table-striped border-dark">
                        
                        <tr>
                            <th>#</th>
                            <th>Debit</th>
                            <th>Credit</th>
                            <th>Balance</th>
                            <th>Time and date</th>
                        </tr>
<?php
/** SYSTEM USED INFORMATION BELOW TO GET
 * USERS/MEMBERS ACCOUNT BALANCE
*/
        $tbl = 'mpc_account_shares';
        $colName1 = 'shares_member_id';
        $colName2 = 'shares_member_phone';
        $increment = 1;
    __mpc_memberGetAccount_All__($conn, $uidId, $uidPhone, $colName1, $colName2, $tbl, $increment);
                        ?>
                    </table>
                </div>
            </div>

            <div class="sect-mpc-trans-one mpc-fancy-style">
            <div class="table-responsive">
                <span class="accountType">Recent Loan Transaction. <strong class="bls lns" style="display:block;">Loan Balance:<span class="biyakise">0.00</strong></strong>     </span>
                    <table class="table table-bordered table-hovered table-striped border-dark">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Debit</th>
                                <th>Credit</th>
                                <th>Balance</th>
                                <th>Time and date</th>
                            </tr>
                        </thead>
                        <tbody class="truserData">

                        </tbody>

                    </table>
                </div>
            </div>
 <script type="module">
                const id = "<?=$uidId?>";
                const ph = "<?=$uidPhone?>";
                var updater = document.querySelector('.truserData');
                var blanc = document.querySelector('.biyakise');
                import * as api from "../script/api.js";
                
                let ddata = await api.getRcent20(__mpc_uri__(), id, ph);
                    blanc.innerHTML = `&#8358; ${ddata.current_balance}`;
                    if('data' in ddata && ddata.data.length >0){
                        ddata.data.forEach((data, i) => {
                            let tr = document.createElement('tr');
                                tr.innerHTML = `
                                    <td>${(i + 1)}</td>
                                    <td>&#8358;${data.debit}</td>
                                    <td>&#8358;${data.credit}</td>
                                    <td>&#8358;${data.balance}</td>
                                    <td>${data.trans_date}</td>
                                `;
                            updater.appendChild(tr);
                        })
                    }else{
                        updater.innerHTML = `
                            <tr>
                                <td>No recent data found</td>
                            <tr>
                        `;
                    }
      
</script>
            <div class="sect-mpc-trans-one mpc-fancy-style">
            <div class="table-responsive">
                <span class="accountType">Special Saving</span>
                    <table class="table table-bordered table-hovered table-striped border-dark">
                        
                        <tr>
                            <th>#</th>
                            <th>Debit</th>
                            <th>Credit</th>
                            <th>Balance</th>
                            <th>Time and date</th>
                        </tr>
<?php
                        /** SYSTEM USED INFORMATION BELOW TO GET
 * USERS/MEMBERS ACCOUNT BALANCE
*/
        $tbl = 'mpc_special_saving';
        $colName1 = 'mem_id';
        $colName2 = 'mem_phone';
        $increment = 3;
    __mpc_memberGetAccount_All__($conn, $uidId, $uidPhone, $colName1, $colName2, $tbl, $increment);
                        ?>
                    </table>
                </div>
            </div>

            <div class="sect-mpc-trans-one mpc-fancy-style">
            <div class="table-responsive">
                <span class="accountType">Thrift Saving</span>
                    <table class="table table-bordered table-hovered table-striped border-dark">
                        
                        <tr>
                            <th>#</th>
                            <th>Debit</th>
                            <th>Credit</th>
                            <th>Balance</th>
                            <th>Time and date</th>
                        </tr>
                        <?php 
/** SYSTEM USED INFORMATION BELOW TO GET
 * USERS/MEMBERS ACCOUNT BALANCE
*/
        $tbl = 'mpc_thrift_saving';
        $colName1 = 'thrift_mem_id';
        $colName2 = 'thrift_mem_phone';
        $increment = 4;
    __mpc_memberGetAccount_All__($conn, $uidId, $uidPhone, $colName1, $colName2, $tbl, $increment);
                        ?>
                    </table>
                </div>
            </div>

            <!-- <div class="sect-mpc-trans-one mpc-fancy-style">
            <div class="table-responsive">
                <span class="accountType">Welfare Contribution</span>

                </div>
            </div> -->

        </div>
            <!-- <button class="mpc-btn">View All</button> -->

        <script type="text/javascript">
            cGroup(); //group loan transaction
        </script>
        <?php
    }else if($_GET['action'] == 'loan'){
        ?>
        <i class="mpcMsg">Loan</i>
        <hr class="mpcHr">

        <div class="mpc-member-loan">
            <div class="loan-info-group">
                <div class="section mpc-fancy-style">
                    <h5 class="text-center;">Group loan</h5>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>names</th>
                                    <th>profile</th>
                                    <th>Amount</th>
                                    <th>Monthly repayment</th>
                                    <th>Weekly repayment</th>
                                    <th>penalty</th>
                                    <th>status</th>
                                </tr>
                            </thead>

                            <?php
                            __mpc_sendGroupLoan__($conn, $uidgroup);
                            ?>
                        </table>

    <script>

            var wpenalty = document.querySelectorAll('.amount-mpc-Paid');
         for (let i = 0; i < wpenalty.length; i++) {
            let element, payment, items;
                element = wpenalty[i].innerText;
            
                payment = element.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
          

                items = document.querySelectorAll('.amount-mpc-Paid')[i].innerHTML = payment


         }

        
    </script>
                    </div>
                </div>

                <div class="section mpc-fancy-style">
                    <h5 class="text-center;">Regular loan</h5>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hovered table-striped border-dark">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Value</th>
                                </tr>
                            </thead>

                            <!--tbody>
                                <tr>
                                    <td>Name:</td>
                                    <td><?php //echo __mpc_member_singleLoanInfo($conn, $uidId, $uidPhone)['mem_phone']?></td>
                                </tr>

                                <tr>
                                    <td>Interest type</td>
                                    <td>&#8358;<?php //echo __mpc_member_singleLoanInfo($conn, $uidId, $uidPhone)['interest_rate_type']?></td>
                                </tr>

                                <tr>
                                    <td>Monthly Repay.</td>
                                    <td>&#8358;<?php //echo __mpc_member_singleLoanInfo($conn, $uidId, $uidPhone)['monthly_payment']?></td>
                                </tr>

                                <tr>
                                    <td>Loan last: </td>
                                    <td><?php //echo __mpc_member_singleLoanInfo($conn, $uidId, $uidPhone)['total_running_month']?> Month</td>
                                </tr>

                                <tr>
                                    <td>Month paid:</td>
                                    <td><?php //echo __mpc_member_singleLoanInfo($conn, $uidId, $uidPhone)['total_month_paid']?> Month</td>
                                </tr>

                                <tr>
                                    <td>Month Remaining:</td>
                                    <td><?php //echo __mpc_member_singleLoanInfo($conn, $uidId, $uidPhone)['total_month_remaining']?> Month</td>
                                </tr>

                                <tr>
                                    <td>Date:</td>
                                    <td><?php //echo __mpc_member_singleLoanInfo($conn, $uidId, $uidPhone)['date'] . ', ' .__mpc_member_singleLoanInfo($conn, $uidId, $uidPhone)['time']?> </td>
                                </tr>

                                <tr>
                                    <td>M. Remaining:</td>
                                    <td><?php //echo __mpc_member_singleLoanInfo($conn, $uidId, $uidPhone)['total_month_remaining']?> Month</td>
                                </tr>

                                <tr>
                                    <td>TOTAL:</td>
                                    <td>&#8358; <?php //echo __mpc_member_singleLoanInfo($conn, $uidId, $uidPhone)['total_amount_to_repay']?></td>
                                </tr>

                                <tr>
                                    <td>LOAN STATUS:</td>
                                    <td><?php //__loanStatus(__mpc_member_singleLoanInfo($conn, $uidId, $uidPhone)['loan_status']) ?></td>
                                </tr>
                            </tbody-->

                            <?php 
                                __mpc_member_singleLoanInfo($conn, $uidId, $uidPhone);
                            ?>
                        </table>
                    </div>
                </div>


            </div>
        </div>
        <?php
}else if($_GET['action'] === 'RequestLoad'){

?>
<style>
    *{
        transition: 0.5s linear;
    }
    ._mpc{
        width: 100%;
        height: 80vh;
/*        border: 2px solid red;*/
    }
    .__ts{
        width: 60%;
        height: 70%;
/*        border: 2px dashed black;*/
        margin: 0 auto;
    }

    .loan-err{
        resize: none;
        -webkit-resize:none;
        width: 60%;
        height: 50%;
        padding: 5px 10px;
    }
    .xmltrk{
        display: none;
        overflow: hidden;
        overflow-y: auto;
/*        border: 2px solid red;*/
    }
    .cls{
/*        border: 2px solid red;*/
        cursor: pointer;
        width: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        height: auto;
    }

    .itm{
        display: flex;
        align-items: center;
        justify-content: space-evenly;
        flex-direction: column;
/*        border: 2px dashed blue;*/
        height: 90%;
    }
    .LoanProcessing{
        width: 100%;
        height: 70px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .LoanProcessing .txtAmount{
        width: 350px;
        height: auto;
/*        border: 2px solid red;*/
    }

    .itm input{
        width: 60%;
        height: 40px;
        padding:5px 10px;
    }
    .itm button{
        width: 60%;
        height: 40px;
    }
    .amountRQ:focus,
    .loan-err:focus{
        outline: orange;
        border: 1px solid orange;
    }

@media only screen and (max-width:800px){
    .__ts{
        width: 80%;
        height: auto;
    }
}

@media only screen and (max-width:600px){
    /*.__ts{
        width: 80%;
    }
*/    .itm input,
    .loan-err,
    .itm button{
        width: 80%;
    }
}

@media only screen and (max-width:450px){
    .__ts{
        width: 95%;
    }
}


</style>
     <i class="mpcMsg">Request Loan</i>
        <hr class="mpcHr">
    <div class="_mpc req-loan">
<input type="search" class="mpcTrackid setStyle createLoanInput " placeholder="Enter your Tracking ID">

        <div class="__ts xmltrk mpc-fancy-style">
            <div class="cls close" title="CLOSE THIS BOX"><i class="fas fa-close fa-2x"></i></div>

            <div class="table-responsive">
                <table class="table table-bordered table-hovered table-striped border-dark ">
<?php 
$system = getSystemName($conn)[1];
?>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <!-- <th>Profile</th> -->
                            <!-- <th>Phone</th> -->
                            <th>Request Amount</th>
                            <!-- <th>Reason</th> -->
                            <th>Date Requested</th>
                            <th><?php echo $system?> Message</th>
                            <th>Approved/Declined date</th>
                            <!-- <th>Tracking Code</th> -->
                            <th>Status</th>
                            <!-- <th>Action</th> -->
                            <!-- <th>Date Requested</th> -->
                        </tr>
                    </thead>
                    <tbody class="txtrtnhere">
                        
                    </tbody>
                    
                </table>
            </div>
        </div>

        <div class="__ts tsxml mpc-fancy-style">
            <h5 class="p-2"><?php echo $uidName?>, How much are you requesting for?</h5>
            <div class="itm">
                <input type="text" placeholder="Enter amount" class="setStyle createLoanInput amountRQ">
                <textarea cols="30" rows="10" class="Txt loan-err setStyle" placeholder="Tell us why you are requesting for this Amount"></textarea>
                <button class="mpc-btn RequestLoan m-2">Request Loan</button>


                <div class="LoanProcessing Info-loan">
                    <div class="txtAmount">
                        <i>Interest.</i>
                        <h6 class="companyIntrest"></h6>
                    </div>
                    <div class="txtAmount">
                        <i>Monthy repayment</i>
                        <h6 class="mpc-monthlyPayment"></h6>
                    </div>
                    <div class="txtAmount">
                        <i>Amount</i>
                        <h6 class="borrowedAmount"></h6>
                    </div>
                    <!-- <div class="txtAmount"></div> -->
                </div>
            </div>

            
<script type="text/javascript">
    let amountInput = document.querySelector('.amountRQ');
    let txtArea = document.querySelector('.Txt');
    let actionButt = document.querySelector('.RequestLoan');
    let company = document.querySelector('.companyIntrest');
    let amountRtn = document.querySelector('.mpc-monthlyPayment');
    let result = document.querySelector('.borrowedAmount');
    let err = document.querySelector('.Usr-rtn');
    let userId = "<?php echo $uidId?>";
    let userPhone = "<?php echo $uidPhone?>";

    actionButt.addEventListener('click', function(e){
        e.preventDefault;

        if(amountInput.value == ''){
            amountInput.style.border = '2px solid red';
            err.innerHTML = 'Enter Loan Amount';
            return;
        }

        if(txtArea.value == ''){
            txtArea.style.border = '2px solid red';
            err.innerHTML = 'Tell '+ "<?php echo getSystemName($conn)[1]?>" + ', Why you are requesting for this amount';

            return;
        }

        if(txtArea.value.length < 50){
            txtArea.style.border = '2px solid red';
            err.innerHTML = "<?php echo getSystemName($conn)[1]?>" + ', cannot Accept this, please Explain in details';

            return;
        }

amountInput.style.border = 'none';
txtArea.style.border = 'none';

        let xhr = new XMLHttpRequest();
        let url = __mpc_uri__() + 'functions/mpc-ajax-action.php';
        let data = JSON.stringify({uid: userId, uidPhone: userPhone, Permition:'loanProcessor', amount:amountInput.value, loanInfo:txtArea.value});

            xhr.open('POST', url, true);
            xhr.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    let resp = JSON.parse(this.response);
                    // alert(this.response);
                    if(resp.code == 200){
                        err.innerHTML = resp.msg + ', This is your tracking ID "'+resp.track+'", copy and keep it safe!';
                        err.classList.add('fa-fade');
                        err.classList.add('text-success');
                        return;
                    }

                    err.innerHTML = resp.msg + ' status=' + resp.code;
                    err.classList.add('fa-fade');
                    err.classList.add('text-danger');

                }
            }
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.send('XLoanRsqt='+data);
    })

    amountInput.addEventListener('input', function(){
        // alert(4)
        if(this.value.search(/[^0-9]/i) != -1){
            amountInput.style.border = '2px solid red';
            return;
        }else{
            amountInput.style.border = 'none';

            let interest_rate = 10;
            let amount = this.value;
            let months = 10;

            let interest = (amount * (interest_rate * .01)) / months; //company interest
            payment = ((amount / months) + interest).toFixed(2); // payment
            payment = payment.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            interest = interest.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            amount = amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            company.innerHTML = "&#8358;"+interest;
            result.innerHTML = "&#8358;"+amount;
            amountRtn.innerHTML = "&#8358;"+ payment;

            
        }
    })


//tracking id start here
let tracker = document.querySelector('.mpcTrackid');
    tracker.addEventListener('input', function(){
        let dataRtn = document.querySelector('.txtrtnhere');
        let searchHide = document.querySelector('.tsxml');
        let searchShow = document.querySelector('.xmltrk');



        if(this.value !== ''){
            searchHide.style.display = 'none';
            searchShow.style.display = 'block';


            let data = JSON.stringify({searchKey: this.value, USRkey:'PermPermited'});
            let xhr = new XMLHttpRequest();
                xhr.open('POST', __mpc_uri__() + 'functions/mpc-mem-ajax.php', true);
                xhr.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){

                       dataRtn.innerHTML = this.response;
                    }
                }
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.send('TrackQry=' + data);
        }
    })

//close popup
    let popclose = document.querySelector('.cls');
        popclose.addEventListener('click', function(){
            let searchHide = document.querySelector('.tsxml');
            let searchShow = document.querySelector('.xmltrk');

                //hide and show element here
                searchHide.style.display = 'block';
                searchShow.style.display = 'none';
        })
</script>

        </div>
    </div>
<?php
    }else if($_GET['action'] === 'Repayloan')
    {

    //         $name = __mpcReturnByPhoneMember($conn, $_GET['k1'])[4];
     $department = __mpcReturnByPhoneMember($conn, $uidPhone)[20];

    // $date = __getmemberMandate($conn, $_GET['k2'], $_GET['k1'])[3];
?>
     <i class="mpcMsg">Check Mandate form</i>
        <hr class="mpcHr">


    <div class="mpc-popup-anytime">
        <div class="mpc-popup-bg" style="height: 80vh;overflow:hidden; overflow-y: auto;">
            <div class="close-mpc-popup" title="CLOSE MODAL BOX HERE">
                <i class="fas fa-xmark fa-3x"></i>
            </div>
            <!-- <span class="Upload-status">Mandatory Form</span> -->
            <div class="responsReturn __xmptcs__ mpc-document-print">
                <h1 style="font-family: serif;color:#999;" class="text-center">MINISTRY OF JUSTICE, <?php print getSystemName($conn)[0]?> ACCOUNT</h1>
                <h2 class="text-center" style="color: #999;">MANDATE FORM</h2>

                <div class="mpc-justice-mandatory-fm">
                    <div class="mpc-justic-nominee">
                    <h5>Kindly approve the following deductions monthly to be credited to my account with <?php print getSystemName($conn)[0]?> until further notice as follows</h5>
                        <ol style="list-style:decimal!important;color: orange;">
                            <li>Shares: <span style="font-weight: 800;">&#8358;</span> <?php echo __getmemberMandate($conn, $uidId, $uidPhone)[2]?> </li>
                            <li>Thrift Savings: <span style="font-weight: 800;">&#8358;</span> <?php echo __getmemberMandate($conn, $uidId, $uidPhone)[1]?></li>
                            <li>Special Savings: <span style="font-weight: 800;">&#8358;</span> <?php echo __getmemberMandate($conn, $uidId, $uidPhone)[2]?></li>
                        </ol>

                        <div class="mandate-name">
                            <h4>Name: <?php echo $uidName?></h4>
                            <h4>Department: <?php echo $department?></h4>
                            <h4>Signature:..............................................</h4>
                            <h4>Date:......<?php echo __getmemberMandate($conn, $uidId, $uidPhone)[3]?> .......</h4>
                        </div>
                    <?php ?>
                    </div>
                </div>
                <!-- <button class="mpc-btn print-mpc-page" title="print <?php //print getSystemName($conn)[0]?> MANDATE FORM"><i class="fas fa-print"></i></button> -->

            </div>

            <!-- <div class="mpc-popup-inner">
                <div class="table-responsive">
                    <input type="text" placeholder="Shares" class="sharesAccount setStyle createLoanInput">
                    <input type="text" placeholder="THRIFT Saving" class="ThriftSaving setStyle createLoanInput">
                    <input type="text" placeholder="Special Saving" class="SpecialSaving setStyle createLoanInput">

                    <button class="mpc-btn setDeductionRate">Deduction Rate</button>
                    <p class="__notice_msg"></p>
                </div>
            </div> -->
<script>
    // let btnclick = document.querySelector('.setDeductionRate');
    // let shares = document.querySelector('.sharesAccount');
    // let thrift = document.querySelector('.ThriftSaving');
    // let special = document.querySelector('.SpecialSaving');
    // let noticeMsg = document.querySelector('.__notice_msg');
    // let personId = "<?php //echo $_GET['k2']?>";
    // let personPhone = "<?php //echo $_GET['k1']?>";

    //     btnclick.onclick = function(){

    //         if(shares.value === ''){
    //             noticeMsg.innerHTML = 'PLEASE ENTER DEBIT AMOUNT FOR SHARES';
    //             noticeMsg.classList.add('to-red-color');
    //             noticeMsg.classList.add('fa-fade');
    //             shares.style.border = '1px solid red';
    //             return;
    //         }

    //         if(thrift.value === ''){
    //             noticeMsg.innerHTML = 'PLEASE ENTER DEBIT AMOUNT FOR THRIFT';
    //             noticeMsg.classList.add('to-red-color');
    //             noticeMsg.classList.add('fa-fade');
    //             thrift.style.border = '1px solid red';
    //             return;
    //         }

    //         if(special.value === ''){
    //             noticeMsg.innerHTML = 'PLEASE ENTER DEBIT AMOUNT FOR SPECIAL SAVING';
    //             noticeMsg.classList.add('to-red-color');
    //             noticeMsg.classList.add('fa-fade');
    //             special.style.border = '1px solid red';
    //             return;
    //         }

    //         if(special.value.search(/[^0-9]/i) !== -1 || shares.value.search(/[^0-9]/i) !== -1 || thrift.value.search(/[^0-9]/i) !== -1){
    //             noticeMsg.innerHTML = 'INVALID CHARACTER DETECTED';
    //             noticeMsg.classList.add('to-red-color');
    //             noticeMsg.classList.add('fa-fade');

    //             return;
    //         }

    //         shares.style.border = 'none';
    //         thrift.style.border = 'none';
    //         special.style.border = 'none';

    //         noticeMsg.innerHTML = 'PLEASE WAIT... LOADING';

    //         let url = __mpc_uri__();
    //         let data = JSON.stringify({
    //                     'shares': shares.value,
    //                     'thrift': thrift.value,
    //                     'special': special.value,
    //                     'memberId': personId,
    //                     'memberPhone': personPhone,
    //                     'perm':'PleaseAllowUs'                  
    //                     });
    //         let xhr = new XMLHttpRequest();
    //             xhr.open('POST', url + 'functions/mpc-ajax-action.php', true);
    //             xhr.onreadystatechange = function(){
    //                 if(this.readyState == 4 && this.status == 200){
    //                     noticeMsg.innerHTML = 'OKAY, Returning response now';


    //                     if(this.response == 'Success'){
    //                         window.location.reload();

    //                     }else{
    //                         noticeMsg.innerHTML = this.response;
    //                     }

    //                 }
    //             }
    //             xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    //             xhr.send('requestSender='+data);
    //     }
</script>
        </div>
    </div>
<?php
    }



    //trying to add active class to elemeent
    if($_GET['action'] == 'dashboard'){
        ?>
        <script>
            var active = document.querySelector('.dboard');
                active.classList.add('active');
        </script>
        <?php
    }else if($_GET['action'] == 'transactions'){
        ?>
        <script>
            var active = document.querySelector('.trzn');
                active.classList.add('active');
        </script>
        <?php
    }else if($_GET['action'] === 'loan'){
        ?>
        <script>
            var active = document.querySelector('.mloan');
                active.classList.add('active');
        </script>
        <?php
    }else if($_GET['action'] === 'Repayloan'){
        ?>
        <script>
            var active = document.querySelector('.Lrpay');
                active.classList.add('active');
        </script>
        <?php
    }else if($_GET['action'] === 'transfer'){
        ?>
        <script>
            var active = document.querySelector('.tfer');
                active.classList.add('active');
        </script>
        <?php
    }else if($_GET['action'] === 'uidMemberSettings'){
        ?>
        <script>
            var active = document.querySelector('.settnz');
                active.classList.add('active');
        </script>
        <?php
    }else if($_GET['action'] === 'RequestLoad'){
        ?>
        <script>
            var active = document.querySelector('.RQl');
                active.classList.add('active');
        </script>
        <?php
    }
}


