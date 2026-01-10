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

    @media (max-width: 768px){
            .db-iconsWrap svg{
                font-size: 1.5rem;

            }

            .db-title h6{
                font-size: .8rem;
            }
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
                <div class="mpc-db-data-one shadow p-2">
                    <div class="db-iconsWrap">
                        <i class="fas fa-money-check fa-3x"></i>
                    </div>
                    <div class="db-title" title="SHARES ACCOUNT ">
                        <h6>SHARES: &#8358; <?php //echo __mpc_getMember_balance__($conn, $uidId, $uidPhone, 'mpc_account_shares', 'shares_member_id', 'shares_member_phone')[2]?>
                            <span class="sharesBalance">0.00</span>
                        </h6>
                        
                    </div>
                </div>

                <div class="mpc-db-data-one shadow p-2">
                    <div class="db-iconsWrap">
                        <i class="fas fa-money-check fa-3x"></i>
                    </div>
                    <div class="db-title" title="THRIFT SAVING">
                        <h6>THRIFT: &#8358; <span class="thriftBalance">0.00</span></h6>
                        
                    </div>
                </div>

                <div class="mpc-db-data-one shadow p-2">
                    <div class="db-iconsWrap">
                        <i class="fas fa-money-check fa-3x"></i>
                    </div>
                    <div class="db-title" title="SPECIAL SAVING">
                        <h6>SPECIAL: &#8358; <span class="specialBalance">0.00</span></h6>
                        
                    </div>    
                </div>

                <!-- PASTE START HERE-->
                <!-- <div class="mpc-db-data-one shadow p-2">
                    <div class="db-iconsWrap">
                        <i class="fas fa-money-check fa-3x"></i>
                    </div>
                    <div class="db-title" title="WELFARE CONTRIBUTIONS">
                        <h6>WELFARE: &#8358; <?php //echo __mpc_getMember_balance__($conn, $uidId, $uidPhone, 'mpc_welfare_contribution', 'welfare_mem_id', 'welfare_mem_phone')[2]?></h6>
                        
                    </div>
                </div> -->

                <a class="mpc-db-data-one shadow p-2 text-decoration-none color-initial" style="color:var(--mpc-normal-mode-color--)" href="<?php echo __mpc_root__()?>dashboard.php/?action=RequestLoad">
                    <div class="db-iconsWrap">
                        <i class="fas fa-hand-holding-usd fa-3x"></i>
                    </div>
                    <div class="db-title" title="FIXED DEPOSIT ACCOUNT">
                        <h6>REQUEST LOAN</h6>
                        
                    </div>
                </a>

                <div class="mpc-db-data-one shadow p-2">
                    <div class="db-iconsWrap">
                        <i class="fas fa-balance-scale fa-3x"></i>
                    </div>
                    <div class="db-title" title="LOAN">
                        <h6>LOAN BALANCE: &#8358; <strong class="__xcessData">0.00</strong></h6>
                        
                    </div>    
                </div>
                <!--PASTE END HERE -->

                <!-- <div class="mpc-db-data-one shadow">
                    <div class="db-iconsWrap">
                        <i class="fas fa-right-left fa-3x"></i>
                    </div>
                    <div class="db-title" title="Transfer cash to Member">
                        <h6><a href="<?php echo __mpc_root__()?>dashboard.php/?action=transfer" style="color:rgb(225, 145, 24);text-decoration:none;">Transfer cash</a></h6>
                    </div>
                </div> -->

                <!-- <div class="mpc-db-data-one shadow">
                    <div class="db-iconsWrap">
                        <i class="fas fa-money-bill fa-3x"></i>
                    </div>
                    <div class="db-title" title="Repay Loan">
                        <h6>Repay Loan</h6>
                    </div>
                </div> -->

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

                try{
                    let db_balance = await api.getSingleBalance(id, ph);
                    // console.log(db_balance);
                    api.selector('.sharesBalance').innerText = db_balance.data.shares_balance.toFixed(2);
                    api.selector('.thriftBalance').innerText = db_balance.data.thrift_saving_balance.toFixed(2);
                    api.selector('.specialBalance').innerText = db_balance.data.special_saving_balance.toFixed(2);


                }catch(error){
                    api.showToast(error);
                    console.error('Error fetching balances:', error);
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
                
                let ddata = await api.dboardLoan(id, ph);
                // console.log(ddata); 
                    if(ddata.status !== false){
                        updater.innerHTML = `&#8358;${ddata.current_balance.toFixed(2)}`;
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
    }else if($_GET['action'] === 'Dues'){
        
        ?>
        <i class="mpcMsg"> <?php print getSystemName($conn)[1]?> Members Dues</i>
        <hr class="mpcHr">

        <div class="member-dues-wrapper">

  <!-- Header -->
  <div class="member-header">
    <h2 style="color: var(--bs-dark)">My Dues Summary</h2>
    <p>All charges applied to your account</p>
  </div>

  <!-- Member Info -->
  <div class="member-info-card">
    <div>
      <p><strong>Name:</strong> <span class="name">John Doe</span></p>
      <p><strong>Member ID:</strong> <span class="member-id">MPC-1023</span></p>
      <p><strong>Phone:</strong> <span class="phone">08031234567</span></p>
    </div>

    <div class="dues-total">
      <span>Total Dues Charged</span>
      <h1 class="totalAmountCharge">₦28,000.00</h1>
    </div>
  </div>

  <!-- Balance -->
  <div class="balance-card">
    <span>Current Special Savings Balance</span>
    <h2 class="specialBalance">₦150,000.00</h2>
  </div>

  <!-- Dues History -->
  <div class="dues-history-card">
    <h3 style="color: var(--bs-dark)">Dues History</h3>

    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Amount</th>
          <th>Reason</th>
          <th>Date</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td class="negative">₦5,000</td>
          <td>Late monthly contribution</td>
          <td>20 Sep 2025</td>
        </tr>
        <tr>
          <td>2</td>
          <td class="negative">₦3,000</td>
          <td>Penalty</td>
          <td>18 Sep 2025</td>
        </tr>
        <tr>
          <td>3</td>
          <td class="negative">₦20,000</td>
          <td>Loan default charge</td>
          <td>01 Sep 2025</td>
        </tr>
      </tbody>
    </table>
  </div>

    <script type="module">

    import * as api from "../script/api.js";
    const id = "<?=$uidId?>";
    const ph = "<?=$uidPhone?>";

    let duesData = await api.getMemberDues(id, ph);
        // console.log(duesData);
    // console.log(duesData);
    let nameEl = api.selector('.name');
    let memberIdEl = api.selector('.member-id');
    let phoneEl = api.selector('.phone');
    let totalAmountChargeEl = api.selector('.totalAmountCharge');
    let duesHistoryTbody = api.selector('.dues-history-card tbody');
    let specialBalanceEl = api.selector('.specialBalance');

    //check if status from api is true
    if(duesData.status !== false){
        let data = duesData.member;

        nameEl.innerText = data.name;
        memberIdEl.innerText = data.id;
        phoneEl.innerText = data.phone;
        totalAmountChargeEl.innerText = `₦${duesData.total_dues.toFixed(2)}`;
        specialBalanceEl.innerText = `₦${data.special_balance.toFixed(2)}`;
        // console.log(duesData.special_balance);

        //populate dues history
        duesHistoryTbody.innerHTML = ''; //clear existing rows
        duesData.recent_dues.forEach((due, index) => {
            let row = document.createElement('tr');
                row.style.color = 'var(--bs-dark)';
            row.innerHTML = `
                <td>${index + 1}</td>
                <td class="negative">₦${due.amount.toFixed(2)}</td>
                <td>${due.reason}</td>
                <td>${due.date}</td>
            `;
            duesHistoryTbody.appendChild(row);
        });

    }else{
        api.showToast('No dues data found for your account.');
    }


    </script>


</div>
<style>
* {
  box-sizing: border-box;
  font-family: "Segoe UI", sans-serif;
}

body {
  background: #f5f7fb;
}

.member-dues-wrapper {
  max-width: 1000px;
  margin: 30px auto;
  display: grid;
  gap: 22px;
}

/* Header */
.member-header h2 {
  margin-bottom: 5px;
}

.member-header p {
  color: #666;
}

/* Member Info */
.member-info-card {
  background: #fff;
  padding: 22px;
  border-radius: 10px;
  display: flex;
  justify-content: space-between;
  box-shadow: 0 4px 10px rgba(0,0,0,0.05);
}

.member-info-card p {
  margin: 5px 0;
}

.dues-total {
  text-align: right;
}

.dues-total span {
  font-size: 14px;
  color: #888;
}

.dues-total h1 {
  color: #c0392b;
  margin-top: 6px;
}

/* Balance */
.balance-card {
  background: #eafaf1;
  padding: 18px 22px;
  border-radius: 10px;
}

.balance-card span {
  font-size: 14px;
  color: #555;
}

.balance-card h2 {
  margin-top: 5px;
  color: #0a7c4a;
}

/* History */
.dues-history-card {
  background: #fff;
  padding: 22px;
  border-radius: 10px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.05);
}

.dues-history-card h3 {
  margin-bottom: 15px;
}

table {
  width: 100%;
  border-collapse: collapse;
}

thead {
  background: #f2f4f8;
}

th, td {
  padding: 14px;
  border-bottom: 1px solid #eee;
}

th {
  text-align: left;
  font-size: 14px;
}

td {
  font-size: 14px;
}

.negative {
  color: #c0392b;
  font-weight: 600;
}




</style>






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
                    let memberDob = "<?php echo __mpcReturnByPhoneMember($conn, $uidPhone)[3]?>";
                    let splt = txt.split('/');
                   console.log(txt);
                    let day = splt[0];
                    let month = splt[1];
                    let year = splt[2];
                    let yearTxt = `${year}-${month}-${day} 00:00:00`;

                    let dateOfAppointment = new Date(yearTxt);
                    let dateOfRetirement = new Date();
                    let rxtx = document.querySelector('.rtnifdueforretirement');


                function checkRetirementStatus(dateOfAppointment, dateOfBirth) {
                    // Parse DD/MM/YYYY
                    const parseDate = (str) => {
                        const [day, month, year] = str.split('/').map(Number);
                        return new Date(year, month - 1, day);
                    };

                    const appointmentDate = parseDate(dateOfAppointment);
                    const birthDate = parseDate(dateOfBirth);
                    const today = new Date();

                    // Calculate years worked
                    let yearsWorked = today.getFullYear() - appointmentDate.getFullYear();
                    if (
                        today.getMonth() < appointmentDate.getMonth() ||
                        (today.getMonth() === appointmentDate.getMonth() && today.getDate() < appointmentDate.getDate())
                    ) {
                        yearsWorked--;
                    }

                    // Calculate age
                    let age = today.getFullYear() - birthDate.getFullYear();
                    if (
                        today.getMonth() < birthDate.getMonth() ||
                        (today.getMonth() === birthDate.getMonth() && today.getDate() < birthDate.getDate())
                    ) {
                        age--;
                    }

                    // Retirement checks
                    const retiredByService = yearsWorked >= 35;
                    const retiredByAge = age >= 60;

                    if (retiredByService || retiredByAge) {
                        return {
                            retired: true,
                            yearsWorked,
                            age,
                            reason: retiredByService ? "35 years of service reached" : "60 years of age reached"
                        };
                    }

                    return {
                        retired: false,
                        yearsWorked,
                        age,
                        yearsRemaining: Math.min(35 - yearsWorked, 60 - age)
                    };
                }


                let RetireStatus = checkRetirementStatus(txt, memberDob);
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
                    document.querySelector('.numberof').innerHTML = `You are <strong>${RetireStatus.age}</strong> years old, worked for <strong>${RetireStatus.yearsWorked} years so far.`;
                 console.log(RetireStatus);

                    if(RetireStatus.retired){
                        rxtx.innerHTML = Name + ' You are due for retirement, it has been a great Journey!';
                        rxtx.classList.add('alert-danger');
                    }else {
                        rxtx.innerHTML = Name + ` you are not yet due for retirement, You still have  ${RetireStatus.yearsRemaining} years to work` ;
                        rxtx.classList.add('alert-success');
                    }
                    // if(returnOnlyYearsWorkedFor(dateOfAppointment, dateOfRetirement) >= 10){
                    //     rxtx.innerHTML = Name + ' You are due for retirement, it has been a great Journey!';
                    //     rxtx.classList.add('alert-danger');
                    // }else {
                    //     rxtx.innerHTML = Name + ` you are not yet due for retirement, You still have  ${45 -returnOnlyYearsWorkedFor(dateOfAppointment, dateOfRetirement)} years to work` ;
                    //     rxtx.classList.add('alert-success');
                    // }

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

    .toQ00{
        height: 35px;
        border: 1px solid #ccc;
    }

@media only screen and (max-width:800px){
    .__ts{
        width: 80%;
        height: auto;
    }

    .loan-card{
        width: 95% !important;
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
        <div class="toQ00 w-100 d-flex h">
        <input type="search" class="mpcTrackid setStyle createLoanInput " placeholder="Enter your Tracking ID">
        <button class="mpc-btn mpcBtnActive btn-success   _track_loan_">
            <i class="fas fa-search"></i>
        </button>
        </div>
<br><br>
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

        <!-- Loan Calculator UI Component (No boilerplate) -->

<div class="loan-card">
    <h3>Loan Calculator</h3>

    <label>Loan Amount</label>
    <input type="number" id="loan_amount" placeholder="Enter amount" />

    <label>Duration (Months)</label>
    <select id="months">
        <option value="">Select...</option>
        <option value="5">5 Months</option>
        <option value="10">10 Months</option>
        <option value="15">12 Months</option>
        <option value="20">20 Months</option>
        <option value="25">25 Months</option>
    </select>

    <div class="loan-results">
        <div><span>Total Interest:</span> <strong id="interest">₦0</strong></div>
        <div><span>Total Payable:</span> <strong id="total_payable">₦0</strong></div>
        <div><span>Monthly Payment:</span> <strong id="monthly_payment">₦0</strong></div>
        <div><span>Due Date:</span> <strong id="due_date">---</strong></div>
        <div><span>Total in Thrift, Shares, Special:</span> <strong id="total3">---</strong></div>
        <div><span>Max Loan Limit:</span> <strong id="limit">---</strong></div>
    </div>

    <button class="btn mpc-btn btn-success btn-active mt-1 mb-1 m-auto w-100 _g_go_">Request for Loan</button>
    <button class="btn btn-danger btn-active m-1 m-auto w-100 mt-1 mb-1 _what_is_special_">Request Special Savings</button>
    <h6 class="mt-1 mb-1 trackingCode"></h6>
</div>

<script type="module">
    //loan calculator script
    import * as api from "../script/api.js";

    const reqLoanBtn = api.selector('._g_go_');
    const specialbtn = api.selector('._what_is_special_');
    const membBalance= await api.getmembersBalanceAll("<?=$uidId?>","<?=$uidPhone?>");
    window.memberbalance = membBalance;
    window.showToast = api.showToast;

    api.selector('#total3').innerHTML = `₦${membBalance.total_balance}`;
    api.selector('#limit').innerHTML = `₦${membBalance.loan_limit}`;

    // console.log('Member balance:', membBalance);
        //checking loan status for member using tracking id
    const trackLoanBtn = api.selector('._track_loan_');
    if(trackLoanBtn){
        trackLoanBtn.addEventListener('click', async function(){
            const trackingIdInput = api.selector('.mpcTrackid');
            const trackingId = trackingIdInput.value.trim();

            if(trackingId === ''){
                api.showToast("Please enter a valid Tracking ID");
                return;
            }


            const loanData = await api.trackLoanRequest("<?=__mpc_root__()?>", trackingId);
            if(loanData.status === 'success'){
                let message = `Loan Found in ${loanData.source_table}:\n`;
                for(const [key, value] of Object.entries(loanData.data)){
                    message += `${key}: <strong class="text-primary">${value}\n</strong>`;
                }
                api.newPopup('Loan Details', {width: '400px', height: 'auto', padding: '20px', background:'#000', color:'#fff'}, function(){
                    const contentWrap = document.querySelector('.popContentWrap');
                    contentWrap.innerHTML = `<pre style="white-space: pre-wrap; word-wrap: break-word;">${message}</pre>`;
                });
            } else {
                api.showToast(loanData.message || "Loan not found");
            }
        });
    }

        reqLoanBtn.addEventListener('click', async function(){
            let loanAmount  = api.selector("#loan_amount")?.value;
            let duration    = api.selector("#months").value;
            let trackcode   = api.selector('.trackingCode');

            if(loanAmount === '' || loanAmount <= 0){
                api.showToast('Enter valid loan amount');
                return;
            }

            if(duration === ''){
                api.showToast('Select loan duration');
                return;
            }

            if(duration > 25){
                api.showToast('Maximum loan duration is 25 months');
                return;
            }

            if(localStorage.getItem('_mpc_loan_calculator_') === null){
                api.showToast('Calculate loan details before proceeding');
                return;
            }

//check if loan amount is within limit
            if(parseFloat(loanAmount) > parseFloat(membBalance.loan_limit)){
                api.showToast('Requested loan amount exceeds your maximum loan limit: Your limit is ₦' + membBalance.loan_limit);
                return;
            }

            let calcData = JSON.parse(localStorage.getItem('_mpc_loan_calculator_'));

            const data = {
                loan_amount: loanAmount,
                duration_months: duration,
                member_id: "<?=$uidId?>",
                member_phone: "<?=$uidPhone?>",
                total_payable: calcData.total,
                interest_rate: calcData.interestInpercent,
                monthly_payment: calcData.monthly,
                due_date: calcData.dueDate,
                repayment_frequency: 'monthly'
                
            };

            // console.log(data);
            //proceed to send loan request
            let response = await api.requestLoan(__mpc_uri__(), data);
            // alert(response.message);
            // console.log(response);
            api.showToast(`${response.message}, Your tracking ID is ${response.tracking_code }`);
            if(response.status === 'success'){
                trackcode.innerHTML = `Your tracking ID is: <strong>${response.tracking_code}</strong>`;
                //clear local storage
                localStorage.removeItem('_mpc_loan_calculator_');
                //reset form
                api.selector("#loan_amount").value = '';
                api.selector("#months").value = '';
                api.selector("#interest").textContent = "₦0";
                api.selector("#total_payable").textContent = "₦0";
                api.selector("#monthly_payment").textContent = "₦0";
                api.selector("#due_date").textContent = "---";

                //write response to clib board here
                //...
            }



        })

        specialbtn.addEventListener('click', function() {
            let style = {
                width: '50%',
                height: '350px',
                padding: '20px',
                borderRadius: '12px',
                background: '#fff',
                overflowY: 'auto',
                boxShadow: '0 4px 12px rgba(0,0,0,0.1)',
            }
            //invoke popup here
            api.newPopup('', style, function(){
                let dwrap = document.querySelector('.popContentWrap');
                    dwrap.innerHTML = '';
                dwrap.innerHTML = `
                    <h3 class="text-center">Special Savings Request</h3>
                    <div class="SpecialAmount mt-2 mb-2 h-25">
                    <!--label>Amount</label-->
                    <input type="number" class="amountRQ p-2 w-100" placeholder="Enter amount" />
                    </div>
                    <div class="SpecialAmount h-50">
                        <!--label>Reason</label-->
                        <textarea class="loan-err p-2 w-100 h-100" placeholder="Enter reason for special savings request"></textarea>
                    </div>
                    <button class="mpc-btn btn-danger btn-active mt-2 submitSpecialRequest w-100">Submit Request</button>
                    <p class="specialErrRtn mt-2 text-dark" style="font-weight:600;transition:0.5s;"></p>
               
              
                
<style>
.SpecialAmount{
    margin-bottom: 10px;
    height: auto;
}

.SpecialAmount input::placeholder,
.SpecialAmount textarea::placeholder{
    font-size: 14px;
    color: #999;
}
              
@media only screen and (max-width:800px){
    .popContentWrap{
        width: 90%!important;
    }
    .SpecialAmount .amountRQ,
    .SpecialAmount .loan-err{
        width: 100%;
    }
}
</style>
             
                    `;
               
                //handle special savings request submission
                const submitBtn = document.querySelector('.submitSpecialRequest');
                submitBtn.addEventListener('click', async function(){
                    const amountInput = api.selector('.amountRQ');
                    const reasonInput = api.selector('.loan-err');
                    const errRtn = api.selector('.specialErrRtn');

                    const memberSpecialBalance =   await api.getSpecialSavings(__mpc_uri__(), "<?=$uidId?>", "<?=$uidPhone?>");
                    console.log(memberSpecialBalance);
                    let amount = amountInput.value;
                    let reason = reasonInput.value;

                    if(amount === '' || amount <= 0){
                        errRtn.innerHTML = 'Enter valid amount';
                        api.showToast('Enter valid amount', 3000, 'error');
                        return;
                    }

                    // if(reason === ''){
                    //     errRtn.innerHTML = 'Enter reason for special savings request';
                    //     api.showToast('Enter valid amount', 3000, 'error');
                    //     return;
                    // }
                    if(!memberSpecialBalance.status || !('data' in memberSpecialBalance)){
                        errRtn.innerHTML = 'Unable to get your special savings balance, refresh page and try again!';
                        api.showToast('Unable to get your special savings balance, refresh page and try again!', 3000, 'error');
                        return;
                    }

                    //check if member is requesting less than 20k
                    if(amount < 20000){
                        errRtn.innerHTML = 'Minimum special savings request is ₦20,000';
                        api.showToast('Minimum special savings request is ₦20,000', 3000, 'error');
                        return;
                    }

                    if(amount > memberSpecialBalance.data.balance){
                        errRtn.innerHTML = 'Your Balance is too low, please fund wallet then try again!';
                        api.showToast('Your Balance is too low, please fund wallet then try again!', 3000, 'error');
                        return;
                    }

                    //proceed to send special savings request
                    const requestData = {
                        member_id: "<?=$uidId?>",
                        members_phone: "<?=$uidPhone?>",
                        loan_amount: amount,
                        loan_reason: reason
                    };
                    /**
                     * member_id
members_phone
loan_amount
loan_reason
                     */

                    let response = await api.specialLoanRequest(__mpc_uri__(), requestData);
                    // console.log(response);
                    errRtn.innerHTML = response.message + ' Your tracking ID is ' + response.tracking_code;
                    if(response.status === 'success'){
                        //clear form
                        api.showToast(`${response.message}, Your tracking ID is ${response.tracking_code}`, 4000, 'success');
                        amountInput.value = '';
                        reasonInput.value = '';
                    }

                })
            });
        })
    
</script>
<style>


.loan-card {
    background: #fff;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    width: 60%;
    margin: 1rem auto 3rem auto;
}

.loan-card h3 {
    text-align: center;
    margin-bottom: 15px;
}

.loan-card label {
    display: block;
    margin: 10px 0 5px;
    font-weight: 600;
}

.loan-card input,
.loan-card select {
    width: 100%;
    padding: 10px;
    font-size: 15px;
    border: 1px solid #ccc;
    border-radius: 6px;
}

.loan-results {
    margin-top: 15px;
    background: #f4f7ff;
    padding: 15px;
    border-radius: 10px;
}

.loan-results div {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
}
</style>

<script>
    const loan = document.getElementById("loan_amount");
    const months = document.getElementById("months");

    loan.addEventListener("input", calculate);
    months.addEventListener("change", calculate);

    function calculate() {
        let amount = parseFloat(loan.value) || 0;
        let duration = parseInt(months.value) || 0;

        if (amount > 0 && duration > 0) {
            let interest = amount * 0.01 * duration;
            let total = amount + interest;
            let monthly = total / duration;

          

            if(!window.memberbalance){
                window.showToast('Unable to get member balance data, refresh page and try again', 5000, 'error');
                return;
            }

            if(amount > window.memberbalance.loan_limit){
                window.showToast(`Loan request exceeds your maximum loan limit of ₦${window.memberbalance.loan_limit}`, 5000, 'error');
                return;
            }

            let key = {
                        interest: interest, 
                        total: total, 
                        monthly: monthly.toFixed(2),
                        dueDate: new Date(new Date().setMonth(new Date().getMonth() + duration)),
                        interestInpercent: 1.00
                    };

            document.getElementById("interest").textContent = "₦" + interest.toLocaleString();
            document.getElementById("total_payable").textContent = "₦" + total.toLocaleString();
            document.getElementById("monthly_payment").textContent = "₦" + monthly.toLocaleString(undefined, {minimumFractionDigits: 2});
            let due = new Date();
            due.setMonth(due.getMonth() + duration);
            document.getElementById("due_date").textContent = due.toDateString();
            localStorage.setItem('_mpc_loan_calculator_', JSON.stringify(key));
            
        }
    }
</script>



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


