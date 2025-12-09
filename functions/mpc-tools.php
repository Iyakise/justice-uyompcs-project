<?php
/**mpc tools file 
 * this file was created on 2/2/2023
 * by Yakise Raphael
 */
if(!defined('MPC-AUTORIZE-CALL')) {
	die('<h1 class="mpc-enter">ACCESS DENIED</h1>');
}

if(isset($_GET['action']) && !empty($_GET['action'])) {
    ?>
    <style>
        ::placeholder {
            color:rgb(226, 145, 24);
            font-family:sans-serif;
            font-weight: 600;
        }
        .mpc-toCheck {
            display:inline;
            margin:0;
            padding:0;
        }

        .to-red-color{
            color: #ff0000;
        }
        .anyOtherCooperative {
            width: 20px;
            height: 20px;
            outline:none;
            border:none; 
        }
        .Last-Steps {
            display:none;
        }
        .addMemberButt {
            height:50px;
            display:inherit;
            align-items: center;
            justify-content:center;
        }
        .table {
            color: /*#3f7e64*/ #515254;
            font-family:monospace;
        }
        .member-status{
            color:gray;
            font-family:monospace;
        }
        .member-status svg[data-icon="user-check"]{
            color:mediumseagreen;
        }

        .member-status svg[data-icon="user-xmark"]{
            color:red;
        }

    </style>
    <?php
    if($_GET['action'] == 'addClient') {
        ?>
        <i class="mpc-admMsg">Add Member </i>
        <i class="cUploadUser"></i>
        <hr class="mpcHr">
        <div class="adm-progress">
            <div class="stepOne ptrack"></div>
            <div class="stepTwo ptrack"></div>
            <div class="stepThree ptrack">

                <p class="usrId mpc-toCheck" >0</p>
                <p class="UploadAny mpc-toCheck">0</p>
            </div>
            
        </div>

        <div class="user-stepOne">
            <form action="" method="post">
                <input type="text" placeholder="Title:" class="Ttle boxSmall setStyle">

                <input type="text" placeholder="Sex:" class="sex boxSmall setStyle">

                <input type="date" placeholder="Date of Birth:" class="dob  boxMedium setStyle">
                <input type="text" placeholder="Name:" class="name  boxMedium setStyle">
                <input type="text" placeholder="Contact Address:" class="cAddr  boxMedium setStyle">
                <input type="text" placeholder="Permanent Address:" class="pAddr  boxMedium setStyle">
                <input type="Phone" placeholder="Phone:" class="PhoneNum  boxMedium setStyle">

                <input type="text" placeholder="L.G.A:" class="lga  boxMedium setStyle">
                <input type="text" placeholder="Place of birth:" class="pobirth  boxMedium setStyle">
                <input type="text" placeholder="Religion:" class="religion  boxMedium setStyle">
                <input type="Email" placeholder="Email:" class="email  boxMedium setStyle">
                <input type="text" placeholder="Occupation/Nature of Business:" class="occupation  boxlarge setStyle">
                <input type="text" placeholder="Business/Work Address:" class="bizAddr  boxlarge setStyle">
                <input type="text" placeholder="Church:" class="church  boxMedium setStyle">

                <!-- next of kin start -->
                <hr class="mpcHr">
                <i class="" style="display:block;">Next of Kin</i>
                <input type="text" placeholder="Name:" class="nextOfKin  boxMedium setStyle">
                <input type="text" placeholder="Relation:" class="RelationNextOfKin  boxMedium setStyle">
                <input type="text" placeholder="Address:" class="NextOfKinAddr  boxlarge setStyle">
                <input type="phone" placeholder="Phone:" class="NextOfKinPhone  boxMedium setStyle">

                <button class="client-add mpc-clientButt" onclick="addClientStepOne()" type="button">Continue <i class="fas fa-arrow-right"></i></button>

            </form>
        </div>

        <div class="user-stepTwo">
            <i class="fa fa-money-bill fa-4x"></i> <i>Bank Detail:</i>
            <form action="" method="post">
                <label for="">*</label>
                    <input type="text" placeholder="Account number:" class="acctNo boxMedium setStyle">

                    <label for="">*</label>
                <input type="text" placeholder="Bank name:" class="BankName boxMedium setStyle">
                <label for="">*</label>
                <input type="text" placeholder="Account Name:" class="ActtName boxMedium setStyle">

                <label for="anyOtherCooperative">Any other cooperative ?
                    <input type="checkbox" id="anyOtherCooperative" class="anyOtherCooperative  setStyle" title="Any other cooperative ?">
                </label>
                <input type="text" disabled placeholder="Name of the cooperative:" class="cooperativeName  boxlarge setStyle">
                <hr class="mpcHr">
                <span style="display:block;margin-top:10px"><i class="far fa-handshake fa-4x" ></i>  <i class="">Gurantors Details</i>  </span>

                <label for="">*</label>
                <input type="text" placeholder="Referee's Name/Address:" class="RefAddre  boxlarge setStyle">
                <label for="">*
                    <input type="text" placeholder="Referee's Phone Number:" class="RefPhone  boxMedium setStyle">
                </label>
                <hr class="mpcHr">
                <span style="display:block;margin-top:10px"><i class="far fas fa-signing fa-4x" ></i>  <i class="">Declaration</i>  </span>
                <p class="declare">I , <span class="declareName" style='color:green;'></span> Promise to abide by the rules, regulations, policies and bye-law governing this cooperative.</p>


                <button class="client-add mpc-clientButt" onclick="addClientStepTwo()" type="button">Continue <i class="fas fa-arrow-right"></i></button>
<!--
                <input type="text" placeholder="L.G.A:" class="lga  boxMedium setStyle">
                <input type="text" placeholder="Place of birth:" class="pobirth  boxMedium setStyle">
                <input type="text" placeholder="Religion:" class="religion  boxMedium setStyle">
                <input type="text" placeholder="Email:" class="email  boxMedium setStyle">
                <input type="text" placeholder="Occupation/Nature of Business:" class="occupation  boxlarge setStyle">
                <input type="text" placeholder="Business/Work Address:" class="bizAddr  boxlarge setStyle">
                <input type="text" placeholder="Church:" class="church  boxMedium setStyle">
    -->
                <!-- next of kin start -->
<!--
                <hr class="mpcHr">
                <i class="" style="display:block;">Next of Kin</i>
                <input type="text" placeholder="Name:" class="nextOfKin  boxMedium setStyle">
                <input type="text" placeholder="Relation:" class="RelationNextOfKin  boxMedium setStyle">
                <input type="text" placeholder="Address:" class="NextOfKinAddr  boxlarge setStyle">
                <input type="text" placeholder="Phone:" class="NextOfKinPhone  boxMedium setStyle">

                
    -->
            </form>
        </div>

        <div class="Last-Steps">
            <button class="addMemberButt client-add mpc-clientButt" onclick="rtnBack()">Finish <i class="fa-check fa"></i></button>
        </div>
    
        <?php
        if(isset($_GET['uid']) && !empty($_GET['uid'])){
            ?>
            <script>
                var a, hide, show, uid, anyOne, curnId;
                //geting inport that data
                    uid = "<?php echo $_GET['uid'];?>"; //current user id
                    anyOne = "<?php echo $_GET['n'];?>"; //curruent user name

                    hide = document.querySelector('.user-stepOne');
                    hide.style.display = 'none';
                    hide.style.visibility = 'hidden';

                    show = document.querySelector('.user-stepTwo');
                    show.style.display = 'block';
                    show.style.visibility = 'visible';

                    //add green color for element
                    a = document.querySelector('.stepOne');
                    a.style.background = 'mediumseagreen';
                    a.style.border = '2px solid #8bf500';
                    a.title = 'Step one completed';

                    //return id for other resources to follow usse
                    document.querySelector('.usrId').innerHTML = uid;
                    document.querySelector('.UploadAny').innerHTML = 1;

                    //return current user bank name
                    document.querySelector('.ActtName').value = anyOne;
                    document.querySelector('.declareName').innerText = anyOne;

                function __checkMpcBox() {
                    var checkedBox, inputBox;
                        checkedBox = document.querySelector('.anyOtherCooperative');
                        inputBox = document.querySelector('.cooperativeName');
                        checkedBox.addEventListener('click', function() {
                            if(this.checked) {
                                inputBox.disabled = false;
                            }else {
                                inputBox.disabled = true;
                            }
                        })
                }
                __checkMpcBox();


            </script>
            <?php
        }

        if(isset($_GET['s']) && !empty($_GET['s']) && $_GET['s'] === 'true') {
            ?>
<script>
    var a, b, c, d, e;
            a = document.querySelectorAll('.ptrack');
            b = document.querySelector('.mpc-admin-ds-notify');
            c = document.querySelector('.Last-Steps');
            d = document.querySelector('.user-stepOne');
            for (let i = 0; i < a.length; i++) {
                a[i].style.background = 'mediumseagreen';
                a[i].style.border = '2px solid #8bf500';
                a[i].title = 'Step ' + i  + ' Completed successful';
                
            }

            b.textContent = 'Member information saved successfully, click the finished button below to return!';
            d.style.display = 'None';
            d.style.visibility = 'hidden';

            c.style.display = 'block';
            c.style.visibility = 'visible';


            function rtnBack() {
                window.location.replace(__mpcFile_path() + 'user/dashboard.php/?action=addClient&r=client');
                //after all of this is over return back to where we first start this journey
            }
</script>

            <?php
        }
    }else {
        if($_GET['action'] == 'ltransaction') {
            ?>
            <i class="mpc-admMsg">Loan transaction</i><br><br>
            <hr class="mpcHr">

            <div class="mpc-loan-transaction">
                <div class="mpc-data-loan">
                    <h6>
                    <?php 
                    echo $fullname = $fn . ' '.$ln; 
                    $month = date('F');
                    $year = date('Y');
                   ?>,
                   
                    </h6>
                    <hr class="mpcHr">

                    <div class="mpc-loan-display-tool">
                        <select class="adm-select createLoanInput mpc-ltransactionQuery">
                            <option value="">-----</option>
                            <option value="Group">GROUP LOAN</option>
                            <option value="Regular">REGULAR LOAN</option>
                            <option value="All">ALL</option>
                            
                        </select>

                        <input type="text" class="setStyle createLoanInput mpc-filter-loanTr" placeholder="Search">
                    </div>

                    <div class="mpc-ltransactions mpc-document-print">
                        <div class="table-responsive ltransaction-return responsReturn">
                            <table class="table table-hover table-striped table-border">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Profil</th>
                                        <th>type</th>
                                        <th>B. Amount</th>
                                        <th>R. Amount</th>
                                        <th>Approved by</th>
                                        <th>penalty</th>
                                        <!-- <th>Group</th> -->
                                        <th>Total paid</th>
                                    </tr>
                                </thead>

                                <tbody>
                                <?php
                                    __mpc_LoadLoan_transaction__($conn, $month); //default, get all approved loan of the current month
                                ?>
                                </tbody>
                            </table>
                            
                        </div>
                    </div>
                    <button class="mpc-btn print-mpc-page" ><i class="fa-print fa-solid" style="color:orange;" title="PRINT PAGE"></i></button>
                    <button class="mpc-btn"><i class="fa-file-pdf fa-solid" title="TO PDF" style="color:orange;"></i></button>

                </div>
            </div>
<script>
    __mpcPrinter__(); //allowed admin to print
    var loantransactionQselect, filterLoantrans;
            
        loantransactionQselect = document.querySelector('.mpc-ltransactionQuery');
        loantransactionQselect.addEventListener('change', function(){
            var val, rtn, xhr, returnAlldata;
                val = this.value
                rtn = document.querySelector('.mpc-admin-ds-notify');
                returnAlldata = document.querySelector('.ltransaction-return');
                filterLoantrans = document.querySelector('.mpc-filter-loanTr');
            
                //change search param input placeholder
                if(val === 'Regular'){
                    filterLoantrans.placeholder = 'Search (+2349069053009)';
                    filterLoantrans.disabled = false;
                }else if(val === 'Group'){
                    filterLoantrans.placeholder = 'Enter group name';
                    filterLoantrans.disabled = false;
                    
                }else {
                    filterLoantrans.disabled = true;
                }

            if(val === ''){
                rtn.innnerHTML = 'PLEASE SELECT FILTER TYPE';
                rtn.classList.add('to-red-color');
                rtn.classList.add('fa-fade');
            }else {
                xhr = new XMLHttpRequest();

                __mpcShowAnimation__();
                
                xhr.open('GET', __mpc_uri__() + 'functions/mpc-ajax-action.php?PERM=mpcLoanTransactionFilter&type='+val, true);
                xhr.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        __mpcAnimaitonOff__();

                        returnAlldata.innerHTML = this.response;
                    }
                }
                xhr.send();
            }
                
        })

    var loanTransactionFilterInput, selectVal, rtn, inputVal, xhr, displayResult;
        loanTransactionFilterInput = document.querySelector('.mpc-filter-loanTr'); //select filter input
        displayResult = document.querySelector('.ltransaction-return'); //get result display div
        selectVal = document.querySelector('.mpc-ltransactionQuery'); //query type select

        loanTransactionFilterInput.addEventListener('input', function(){
        rtn = document.querySelector('.mpc-admin-ds-notify');
//Group
            inputVal = this.value;
            
            if(selectVal.value === ''){
                rtn.innerHTML = 'Select filter parameter';
                rtn.classList.add('to-red-color');
                rtn.classList.add('fa-fade');
                selectVal.style.border = '1.5px solid red';

            }else if(selectVal.value === 'Regular' && inputVal.search(/[a-z!+@#$%^&*<(-):?"'{|}X>]/i) !== -1){
                rtn.innerHTML = 'Invalid filter key in search field ' + inputVal;
                rtn.classList.add('to-red-color');
                rtn.classList.add('fa-fade');
            }else if(selectVal.value === 'Group' && inputVal.search(/[0-9!+@#$%^&*<(-):?"'{|}X>]/i) !== -1){
                rtn.innerHTML = 'Invalid filter key in search field';
                rtn.classList.add('to-red-color');
                rtn.classList.add('fa-fade');
            }else{
                rtn.innerHTML = '';
                rtn.classList.remove('to-red-color');
                rtn.classList.remove('fa-fade');
                selectVal.style.border = 'none';

                

                xhr = new XMLHttpRequest();
                xhr.open('GET', __mpc_uri__() + 'functions/mpc-ajax-action.php?PERM=filterWithMPCinpuT&key='+ inputVal + '&type='+selectVal.value, true);
                xhr.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        displayResult.innerHTML = this.response;
                    }
                }
                xhr.send();
            }

        })
</script>
        
            <?php
        }else {
            if($_GET['action'] == 'dTransactions') {
                ?>
                <i class="mpc-admMsg">Deposit Transaction</i><br><br>
                <hr class="mpcHr">
                <div class="mpc-deposit-transaction">
                    <div class="deposit-wrapper">
                        <div class="deposit-top-tools">
                        
                            <input type="text" class="setStyle createLoanInput searchReference" placeholder="Reference code, phone">
                        </div>

                        <div class="mpc-deposit-load mpc-document-print">
                            <div class="table-responsive responsReturn">
                                <table class="table table-border table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Account owner</th>
                                            <th>Account Number</th>
                                            <th>Amount deposit</th>
                                            <th>Deposit Account type</th>
                                            <th>Depositor Name</th>
                                            <th>Depositor Phone</th>
                                            <th>Reference code</th>
                                            <th>Time</th>
                                            
                                        </tr>
                                    </thead>

                                    <?php
                                        __mpc_deposit__($conn);
                                    ?>
                                </table>

                            </div>
                        </div>

                        <button class="mpc-btn print-mpc-page" ><i class="fa-print fa-solid" style="color:orange;" title="PRINT PAGE"></i></button>
                        <button class="mpc-btn"><i class="fa-file-pdf fa-solid" title="TO PDF" style="color:orange;"></i></button>

<script>
     __mpcPrinter__(); //allowed admin to print
    var groupAmount = document.querySelectorAll('.mpc-admGroup');
        
        groupAmount.forEach(
            amount => {
                var each = amount.innerText.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                
                amount.innerHTML = each;
            }
        )

        var searchReference = document.querySelector('.searchReference');
            searchReference.oninput = function(){

                var xhr, returnData;
                returnData = document.querySelector('.responsReturn');

                xhr = new XMLHttpRequest();
                
                xhr.open('GET', __mpc_uri__() + 'functions/mpc-ajax-action.php?PERM=Xquerympc&Q='+this.value);
                    xhr.onreadystatechange = function(){
                        if(xhr.readyState == 4 && this.status == 200){
                        returnData.innerHTML = this.response;
                      //  console.warn(this.status)
                    }
                }
                xhr.send();
            }

          
</script>
                    </div>
                </div>
                <?php
            }else {
                if($_GET['action'] == 'accounting') {
                    ?>
                    <i class="mpc-admMsg">Accounting</i><br><br>
                    <hr class="mpcHr">
                    <div class="mpc-Accounting-wrap">
                        <h6><?php echo $fn .' '. $ln?>, <?php echo getSystemName($conn)[1]?> Disburse <span class="HighLight disbursement-restyle"> &#8358; <span class="disbursment"><?php echo __totalMoneyPaidOut__($conn)?></span> this month <?php print date('F')?></span></h6>
                        <div class="mpc-accounting-wrapp">
                            <select class="mpc-selectAccounting adm-select createLoanInput">
                                <option value="">-----</option>
                                <option value="Regular">Regular</option>
                                <option value="Group">Group</option>
                            </select>
                            <input type="search" class="setStyle createLoanInput mpcs-searchMonth" placeholder="Enter month (<?php echo date('F')?>)">
                        </div>

                    <div class="mpc-document-print">
                        <div class="mpc-account-made responsReturn mpc-monthly-disbursement">
                            <div class="accout-sec-one group-mpc table-responsive">
                            <table class="table table-border table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Profile</th>
                                        <th>Amount</th>
                                    </tr>
                                    </thead>

                                    <?php __mpc_loanDisbursementMonthly__($conn, 'group', date('F'))?>
                                </table>
                            </div>

                            <div class="accout-sec-one regular-mpc table-responsive">
                                <table class="table table-border table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Profile</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>

                                    <?php __mpc_loanDisbursementMonthly__($conn, 'regular', date('F'))?>
                                </table>
                            </div>
                        </div>
                    </div>
                        <button class="mpc-btn print-mpc-page" ><i class="fa-print fa-solid" style="color:orange;" title="PRINT PAGE"></i></button>
                        <button class="mpc-btn"><i class="fa-file-pdf fa-solid" title="TO PDF" style="color:orange;"></i></button>
                    </div>
<script>
    __mpcPrinter__();
    var MonthlyDisbursement, tompc
        MonthlyDisbursement = document.querySelector('.disbursment').innerText;

        tompc = MonthlyDisbursement.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        document.querySelector('.disbursment').innerHTML = tompc;


//loading
var moneyGroup = document.querySelectorAll('.amountEach');
    
    //loopthrough
    moneyGroup.forEach(
        money => {
           var addGroup =  money.innerText.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            money.innerHTML = addGroup;
        }
    )

    var selectBygrouop = document.querySelector('.mpc-selectAccounting');
        selectBygrouop.addEventListener('change', function(){
            var a, b, c, d, e, f, g;
                a = document.querySelector('.mpc-admin-ds-notify');

            if(this.value === ''){
                a.innerHTML = 'SELECT QUERY PARAMETER';
                a.classList.add('to-red-color');
                a.classList.add('fa-fade');

            }else if(this.value === 'Regular'){
                b = document.querySelector('.regular-mpc');

                //PULLING DATA FROM DATABASE IS MUCH THEN LET DO TIS
                __mpcShowAnimation__(); //show loading animation here
                var xhr;
                
                xhr = new XMLHttpRequest();
                xhr.open('GET', __mpc_uri__() + 'functions/mpc-ajax-action.php?PERM=mpcQueryLOad', true);
                xhr.onreadystatechange = function(){

                    // __mpcAnimaitonOff__(); //turn off aimation here
                    if(this.status == 200 && this.readyState == 4){
                       
                        b.innerHTML = this.response;

                        __amountGroup__(); //group by each 100,00 e.g 100,000.23
                    }
                    
                }
                xhr.send();

                __mpcAnimaitonOff__(); ///animation turn off

            }else if(this.value === 'Group'){
                c = document.querySelector('.group-mpc');

                //PULLING DATA FROM DATABASE IS MUCH THEN LET DO TIS
                __mpcShowAnimation__(); //show loading animation here
                var xhr;
                xhr = new XMLHttpRequest();
                xhr.open('GET', __mpc_uri__() + 'functions/mpc-ajax-action.php?PERM=MPCgroupLOANdISBURSE', true);
                xhr.onreadystatechange = function(){
                    //turn off animation here
                    __mpcAnimaitonOff__(); ///animation turn off
                    if(this.readyState == 4 && this.status == 200){
                        c.innerHTML = this.response;

                        __amountGroup__(); //group amount by each 100,00 e.g 100,000.23
                    }
                }
                xhr.send();
                
            }
        })


//search by month name start here
let mpcsSearchByMonth = document.querySelector('.mpcs-searchMonth');
    mpcsSearchByMonth.addEventListener('input', function(){
        
        var xhr, responseReturn;
            responseReturn = document.querySelector('.mpc-monthly-disbursement');
            xhr = new XMLHttpRequest();
            xhr.open('GET', __mpc_uri__() + 'functions/mpc-ajax-action.php?PERM=disbursementMonth&monthname=' + this.value, true);
            xhr.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    responseReturn.innerHTML = this.responseText;

                    __amountGroup__(); //group return amount 3 after first hundred add comma (100,000),
                }
            }
            xhr.send();
    })
</script>        
                    <?php
                    
                }else {
                    if($_GET['action'] == 'accountingStystemYakise') {
                        
    ?>
    <!--i class="mpc-admMsg">Accounting</i-->

    <?php
                    }else {
                        if($_GET['action'] == 'cSheet') {
    ?>
    <i class="mpc-admMsg">Collect sheet</i><br><br>
    <hr class="mpcHr">

    <div class="mpc-csheet-container">
        <div class="csheet-padder">
            <div class="csheet-item">
                <div class="mpc-csheet-item1">
                    <select class="setStyle adm-select LoanType filter-groupLoan">
                        <option value="">-----</option>
                        <option value="GROUP">GROUP LOAN</option>
                        <option value="REGULAR">REGULAR LOAN</option>
                    </select>
                    <input type="search" class="adm-select LoanType mpc-qinfo collectionSheetFilterByInput" placeholder="Search (<?php echo date('F')?>)">
                    <!--input type="search" class="mpc-table-input-fullwidth mpc-group-loan-group-search setStyle createLoanInput" placeholder="ENTER SEARCH" title="SEARCH FOR GROUP, PHONE, NAME"-->
                </div>

            </div>
            <hr class="mpcHr">

            <!-- RESULT SHOWUP HERE-->
            <div class="mpc-sheet-wrap mpc-document-print">
                <div class="table-responsive responsReturn db-response-return">
                    <table class="table table-bordered table-hover table-striped ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th title="MEMBER GROUP">Group</th>
                                <th title="MEMBER NAME">Member Name</th>
                                <th title="MEMBER PROFILE">Profile</th>
                                <th title="BORROWED AMOUNT BY MEMBER">B. Amount</th>
                                <th title="MONTLY RETURN">M. return</th>
                                <th title="WEEKLY RETURN">W. return</th>
                                <th title="MEMBER PENALTY">penalty</th>
                                <th title="TOTAL AMOUNT MEMBER TO RETURN">Total</th>
                                <th title="TOTAL AMOUNT PAID BY MEMBER">Paid</th>
                                <th title="TOTAL AMOUNT REMAINING">Outstanding</th>
                            </tr>
                        </thead>

                        <?php
/**GETTING ALL ALVAILALBE MEMBERS HERE FOR SHEET COLLECTION
 * THE FUNCTION BELOW ACCEPT 3 PARAMETER
 * [0] DB CONNECTION
 * [1] TYPE OF DATA TO RETURN GROUP OR REGULAR
 * [2] MONTH
 */
$type = 'group';
$month = date('F');
__mpc_collectSheet__($conn, $type, $month);
                        ?>
                    </table>
                </div>
            </div>
            <!-- RESULT SHOWUP HERE-->
        </div>
        <button class="mpc-btn print-mpc-page" ><i class="fa-print fa-solid" style="color:orange;" title="PRINT PAGE"></i></button>
        <button class="mpc-btn"><i class="fa-file-pdf fa-solid" title="TO PDF" style="color:orange;"></i></button>

    </div>

<script>
     __mpcPrinter__(); //allowed admin to print
    __amountGroup__(); //amount group start here

    let filterCollectionSheet = document.querySelector('.filter-groupLoan');
        filterCollectionSheet.onchange = function(){
            let txt,xhr, responseReturn;
                txt = document.querySelector('.mpc-admin-ds-notify');
                responseReturn = document.querySelector('.db-response-return');
           
            if(this.value === ''){
                txt.innerHTML = 'SELECT FILTER PARAMETER';
                txt.classList.add('to-red-color');
                txt.classList.add('fa-fade');
            }else {
                __mpcShowAnimation__(); //ANIMATION TURN HERE
                xhr = new XMLHttpRequest();
                xhr.open('GET', __mpc_uri__() + 'functions/mpc-ajax-action.php?PERM=FILTERPARams&mpcLastkey=' + this.value, true);
                xhr.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        __mpcAnimaitonOff__(); //TURNING OFF ANIMATION HERE
                        responseReturn.innerHTML = this.response;

                        console.log(this.status);
                        __amountGroup__();
                    }
                }
                xhr.send();
            }
        }

    
    //collection sheet collecting by input
    let collectionSheetInput = document.querySelector('.collectionSheetFilterByInput');
        collectionSheetInput.addEventListener('input', function(){
            
            //query type
            let selectVal, xhr, rTxt, responseReturn;
                selectVal = document.querySelector('.filter-groupLoan');
                rTxt = document.querySelector('.mpc-admin-ds-notify');
                responseReturn = document.querySelector('.db-response-return');

                if(selectVal.value === ''){
                    rTxt.innerHTML = 'SELECT SEARCH PARAMETER';
                    selectVal.style.border = '1.5px solid red';
                    rTxt.classList.add('to-red-color');
                    rTxt.classList.add('fa-fade');
                }else {
                    //load animation
                    __mpcShowAnimation__(); //show animation
                    xhr = new XMLHttpRequest();
                    xhr.open('GET', __mpc_uri__() + 'functions/mpc-ajax-action.php?PERM=cSHEEtfilter&key1='+ this.value + '&key2='+selectVal.value, true);
                    xhr.onreadystatechange = function(){
                        if(this.readyState == 4 && this.status == 200){
                            __mpcAnimaitonOff__(); //TURNOFF ANIMATION HERE
                            responseReturn.innerHTML = this.responseText;

                            __amountGroup__(); //group amount
                        }
                    }
                    xhr.send(); //mpc-send ajax request here
                }
        })
</script>
    <?php

                        }else {
                            if($_GET['action'] == 'dashboard') {
                                ?>

                                
                                <i class="mpc-admMsg">Dashboard</i><br><br>
                                <hr class="mpcHr">
                                <div class="dash-board-data">
                                    <div class="mpc-db-one dsh-board-light-mode shadow" title="Active loan">
                                        <div class="part1">
                                            <span class="totalNum activeLoans"></span>
                                            <i class="view">Active</i>
                                        </div>

                                        <div class="part2">
                                            <i class="far fa-eye fa-3x"></i>
                                        </div>
                                    </div>
                                    <div class="mpc-db-one dsh-board-light-mode shadow" title="Loan Request">
                                        <div class="part1">
                                            <span class="totalNum loanRequests" title="loan transaction this month"><?php echo __mpcTotalCounter($conn, 'loan')?></span>
                                            <i class="view">Loan</i>
                                            
                                        </div>

                                        <div class="part2">
                                            <i class="fas fa-balance-scale fa-3x"></i>
                                        </div>
                                    </div>
                                    <div class="mpc-db-one dsh-board-light-mode shadow" title="deposit transaction">
                                        <div class="part1" >
                                            <span class="totalNum depositTotal" title="deposit transaction this month"></span>
                                            <i class="view">Deposit</i>
                                            
                                        </div>

                                        <div class="part2">
                                            <i class="fas fa-shopping-basket fa-3x"></i>
                                        </div>
                                    </div>
                                    <div class="mpc-db-one dsh-board-light-mode shadow">
                                        <div class="part1">
                                            <span class="totalNum">&#8358; <span class="totalCompanyEarnings"><?php echo __mpc_goodLife__($conn)?></span></span>
                                            <i class="view">Earning</i>
                                            
                                        </div>

                                        <div class="part2">
                                            <i class="fas fa-money-check-alt fa-3x"></i>
                                        </div>
                                    </div>

<script type="module">
    import { getCountDeposit, newPopup, fetchDataPost, showToast, selector, getCountAllLoanRequests} from "../../script/api.js";

    const totDep = await getCountDeposit();
    const tpl    = await getCountAllLoanRequests();
    let activeLoan, loanReqCount;
    activeLoan = selector('.activeLoans');
    loanReqCount = selector('.loanRequests');
    if(totDep.status !== "success"){
        showToast('Failed to load deposit count', 'error', 3000);
    }else{
        selector('.depositTotal').innerText = totDep.data.total_unique_members.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    if(tpl.status !== "success"){
        showToast('Failed to load loan request count', 'error', 3000);
    }else{
     activeLoan.innerText = tpl.data.active_loans.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
     loanReqCount.innerText = tpl.data.total_loans.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
    // $('.depositTotal').innerText = totDep.data.total_deposit_transactions.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

console.log(tpl);
    //open chart js here
const ctx = document.querySelector('.deposit-canvass');

new Chart(ctx, {
    type: 'polarArea',
    data: {
        labels: ['Loan', 'Deposit', 'Active Loan'],
        datasets: [{
            label: 'Activities 2023',
            data: [
                tpl?.data?.total_loans ?? 10,
                totDep?.data?.total_unique_members ?? 0,
                tpl?.data?.active_loans ?? 0
            ],
            backgroundColor: [
                'rgba(244, 149, 236, 1)',
                'rgb(255, 159, 64)',
                'rgb(255, 205, 86)'
            ],
            borderColor: [
                'rgb(255, 99, 132)',
                'rgb(255, 159, 64)',
                'rgb(255, 205, 86)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true
    }
});



</script>
<script>
    var totalCompanyEarning, allEarnings, moneyEarn;
        totalCompanyEarning = document.querySelector('.totalCompanyEarnings').innerText; //getting company earnings
        allEarnings = totalCompanyEarning.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        moneyEarn = document.querySelector('.totalCompanyEarnings').innerHTML = allEarnings;

    //fetch deposit count from server
</script>                                    

                                    
                                </div>
                                
                                    <div class="mpc-earn-graph-cnt">
                                        <div class="graph-30 dsh-board-light-mode shadow">
                                            <canvas class="deposit-canvass" style="width:100%;height:fit-content;"></canvas>

                                        </div>
                                        <div class="graph70 dsh-board-light-mode shadow">
                                            <canvas id="mpcchart" style="width:100%;max-height:100%"></canvas>
                                        </div>
                                    </div>
                                    
                                    <script>
                                      /*  const ctx = document.getElementById('mpcchart');
                                        new Chart(ctx, {
                                            type: 'bar',
                                            data: {
                                            labels: ['Jan.', 'Feb.', 'Mar.', 'Apr.', 'May', 'Jun.', 'Jul.', 'Aug.', 'Sept.', 'Oct.', 'Nov.', 'Dec.'],
                                            backgroundColor: [
                                                    'red',
                                                    'green',
                                                    'blue',
                                                    'yellow',
                                                    'black',
                                                    'purple',
                                                    'white',
                                                    'gray',
                                                    'orange',
                                                    'rgba(255, 205, 86, 0.2)',
                                                    'rgba(75, 192, 192, 0.2)',
                                                    'maroon',
                                                    
                                                    ],
                                                    borderColor: [
                                                    'rgb(255, 99, 132)',
                                                    'rgb(255, 159, 64)',
                                                    'rgb(255, 205, 86)',
                                                    'rgb(75, 192, 192)',
                                                    'rgb(54, 162, 235)',
                                                    'rgb(153, 102, 255)',
                                                    'rgb(201, 203, 207)',
                                                    'rgb(255, 99, 132)',
                                                    'rgb(255, 159, 64)',
                                                    'rgb(255, 205, 86)',
                                                    'rgb(75, 192, 192)',
                                                    'rgb(54, 162, 235)'
                                                    ],
                                            datasets: [{
                                                label: 'Earnings 2023',
                                                data: [102000, 1090000, 86000, 500000, 201000, 230000, 600000, 96000, 30000, 90000, 65000, 250000],
                                                borderWidth: 1
                                            }]
                                            },
                                            options: {
                                            scales: {
                                                y: {
                                                beginAtZero: true
                                                },

                                                }
                                                
                                            }
                                        });

                                        */
                                    </script>

                                    <div class="mpc-detail-breakDown">
                                        <div class="mpc-breakPartOne dsh-board-light-mode shadow">
                                            <?php 
                                                
                                            ?>
                                        </div>

                                        <div class="mpc-breakPartTwo dsh-board-light-mode shadow">

                                        </div>
                                    </div>

                                    <div class="mpc-detail-breakDown">
                                        <div class="dsh-board-light-mode adm-lst-login shadow">
                                            <div class="lastLoginTop">
                                                <h5 class="mpc-lastLogin" style="font-weight:normal;padding-left:8px;font-family:monospace">
                                                    <?php print getSystemName($conn)[1]?> login records
                                                </h5>
                                            </div>

                                            <div class="userLogin">
                                                <div class="table-responsive">
                                                    <table class="table table-border table-striped table-hover lastLoginData">
                                                        
                                                        <?php print __mpc_last_login__($conn)?>
                                                        
                                                        <caption class="loginCaption"></caption>
                                                    </table>
                                                    
                                                </div>
                                                <script>
function __reportMemberLogin__() {
    var a, b, c, d, e, xhr, rtn;
        rtn = document.querySelector('.lastLoginData');
        c = document.querySelector('.loginCaption');
        url = __mpcFile_path() + '/functions/mpc-ajax-action.php?ajaxAction=lastLogin'; //file url where ajax request is happening
        xhr = new XMLHttpRequest(); //initializing
        xhr.open('GET', url, true);

       // c.innerHTML = 'Please wait... LOADING';
        xhr.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){

                rtn.innerHTML = this.response;
            }
        }
        xhr.send();
}
/*
setInterval(() => {
    __reportMemberLogin__();
}, 3000);
*/
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                
                                <?php
                            }else {
                                if($_GET['action'] == 'LogOut' && $_GET['v'] == 'true'){
                                    //load this file and process admin logout request
                                    //require_once dirname(__DIR__) ."/functions/mpc-func.php";
                                    require_once dirname(__DIR__) ."/config/conn.php";
                                    $from = 'mpc_user'; 
                                    $type = 'SignOut'; //typeof action executed
                                    $redirect = __mpc_root__() . 'user/dashboard.php/?action=dashboard';
                                    
                                   // print_r(__mpcConn__());
                                    __logoutMpc_admin($id, $from, $prev, $redirect, $type, __mpcConn__());
                                }else {
                                    if($_GET['action'] == 'inputData') {
                                        ?>
                                            <i class="mpc-admMsg">Input Record</i><br><br>
                                            <hr class="mpcHr">
                                            <div class="mpc-inputRecord">
                                                <select  class="inputData mpc-inp-dataSelect mpc-disabled">
                                                    <option value="">----</option>
                                                    <option value="Loan">REGULAR LOAN</option>
                                                    <option value="Group Loan">GROUP LOAN</option>
                                                    <option value="Deposit">DEPOSIT </option>
                                                    <option value="Debit">DEBIT <i class="fas fa-user fa-3x"></i> </option>

                                                    
                                                </select>

                                                
                                                
                                            </div>

                                            <div class="deposit-item">
                                                <style>
                                                    .deposit-item input,
                                                    .deposit-item select {
                                                        margin: 10px;
                                                    }
                                                    
                                                    .account-bal{
                                                        font-weight: 600;
                                                        font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;

                                                    }
                                                    .mpc-debitor{display: none;}
                                                </style>
                                                <input type="text" placeholder="Account Number" class="setStyle createLoanInput mpc-memberAccount mpc-disabled" title="ACCOUNT NUMBER">
                                                <input type="text" placeholder="Account name" class="setStyle createLoanInput ownerName mpc-disabled">

                                                <select class="adm-select LoanType mpc-MemDisabled creditAccountType mpc-disabled" title="SELECT DESTINATION ACCOUNT TYPE">
                                                    <option value="">----</option>
                                                    <option value="SHARES">SHARES ACCOUNT</option>
                                                    <!--<option value="FIXED">FIXED DEPOSIT</option>-->
                                                    <option value="SPECIAL">SPECIAL SAVING</option>
                                                    <option value="THRIFT">THRIFT SAVING</option>
                                                    <!--<option value="WELFARE">WELFARE CONTRIBUTIONS</option>-->
                                                </select><br>

                                                <input type="text" placeholder="Depositor name" class="setStyle createLoanInput depositorName mpc-disabled">
                                                <input type="text" placeholder="Depositor phone" class="setStyle createLoanInput depositorPhone mpc-disabled">
                                                <input type="text" placeholder="Amount" class="setStyle createLoanInput AmountDeposit mpc-disabled">

                                                <button class="Deposit butt mpc-btn mpc-disabled">Saved deposit</button>
                                            </div>
<!-- paste start here-->
<hr class="mpcHr">
<div class="mpc-debitor" ddd="<?php echo $id?>">
<i class="adm-Msg">Debit members account</i>
<div class="mpc-dbt"><br>
<input type="search" title="Search With: PHONE, NAME, ACCOUNT NO." class="setStyle createLoanInput mpc-disabled searchMember d-block" placeholder="Search member">
<br>
<select tabindex="0" class="adm-select LoanType mpc-loadBalance mpc-disabled" title="SELECT DEBIT ACCOUNT!">
    <option value="">---------------</option>
    <option value="SHARES">SHARES ACCOUNT</option>
    <option value="FIXED">FIXED DEPOSIT</option>
    <option value="SPECIAL">SPECIAL SAVING</option>
    <option value="THRIFT">THRIFT SAVING</option>
    <option value="WELFARE">WELFARE CONTRIBUTIONS</option>
</select>

<span class="account-bal">
    &#8358; <span class="accountBalance">0</span>
</span>
<br><br>
</div>

    <div class="debit-input-wrap">
    <input type="text" class="setStyle createLoanInput debitAccount mpc-disabled" placeholder="Account No.">
    <input type="text" class="setStyle createLoanInput DebitAccountName mpc-disabled" placeholder="Member name">
    <input type="text" class="setStyle createLoanInput AMountDebit mpc-disabled" placeholder="Debit Amount">
    <input type="text" class="setStyle createLoanInput ReasonFor mpc-disabled" placeholder="Reason for this debit">
    <!-- <input type="text" class="setStyle createLoanInput AmountDeposit mpc-disabled" placeholder="Debit Amount"> -->
    <button class="mpc-btn controller-btn">Debit Account</button>
    </div>
<hr class="mpcHr">
    <div class="main-member-wrap">
        <div class="table-responsive rtnDataHere">
            <table class="table table-hover table-striped table-border">
                <thead>
                    <th>#</th>
                    <th>Name</th>
                    <th>Account No.</th>
                    <th>Profile</th>
                    <!-- <th>#</th>
                    <th>#</th> -->
                </thead>

<?php __mpc_memberOut($conn)?>
            </table>
        </div>
    </div>
</div>

<script>
    let sch = document.querySelector('.searchMember');
        sch.addEventListener('input', function(){
let xhr = new XMLHttpRequest();
let returnDataTo = document.querySelector('.rtnDataHere');

    xhr.open('POST', __mpc_uri__() + 'functions/mpc-ajax-action.php', true);
    xhr.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
          //  let resp = JSON.parse(this.response);

            returnDataTo.innerHTML = this.response;

            __addFordebit(); //add member for debit
        }
    }
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send('SendingSeach=' + JSON.stringify({search: this.value}));
})

__addFordebit(); //add members for account edit here
__getAccountBalance__();
__processMpc_debit(); //debit members account processor
</script>
                                            <div class="mpc-group-loan-repayment">
                                                <i class="adm-Msg">Group loan repayment</i>
                                                <div class="group-repay-mpc">
                                                <select class="adm-select LoanType mpc-load-group4Repayment mpc-disabled" title="SELECT GROUP NAME HERE">
                                                    <option value="">-----</option>
                                                    <?php 
                                                        // $prev = 1;
                                                    $whattoselect = ['group_id', 'group_name', 'group_branch'];
                                                    $tbl = 'mpc_available_group';
                                                    $howToReturn = 'options';
                                                    __mpcAll_availableGroup__($conn, $prev, $branch, $whattoselect, $tbl, $howToReturn, 0, 0);
                                                    ?>
                                                </select>


                                                    
                                                </div>
<!---GROUP MEMBER RETURN SHOWS  BELOWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWW-->
                                                <div class="mpc-groupMemberReturn"></div>
                                            </div>

                                            <div class="mpc-regular-loan-repayment">
                                                <div class="mpc-regular-loan">

                                                    <div class="mpc-regular-tool-top" >
                                                        <input type="text" placeholder="Search" class="setStyle createLoanInput mpc-regular-search mpc-disabled" title="SEARCH PARAMETER => PHONE NUMBER">

                                                        <div class="regular-member4repayment table-reponsive liveSearch">
                                                            <?php 
                                                             
                                                                __mpc_regular($conn);
                                                                
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
<script>
    var liveSearch, val, xhr, returnR;
        liveSearch = document.querySelector('.mpc-regular-search');
        liveSearch.addEventListener('input', ()=>{
            val = liveSearch.value; //search value here
            returnR = document.querySelector('.liveSearch')//live search
            xhr = new XMLHttpRequest();
            xhr.open('GET', __mpc_uri__() + 'functions/mpc-ajax-action.php?qparam=MPCREgular@members&queryKey=' + val);

            //trying to create new element and class
            returnR.classList.add('liveSearchLoading');
            returnR.innerHTML = ''; //remove everything that was inside
            let newEl = document.createElement('H3');
                newEl.textContent = 'PLEASE WAIT... LOADING';
                returnR.appendChild(newEl);

            xhr.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    returnR.classList.remove('liveSearchLoading');
                    returnR.innerHTML = '';

                    returnR.innerHTML = this.response;

                    __mpc_regularLoanRepaymnet__(); //regular member return from admin search query
                }
            }
            xhr.send();
        })


        __mpc_regularLoanRepaymnet__(); //regular loan repayment button here
</script>
                                                <?php 
                                                
                                               // echo __sumTotalPenalty__($conn, $groupName, $groupId, 'group'); 
                                              //echo __get_member_total_repayment__($conn, '17', '08085477545', 'mpc_group_loan_request', 'member_id', 'member_phone');
                                                
                                                //penalty group
                                               // $memberPhone = '07044336767';
                                               /* $memberId = '21';
                                                $col1 = 'member_id';
                                                $col2 = 'member_phone';
                                                $tbl = 'mpc_group_loan_repayment';
                                                $sumColumn = 'amount_paid';
                                               
                                                $sumColumn = 'amount_paid';
                                                $col1 = 'member_id';
                                                $col2 = 'member_phone';
                                                $tbl1 = 'mpc_group_loan_repayment';
                                                $totalAmountPaidByMember = __mpc_member_totalPaid__($conn, 22, '07044336767', $col1, $col2, $tbl1, $sumColumn);
                                    
                                                $tbl2 = 'mpc_group_loan_request';
                                                $tb2Col1 = 'member_id';
                                                $tb2Col2 = 'member_phone';
                                    
                                                $totalAmountForMemberRepayment = __get_member_total_amountFor_repayment__($conn, 22, '07044336767', $tbl2, $tb2Col1, $tb2Col2);
                                    
                                    
                                                if($totalAmountPaidByMember >= $totalAmountForMemberRepayment){
                                                    $status = 3;
                                    
                                                    $update = "UPDATE mpc_group_loan_request SET status='$status' WHERE member_id='$payerId' && member_phone='$payerPhone'";
                                                    if(mysqli_query($conn, $update)){
                                                        echo "payment complete";
                                                    }
                                                    
                                    
                                                }
                                                */
                                                ?>

                                            </div>
                        
<script>
    __mpc_inputDataSelect__(); //THIS FUNCTION WILL CHECK WHAT ADMIN IS TRYING TO DO
    __mpcAdminSearch_memberAcct__(); //THIS FUNCTION WILL LOOK FOR AND RETURN MEMBER ACCOUNT NUMBER AND NAME + MISC. ATTRIBUTE ON CALLING INPUT/ELEMENT
    
    var a, b, c, d;
    a = document.querySelector('.ownerName');
    a.addEventListener('input', function(){
        b = document.querySelector('.mpc-memberAccount');
        c = document.querySelector('.mpc-admin-ds-notify');

        if(b.value == ''){
            this.style.border = '2px solid red';
            this.value = '';
            b.style.border = '2px solid red';
            c.innerHTML = 'Please perform account lookup first!';
            c.classList.add('to-red-color');

            __clearoutMpc('mpc-admin-ds-notify', 3000);
        }else{
            this.style.border = 'none';
            b.style.border = 'none';
        }
        
    })

    var groupMemberGet = document.querySelector('.mpc-load-group4Repayment');
        groupMemberGet.addEventListener('change', function(){
            var searchVal, Rtxt, xhr, returnData; 
                searchVal = this.value;
                Rtxt = document.querySelector('.mpc-admin-ds-notify');
                returnData = document.querySelector('.mpc-groupMemberReturn');

                if(this.value === ''){
                    Rtxt.innerHTML = 'Please select group';
                    Rtxt.classList.add('to-red-color');
                    Rtxt.classList.add('fa-fade');
                }else{
                    Rtxt.innerHTML = 'Please wait... LOADING REQUEST';
                    this.disabled = true; /// disabled the select button

                    __mpcShowAnimation__(); //turn ON ANIMATION
                    //ajax request start here
                    xhr = new XMLHttpRequest();
                    xhr.open('GET', __mpc_uri__() + 'functions/mpc-ajax-action.php?xmpcq=repayGroupGEt&qparam='+ searchVal, true);
                    xhr.onreadystatechange = function(){
                        if(this.readyState == 4 && this.status == 200){
                            __mpcAnimaitonOff__(); //TURNOFF ANIMATION
                            returnData.innerHTML = this.response;
                            Rtxt.innerHTML = '';

                            groupMemberGet.disabled = false;

                            __loan_repaymentGroup__(); //group loan repayment function is here
                        }
                    }
                    xhr.send();
                }
        })

//mpc-disabled if you are not secretary
let previ = <?php echo $prev?>;
let staffId = <?php echo $id?>;

// if(previ !== 2 /*&& staffId !== 1*/){
// __mpc_disabled__('mpc-disabled', 'ADMIN'); ///disabled all the input here
// }
</script>
                                    <?php
                                        if(isset($_GET['qparam'])){
                                            if($_GET['k'] === 'group'){
                                            ?>
                                            <div class="mpc-popup-anytime" style="z-index:40;top:-100px;">
                                                <div class="mpc-popup-bg">
                                                    <div class="close-mpc-popup" title="CLOSE THIS POPUP">
                                                        <i class="fas fa-xmark fa-2x"></i>
                                                    </div>

                                                    <div class="mpc-penalty">
                                                        <?php 
                                                            __showMpcMembers4Penalty($conn, $_GET['group'], 'group');
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php 
                                        }else if($_GET['k'] === 'regular'){
                                            ?>
                                            <div class="mpc-popup-anytime" style="z-index:40;top:-100px;">
                                                <div class="mpc-popup-bg">
                                                    <div class="close-mpc-popup" title="CLOSE THIS POPUP">
                                                        <i class="fas fa-xmark fa-2x"></i>
                                                    </div>

                                                    <div class="mpc-penalty">
                                                        <?php 
                                                            __showMpcMembers4Penalty($conn, $_GET['group'], 'regular');
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>
<script>
    var popUpClose = document.querySelectorAll('.close-mpc-popup');
        for (let x = 0; x < popUpClose.length; x++) {
            popUpClose[x].addEventListener('click', () =>{
            //let close all
            var close = document.querySelectorAll('.mpc-popup-anytime');
                close.forEach(
                    element => {
                        element.remove();
                    }
                )
        })
            
        }

//mpc-disabled if you are not secretary
let prev = <?php echo $prev?>;
//let staffId = <?php echo $id?>;

if(prev !== 2 /*&& staffId !== 1*/){
    __mpc_disabled__('mpc-disabled', 'ADMIN'); ///disabled all the input here
}
</script>
                                            <?php
                                        }

        }else if($_GET['action'] == 'CreateLoan') {
                                        ?>
    <!-- CREATE NEW LOAN USER HERER-->
    <i class="mpc-admMsg">Create new Loan</i><br><br>
        <hr class="mpcHr">

        <div class="mpc-create-loan dsh-board-light-mode shadow w-100">
            <div class="card shadow-sm mt-4">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Loan Requests</h5>
                    <span class="badge bg-light text-dark" id="loan-count">0 Requests</span>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Member</th>
                                    <th>Phone</th>
                                    <th>Amount</th>
                                    <th>Type</th>
                                    <th>Duration</th>
                                    <th>Status</th>
                                    <th>Requested</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="loan-table-body">
                                <!-- Rows injected by JS -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

<script type="module">
   
import { getAllLoanRequests, selector, selectorAll, newPopup, getSingleLoanRequest, approveLoanRequest,showToast, rejectLoanRequest  } from "../../script/api.js";
const totalLoan = await getAllLoanRequests();
/**CRATE LOAN FOR MEMBER START HERE
 * MEMBER LOAN WILL BE CREATE HERE
 * 
 */

// console.log(totalLoan);
let showTotalReq = selector('#loan-count');
let tbody        = selector('#loan-table-body');
    if(totalLoan.status === 'success'){
        showTotalReq.textContent = `${totalLoan.total} Requests`;

        let rows = '';
        totalLoan.loans.forEach((loan, index) => {
            rows += `
                <tr>
                    <td>${index + 1}</td>
                    <td>${loan.member_name} (ID: ${loan.member_id})</td>
                    <td>${loan.members_phone}</td>
                    <td>&#8358; ${Number(loan.loan_amount).toLocaleString()}</td>
                    <td>${loan.loan_type}</td>
                    <td>${loan.duration_months ? loan.duration_months + ' months' : 'N/A'}</td>
                    <td>${loan.status}</td>
                    <td>${new Date(loan.created_at).toLocaleDateString()}</td>
                    <td>
                        <button class="mpc-btn approve-loan-btn more-info" user-name="${loan.member_name}" data-loan-id="${loan.tracking_code}">View</button>
                        <!--<button class="mpc-btn reject-loan-btn" user-name="${loan.member_name}" data-loan-id="${loan.tracking_code}">Reject</button>-->
                    </td>
                </tr>
            `;
           

        });
        tbody.innerHTML = rows;
    }


 //loan more info invoker btn
    let moreInfo = selectorAll('.more-info');

moreInfo.forEach(button => {
    button.addEventListener('click', async function(){
        let loanId = this.getAttribute('data-loan-id');
        let user = this.getAttribute('user-name');
        //when button is clicked scroll back to top
        window.scrollTo({top: 0, behavior: 'smooth'});

        let style = {
            width:'60%',
            height:'80vh',
            top:'50px',
            background:'#fff',
            borderRadius:'8px',
            boxShadow:'0 0 10px rgba(0,0,0,0.3)',
            padding:'20px',
        };

        newPopup(document.body, style, async function(){
            // duration_months
            let req = await getSingleLoanRequest(loanId);
            let dwrap = document.querySelector('.popContentWrap');
            // Add modal HTML
            dwrap.innerHTML = `
                
                <h2 class="loan-header">${user} Loan Transaction Information</h2>

                <div class="loan-details-box">

                    <div class="loan-section">
                        <h3>Member Information</h3>
                        <div class="loan-row">
                            <p><strong>Member Name:</strong> ${user}</p>
                            <p><strong>Phone:</strong> ${req.data.members_phone}</p>
                            <p><strong>Tracking Code:</strong> ${req.data.tracking_code}</p>
                        </div>
                    </div>

                    <div class="loan-section">
                        <h3>Loan Overview</h3>
                        <div class="loan-row">
                            <p><strong>Loan type:</strong> ${req.data.loan_type}</p>
                            <p><strong>Loan Amount:</strong> ₦${Number(req.data.loan_amount).toLocaleString()}</p>
                            <p><strong>Status:</strong> 
                                <span class="loan-status ${req.data.status}">
                                    ${req.data.status}
                                </span>
                            </p>
                            <p><strong>Duration:</strong> ${req.data.loan_type === 'special' ? 'N/A' : req.data.duration_months + ' months'} </p>
                        </div>
                    </div>

                    <div class="loan-section">
                        <h3>Payment Breakdown</h3>
                        <div class="loan-row">
                            <p><strong>Total Payable:</strong> ${req.data.loan_type === 'special' ? 'N/A' : '₦' + Number(req.data.total_payable).toLocaleString()}</p>
                            <p><strong>Repayment Frequency:</strong>${req.data.loan_type === 'special' ? 'N/A' : req.data.repayment_frequency}</p>
                            <p><strong>Monthly Payment:</strong>${req.data.loan_type === 'special' ? 'N/A' : '₦' + Number(req.data.monthly_payment).toLocaleString()}</p>
                            <p><strong>Due Date:</strong> ${req.data.loan_type === 'special' ? 'N/A' : req.data.due_date}</p>
                        </div>
                    </div>

                    <div class="__xcx__ p-1 max-content loan-section">
                        <!-- Additional sections can be added here -->
                        <h3>Special Savings Information</h3>
                        <p><strong>Special Savings Balance:</strong> ₦${Number(req?.special_savings?.balance).toLocaleString()}</p>
                        <p><strong>Last Transaction:</strong> ₦${Number(req?.special_savings?.credit).toLocaleString()} on ${req?.special_savings?.date_time}</p>
                    </div>

                    <div class="loan-actions">
                        <button class="reject-btn" data-trk-id="${req.data.tracking_code}" ${req.data.status == 'pending' ? '' : 'disabled'} id="reject-loan-btn">Reject</button>
                        <button class="approve-btn" data-trk-id="${req.data.tracking_code}" ${req.data.status == 'pending' ? '' : 'disabled'} id="approve-loan-btn">Approve</button>
                    </div>

                </div>

<style>
.loan-header {
    font-size: 22px;
    margin-bottom: 15px;
    padding-bottom: 10px;
    border-bottom: 3px solid #3f51b5;
    color: #333;
    font-weight: 600;
}

.loan-details-box {
    background: #ffffff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    overflow-y: auto;
    max-height: 65vh;
}

.loan-section {
    margin-bottom: 25px;
}

.loan-section h3 {
    font-size: 18px;
    border-left: 4px solid #3f51b5;
    padding-left: 10px;
    margin-bottom: 15px;
    font-weight: 600;
    color: #222;
}

.loan-row p {
    margin: 6px 0;
    font-size: 15px;
}

.loan-status {
    padding: 3px 10px;
    border-radius: 6px;
    font-weight: bold;
    font-size: 13px;
}

/* STATUS COLORS */
.loan-status.pending {
    background: #ffeb3b;
    color: #9e7b00;
}
.loan-status.approved {
    background: #4caf50;
    color: white;
}
.loan-status.rejected {
    background: #f44336;
    color: white;
}

/* BUTTONS */
.loan-actions {
    margin-top: 25px;
    display: flex;
    justify-content: space-between;
}

.approve-btn, .reject-btn {
    padding: 10px 25px;
    border: none;
    border-radius: 6px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
}

.approve-btn {
    background: #4caf50;
    color: white;
}

.reject-btn {
    background: #f44336;
    color: white;
}

.approve-btn:hover {
    background: #43a047;
}

.reject-btn:hover {
    background: #d32f2f;
}
/*if button is disabled*/
.loan-actions button:disabled {
    background: #e0e0e0;
    color: #9e9e9e;
    cursor: not-allowed;
}

@media (max-width: 768px) {
    .loan-details-box {
        max-height: none;
    }
    .loan-header {
        font-size: 20px;
    }
    .loan-section h3 {
        font-size: 16px;
    }
    .loan-row p {
        font-size: 14px;
    }

    .popContentWrap {
        width: 90% !important;
        height: auto !important;
    }
}
</style>            

            `;

        //check if it not special
        if(req.source !== 'special'){
            //hide special savings section
            let specialSection = document.querySelector('.__xcx__');
                specialSection.style.display = 'none';
        }




        //approve request
        let approveBtn = selector('.approve-btn');
            approveBtn.addEventListener('click', async function(){
                let trkId = this.getAttribute('data-trk-id');
                let asside = "<?php echo $fn . ' ' . $ln?>";
                this.disabled = true;
                selector('.reject-btn').disabled = true;
                this.textContent = 'Processing...';

                let Approved = await approveLoanRequest(trkId, asside);

                    if(Approved.status){
                        showToast(Approved.message);
                        selector('.closeData').click();
                    }else{
                        showToast(Approved.message);
                    }

                    // 
                // console.log(Approved);

            });

        selector('.reject-btn').addEventListener('click', function(){

            let trkId = this.getAttribute('data-trk-id');
            let asside = "<?php echo $fn . ' ' . $ln?>";
            this.disabled = true;
            selector('.approve-btn').disabled = true;
            this.textContent = 'Processing...';

            //reject loan request function here
            rejectLoanRequest(trkId, asside).then(response => {
                if(response.status){
                    showToast(response.message);
                    selector('.closeData').click();
                }else{
                    showToast(response.message);
                }
            })
        })
    });
});

});

</script>
                                        

                                        <?php
                                        
                                    }else{
                                        if($_GET['action'] == 'Settings' && $_GET['r'] == 'allsettings'){
                                            ?>
                                                <i class="mpc-admMsg">Settings</i><br><br>
                                                <hr class="mpcHr">

                                                <div class="mpc-all-settings">
                                                    <div class="mpc-set-in dsh-board-light-mode shadow">
                                                        <i class="fas fa-user-alt fa-2x"></i>
                                                       <a href="<?php echo __mpc_root__()?>user/dashboard.php/?action=Settings&r=createUser&rtn=settings" class="Setting-link">
                                                            Create staff
                                                        </a>
                                                    </div>

                                                    <div class="mpc-set-in dsh-board-light-mode shadow">
                                                        <i class="fas fa-line-chart fa-2x"></i>
                                                        <a href="<?php echo __mpc_root__()?>user/dashboard.php/?action=Settings&r=intrestRate&rtn=settings" class="Setting-link">
                                                            Interest rate
                                                        </a>
                                                    </div>

                                                    <div class="mpc-set-in dsh-board-light-mode shadow">
                                                        <i class="fas fa-transgender fa-2x"></i>
                                                        <a href="<?php echo __mpc_root__()?>user/dashboard.php/?action=Settings&r=createMember&rtn=settings" class="Setting-link">
                                                            Create members
                                                        </a>
                                                    </div>

                                                    <div class="mpc-set-in dsh-board-light-mode shadow">
                                                        <i class="fas fa-users fa-2x"></i>
                                                        <!--<a href="<?php //echo __mpc_root__()?>user/dashboard.php/?action=Settings&r=createGroup&rtn=settings" class="Setting-link">-->
                                                        <!--    Create group-->
                                                        <!--</a>-->
                                                    </div>

                                                    <div class="mpc-set-in dsh-board-light-mode shadow">
                                                        <i class="fas fa-pen fa-2x"></i>
                                                        <a href="<?php echo __mpc_root__()?>user/dashboard.php/?action=Settings&r=guarantor&rtn=settings" class="Setting-link">
                                                            Witness
                                                        </a>
                                                    </div>

                                                    <div class="mpc-set-in dsh-board-light-mode shadow">
                                                        <!-- <i class="fas fa-hand-holding fa-2x"></i> -->
                                                        <!--<a href="<?php //echo __mpc_root__()?>user/dashboard.php/?action=Settings&r=cBranch&rtn=settings" class="Setting-link">-->
                                                        <!--    Branch-->
                                                        <!--</a>-->
                                                    </div>

                                                    <div class="mpc-set-in dsh-board-light-mode shadow">
                                                        <i class="fas fa-sms fa-2x"></i>
                                                        <a href="<?php echo __mpc_root__()?>user/dashboard.php/?action=Settings&r=bulksms&rtn=settings" class="Setting-link">   
                                                            Bulk sms
                                                        </a>
                                                    </div>

                                                    <div class="mpc-set-in dsh-board-light-mode shadow">
                                                        <i class="fa-2x fas fa-fingerprint"></i>
                                                        <a href="<?php echo __mpc_root__()?>user/dashboard.php/?action=Settings&r=memberInfo&rtn=settings" class="Setting-link">
                                                            
                                                            members info
                                                        </a>
                                                    </div>

                                                    <!-- <div class="mpc-set-in dsh-board-light-mode shadow">
                                                        
                                                        <i class="fa-2x fas fa-crutch"></i>
                                                        <a href="?action=verifyAction&actionId=338&t=member&r1=Settings&r2=createMember" class="Setting-link">
                                                            Delete
                                                        </a>
                                                    </div> -->

                                                    <div class="mpc-set-in dsh-board-light-mode shadow">
                                                        <i class="fa-2x fas fa-shipping-fast"></i>
                                                        <!--<a href="<?php //echo __mpc_root__()?>user/dashboard.php/?action=Settings&r=credit/Bmg&rtn=settings" class="Setting-link">-->
                                                        <!--    branch manager-->
                                                        <!--</a>-->
                                                    </div>

                                                    <div class="mpc-set-in dsh-board-light-mode shadow">
                                                        <i class="fa-2x fas fa-fighter-jet"></i>
                                                        <a href="#" class="Setting-link">
                                                            SEO
                                                        </a>
                                                    </div>

                                                    <div class="mpc-set-in dsh-board-light-mode shadow">
                                                        <i class="fa-2x fas fa-atlas"></i>
                                                        <a href="#" class="Setting-link">
                                                            Edit loan 
                                                        </a>
                                                    </div>

                                                    <div class="mpc-set-in dsh-board-light-mode shadow">
                                                        <i class="fa-2x fas fa-user-clock"></i>
                                                        <a href="<?php echo __mpc_root__()?>user/dashboard.php/?action=Settings&r=AboutUs&rtn=settings" class="Setting-link">
                                                            About us 
                                                        </a>
                                                    </div>

                                                    <div class="mpc-set-in dsh-board-light-mode shadow">
                                                        <i class="fa-2x fas fa-id-card-alt"></i>
                                                        <a href="<?php echo __mpc_root__()?>user/dashboard.php/?action=Settings&r=ContactUs&rtn=settings" class="Setting-link">
                                                            Contact us 
                                                        </a>
                                                    </div>

                                                    <div class="mpc-set-in dsh-board-light-mode shadow">
                                                        <i class="fa-2x fas fa-question"></i>
                                                        <a href="<?php echo __mpc_root__()?>user/dashboard.php/?action=Settings&r=faqs&rtn=settings" class="Setting-link">
                                                            FAQS
                                                        </a>
                                                    </div>
                                                    
                                                    <div class="mpc-set-in dsh-board-light-mode shadow">
                                                        <i class="fa-2x fas fa-broadcast-tower"></i>
                                                        <a href="<?php echo __mpc_root__()?>user/dashboard.php/?action=Settings&r=missingData&rtn=settings" class="Setting-link">
                                                            Missing data
                                                        </a>
                                                    </div>
                                                    
                                                    <div class="mpc-set-in dsh-board-light-mode shadow">
                                                        <i class="fa-2x fas fa-bug"></i>
                                                        <a href="<?php echo __mpc_root__()?>user/dashboard.php/?action=Bugsfixed&r=fbugs&rtn=settings" class="Setting-link">
                                                            User Bugs
                                                        </a>
                                                    </div>

                                                    <div class="mpc-set-in dsh-board-light-mode shadow">
                                                        <i class="fa-2x fas fa-cogs"></i>
                                                        <a href="<?php echo __mpc_root__()?>user/dashboard.php/?action=GeneralSettings&r=gsettings&rtn=settings" class="Setting-link">
                                                            General settings
                                                        </a>
                                                    </div>

                                                    
                                                </div>
                                            <?php
                                        }else{
                                            if($_GET['action'] == 'Settings' && $_GET['r'] == 'createUser'){
                                                //*901#
                                                ?>
                                                <!------CREATE NEW USER ADMIN START HEREREEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEE-------->
                                                <i class="mpc-admMsg">Create Staff</i><br><br>
                                                <hr class="mpcHr">

                                                <input type="text" class="setStyle createLoanInput loanUserFname mpc-disabled" placeholder="Firstname">
                                                <input type="text" class="setStyle createLoanInput loanUserLname mpc-disabled" placeholder="Lastname">
                                                <input type="text" class="setStyle createLoanInput usrname mpc-disabled" placeholder="Username, Phone or Email">
                                                <input type="text" class="setStyle createLoanInput loanpwd mpc-disabled" placeholder="Password">
                                               
                                                <select class="adm-select mpc-availBranch LoanType mpc-m-top mpc-disabled" id="uidUsrBranch" title="Choose branch which user will be working">
                                                    <option value="">----</option>
                                                    <?php   
                                                     __mpc_branchesName($conn, 'mpc_branches', 'branch_name', 'branch_id');
                                                    /*
                                                    * Allows admin to assigned branches to users
                                                    * all the options avaiable here will be loaded with php
                                                    */?>
                                                </select>


                                                <select class="mpc-prev-usr adm-select LoanType mpc-m-top mpc-disabled" title="Select previllage for this user">
                                                    <option value="">----</option>
                                                    <option value="1">Super Admin</option>
                                                    <option value="2">Admin</option>
                                                    <option value="3">Staff</option>
                                                    <option value="4">Developer</option>
                                                    <option value="5">Secretary</option>
                                                </select>
                                                <button class="generate-pwd mpc-loan-butt mpc-go-block mpc-btn mpc-disabled">Generate pwd </button>
                                                <button class="crte-mpc-user mpc-loan-butt button-go-block mpc-btn mpc-disabled">Create Staff <i class="fas fa-user-alt"></i></button>

                                                <hr class="mpcHr">
                                                <i class="mpc-admMsg" style="display:block;">Available staff and branch</i>

                                                <div class="table-responsive load-loan-user-rtn">
                                                    <table class="table table-bordered border-dark">
                                
                                                            <tr>
                                                                <td>#</td>
                                                                <td>Name</td>
                                                                <td>Username</td>
                                                                <td>Branch</td>
                                                                <td>privilege</td>
                                                                <td>Profile</td>
                                                            
                                                            </tr>
                                                        
                                                        <!-- MPC AVAILABLE USERS DATA APPEAR HERE-->
                                                        <?php  __mpc_availUser__($conn)?>

                                                         <!-- MPC AVAILABLE USERS DATA END HERE-->
                                                    </table>
                                                </div>
                                                
                                                <script type="text/javascript">
                                                    var a, creatloan, c, d, e, pwd, pass;

                                                    a = document.querySelector('.generate-pwd');
                                                    creatloan = document.querySelector('.crte-mpc-user');
                                                    pwd = document.querySelector('.loanpwd');
                                                    a.addEventListener('click', function(){
                                                        
                                                       pwd.value = __mpc_gen_pwd();
                                                       pwd.style.border = '2px solid mediumseagreen';
                                                    })

                                                    creatloan.addEventListener('click', () => {
                                                        var ln, fn, usr, pass, branch, prev, rtn, xhr, data;

                                                      //  creatloan.disabled = true;
                                                        
                                                        fn = document.querySelector('.loanUserFname');
                                                        ln = document.querySelector('.loanUserLname');
                                                        usr = document.querySelector('.usrname');
                                                        pass = document.querySelector('.loanpwd');
                                                        branch = document.querySelector('.mpc-availBranch');
                                                        prev = document.querySelector('.mpc-prev-usr');
                                                        rtn = document.querySelector('.mpc-admin-ds-notify');

                                                        //start to check and validate user input
                                                        data = "fn=" +fn.value +"&ln="+ ln.value + '&usr='+usr.value +'&pwd='+ pass.value +'&branch='+ branch.value + '&prev='+ prev.value +"&PERM=@YAKISEETIM";
                                                        if(fn.value == ''){

                                                            fn.style.border = '2px solid #ff0000';
                                                            rtn.textContent = 'Firstname is required';
                                                            rtn.classList.add('to-red-color');

                                                        }else if(ln.value == ''){

                                                            ln.style.border = '2px solid #ff0000';
                                                            rtn.textContent = 'Lastname is required!';
                                                            rtn.classList.add('to-red-color');

                                                        }else if(usr.value == ''){

                                                            usr.style.border = '2px solid #ff0000';
                                                            rtn.textContent = 'Username is required!';
                                                            rtn.classList.add('to-red-color');

                                                        }else if(pwd.value == ''){

                                                            pass.style.border = '2px solid #ff0000';
                                                            rtn.textContent = 'Password is required!';
                                                            rtn.classList.add('to-red-color');

                                                        }else if(branch.value == ''){

                                                            branch.style.border = '2px solid #ff0000';
                                                            rtn.textContent = 'Select branch staff will be working on, or create new branch!';
                                                            rtn.classList.add('to-red-color');

                                                        }else if(prev.value == ''){

                                                            prev.style.border = '2px solid #ff0000';
                                                            rtn.textContent = 'Please assign previllege to "' + fn.value + ' ' +ln.value +'"';
                                                            rtn.classList.add('to-red-color');
                                                        }else if(fn.value.search(/[0-9!@,><#".$=%'^&*()_+]/i) != -1){

                                                            rtn.textContent = 'Firstname contains an invalid character!';
                                                            rtn.classList.add('to-red-color');
                                                            fn.style.borderBottom = '2px solid #ff0000';
                                                        }else if(ln.value.search(/[0-9@,><#".$=%'^&*()_+]/i) != -1){
                                                            rtn.textContent = 'Lastname contains an invalid character!';
                                                            rtn.classList.add('to-red-color');
                                                            fn.style.borderBottom = '2px solid #ff0000';
                                                        }else{
                                                            fn.style.border = 'none';
                                                            ln.style.border = 'none';
                                                            usr.style.border = 'none';
                                                            pass.style.border = 'none';
                                                            branch.style.border = 'none';
                                                            prev.style.border = 'none';
                                                            rtn.innerHTML = 'LOADING... please wait.';
                                                            rtn.classList.remove('to-red-color');
//trying to create a new ajax request to create a new user
                                                            xhr = new XMLHttpRequest();
                                                            xhr.open('POST', __mpc_uri__() + '/functions/mpc-ajax-action.php', true);
                                                            xhr.onreadystatechange = function(){
                                                                if(this.readyState == 4 && this.status == 200){
                                                                    creatloan.disable = false; //try to renable button
                                                                    if(this.readyState == 4 && this.status == 200){
                                                                        if(this.responseText == 'success'){
                                                                            console.log('Query to create mpc user return this status = "' + this.status + '"');
                                                                            rtn.innerHTML = fn.value + ' ' + ln.value + ', has been successfully added to '+ __mpc_companyName__()+' staff list';
                                                                        }
                                                                       
                                                                    }
                                                                }
                                                            }
                                                            
                                                            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                                                            xhr.send(data);
                                                            
                                                        }
                                                    })

                                                    document.querySelector('.loanpwd').addEventListener('input', function(){
                                                        if(this.value == ''){
                                                            this.style.border = 'none';
                                                        }
                                                    })
//mpc-disabled if you are not secretary
let previ = <?php echo $prev?>;
let staffId = <?php echo $id?>;

if(previ !== 2 && staffId !== 1){
    __mpc_disabled__('mpc-disabled', 'SUPER-ADMIN'); ///disabled all the input here
}
                                                </script>
                                                <?php
                                            }else{
                                                if($_GET['action'] == 'Settings' && $_GET['r'] == 'cBranch'){
                                                    ?>
                                                <i class="mpc-admMsg"><?php print getSystemName($conn)[1]?> branches</i>
                                                <hr class="mpcHr">
                                            
                                                <input type="text" class="mpc-disabled setStyle mpc-crt-branch-name createLoanInput" placeholder="Branch Name">
                                                <input type="text" class="mpc-disabled setStyle brnchLocation createLoanInput" placeholder="Branch Location">
                                                <button class="mpc-crt-branch mpc-btn mpc-loan-butt mpc-disabled">Create branch</button>
                                                <span class="mpc-refresh" title="Click to reload window"><i class="fas fa-refresh"></i></span>
                                                <span class="mpc-go-block"> <a href="<?php echo __mpc_root__()?>user/dashboard.php/?action=Settings&r=credit/Bmg" class="nav-item nav">Assigned branch Manager/Credit officer</a></span>
                                                    
<script>
    var a, input1, input2, d, e, rtn, xhr, sendQ;

        a = document.querySelector('.mpc-crt-branch'); //create branch button
        input1 = document.querySelector('.mpc-crt-branch-name'); //branch name
        input2 = document.querySelector('.brnchLocation'); //branch location
        msg = document.querySelector('.mpc-admin-ds-notify'); //error and success message
        a.addEventListener('click', function(){
            
          //  
           // this.disabled = true;
           sendQ = "PERM=YAKIseRAphael&brn="+ input1.value + "&brnLocation=" + input2.value;
          // "fname=Henry&lname=Ford"

            if(input1.value == '') {
                input1.style.border = '2px solid #ff0000';
                msg.innerHTML = 'Please enter correct branch name';
                this.disabled = false;
            }else if(input2.value == '') {
                input2.style.border = '2px solid #ff0000';
                msg.innerHTML = 'Please enter location name';
                this.disabled = false;
            }else if(input1.value.search(/[!@#$%^&*_=}{:';|<.>?]/) != -1){
                input2.style.border = '2px solid #ff0000';
                msg.innerHTML = 'Invalid branch name => ' + input1.value;
                this.disabled = false;
            }else if(input2.value.search(/[!@#$%^&*()_=}{:';|<.>?]/) != -1){
                input2.style.border = '2px solid #ff0000';
                msg.innerHTML = 'Invalid branch location => ' + input2.value;
                this.disabled = false;
            }else{
                __mpcShowAnimation__(); //SHOW ANIMATION HERE
                msg.textContent = 'Loading... PLEASE WAIT.';

                xhr = new XMLHttpRequest(); //initializing
                xhr.open('POST', __mpc_uri__() + 'functions/mpc-ajax-action.php', true);
                xhr.onreadystatechange = function() {
                    if(this.readyState == 4 && this.status == 200) {
                        __mpcAnimaitonOff__(); //turn off animation
                        if(this.response == 'success') {
                            msg.innerHTML = 'BRANCH CREATE SUCCESS <i class="fa fa-check"></i>';
                            window.location.reload();
                        }else {
                            msg.innerHTML = this.response;
                        }
                      // alert(this.response)

                        console.log('User create response code => ' + this.status + ' Query was perform on this time ' + new Date().getTime());
                    }
                }
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.send(sendQ);
            }
        })

        __mpcForceReload();//window reload 

//mpc-disabled if you are not secretary
let previ = <?php echo $prev?>;
let staffId = <?php echo $id?>;

if(/*previ !== 5 && */staffId !== 1){
    __mpc_disabled__('mpc-disabled', 'SUPER-ADMIN'); ///disabled all the input here
}
</script>
                    
                <hr class="mpcHr">
                <div class="mpc-resonsive-tbl load-loan-user-rtn">
                    <!--DISPLAY ALL AVAILABLE BRANCHES HERE-->
                    <?php __mpc_omit_Add__($conn)?>
                </div>
        <?php
        
    }else {
        if($_GET['action'] == 'Settings' && $_GET['r'] == 'createGroup'){
        /**ALL THE AVAILABLE GROUP WILL BE SHOWN HERE
         * ONE AFTER ANOTHER
         */
            ?>
    <i class="mpc-admMsg"><?php print getSystemName($conn)[1]?>, create group</i><br><br>
    <hr class="mpcHr">

    <input type="text" class="mpc-groupName setStyle createLoanInput" placeholder="Group name" title="Enter group name">
    <select name="" title="SELECT BRANCH YOU ARE CREATING GROUP FOR" class="mpc-branch-available LoanType adm-select createLoanInput">
    
        <option value="">----</option>
        <!--available branches-->
        <?php print __mpc_branchesName($conn, 'mpc_branches', 'branch_name', 'branch_id');

            $arr = ['group_id', 'group_name', 'group_branch', 'group_leader', 'group_created_by']; //this is the param used to display table data below

        ?>
        <!--available branches display end here-->
    </select>
    <button class="crate-mpc-group mpc-loan-butt">Create group</button>
    <span class="mpc-refresh" title="Click to reload window"><i class="fas fa-refresh"></i></span>
    <hr class="mpcHr">
<div class="mpc-resonsive-tbl load-loan-user">
    <table class="table border-dark table-bordered">
        <tr>
            <td>#</td>
            <td>Group name</td>
            <td>Branch</td>
            <td>Group Leader</td>
            <td>Created by</td>
            <td>Action</td>
        </tr>
        <?php print __mpcAll_availableGroup__($conn, $prev, $branch, $arr, 'mpc_available_group', 'table-data', $id, 'group')?>
    </table>
</div>
    <script>
    
        var grpbutt, group, brch, errMsg, xhr, xhrdata, adminName;
        grpbutt = document.querySelector('.crate-mpc-group');
        group = document.querySelector('.mpc-groupName');
        brch = document.querySelector('.mpc-branch-available');
        errMsg = document.querySelector('.mpc-admin-ds-notify');
        adminName = document.querySelector('.adm-prev').getAttribute('mpc-prevtype');

        grpbutt.addEventListener('click', function(){
            
            //let do some checking
            
            if(group.value == ''){
                errMsg.innerHTML = 'Enter a valid group name.';
                errMsg.classList.add('to-red-color')
                group.style.border = '2px solid #ff0000';
            }else if(brch.value == '') {

                errMsg.innerHTML = 'Select Branch this group is mend for.';
                errMsg.classList.add('to-red-color')
                brch.style.border = '2px solid #ff0000';
            }else if(group.value.search(/[!@#$%^&*();'"<>?.,}|{]/i) != -1){
                //trying to sanitize group name

                errMsg.innerHTML = 'Invalid character in group name.';
                errMsg.classList.add('to-red-color')
                group.style.border = '2px solid #ff0000';
            }else {
                // errMsg.innerHTML = 'OK';
                errMsg.classList.remove('to-red-color');
                brch.style.border = 'none';
                group.style.border = 'none';

                //try to initialize ajax request
                xhrdata = 'PERM=dataGroup&grpName=' + group.value + '&groupBranch=' + brch.value + '&adminId=' + adminName;
                xhr = new XMLHttpRequest();
                xhr.open('POST', __mpc_uri__() + 'functions/mpc-ajax-action.php', true);
                xhr.onreadystatechange = function() {
                    
                    //LET CHECK AND LISTEN TO WHAT THE SERVER IS SAYING
                    if (this.readyState == 4 && this.status == 200) {
                        errMsg.innerHTML = this.responseText;
                    }
                }
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.send(xhrdata); //send all the sendable

            }
        })
        __mpcForceReload(); //trying to reload window when being call

    </script>

            <?php
                                                        
            }else {
        if($_GET['action'] == 'verifyAction' && !empty($_GET['actionId']) && !empty($_GET['t'])){

            /**THIS PAGE AM USING IT TO VERIFY ADMIN BASE ON WHAT HE WANT TO DO
             * I MEAN HIS/HER ACTION
             * CODE FROM THIS VERIFICATION PAGE
             * THERE IS A FUNCTION BELOW CALLED __MPC_SMALL_MININ__();
             * THIS FUNCTION ACCEPT 6 (SIX) AGUMENT
             * [0] => DATABASE CONNECTION
             * [1] => COLUMN ['COUNT', 'COLUMN', 'ALL']
             * COUNT MEANS COUNT FROM A PARTICULAR TABLE
             * COLUMN MEANS SELECT A PARTICULAR COLUMN FROM A PARTICULAR TABLE
             * ALL MEANS SELECT ALL ROWS IN A TABLE WHERE DATA MATCH A PARTICULAR RECORD
             * [2] => TABLE ID WHICH QUERY WILL BE CONDUCTED
             * [3] => WHAT EXACTLY ARE YOU SELECTING INSIDE DATABASE
             * [4] => PASSING A WHERE CLAUSE TO THE DB QUERY
             * [5] => TABLE WHICH THIS QUERY WILL BE CARRIED ON
             */

            if($_GET['t'] === 'group'){

                $req = 'count';
                $whattoselect = 'groups';
                $tbl = 'mpc_members';
                $tblId = 'members_id';
                $actId = $_GET['actionId'];

                $affected = __mpc_small_mini__($conn, 'column', $actId, 'group_name', 'group_id', 'mpc_available_group')['group_name'];
                $allAffected = __mpc_small_mini__($conn, $req, $tblId, $affected, 'groups' , $tbl)[$tblId];
                $actionAffected =   'members table';
                $affectedAddressByName = 'Member(s)';
                $additionalInfo = '';

                $allAffected2 = __mpc_small_mini__($conn, 'count', 'branch_id', $_GET['actionId'], 'branch_manager' , 'mpc_branches')['branch_id'];
                $tbl2check = '';

            }else if($_GET['t'] == 'user'){
                $tbl = "mpc_user";
                $tblId = "user_id";
                $visitorId = $_GET['actionId'];

                $name1 = __mpc_small_mini__($conn, 'column', $visitorId, 'user_fname, user_lname', $tblId, $tbl)['user_fname'];
                $name2 = __mpc_small_mini__($conn, 'column', $visitorId, 'user_fname, user_lname', $tblId, $tbl)['user_lname'];

                $affected = $name1 .' '. $name2;
                $allAffected = __mpc_small_mini__($conn, 'count', 'user_id', $visitorId, 'user_id' , $tbl)[$tblId];

                $allAffected2 = __mpc_small_mini__($conn, 'count', 'branch_id', $visitorId, 'branch_manager' , 'mpc_branches')['branch_id'];
                $affectedAddressByName = 'User(s)';
               // __mpc_small_mini__($conn, $req, $tblId, $whattoselect, $where,  $tbl);

               if($allAffected2 == 0){
                    $tbl2check = "$allAffected2 In all Branch(es)";
               }else {
                //trying to get the will be affect branch by name here
                //this function below accept different paramether
                    $tbl2check = $_GET['t'].' is working as Branch manager In "' .__mpc_small_mini__($conn, 'column', $visitorId, 'branch_name', 'branch_manager', 'mpc_branches')['branch_name'] .'" branch';
               }
               

               $actionAffected = $_GET['t'] ."'s table";
               $myadpriviledge = __Adm__($_GET['actionId']); //admin preeviledge
               $branch = __mpcReturnByIdAll__($conn, $visitorId);
               $src = __mpc_root__() .'/asset/img/'.__mpcReturnByIdAll__($conn, $visitorId)[5];
               $img = "<img src=\"$src\" srcset=\"$src\" class=\"dboard-img\" alt=\"pics\">";

               $additionalInfo = "
                            <p></p>
                                <div class=\"table-responive\">
                                    <table class=\"table table-bordered\" style=\"text-align:left;border-color:#330000;width:40%;color:inherit;\">
                                        <tr>
                                            <td>Name:</td>
                                            <td>values</td>
                                        </tr>
                                        <tr>
                                            <td>Priviledge:</td>
                                            <td>$myadpriviledge</td>
                                        </tr>
                                        <tr>
                                            <td>Branch:</td>
                                            <td>$branch[8]</td>
                                        </tr>
                                        <tr>
                                            <td>Group:</td>
                                            <td>No</td>
                                        </tr>
                                        <tr>
                                            <td>picture:</td>
                                            <td>$img</td>
                                        </tr>
                                        <!--tr>
                                            <td>BM</td>
                                            <td>Yes</td>
                                        </tr-->
                                        <caption>Indept breakdown information about user  $affected </caption>
                                    </table>
                                </div>";

            }else if($_GET['t'] == 'member') {
                $tbl = "mpc_members";
                $tblId = "members_id";
                $visitorId = $_GET['actionId'];

                $name1 = __mpc_small_mini__($conn, 'column', $visitorId, 'name', $tblId, $tbl)['name'];
               // $name2 = __mpc_small_mini__($conn, 'column', $visitorId, 'name', $tblId, $tbl)['user_lname'];

                $affected = $name1 ;
                $allAffected = __mpc_small_mini__($conn, 'count', 'members_id', $visitorId, 'members_id' , $tbl)[$tblId];

                $allAffected2 = __mpc_small_mini__($conn, 'count', 'group_id', $visitorId, 'group_leader' , 'mpc_available_group')['group_id'];
                $affectedAddressByName = 'Member(s)';
               // __mpc_small_mini__($conn, $req, $tblId, $whattoselect, $where,  $tbl);

               $actionAffected = $_GET['t'] ."'s table";
               $additionalInfo = '';

                if($allAffected2 == 0){
                    $tbl2check = "$allAffected2 In all group(es)";
                }else {
                        //trying to get the will be affect branch by name here
                        //this function below accept different paramether
                    $tbl2check = $_GET['t'].' is serving as group leader In "' .__mpc_small_mini__($conn, 'column', $visitorId, 'group_name', 'group_leader', 'mpc_available_group')['group_name'] .'" group';
                }
            }else if($_GET['t'] == 'branch'){
                $tbl = "mpc_branches";
                $tblId = "branch_id";
                $visitorId = $_GET['actionId'];

                $name1 = __mpc_small_mini__($conn, 'column', $visitorId, 'branch_name', $tblId, $tbl)['branch_name'];
               // $name2 = __mpc_small_mini__($conn, 'column', $visitorId, 'name', $tblId, $tbl)['user_lname'];

                $affected = $name1 ;
                $allAffected = __mpc_small_mini__($conn, 'count', $tblId, $visitorId, $tblId , $tbl)[$tblId];

                $allAffected2 = __mpc_small_mini__($conn, 'count', 'members_id', $affected, 'branch' , 'mpc_members')['members_id'];
               // $allAffected2 = __mpc_small_mini__($conn, 'count', 'members_id', $affected, 'group_name' , 'mpc_available_group')['members_id'];
                $affectedAddressByName = 'Member(s)';

                $actionAffected = $_GET['t'] ." table";
               $additionalInfo = '';

               if($allAffected2 == 0){
                $tbl2check = "$allAffected2 In all group(es)";
                }else {
                        //trying to get the will be affect branch by name here
                        //this function below accept different paramether
                    $tbl2check = 'Removing this '.$_GET['t'].' will affect "' .$allAffected2 . ' Member(s) from members table';
                }
            }
            
            ?>

            <i class="mpc-admMsg">Action Verification page</i>
            <hr class="mpcHr">

    <div class="dsh-board-light-mode mpc-db-one shadow db-check-rvme">
        
        <div class="verification-div bg-dark">
            <h2>Welcome <?php  print __mpcReturnByIdAll__($conn, $id)[1].' ' .__mpcReturnByIdAll__($conn, $id)[2]?></h2>
        
            <p>System detect that you want to remove <span class="rmve-data"><?php echo $_GET['t']?></span> from this system, to verify if this is really you, The system will asked you few questions before processing this request!</p>
            <p>Please note that once your verification process is successful, your request will be granted, and you can't undo this...</p>
            <p>This action will be perform on <span class="rmve-data"><?php echo $_GET['t'].' "' . $affected.'"' ?></span>, and it will affect <span class="rmve-data"><?php print $allAffected .' ' . $affectedAddressByName?> </span> in the <span class="rmve-data"><?php echo $actionAffected?></span>, <span class="rmve-data"><?php echo $tbl2check ?></span>, if you still want to proceed with this request, Answer the security question below! <i class="fas fa-arrow-down"></i><i class="fas fa-arrow-down"></i><i class="fas fa-arrow-down"></i> </p>
            
            <div class="sq-Input-butt">
                <?php echo $additionalInfo //User info?>
                <h4>QUESTION: <?php print __mpcReturnByIdAll__($conn, $id)[6]?> ?</h4>
                <input type="text" placeholder="Answer here" class="sq-answ setStyle createLoanInput">
                <button class="mpc-sq-check mpc-loan-butt">Proceed</button>
            </div>

            <div class="queryRtnmpc"></div>
            
        </div>
        <script>
                var inp1, inp2, butt, txtrtn, admId, xhr, rtnResp, sendData, toHide;

                butt = document.querySelector('.mpc-sq-check');
                butt.addEventListener('click', () =>{
                    
                    txtrtn = document.querySelector('.mpc-admin-ds-notify');
                    inp1 = document.querySelector('.sq-answ');
                    admId = document.querySelector('.adm-prev').getAttribute('mpc-admid');
                    rtnResp = document.querySelector('.queryRtnmpc');
                    toHide = document.querySelector('.sq-Input-butt');

                    //check for anything that might cause error
                    if(inp1.value == ''){
                        inp1.style.border = '1px solid #ff0000';
                        txtrtn.innerHTML = 'Enter Security answer...';
                        txtrtn.classList.add('to-red-color');

                        
                    }else {
                        inp1.style.border = 'none';
                        txtrtn.innerHTML = 'LOADING...';
                        txtrtn.classList.remove('to-red-color');
                        butt.disabled = true;
                        butt.textContent = 'Wait...';

                        //start ajax request
                        
                        sendData = 'PERM=SQcheCK&SQans=' + inp1.value + "&dataType=<?php echo $_GET['t']?>&actionId=<?php echo $_GET['actionId']?>&adminId=" + admId;
                        xhr = new XMLHttpRequest();
                        xhr.open('POST', __mpc_uri__() + 'functions/mpc-ajax-action.php', true);
                        xhr.onreadystatechange = function(){
                            if(this.readyState == 4 && this.status == 200){
                                if(this.responseText !== 'successfully deleted'){
                                    txtrtn.innerHTML = this.response;
                                    txtrtn.classList.add('to-red-color')
                                    butt.disabled = false;
                                    butt.textContent = 'proceed';
                                   
                                }else {
                                    var redirect =  __mpc_uri__() + "user/dashboard.php/?action=<?php echo $_GET['r1']?>&r=<?php echo $_GET['r2']?>"; //redirect url grab from url back
                                    rtnResp.appendChild(__showOKaySuccess__());
                                    butt.textContent = 'Verified...';
                                    butt.style.color = '#ffffff';

                                    toHide.style.display = 'none';
                                    toHide.style.visibility = 'hidden';
                                    txtrtn.innerHTML = 'Delete success, Redirecting... PLEASE WAIT.';

                                    //let the script wait for about 3 seconds before firing redirecting code
                                    setTimeout(() => {
                                        window.location.replace(redirect); //redirect user to this particular page
                                    }, 3000);

                                    
                                }
                            }
                        }
                        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                        xhr.send(sendData);
                    }
                    
                })
                inp2 = document.querySelector('.sq-answ');
                inp2.addEventListener('input', function(){
                    if(this.value == ''){
                        this.style.border = '1px solid #ff0000';
                    }else {
                        this.style.border = 'none';
                    }
                })
            </script>
    </div>
            <?php
            // echo $id;
        }else{
            if($_GET['action'] == 'Settings' && $_GET['r'] == 'createMember' && !empty($_GET['r'])){
                ?>
                    <i class="mpc-msg">Create Member</i><br><br>
                    <hr class="mpcHr">

                    <input type="text" class="setStyle boxMedium MEMBER-SEARCH" Placeholder="Search here">
                    <hr class="mpcHr">
                    <div class="mpc-data">
                        <input type="text" class="boxMedium createLoanInput setStyle uid-fullname mpc-disabled" placeholder="Fullname">
                        <input type="text" class="boxMedium createLoanInput setStyle  mpc-mdaDepartment mpc-disabled" placeholder="Present MDA/Department">
                        <input type="text" class="boxMedium createLoanInput setStyle  poolingMDa mpc-disabled" placeholder="Pooling MDA">
                        <input type="text" class="boxMedium createLoanInput setStyle uid-Caddress mpc-disabled" placeholder="Contact address">
                        <input type="text" class="boxMedium createLoanInput setStyle uid-AccountNo mpc-disabled" placeholder="Staff ID No">
                        <!-- NEW FILE UPDATE START HERE -->

                        <input type="text" class="boxMedium createLoanInput setStyle uid-gender mpc-disabled" placeholder="Gender">
                        <input type="text" class="boxMedium createLoanInput setStyle uid-dob mpc-disabled" placeholder="Date of Birth">
                        <input type="text" class="boxMedium createLoanInput setStyle uid-rank mpc-disabled" placeholder="Rank/Gradle Level">
                        <input type="text" class="boxMedium createLoanInput setStyle uid-appointment mpc-disabled" placeholder="Date of First Appointment">
                        <input type="text" class="boxMedium createLoanInput setStyle uid-dRetirement mpc-disabled" placeholder="Date of Retirement">
                        <input type="text" class="boxMedium createLoanInput setStyle uid-mStatus mpc-disabled" placeholder="Marital Status">
                        <input type="text" class="boxMedium createLoanInput setStyle uid-nextOfkin mpc-disabled" placeholder="Name of Next of Kin/Relationship">
                        <input type="text" class="boxMedium createLoanInput setStyle uid-Addr mpc-disabled" placeholder="Address of Next of Kin">
<!-- NEW FILE UPDATE CODE END HERE -->
                        <input type="text" class="boxMedium createLoanInput setStyle uid-phone mpc-disabled" placeholder="Phone">
                        <input type="text" class="boxMedium createLoanInput setStyle uid-pass mpc-disabled" placeholder="Password">
                        <!--select class="adm-select LoanType mpc-branches mpc-disabled" title="Branch available">
                            <option value="">----</option>
                            <?php //print __mpc_branchesName($conn, 'mpc_branches', 'branch_name', 'branch_id');?>

                        </select-->
                        
                        <!--select class="adm-select LoanType avail-groupGet" title="Group available">
                            <option value="">----</option>
                            <?php
                            /*
                                $id = $_SESSION['MPC_ADMIN_LOGIN_ID_AS'];
                                $fn = $_SESSION['MPC_ADMIN_LOGIN_FN_AS'];
                                $ln = $_SESSION['MPC_ADMIN_LOGIN_LN_AS'];
                                $usrname = $_SESSION['MPC_ADMIN_LOGIN_USR_AS'];
                                $prev = $_SESSION['MPC_ADMIN_LOGIN_PRV_AS'];
                                $sq = $_SESSION['MPC_ADMIN_LOGIN_SQ_AS'];
                                $branch = $_SESSION['MPC_ADMIN_LOGIN_BRANCH_AS'];
                                $tbl = "mpc_available_group";
                                $howToReturn = 'options';
                                $whattoselect = ['group_id', 'group_name', 'group_branch'];
                              

                                __mpcAll_availableGroup__($conn, $prev, $branch, $whattoselect, $tbl, $howToReturn, '', '');
                                */
                        ?>
                        </select-->

                        <button class="mpc-loan-butt mpc-passGenerator mpc-disabled">Generate pwd <i class="fa-key fas"></i></button> 
                        <button class="mpc-loan-butt mpc-mem-create mpc-btn mpc-disabled">Create Member <i class="fa-user fas"></i></button> 
                        <span class="mpc-refresh" title="Reload this window">
                            <i class="fa-arrows-rotate fas"></i>
                        </span>
                        <hr class="mpcHr">


                        <div class="Member-dataRtn">
                            <div class="table-responsive data-display">
                                <table class="table border-dark table-bordered">
                                    <tr>
                                        <td>#</td>
                                        <!--<td>Title </td>-->
                                        <td>Name </td>
                                        <td>Contact Address</td>
                                        <td>Phone </td>
                                        <!--<td>Group </td>-->
                                        <!--<td>Branch </td>-->
                                        <td>Staff ID No.</td>
                                        <!-- <td>Profile</td>
                                        <td>status</td> -->
                                    </tr>
                                    
                                        <?php
                                        $tbleCol = 'branch';
                                        $tble = 'mpc_members'; 
                                        //$tble = ''; 
                                        __mpc_data__($conn, $prev, $tbleCol, $tble, $branch, ['members_id', 'title', 'name', 'contact_addr', 'phone', 'groups', 'branch', 'registration_number', 'user_profile', 'status', '']);
                                        ?>
                                    
                                </table>
                            </div>
                        </div>

                        <script>
                           var el1, el2, el3, el4, liveSearch, ReturnResponse, rtnData, regNo, PhoneToPass;
                            /**TRY TO CREATE A MEMBER INTO THE SYSTEM
                             * FROM HERE ANY JAVASCRIPT CODE BELOW IS RELATED TO
                             * ADMIN LIVE SEARCH AND OTHERS STUFF
                             * YAKISE RAPHAEL IS MY NAME
                             */



                             //password generator start for member here
                            el1 = document.querySelector('.mpc-passGenerator');
                            el1.addEventListener('click', () => {
                                var input = document.querySelector('.uid-pass');
                                    input.value = __mpc_gen_pwd();
                            });

                            el2 = document.querySelector('.mpc-mem-create');
                            el2.addEventListener('click', () => {
                                var inp1, inp2, inp3, inp4, inp5, inp6, inp7, inp8, inp9,inp10, inp11, inp12, inp13, inp14, inp15, inp16, inp17, txtrtn;

                                    inp1 = document.querySelector('.uid-fullname');
                                    inp2 = document.querySelector('.uid-Caddress');
                                    inp3 = document.querySelector('.uid-AccountNo');
                                    inp4 = document.querySelector('.uid-phone');
                                    inp5 = document.querySelector('.uid-pass');
                                 //   inp6 = document.querySelector('.mpc-branches');
                                    inp7 = document.querySelector('.mpc-mdaDepartment');
                                    inp8 = document.querySelector('.poolingMDa');

                                // new code start here

                                    inp10 = document.querySelector('.uid-gender');
                                    inp11 = document.querySelector('.uid-dob');
                                    inp12 = document.querySelector('.uid-rank');
                                    inp13 = document.querySelector('.uid-appointment');
                                    inp14 = document.querySelector('.uid-dRetirement');
                                    inp15 = document.querySelector('.uid-mStatus');
                                    inp16 = document.querySelector('.uid-nextOfkin');
                                    inp17 = document.querySelector('.uid-Addr');


    let getSlash = inp16.value.lastIndexOf('/');
    let relationShip = inp16.value.substring(getSlash +1);
    let nextOfKinName = inp16.value.split('/', 1)[0];

                                //new code end here

                                    txtrtn = document.querySelector('.mpc-admin-ds-notify');

                               /* if(inp6.value === '' ){
                                    inp6.style.border = '1px solid #ff0000';
                                    txtrtn.innerHTML = 'Please select branch and Assign member, or create new one';
                                    txtrtn.classList.add('to-red-color');
                                }else*/ if(inp7.value === ''){
                                    inp7.style.border = '1px solid #ff0000';
                                    txtrtn.innerHTML = 'Please "Present MDA/DEPARTMENT" Is required for ' + inp1.value;
                                    txtrtn.classList.add('to-red-color');
                                    txtrtn.classList.add('fa-fade');
                                }else if(inp1.value === ''){
                                    txtrtn.innerHTML = 'Fullname is required';
                                    txtrtn.classList.add('to-red-color');
                                }else if(inp2.value === ''){
                                    txtrtn.innerHTML = 'Contact address is required';
                                    txtrtn.classList.add('to-red-color');
                                }else if(inp3.value === ''){
                                    txtrtn.innerHTML = 'Staff ID NO. is required';
                                    txtrtn.classList.add('to-red-color');
                                }else if(inp4.value === ''){
                                    txtrtn.innerHTML = 'Phone number is required';
                                    txtrtn.classList.add('to-red-color');
                                }else if(inp5.value === ''){
                                    txtrtn.innerHTML = 'Password is required, you can use member phone number as password';
                                    txtrtn.classList.add('to-red-color');
                                }else if(inp10.value === ''){
                                    txtrtn.innerHTML = 'Member Gender is required'
                                    txtrtn.classList.add('to-red-color');
                                    inp10.style.border = '1px solid red';
                                }else if(inp11.value === ''){
                                    txtrtn.innerHTML = 'Member Date of Birth is required'
                                    txtrtn.classList.add('to-red-color');
                                    inp11.style.border = '1px solid red';
                                }else if(inp12.value === ''){
                                    txtrtn.innerHTML = 'Member Rank/Gradle level is required'
                                    txtrtn.classList.add('to-red-color');
                                    inp12.style.border = '1px solid red';

                                }else if(inp13.value === ''){
                                    txtrtn.innerHTML = 'Member Appointment date is required'
                                    txtrtn.classList.add('to-red-color');
                                    inp13.style.border = '1px solid red';

                                }else if(inp14.value === ''){
                                    txtrtn.innerHTML = 'Member Retirement date is required'
                                    txtrtn.classList.add('to-red-color');
                                    inp14.style.border = '1px solid red';

                                }else if(inp15.value === ''){
                                    txtrtn.innerHTML = 'Member Marital status is required'
                                    txtrtn.classList.add('to-red-color');
                                    inp15.style.border = '1px solid red';

                                }else if(inp16.value === ''){
                                    txtrtn.innerHTML = 'Member Next of kin/relationship is required'
                                    txtrtn.classList.add('to-red-color');
                                    inp16.style.border = '1px solid red';

                                }else if(inp17.value === ''){
                                    txtrtn.innerHTML = 'Next of kin address is required'
                                    txtrtn.classList.add('to-red-color');
                                    inp17.style.border = '1px solid red';
                                }else if(inp16.value.search(/[/]/) == -1){
                                    txtrtn.innerHTML = 'Please use "/" to separate next of kin and relationship';
                                    txtrtn.classList.add('to-red-color');
                                    inp17.style.border = '1px solid red';

                                }else if(relationShip < 5){
                                    txtrtn.innerHTML = 'Please use "/" to separate name and relationship, relationship is required';
                                    txtrtn.classList.add('to-red-color');
                                    inp16.style.color = '2px solid red';

                                }else if(inp1.value.search(/[0-9!@#$%^&*<(}>{)?.]/) != -1){
                                    txtrtn.innerHTML = 'Unknown character in name field';
                                    txtrtn.classList.add('to-red-color');

                                }else if(inp4.value.search(/[a-z!@#$%^&*<(}>{)?.]/i) != -1){
                                    txtrtn.innerHTML = 'Unknown character in Phone field';
                                    txtrtn.classList.add('to-red-color');
                                }else if(inp4.value.length > 11){
                                    txtrtn.innerHTML = 'Invalid phone number ' + inp4.value;
                                    txtrtn.classList.add('to-red-color');
                                    txtrtn.classList.add('fa-fade');
                                }else if(inp3.value.length > 10){
                                    txtrtn.innerHTML = 'STAFF ID No. out of lenght ' + inp3.value;
                                    txtrtn.classList.add('to-red-color');
                                    txtrtn.classList.add('fa-fade');
                                }else if(inp8.value === ''){
                                    txtrtn.innerHTML = 'Pooling MDA is required ' + inp8.value;
                                    txtrtn.classList.add('to-red-color');
                                    txtrtn.classList.add('fa-fade');
                                }else {
                                   // inp6.style.border = 'none';
                                    inp7.style.border = 'none';
                                    inp8.style.border = 'none';
                                    inp3.style.border = 'none';
                                    txtrtn.innerHTML = 'LOADING... PLEASE WAIT';
                                    txtrtn.classList.remove('to-red-color');
                                    el2.disabled = true;
                                    el2.title = 'LOADING... PLEASE WAIT.';

                                    var xhr, URI, Senddata;
                                    xhr = new XMLHttpRequest();
                                    URI = __mpc_uri__() + 'functions/mpc-ajax-action.php';
                                    xhr.open('POST', URI, true);

                                    // Senddata = "PERM=mpcMemberAdd&memName="+inp1.value + '&ctAddr='+inp2.value +
                                    //  '&AccNo='+inp3.value + '&phone='+inp4.value + '&pwd='+inp5.value + 
                                    //  '&branch='+inp6.value /*+ '&group='+inp7.value*/;

                                    Senddata = JSON.stringify({
                                        PERM:'mpcMemberAdd',
                                        memName: inp1.value,
                                        ctAddr:inp2.value,
                                        AccNo:inp3.value,
                                        phone:inp4.value,
                                        pwd:inp5.value,
                                        gender:inp10.value,
                                        dob: inp11.value,
                                        gRank:inp12.value,
                                        dAppointment:inp13.value,
                                        dRetirment:inp14.value,
                                        MaritalStatus:inp15.value,
                                        NextOfkin: nextOfKinName,
                                        relationship: relationShip,
                                        nextOfkinAddr:inp17.value,
                                        branch:'UNAVAILABLE',
                                        presentMda:inp7.value,
                                        poolingMda:inp8.value

                                    })
                                    xhr.onreadystatechange = function(){
                                        if (this.readyState == 4 && this.status == 200) {
                                            if(this.response == 'successful'){
                                                el2.disabled = false;
                                                txtrtn.innerHTML = inp1.value +' successfully added to members record list, reload window to view result...';
                                                setTimeout(() => {
                                                    txtrtn.innerHTML = '';
                                                    window.location.reload();
                                                }, 3000);

                                            }else{
                                                el2.disabled = false;
                                                txtrtn.innerHTML = this.response;
                                            }
                                        }
                                    }
                                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                                    xhr.send('mpcMemberAdd='+Senddata);
                                }
                            })



 liveSearch = document.querySelector('.MEMBER-SEARCH');
 rtnData = document.querySelector('.mpc-admin-ds-notify');
 ReturnResponse = document.querySelector('.data-display');
 liveSearch.addEventListener('input', () =>{
    var ajaxRequest ;
    rtnData.innerHTML= 'Processing Request...';
    ajaxRequest = new XMLHttpRequest();
    ajaxRequest.open('GET', __mpc_uri__() + '/functions/mpc-ajax-action.php?PERM=myYakiseMYmpc&q=' + liveSearch.value, true);
    ajaxRequest.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            rtnData.innerHTML = 'Search complete!';
            ReturnResponse.innerHTML = this.response;
        }
    }
    ajaxRequest.send();

 })

 //ACCOUNT NUMBER VALIDATION
regNo = document.querySelector('.uid-AccountNo');
var inputvalue;
regNo.addEventListener('input', function(){

    if(this.value.length > 10) {
        var rtn = this.value.slice(0, 3);

        //alert(rtn)
        regNo.value = rtn;

    }else if(this.value.search(/[a-z!@#$-%^&*+()_<.>?]/i) != -1){
        this.style.border = '1px solid #ff0000';
    }else {
        this.style.border = 'none';
    }
})

//PHONE NUMBER TO PASSWORD
PhoneToPass = document.querySelector('.uid-phone');
PhoneToPass.addEventListener('input', function(){
    document.querySelector('.uid-pass').value =  this.value;; //getting phone as password at default
        
       
})

__mpcForceReload();

//mpc-disabled if you are not secretary
let previ = <?php echo $prev?>;
let staffId = <?php echo $id?>;

if(previ !== 5 && staffId !== 1 && previ !== 4){
    __mpc_disabled__('mpc-disabled', 'SUPER-ADMIN, SECRETARY'); ///disabled all the input here
}
                        </script>
                    </div>
                <?php
            }else{
                if($_GET['action'] == 'Settings' && $_GET['r'] == 'credit/Bmg' && !empty($_GET['r'])){
                    ?>
                    <i class="mpc-admMsg">Assign branch manager</i><br><br>
                    <hr class="mpcHr">
                    <div class="table-responsive">
                        <table class="table table-bordered border-dark">
                            <tr>
                                <td>#</td>
                                <td>Branch</td>
                                <td>Manager</td>
                                <td>Credit officer</td>
                                <td>action</td>
                                
                            </tr>
                            <?php __mpc_branchWithoutMg__($conn, $prev, $branch);
                            
                            ?>
                        </table>
<script>
    //mpc-disabled if you are not secretary
let previ = <?php echo $prev?>;
let staffId = <?php echo $id?>;

if(/*previ !== 5 && */staffId !== 1){
__mpc_disabled__('mpc-disabled', 'SUPER-ADMIN'); ///disabled all the input here
}
</script>
                    </div>
                    <?php
                }else{
                    if($_GET['action'] == 'Settings' && $_GET['r'] == 'intrestRate' && !empty($_GET['r'])){
                        ?>
                            <i class="mpc-admMsg">Interest Rate</i><br><br>
                            <hr class="mpcHr">

                            <div class="mpc-intrest-rate-set">
                                <!--select class="adm-select mpc-availBranch mpc-Intrest LoanType mpc-m-top" >
                                    <option value="">----</option>
                                    <option value="Group loan">Group loan</option>
                                    <option value="Fixed interest">Fixed interest</option>
                                    <option value="Reducing balance interest">Reducing balance interest</option>
                                    <option value="Fixed interest loans">Fixed interest loans</option>

                                </select-->
                                <input type="text" class="mpc-Intrest setStyle LoanType mpc-m-top mpc-qinfo mpc-disabled" placeholder="Interest rate name">

                                <input type="text" placeholder="Enter interest rate" class="intrestVal mpc-disabled setStyle createLoanInput loanUserFname">
                                <button class="mpc-buttx crte-mpc-user mpc-loan-butt mpc-disabled button-go-block mpc-btn intrest-butt">Set rate</button>
                                <span class="mpc-refresh" title="RELOAD WINDOW"><i class="fas fa-refresh"></i></span>
                            </div>

                            <div class="table-responsive mpc-marginTop-small">
                                <table class="table table-striped table-bordered border-dark">
                                    <thead>
                                        <tr class="mpc-tableHead-tr">
                                            <th>#</th>
                                            <th>Interest type</th>
                                            <th>rate</th>
                                        </tr>
                                    </thead>
                                    
                                    <?php
                                        __mpc_get_IntrestRate__($conn, 'table');
                                    ?>
                                </table>
                            </div>
<script>
    var a, b, c, d, xhr, sendData;

        a = document.querySelector('.intrest-butt');
        a.addEventListener('click', function(){
            this.disabled = true;

            b = document.querySelector('.mpc-Intrest');
            c = document.querySelector('.intrestVal');
            d = document.querySelector('.mpc-admin-ds-notify');

            //check and validate start
            if(b.value == ''){
                d.innerHTML = 'Select interest rate type!';
                d.classList.add('to-red-color');
                this.disabled = false;
            }else if(c.value == ''){
                d.innerHTML = 'Enter interest value';
                d.classList.add('to-red-color');
                this.disabled = false;
            }else if(c.value.search(/[a-z!@#$%^&)*|}{(>'"<,]/i) !== -1){
                d.innerHTML = 'Error, Interest contains an invalid data => "' + c.value + '"';
                d.classList.add('to-red-color');
                this.disabled = false;
            }else{
                d.innerHTML = 'Processing... please wait.';
                d.classList.remove('to-red-color');

                sendData = "PERMI=PLEASEsetRate&rateType=" + b.value + '&rateValue='+ c.value;
                xhr = new XMLHttpRequest();
                xhr.open('POST',  __mpc_uri__() + 'functions/mpc-ajax-action.php', true);
                xhr.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        if(this.response == 'Intrest rateSaved'){
                            a.disabled = false;
                            d.innerHTML = 'Interest rate successfully saved, reload window to view result...';
                        }else{
                          ///  a.disabled = false;
                            d.innerHTML = this.response;
                            d.classList.add('to-red-color');
                           // alert(this.response);
                           document.querySelector('.intrest-butt').disabled = false;
                        }
                    }
                }
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.send(sendData);
            }


        })

        __mpcForceReload();

    //mpc-disabled if you are not secretary
let previ = <?php echo $prev?>;
let staffId = <?php echo $id?>;

if(/*previ !== 5 && */staffId !== 1){
    __mpc_disabled__('mpc-disabled', 'SUPER-ADMIN'); ///disabled all the input here
}
</script>
                        <?php
                    }else if($_GET['action'] === 'Settings' && $_GET['r'] === 'faqs' && !empty($_GET['r'])){
    ?>
        <i class="mpcMsg">Frequently Ask Questions</i><br><br>
        <hr class="mpcHr">

        <div class="mpc-faqsAdd">
            <div class="faqsTitle">
                <input type="text" placeholder="Question title" class="adm-select inputData mpcFullWidth mpc-faqsTitle dsh-board-light-mode mpc-db-one">
            </div>
            <div class="faqsContent">
                <textarea class="mpc-faqsContent faqs-textArea dsh-board-light-mode mpc-db-one" id="faqs" cols="30" rows="10" placeholder="Frequently ask questions"></textarea>

                <button class="mpc-btn mpc-btn-fullWidth">Saved</button>
            </div>
        </div>
    <script>

        var a, b, c, d, xhr, sendData;
            a = document.querySelector('.mpc-btn-fullWidth');
            a.addEventListener('click', function(){
                b = document.querySelector('.mpc-faqsTitle');
                c = document.querySelector('.mpc-faqsContent');
                d = document.querySelector('.mpc-admin-ds-notify');

               // alert(b.value);
                //alert(c.value);
                if(b.value == ''){
                    d.innerHTML = 'Please Enter title';
                    d.classList.add('to-red-color');
                    __clearoutMpc('mpc-admin-ds-notify', 3000);

                }else if(c.value == ''){
                    d.innerHTML = 'Please Enter title';
                    d.classList.add('to-red-color');

                    __clearoutMpc('mpc-admin-ds-notify', 3000);
                }else {
                    sendData = "PERMITED=DOUbleFaqS&title=" + b.value + '&Content='+ c.value;
                    this.disabled = true ;// trying to disabled button to prevent double clicking/sending of data twice
                    
                    xhr = new XMLHttpRequest(); //START GOODLIFE AJAX REQUEST
                    xhr.open('POST', __mpc_uri__() + 'functions/mpc-ajax-action.php', true);
                    //checking request ready state
                    xhr.onreadystatechange = function(){
                        if(this.readyState == 4 && this.status == 200){
                            if(this.response == 'FAQS SAVED'){
                                d.innerHTML = 'Frequently Ask Question saved!';
                                a.disabled = false;
                                
                                setTimeout(function(){
                                    window.location.reload();
                                }, 2000)
                            }else {
                                d.innerHTML = this.response;
                                a.disabled = false;
                                console.log('Developer: Yakise Raphael Etim, Phone: 09069053009');
                                
                            }
                        }
                    }
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.send(sendData);

                }
            })
    </script>
        <div class="mpc-accordionCtn">
            <?php __mpc_faqs__($conn)?>
        </div>
    <?php
        }else{
            if($_GET['action'] === 'CheckNotification'){

    $AdminId = $_GET['id'];
    $AdminPrev = $_GET['prev'];

?>
<i class="mpc-admMsg">Check Notification</i><br><br>
<hr class="mpcHr">

    <h5> <?php  print $fn . ' ' . $ln . ' Your have ' . __mpcNotificationForAdmin__($conn, $AdminId, $AdminPrev)?> unread notification(s)</h5>

    <div class="table-responsive">
        <!--SEND BULK SMS-->
        <a class="mpc-willBe-hidden" href="<?php echo __mpc_root__()?>user/dashboard.php/?action=sendMsg">Send message</a>
        <table class="table table-bordered border-dark">
            <thead><tr>
                <th>#</th>
                <th>Sender</th>
                <th>Notification</th>
                <th>Time and date</th>
                <th>Notification For</th>
                <th>action</th>
            </tr></thead>

            <tbody>
                <?php 
                    __showAdmin_Notification__($conn, $AdminId, $AdminPrev);
                ?>
            </tbody>
        </table>
    </div>
<?php
                        }else{
                             if($_GET['action'] === 'AdminRead'){
                                ?>
                                    <i class="mpc-admMsg">Read Notification</i><br><br>
                                    <hr class="mpcHr">
                                        <a href="<?php echo __mpc_root__()?>user/dashboard.php/?action=sendMsg">Send message</a>
                                    <div class="mpc-popup-anytime">
                                        <div class="mpc-popup-bg mpc-just-black">
                                            <div class="close-mpc-popup" title="CLOSE THIS POP UP">
                                                <i class="fa-solid fa-xmark fa-2x"></i>
                                            </div>

                                            <div class="mpc-popup-inner">
        <?php 
        
            /**THIS FUNCTION BELOW WILL 
             * ALLOWED OUR ADMIN TO
             * READ NOTIFICATION WITH EASE
             * AND ALSO REMOVE ALL READ
             * NOTIFICATIONS FROM UNREAD
             * NOTIFICATION LIST
             */
            print __mpcShowAdminNotification__($conn, $_GET['reader'], $_GET['notId'])['notification'];
        ?>
                                            </div>
                                            <div class="mpc-Read-notification-time">
                                                Sender:
                                                <?php print __mpcShowAdminNotification__($conn, $_GET['reader'], $_GET['notId'])['notification_sender'];?>
                                            </div>
                                            <div class="mpc-Read-notification-time">
                                                Time: <?php print __mpcShowAdminNotification__($conn, $_GET['reader'], $_GET['notId'])['time_and_date'];?>
                                            </div>
                                        </div>
                                        <script>
                                            mpc_ReadPopclose(); //THIS FUNCTION HERE WILL ALLOWED ADMIN TO 
                                                            // CLOSE NOTIFICATION POP UP
                                        </script>
                                    </div>
                                <?php

                             }else{
                                if($_GET['action'] === 'sendMsg'){

                                    ?>
                                        <i class="mpc-admMsg">Send message to staff</i><br><br>
                                        <hr class="mpcHr">
                                    <style>.rmv-item{display: none;}</style>
                                        <div class="mpc-staffList">
                                            <div class="mpc-div-2">
                                                <div class="mpc-Send-sideOne mpc-set-in dsh-board-light-mode shadow table-responsive">
                                                    <table class="table table-bordered border-dark">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Name</th>
                                                                <th>Username</th>
                                                                <th>Branch</th>
                                                                <th>Previllegde</th>
                                                                <th>Profile</th>
                                                            </tr>

                                                        </thead>

                                                        <?php  __mpc_availUser__($conn)?>
                                                    </table>
                                                </div>

                                                <div class="mpc-Send-sideTwo mpc-set-in dsh-board-light-mode shadow">
                                                    <div class="msg-wrap mpc-faqsAdd">
                                                        <select class="adm-select LoanType msgSenderSendto">
                                                            <option value="">-----</option>
                                                            
                                                            <?php 
                                                                /**THIS FUNCTION WILL RETURN ALL STAFF BY NAME */
                                                                __mpcStaffByName__($conn);
                                                            ?>
                                                        </select>

                        <div class="mpc-msgBox">
                            <textarea class="mpc-faqsContent faqs-textArea dsh-board-light-mode mpc-db-one" id="faqs" cols="30" rows="10" placeholder="Enter message"></textarea>

                            <button style="margin:auto;" mpc-adm-id="<?php echo $id?>" mpc-data-prev="<?php echo $prev?>" class="mpc-btn mpc-go-block send-mpc-msg-btn"><i class="fa-solid fa-paper-plane"></i></button>
                            <p class="rtnMsg"></p>
<script>
        let SendBtn = document.querySelector('.send-mpc-msg-btn');
        SendBtn.onclick = function(){
        let senderId = this.getAttribute('mpc-adm-id');
        let senderPrev = this.getAttribute('mpc-adm-id');
        let rtn, xhr, msg, sendTo;
        rtn = document.querySelector('.rtnMsg');
        sendTo = document.querySelector('.msgSenderSendto');
        msg = document.querySelector('.mpc-faqsContent');

        if(msg.value == ''){
            msg.placeholder = 'Pls enter message';
           // __clearoutMpc('rtnMsg', 3000);
        }else if(sendTo.value == ''){
            rtn.innerHTML = 'Who are you sending to'
            sendTo.style.border = '1.5px solid red';
            __clearoutMpc('rtnMsg', 3000); //cler out message after 3000 milliseconds
        }else {
            xhr = new XMLHttpRequest();
            xhr.open('GET', __mpc_uri__() + 'functions/mpc-ajax-action.php?Mparam=YakiseRaphaelIsgo&senderId='+senderId + '&senderPrev='+senderPrev + '&msg='+msg.value + '&sendTo='+sendTo.value, true);
            
            xhr.onreadystatechange = function(){

                if(this.readyState == 4 && this.status == 200){
                    if(this.response == 'Okay'){
                        rtn.innerHTML == 'Message sent!'
                    }else{
                        rtn.innerHTML = this.response;
                        setTimeout(function(){
                            rtn.innerHTML = '';
                            msg.value = '';
                        }, 4000);
                    }
                }
            }
            xhr.send();
        }


        
}
</script>
                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                }else{
                                    if($_GET['action'] === 'Bulksms'){
                                        ?>
<i class="mpc-admMsg">Send Bulk sms</i><br><br>
<hr class="mpcHr">

<div class="mpc-s-bulksms">
    <div class="sms-mpc-two ">
        <textarea class="bulk-sms-textarea sndrNumber" cols="30" rows="10" placeholder="<?php echo getSystemName($conn)[1]?> MEMBERS PHONE NUMBERS HERE"><?php echo __mpc_member_phone__($conn)?></textarea>
    </div>

    <div class="sms-mpc-two">
        <textarea class="bulk-sms-textarea sndrsms" cols="30" rows="10" placeholder="<?php print getSystemName($conn)[0] ?>...  Enter message here "></textarea>

        <button class="mpc-send-bulksms-members mpc-btn bulkSms" style="padding:8px"><i class="fa-solid fa-paper-plane fa-2x"></i></button>
        
    </div>
    <script>
        sendBulkSmsButt = document.querySelector('.mpc-send-bulksms-members');

        sendBulkSmsButt.onclick = function(){
            let bulkNumber,Msg, rtn, xhr;

            bulkNumber = document.querySelector('.sndrNumber');
            Msg = document.querySelector('.sndrsms');
            rtn = document.querySelector('.mpc-admin-ds-notify');

            if(bulkNumber.value === ''){
                bulkNumber.style.border = '1.5px solid #ff0000';
                rtn.innerHTML = 'Enter number here or refresh window for system auto add.';

            }else if(bulkNumber.value.length < 13){
                bulkNumber.style.border = '1.5px solid #ff0000';
                rtn.innerHTML = 'Invalid number, pls number should start with 234.';

            }else if(Msg.value === ''){
                Msg.style.border = '1.5px solid red';
                rtn.innerHTML = 'Pls type some text before clicking send button';

            }else if(Msg.value.length < 15){
                Msg.style.border = '1.5px solid red';
                rtn.innerHTML = 'Pls type some text before clicking send button';

            }else {

                xhr = new XMLHttpRequest();
                xhr.open('GET', __mpc_uri__() + 'functions/mpc-ajax-action.php?bulkySms=MpcsYAkiseETIm&n='+ bulkNumber.value + '&msg=' + Msg.value, true);
                xhr.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status){
                        rtn.innerHTML = this.response;
                    }
                }
                xhr.send();
            }

        }
    </script>

    <?php // echo ?>
</div>
            <?php
        }else if($_GET['action'] === 'Settings' && $_GET['r'] == 'missingData'){
?>
<i class="mpc-admMsg">Add Information Manually</i><br><br>
<hr class="mpcHr">
<div class="mpc-group-loan-container">
    <div class="mpc-fxlled slkkewf">
<style type="text/css">
    .__system_notice__{
        border-radius: 50%;
    }
</style>
        <div class="xmltpSch">
            <input type="search" title="Search With: Phone, Name, Department, staff ID and Date of Retirement" class="setStyle createLoanInput sjjmemb" placeholder="Search Phone, Name, Department, staff ID and Date of Retirement">
        </div>
<?php 

?>
        <div class="xmecss mpplesd cmputer uyo" uid="<?php if(isset($_GET['id'])){echo $_GET['id'];}?>" ph="<?php 

        if(isset($_GET['v'])){echo $_GET['v'];}?>"> 
            <div class="table-responsive uyoetibass">
                <table class="table table-bordered border-dark table-striped table-hover">
                    <thead>
                        <th>#</th>
                        <th>Name</th>
                        <th>Profile</th>
                        <th>Department</th>
                        <th>Staff ID</th>
                        <!-- <th>#</th> -->
                    </thead>
                    
                    <?php 
                        __getSystemMembers($conn);
                    ?>
                </table>
            </div>
        </div>

    </div>
</div>
<!-- auto generate:  <?php echo date('d-m-y h:i: s')?> -->
<?php 
if(isset($_GET['v']) && $_GET['v'] !== '' && $_GET['id'] !== '')
{
?>
<div class="mpc-popup-anytime">
    <div class="missingData">
        <div class="__eltop">
            <span title="CLOSE THIS WINDOW" class="close" tabindex="1"><i class="fas fa-xmark fa-3x"></i></span>

            <span class="tryReload" title="Reload this window">
                <i class="fas fa-refresh fa-3x"></i>
            </span>

            <span class="membername" title="YOU ARE CURRENTLY EDITING THIS MEMBER">
                <?php 
                     $ph = $_GET['v'];
                    echo __mpcReturnByPhoneMember($conn, $ph)[4];
                ?>
            </span>
        </div>
<script>
    let reloader = document.querySelector('.tryReload');
        reloader.onclick = function(){
            window.location.reload()
        }
</script>
        <main class="mainEle">
            <div class="_mpc-item__wrap">
                <div class="items shadow">
                    <div class="dsh-board-light-mode appName text-center">
                        <h5>Thrift saving</h5>

                        <!-- <button class="mpc-btn save-thrift"> -->
                        <button class="mpc-btn save-thrift">&#8358;
<?php 
$tbl = "mpc_thrift_saving";
$uid = $_GET['id'];
$ph = $_GET['v'];
$tblCol1 = 'thrift_mem_id'; //col1
$tblCol2 = 'thrift_mem_phone'; //col2
$tblid = 'thrift_id';
echo __mpcMemberAccountBal__($conn, $tbl, $uid, $ph, $tblCol1, $tblCol2, $tblid)[2]?>
    
</button>
                        <!-- </button> -->
                    </div>
                    <div class="table-responsive">
<table class="table table-bordered border-dark table-striped table-hover">
    <thead>
        <th>Date</th>
        <th>Debit</th>
        <th>Credit</th>
        <th>Balance</th>
    </thead>
    <tbody>
        <tr >
            <td>
                <input type="text" class="setStyle missingInput special thrift-dte1" attr="dte1" placeholder="Date">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special thrift-dbt1" dbt="dbt1" placeholder="Debit">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special thrift-crdt1" crt="crd1" placeholder="Credit">
            </td>

            <td>
                <!-- <input type="text" class="setStyle missingInput splance spc_bl1" bln="1" placeholder="Balance"> -->
                <button class="mpc-btn thrift-Saving" bln="1">save</button>
            </td>
        </tr>

        <tr>
            <td>
                <input type="text" class="setStyle missingInput special thrift-dte2" attr="spdte2" placeholder="Date">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special thrift-dbt2" dbt="spdt2" placeholder="Debit">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special thrift-crdt2" crt="spcdt2" placeholder="Credit">
            </td>

            <td>
                <!-- <input type="text" class="setStyle missingInput splance spcbal2" bln="2" placeholder="Balance"> -->
                <button class="mpc-btn thrift-Saving" bln="2">save</button>

            </td>
        </tr>

        <tr>
            <td>
                <input type="text" class="setStyle missingInput special thrift-dte3" attr="spdte3" placeholder="Date">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special thrift-dbt3" dbt="spdte3" placeholder="Debit">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special thrift-crdt3" crt="spcdte3" placeholder="Credit">
            </td>

            <td>
                <!-- <input type="text" class="setStyle missingInput splance spbal3" bln="3" placeholder="Balance"> -->
                <button class="mpc-btn thrift-Saving" bln="3">save</button>

            </td>
        </tr>

        <tr>
            <td>
                <input type="text" class="setStyle missingInput special thrift-dte4" attr="dte4" placeholder="Date">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special thrift-dbt4" dbt="dbit4" placeholder="Debit">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special thrift-crdt4" crt="crdt4" placeholder="Credit">
            </td>

            <td>
                <!-- <input type="text" class="setStyle missingInput splance" bln="4" placeholder="Balance"> -->
                <button class="mpc-btn thrift-Saving" bln="4">save</button>

            </td>
        </tr>

        <tr>
            <td>
                <input type="text" class="setStyle missingInput special thrift-dte5" attr="dte5" placeholder="Date">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special thrift-dbt5" dbt="dbt5" placeholder="Debit">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special thrift-crdt5" crt="crdt5" placeholder="Credit">
            </td>

            <td>
                <!-- <input type="text" class="setStyle missingInput splance bl1" bln="5" placeholder="Balance"> -->
                <button class="mpc-btn thrift-Saving" bln="5">save</button>

            </td>
        </tr>

        <tr>
            <td>
                <input type="text" class="setStyle missingInput special thrift-dte6" attr="dte6" placeholder="Date">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special thrift-dbt6" dbt="dbt6" placeholder="Debit">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special thrift-crdt6" crt="crdt6" placeholder="Credit">
            </td>

            <td>
                <!-- <input type="text" class="setStyle missingInput splance bl1" bln="6" placeholder="Balance"> -->
                <button class="mpc-btn thrift-Saving" bln="6">save</button>

            </td>
        </tr>

        <tr>
            <td>
                <input type="text" class="setStyle missingInput special thrift-dte7" attr="dte" placeholder="Date">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special thrift-dbt7" dbt="dbt7" placeholder="Debit">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special thrift-crdt7" crt="crdt7" placeholder="Credit">
            </td>

            <td>
                <!-- <input type="text" class="setStyle missingInput splance bl1" bln="7" placeholder="Balance"> -->
                <button class="mpc-btn thrift-Saving" bln="7">save</button>

            </td>
        </tr>

        <tr>
            <td>
                <input type="text" class="setStyle missingInput special thrift-dte8" attr="dte8" placeholder="Date">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special thrift-dbt8" dbt="dbt8" placeholder="Debit">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special thrift-crdt8" crt="crdt8" placeholder="Credit">
            </td>

            <td>
                <!-- <input type="text" class="setStyle missingInput splance bl1" bln="8" placeholder="Balance"> -->
                <button class="mpc-btn thrift-Saving" bln="8">save</button>

            </td>
        </tr>

        <tr>
            <td>
                <input type="text" class="setStyle missingInput special thrift-dte9" attr="dte" placeholder="Date">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special thrift-dbt9" dbt="dbt9" placeholder="Debit">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special thrift-crdt9" crt="crdt9" placeholder="Credit">
            </td>

            <td>
                <!-- <input type="text" class="setStyle missingInput splance  bl1" bln="9" placeholder="Balance"> -->
                <button class="mpc-btn thrift-Saving" bln="9">save</button>

            </td>
        </tr>

        <tr>
            <td>
                <input type="text" class="setStyle missingInput special thrift-dte10" attr="dte10" placeholder="Date">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special thrift-dbt10" dbt="dbt10" placeholder="Debit">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special  thrift-crdt10" crt="crdt10" placeholder="Credit">
            </td>

            <td>
                <!-- <input type="text" class="setStyle missingInput splance  bl1" bln="10" placeholder="Balance"> -->
                <button class="mpc-btn thrift-Saving" bln="10">save</button>

            </td>
        </tr>

        <tr>
            <td>
                <input type="text" class="setStyle missingInput special thrift-dte11" attr="dte11" placeholder="Date">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special thrift-dbt11" dbt="dbt11" placeholder="Debit">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special  thrift-crdt11" crt="crdt11" placeholder="Credit">
            </td>

            <td>
                <!-- <input type="text" class="setStyle missingInput splance  bl1" bln="11" placeholder="Balance"> -->
                <button class="mpc-btn thrift-Saving" bln="11">save</button>

            </td>
        </tr>

        <tr>
            <td>
                <input type="text" class="setStyle missingInput special thrift-dte12" attr="dte" placeholder="Date">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special thrift-dbt12" dbt="dbt12" placeholder="Debit">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special  thrift-crdt12" crt="crdt12" placeholder="Credit">
            </td>

            <td>
                <!-- <input type="text" class="setStyle missingInput splance  bl1" bln="12" placeholder="Balance"> -->

                <button class="mpc-btn thrift-Saving" bln="12">save</button>
            </td>
        </tr>

        <tr>
            <td>
                <input type="text" class="setStyle missingInput special thrift-dte13" attr="dte13" placeholder="Date">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special thrift-dbt13" dbt="dbt13" placeholder="Debit">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special  thrift-crdt13" crt="crdt13" placeholder="Credit">
            </td>

            <td>
                <!-- <input type="text" class="setStyle missingInput splance  bl1" bln="13" placeholder="Balance"> -->
                <button class="mpc-btn thrift-Saving" bln="13">save</button>

            </td>
        </tr>

        <tr>
            <td>
                <input type="text" class="setStyle missingInput special thrift-dte14" attr="dte14" placeholder="Date">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special thrift-dbt14" dbt="dbt14" placeholder="Debit">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special  thrift-crdt14" crt="crdt14" placeholder="Credit">
            </td>

            <td>
                <!-- <input type="text" class="setStyle missingInput splance  bl1" bln="14" placeholder="Balance"> -->
                <button class="mpc-btn thrift-Saving" bln="14">save</button>

            </td>
        </tr>

        <tr>
            <td>
                <input type="text" class="setStyle missingInput special thrift-dte15" attr="dte15" placeholder="Date">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special thrift-dbt15" dbt="dbt15" placeholder="Debit">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special  thrift-crdt15" crt="crdt15" placeholder="Credit">
            </td>

            <td>
                <!-- <input type="text" class="setStyle missingInput splance  bl1" bln="15" placeholder="Balance"> -->
                <button class="mpc-btn thrift-Saving" bln="15">save</button>

            </td>
        </tr>

        <tr>
            <td>
                <input type="text" class="setStyle missingInput special thrift-dte16" attr="dte16" placeholder="Date">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special thrift-dbt16" dbt="dbt16" placeholder="Debit">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special thrift-crdt16" crt="crdt16" placeholder="Credit">
            </td>

            <td>
                <!-- <input type="text" class="setStyle missingInput splance  bl1" bln="16" placeholder="Balance"> -->
                <button class="mpc-btn thrift-Saving" bln="16">save</button>

            </td>
        </tr>

        <tr>
            <td>
                <input type="text" class="setStyle missingInput special thrift-dte17" attr="dte" placeholder="Date">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special thrift-dbt17" dbt="crdt17" placeholder="Debit">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special  thrift-crdt17" crt="crdt17" placeholder="Credit">
            </td>

            <td>
                <!-- <input type="text" class="setStyle missingInput splance  bl1" bln="17" placeholder="Balance"> -->
                <button class="mpc-btn thrift-Saving" bln="17">save</button>

            </td>
        </tr>
    </tbody>
</table>
                    </div>
        

                </div>
                <div class="items shadow">
                    <div class="dsh-board-light-mode appName text-center">
                        <h5>Shares saving</h5>

                        <!-- <button class="mpc-btn save-share"> -->
                        <button class="mpc-btn save-share">&#8358;
<?php 
$tbl = "mpc_account_shares";
$uid = $_GET['id'];
$ph = $_GET['v'];
$tblCol1 = 'shares_member_id'; //col1
$tblCol2 = 'shares_member_phone'; //col2
$tblid = 'shares_id';
echo __mpcMemberAccountBal__($conn, $tbl, $uid, $ph, $tblCol1, $tblCol2, $tblid)[2]?>
    
</button>
                        <!-- </button> -->
                    </div>

                    <div class="table-responsive">
<table class="table table-bordered border-dark table-striped table-hover">
    <thead>
        <th>Date</th>
        <th>Debit</th>
        <th>Credit</th>
        <th>Balance</th>
    </thead>
    <tbody>
        <tr >
            <td>
                <input type="text" class="setStyle missingInput special share_dte1" attr="dte1" placeholder="Date">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special share_dbt1" dbt="dbt1" placeholder="Debit">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special share_crdt1" crt="crd1" placeholder="Credit">
            </td>

            <td>
                <!-- <input type="text" class="setStyle missingInput splance spc_bl1" bln="1" placeholder="Balance"> -->
                <button class="mpc-btn share-Saving" bln="1">save</button>
            </td>
        </tr>

        <tr>
            <td>
                <input type="text" class="setStyle missingInput special share_dte2" attr="spdte2" placeholder="Date">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special share_dbt2" dbt="spdt2" placeholder="Debit">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special share_crdt2" crt="spcdt2" placeholder="Credit">
            </td>

            <td>
                <!-- <input type="text" class="setStyle missingInput splance spcbal2" bln="2" placeholder="Balance"> -->
                <button class="mpc-btn share-Saving" bln="2">save</button>

            </td>
        </tr>

        <tr>
            <td>
                <input type="text" class="setStyle missingInput special share_dte3" attr="spdte3" placeholder="Date">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special share_dbt3" dbt="spdte3" placeholder="Debit">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special share_crdt3" crt="spcdte3" placeholder="Credit">
            </td>

            <td>
                <!-- <input type="text" class="setStyle missingInput splance spbal3" bln="3" placeholder="Balance"> -->
                <button class="mpc-btn share-Saving" bln="3">save</button>

            </td>
        </tr>

        <tr>
            <td>
                <input type="text" class="setStyle missingInput special share_dte4" attr="dte4" placeholder="Date">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special share_dbt4" dbt="dbit4" placeholder="Debit">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special share_crdt4" crt="crdt4" placeholder="Credit">
            </td>

            <td>
                <!-- <input type="text" class="setStyle missingInput splance" bln="4" placeholder="Balance"> -->
                <button class="mpc-btn share-Saving" bln="4">save</button>

            </td>
        </tr>

        <tr>
            <td>
                <input type="text" class="setStyle missingInput special share_dte5" attr="dte5" placeholder="Date">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special share_dbt5" dbt="dbt5" placeholder="Debit">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special share_crdt5" crt="crdt5" placeholder="Credit">
            </td>

            <td>
                <!-- <input type="text" class="setStyle missingInput splance bl1" bln="5" placeholder="Balance"> -->
                <button class="mpc-btn share-Saving" bln="5">save</button>

            </td>
        </tr>

        <tr>
            <td>
                <input type="text" class="setStyle missingInput special share_dte6" attr="dte6" placeholder="Date">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special share_dbt6" dbt="dbt6" placeholder="Debit">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special share_crdt6" crt="crdt6" placeholder="Credit">
            </td>

            <td>
                <!-- <input type="text" class="setStyle missingInput splance bl1" bln="6" placeholder="Balance"> -->
                <button class="mpc-btn share-Saving" bln="6">save</button>

            </td>
        </tr>

        <tr>
            <td>
                <input type="text" class="setStyle missingInput special share_dte7" attr="dte" placeholder="Date">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special share_dbt7" dbt="dbt7" placeholder="Debit">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special share_crdt7" crt="crdt7" placeholder="Credit">
            </td>

            <td>
                <!-- <input type="text" class="setStyle missingInput splance bl1" bln="7" placeholder="Balance"> -->
                <button class="mpc-btn share-Saving" bln="7">save</button>

            </td>
        </tr>

        <tr>
            <td>
                <input type="text" class="setStyle missingInput special share_dte8" attr="dte8" placeholder="Date">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special share_dbt8" dbt="dbt8" placeholder="Debit">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special share_crdt8" crt="crdt8" placeholder="Credit">
            </td>

            <td>
                <!-- <input type="text" class="setStyle missingInput splance bl1" bln="8" placeholder="Balance"> -->
                <button class="mpc-btn share-Saving" bln="8">save</button>

            </td>
        </tr>

        <tr>
            <td>
                <input type="text" class="setStyle missingInput special share_dte9" attr="dte" placeholder="Date">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special share_dbt9" dbt="dbt9" placeholder="Debit">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special share_crdt9" crt="crdt9" placeholder="Credit">
            </td>

            <td>
                <!-- <input type="text" class="setStyle missingInput splance  bl1" bln="9" placeholder="Balance"> -->
                <button class="mpc-btn share-Saving" bln="9">save</button>

            </td>
        </tr>

        <tr>
            <td>
                <input type="text" class="setStyle missingInput special share_dte10" attr="dte10" placeholder="Date">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special share_dbt10" dbt="dbt10" placeholder="Debit">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special  share_crdt10" crt="crdt10" placeholder="Credit">
            </td>

            <td>
                <!-- <input type="text" class="setStyle missingInput splance  bl1" bln="10" placeholder="Balance"> -->
                <button class="mpc-btn share-Saving" bln="10">save</button>

            </td>
        </tr>

        <tr>
            <td>
                <input type="text" class="setStyle missingInput special share_dte11" attr="dte11" placeholder="Date">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special share_dbt11" dbt="dbt11" placeholder="Debit">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special  share_crdt11" crt="crdt11" placeholder="Credit">
            </td>

            <td>
                <!-- <input type="text" class="setStyle missingInput splance  bl1" bln="11" placeholder="Balance"> -->
                <button class="mpc-btn share-Saving" bln="11">save</button>

            </td>
        </tr>

        <tr>
            <td>
                <input type="text" class="setStyle missingInput special share_dte12" attr="dte" placeholder="Date">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special share_dbt12" dbt="dbt12" placeholder="Debit">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special  share_crdt12" crt="crdt12" placeholder="Credit">
            </td>

            <td>
                <!-- <input type="text" class="setStyle missingInput splance  bl1" bln="12" placeholder="Balance"> -->

                <button class="mpc-btn share-Saving" bln="12">save</button>
            </td>
        </tr>

        <tr>
            <td>
                <input type="text" class="setStyle missingInput special share_dte13" attr="dte13" placeholder="Date">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special share_dbt13" dbt="dbt13" placeholder="Debit">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special  share_crdt13" crt="crdt13" placeholder="Credit">
            </td>

            <td>
                <!-- <input type="text" class="setStyle missingInput splance  bl1" bln="13" placeholder="Balance"> -->
                <button class="mpc-btn share-Saving" bln="13">save</button>

            </td>
        </tr>

        <tr>
            <td>
                <input type="text" class="setStyle missingInput special share_dte14" attr="dte14" placeholder="Date">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special share_dbt14" dbt="dbt14" placeholder="Debit">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special  share_crdt14" crt="crdt14" placeholder="Credit">
            </td>

            <td>
                <!-- <input type="text" class="setStyle missingInput splance  bl1" bln="14" placeholder="Balance"> -->
                <button class="mpc-btn share-Saving" bln="14">save</button>

            </td>
        </tr>

        <tr>
            <td>
                <input type="text" class="setStyle missingInput special share_dte15" attr="dte15" placeholder="Date">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special share_dbt15" dbt="dbt15" placeholder="Debit">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special  share_crdt15" crt="crdt15" placeholder="Credit">
            </td>

            <td>
                <!-- <input type="text" class="setStyle missingInput splance  bl1" bln="15" placeholder="Balance"> -->
                <button class="mpc-btn share-Saving" bln="15">save</button>

            </td>
        </tr>

        <tr>
            <td>
                <input type="text" class="setStyle missingInput special share_dte16" attr="dte16" placeholder="Date">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special share_dbt16" dbt="dbt16" placeholder="Debit">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special share_crdt16" crt="crdt16" placeholder="Credit">
            </td>

            <td>
                <!-- <input type="text" class="setStyle missingInput splance  bl1" bln="16" placeholder="Balance"> -->
                <button class="mpc-btn share-Saving" bln="16">save</button>

            </td>
        </tr>

        <tr>
            <td>
                <input type="text" class="setStyle missingInput special share_dte17" attr="dte" placeholder="Date">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special share_dbt17" dbt="crdt17" placeholder="Debit">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special  share_crdt17" crt="crdt17" placeholder="Credit">
            </td>

            <td>
                <!-- <input type="text" class="setStyle missingInput splance  bl1" bln="17" placeholder="Balance"> -->
                <button class="mpc-btn share-Saving" bln="17">save</button>

            </td>
        </tr>
    </tbody>
</table>
                    </div>

                </div>
                <div class="items shadow">
                    <div class="dsh-board-light-mode appName">
                        <h5>Special saving</h5>
                        <button class="mpc-btn save-special">&#8358;
<?php 
$tbl = "mpc_special_saving";
$uid = $_GET['id'];
$ph = $_GET['v'];
$tblCol1 = 'mem_id'; //col1
$tblCol2 = 'mem_phone'; //col2
$tblid = 'special_id';
echo __mpcMemberAccountBal__($conn, $tbl, $uid, $ph, $tblCol1, $tblCol2, $tblid)[2]?>
    
</button>
                    </div>

                    <div class="table-responsive">
<table class="table table-bordered border-dark table-striped table-hover">
    <thead>
        <th>Date</th>
        <th>Debit</th>
        <th>Credit</th>
        <th>Balance</th>
    </thead>
    <tbody>
        <tr >
            <td>
                <input type="text" class="setStyle missingInput special dte1" attr="dte1" placeholder="Date">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special dbt1" dbt="dbt1" placeholder="Debit">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special crdt1" crt="crd1" placeholder="Credit">
            </td>

            <td>
                <!-- <input type="text" class="setStyle missingInput splance spc_bl1" bln="1" placeholder="Balance"> -->
                <button class="mpc-btn splance" bln="1">save</button>
            </td>
        </tr>

        <tr>
            <td>
                <input type="text" class="setStyle missingInput special dte2" attr="spdte2" placeholder="Date">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special dbt2" dbt="spdt2" placeholder="Debit">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special crdt2" crt="spcdt2" placeholder="Credit">
            </td>

            <td>
                <!-- <input type="text" class="setStyle missingInput splance spcbal2" bln="2" placeholder="Balance"> -->
                <button class="mpc-btn splance" bln="2">save</button>

            </td>
        </tr>

        <tr>
            <td>
                <input type="text" class="setStyle missingInput special dte3" attr="spdte3" placeholder="Date">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special dbt3" dbt="spdte3" placeholder="Debit">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special crdt3" crt="spcdte3" placeholder="Credit">
            </td>

            <td>
                <!-- <input type="text" class="setStyle missingInput splance spbal3" bln="3" placeholder="Balance"> -->
                <button class="mpc-btn splance" bln="3">save</button>

            </td>
        </tr>

        <tr>
            <td>
                <input type="text" class="setStyle missingInput special dte4" attr="dte4" placeholder="Date">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special dbt4" dbt="dbit4" placeholder="Debit">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special crdt4" crt="crdt4" placeholder="Credit">
            </td>

            <td>
                <!-- <input type="text" class="setStyle missingInput splance" bln="4" placeholder="Balance"> -->
                <button class="mpc-btn splance" bln="4">save</button>

            </td>
        </tr>

        <tr>
            <td>
                <input type="text" class="setStyle missingInput special dte5" attr="dte5" placeholder="Date">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special dbt5" dbt="dbt5" placeholder="Debit">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special crdt5" crt="crdt5" placeholder="Credit">
            </td>

            <td>
                <!-- <input type="text" class="setStyle missingInput splance bl1" bln="5" placeholder="Balance"> -->
                <button class="mpc-btn splance" bln="5">save</button>

            </td>
        </tr>

        <tr>
            <td>
                <input type="text" class="setStyle missingInput special dte6" attr="dte6" placeholder="Date">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special dbt6" dbt="dbt6" placeholder="Debit">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special crdt6" crt="crdt6" placeholder="Credit">
            </td>

            <td>
                <!-- <input type="text" class="setStyle missingInput splance bl1" bln="6" placeholder="Balance"> -->
                <button class="mpc-btn splance" bln="6">save</button>

            </td>
        </tr>

        <tr>
            <td>
                <input type="text" class="setStyle missingInput special dte7" attr="dte" placeholder="Date">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special dbt7" dbt="dbt7" placeholder="Debit">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special crdt7" crt="crdt7" placeholder="Credit">
            </td>

            <td>
                <!-- <input type="text" class="setStyle missingInput splance bl1" bln="7" placeholder="Balance"> -->
                <button class="mpc-btn splance" bln="7">save</button>

            </td>
        </tr>

        <tr>
            <td>
                <input type="text" class="setStyle missingInput special dte8" attr="dte8" placeholder="Date">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special dbt8" dbt="dbt8" placeholder="Debit">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special crdt8" crt="crdt8" placeholder="Credit">
            </td>

            <td>
                <!-- <input type="text" class="setStyle missingInput splance bl1" bln="8" placeholder="Balance"> -->
                <button class="mpc-btn splance" bln="8">save</button>

            </td>
        </tr>

        <tr>
            <td>
                <input type="text" class="setStyle missingInput special dte9" attr="dte" placeholder="Date">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special dbt9" dbt="dbt9" placeholder="Debit">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special crdt9" crt="crdt9" placeholder="Credit">
            </td>

            <td>
                <!-- <input type="text" class="setStyle missingInput splance  bl1" bln="9" placeholder="Balance"> -->
                <button class="mpc-btn splance" bln="9">save</button>

            </td>
        </tr>

        <tr>
            <td>
                <input type="text" class="setStyle missingInput special dte10" attr="dte10" placeholder="Date">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special dbt10" dbt="dbt10" placeholder="Debit">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special  crdt10" crt="crdt10" placeholder="Credit">
            </td>

            <td>
                <!-- <input type="text" class="setStyle missingInput splance  bl1" bln="10" placeholder="Balance"> -->
                <button class="mpc-btn splance" bln="10">save</button>

            </td>
        </tr>

        <tr>
            <td>
                <input type="text" class="setStyle missingInput special dte11" attr="dte11" placeholder="Date">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special dbt11" dbt="dbt11" placeholder="Debit">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special  crdt11" crt="crdt11" placeholder="Credit">
            </td>

            <td>
                <!-- <input type="text" class="setStyle missingInput splance  bl1" bln="11" placeholder="Balance"> -->
                <button class="mpc-btn splance" bln="11">save</button>

            </td>
        </tr>

        <tr>
            <td>
                <input type="text" class="setStyle missingInput special dte12" attr="dte" placeholder="Date">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special dbt12" dbt="dbt12" placeholder="Debit">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special  crdt12" crt="crdt12" placeholder="Credit">
            </td>

            <td>
                <!-- <input type="text" class="setStyle missingInput splance  bl1" bln="12" placeholder="Balance"> -->

                <button class="mpc-btn splance" bln="12">save</button>
            </td>
        </tr>

        <tr>
            <td>
                <input type="text" class="setStyle missingInput special dte13" attr="dte13" placeholder="Date">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special dbt13" dbt="dbt13" placeholder="Debit">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special  crdt13" crt="crdt13" placeholder="Credit">
            </td>

            <td>
                <!-- <input type="text" class="setStyle missingInput splance  bl1" bln="13" placeholder="Balance"> -->
                <button class="mpc-btn splance" bln="13">save</button>

            </td>
        </tr>

        <tr>
            <td>
                <input type="text" class="setStyle missingInput special dte14" attr="dte14" placeholder="Date">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special dbt14" dbt="dbt14" placeholder="Debit">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special  crdt14" crt="crdt14" placeholder="Credit">
            </td>

            <td>
                <!-- <input type="text" class="setStyle missingInput splance  bl1" bln="14" placeholder="Balance"> -->
                <button class="mpc-btn splance" bln="14">save</button>

            </td>
        </tr>

        <tr>
            <td>
                <input type="text" class="setStyle missingInput special dte15" attr="dte15" placeholder="Date">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special dbt15" dbt="dbt15" placeholder="Debit">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special  crdt15" crt="crdt15" placeholder="Credit">
            </td>

            <td>
                <!-- <input type="text" class="setStyle missingInput splance  bl1" bln="15" placeholder="Balance"> -->
                <button class="mpc-btn splance" bln="15">save</button>

            </td>
        </tr>

        <tr>
            <td>
                <input type="text" class="setStyle missingInput special dte16" attr="dte16" placeholder="Date">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special dbt16" dbt="dbt16" placeholder="Debit">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special crdt16" crt="crdt16" placeholder="Credit">
            </td>

            <td>
                <!-- <input type="text" class="setStyle missingInput splance  bl1" bln="16" placeholder="Balance"> -->
                <button class="mpc-btn splance" bln="16">save</button>

            </td>
        </tr>

        <tr>
            <td>
                <input type="text" class="setStyle missingInput special dte17" attr="dte" placeholder="Date">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special dbt17" dbt="crdt17" placeholder="Debit">
            </td>

            <td>
                <input type="text" class="setStyle missingInput special  crdt17" crt="crdt17" placeholder="Credit">
            </td>

            <td>
                <!-- <input type="text" class="setStyle missingInput splance  bl1" bln="17" placeholder="Balance"> -->
                <button class="mpc-btn splance" bln="17">save</button>

            </td>
        </tr>
    </tbody>
</table>
                    </div>
                </div>
            </div>

<script type="text/javascript">
    __system_missingData_saving(); //special savings
    __system_missingDataShares_saving(); //shares saving
    __system_missingDataThrift_saving(); //thrift savings

    let close = document.querySelector('.close');
        close.onclick = function(){
            window.location.replace(__mpc_uri__() + 'user/dashboard.php/?action=Settings&r=missingData&rtn=settings');

        }
</script>
        </main>
    </div>
</div>

<style>
.mainEle{
    width: 100%;
    height: auto;
    background: #fff;
}
.mpc-adm-info{
    z-index: -10;
}

.missingInput{
    width: 100%;
    border: none;
    outline: none;
    padding-left: 5px;
}
.appName{
    width: 100%;
    height: 50px;
    z-index: 100;
    display: flex;
    align-items: center;
    justify-content: space-evenly;
    position: sticky;
}

._mpc-item__wrap{
    display: flex;
    gap: 10px;
    width: 100%;
    height: auto;
}

._mpc-item__wrap .items{
    width: calc(100% / 3);
    height: auto;
/*    border: 2px solid red;*/
}
.missingData{
    width: 90%;
    height: 100%;
    overflow: hidden;
    overflow-y: auto;

}
.__eltop{
    margin-top: 30px;
    display: flex;
    align-items: center;
    justify-content: space-evenly;
    background: gray;
    cursor: pointer;
}
.close{
    width: 25px;
    height: 25px;
    background: rgba(0, 0, 0, .4);
    display: inline-block;
    color: #ff0000;
    z-index: 100;
}

.mpc-btn{
    transition: 0.5s linear;
}
</style>
<?php
}
?>


<script>
    let xmpsch = document.querySelector('.sjjmemb');
    let Rdata = document.querySelector('.uyoetibass');

    xmpsch.oninput = function(){
        // let val = this.value;
        if(this.value === ''){
            Rdata.innerHTML =   `<h4 class="m-2">Search: Phone, Name, Department, staff ID and Date of Retirement</h4>`;
            return;
        }
        let xhr = new XMLHttpRequest();
            xhr.open('POST', __mpc_uri__() + 'functions/mpc-ajax-action.php', true);
            xhr.onreadystatechange = function(){
                if(this.readyState == 4 && this.status === 200){
                    Rdata.innerHTML = this.response;
                }
            }
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.send('Xmlsdata=' + this.value);
    }
</script>
<?php
        }else if($_GET['action'] === 'addLoanTransaction'){
?>
<!-- <script type="module" src=""></script> -->

<i class="mpc-admMsg">Add Loan Transaction</i><br><br>
<hr class="mpcHr">
<style>
.__usrKXC__{
    border:none;
    outline:none;
    padding:10px
}

/* .addwrapper{
    border:2px dashed yellow;
    
} */

    .iyakise-2025{
        max-width: 100% !important;
        width: 100%;
        height: 100vh;
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter:blur(8px);

    }

    ._wrp_wk{
        display:flex;
        flex-direction:column;
        height:100%;
        width: auto;
        /* height:auto; */
        align-items:center;
        justify-content:center;
    }

 @media (max-width:768px){
    .addwrapper.w-50{
        width: 100% !important;
    }
 }
</style>
<div class="mpc-group-loan-container">
    <div class="mpc-group-loanInput">
        <!-- <div class="mpc-rtn-item1 sec13">Loan amount: &#8358; <span class="sec1">0</span></div>
        <div class="mpc-rtn-item1 sec23">Company interest (monthly): &#8358; <span class="sec2">0</span></div>
        <div class="mpc-rtn-item1 sec33">Monthly repayment: &#8358; <span class="sec3">0</span></div>
        <div class="mpc-rtn-item1 sec43">Total: &#8358; <span class="sec4">0</span></div> -->
        
        <!--input type="text" class="createLoanInput setStyle" placeholder="GROUP NAME">

        <select class="adm-select LoanType ">
            <option value="">-----</option>
            <?php //  __mpc_get_IntrestRate__($conn, 'options');?>
        </select>

        <input type="text" class="createLoanInput setStyle" placeholder="LOAN AMOUNT"-->
    </div>
    <div class="mpc-grouploan-controllersss">
        <!-- <div class="mpc-sideSmall">
            <div class="mpc-group-Seletor">
                
               <select class="adm-select LoanType avail-groupGet mpcFullWidth mpc-certain-viewport mpc-disabled" title="Group available">
                            <option value="">----</option>
                            <?php
                            
                                $id = $_SESSION['MPC_ADMIN_LOGIN_ID_AS'];
                                $fn = $_SESSION['MPC_ADMIN_LOGIN_FN_AS'];
                                $ln = $_SESSION['MPC_ADMIN_LOGIN_LN_AS'];
                                $usrname = $_SESSION['MPC_ADMIN_LOGIN_USR_AS'];
                                $prev = $_SESSION['MPC_ADMIN_LOGIN_PRV_AS'];
                                $sq = $_SESSION['MPC_ADMIN_LOGIN_SQ_AS'];
                                $branch = $_SESSION['MPC_ADMIN_LOGIN_BRANCH_AS'];
                                $tbl = "mpc_available_group";
                                $howToReturn = 'options';
                                $whattoselect = ['group_id', 'group_name', 'group_branch'];
                              

                                __mpcAll_availableGroup__($conn, $prev, $branch, $whattoselect, $tbl, $howToReturn, '', '');
                                
                        ?>
                </select>
            </div>
        </div> -->

        <div class="mpc-bigSide">
                <div class="inpt-wrap" style="width:100% !important;">
                    <input type="search" class="mpc-input setStyle createLoanInputs mpcs-searchMonth __usrKXC__" placeholder="Enter search name">
                </div>
                <div class="spacer"></div>

                <div class="addwrapper w-50">
                    <div class="table-responsive">
                        <table class="table table-border table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>Action</th>
                                    <!-- <th>Name</th>
                                    <th>Name</th>
                                    <th>Name</th> -->
                                    
                                </tr>
                            </thead>
                            <tbody class="__etukebasa__"></tbody>
                        </table>
                    </div>
                </div>
        <!-- <input type="number" disabled value="5" class="setStyle createLoanInput gmonth mpc-disabled" title="ENTER LOAN DURATION" placeholder="Month">
        <input type="number" disabled value="4" class="setStyle createLoanInput glrate mpc-disabled" title="ENTER INTEREST RATE" placeholder="Rate">
            <select class="adm-select LoanType glrate" title="Select rate">
            <option value="">-----</option>
                <?php //__mpc_get_IntrestRate__($conn, 'options');?>
            </select
            <div class="mpc-mpc-group table-responsive"></div> -->
        </div>
    </div>
    
    <script type="module">

            import { getMembers, newPopup, getLoanTransaction, fetchDataPost, showToast, adminSearch, normalPopup } from "../../script/api.js";
            const memTbl = document.querySelector('.__etukebasa__');
            let tr, bdy, style;

            const members = await getMembers(__mpc_uri__());
        try{
                if(members.data.length === 0){
                    memTbl.innerHTML = `
                        <tr>
                            <td>No single members found, if you think it an error contact developer</td>
                        </tr>
                    `;
                 //   return;
                }else{

                members.data.forEach((mem, i) => {
                    tr = document.createElement('tr');
                    tr.className = 'iyakise';
                    tr.innerHTML = `
                        <td>${(i + 1)}</td>
                        <td>${mem.name}</td>
                        <td>${mem.lga}</td>
                        <td>
                            <button data-tk="${mem.registration_number}" class="mpc-btn btn btn-warning _jkksj_" data-action-phone="${mem.phone}" data-action-name="${mem.name}" data-action-iyakise="${mem.members_id}">Add loan</button>
                        </td>
                    `;
                    memTbl.appendChild(tr);
                })
            }

            //search for members start here
            let searchMember = document.querySelector('.__usrKXC__');
                searchMember.addEventListener('input', async function(){
                    if(this.value === '') return showToast('Enter valid search keyword');

                    const searchResult = await adminSearch(__mpc_uri__(), this.value);

                    if(searchResult.data.length === 0){
                            memTbl.innerHTML = `
                                <tr>
                                    <td colspan="4">No single members found, if you think it an error contact developer</td>
                                </tr>
                            `;
                        //   return;
                        }else{
                            memTbl.innerHTML = '';
                        searchResult.data.forEach((mem, i) => {
                            tr = document.createElement('tr');
                            tr.className = 'iyakise';
                            tr.innerHTML = `
                                <td>${(i + 1)}</td>
                                <td>${mem.name}</td>
                                <td>${mem.lga}</td>
                                <td>
                                    <button data-tk="${mem.registration_number}" class="mpc-btn btn btn-warning _jkksj_" data-action-phone="${mem.phone}" data-action-name="${mem.name}" data-action-iyakise="${mem.members_id}">Add loan</button>
                                </td>
                            `;
                            memTbl.appendChild(tr);
                        })
                        normalPopup();
                    }


                });


            // starterd
                        //memb btn
            const btn = document.querySelectorAll('._jkksj_');
                  btn.forEach((member, i) => {
                    member.addEventListener('click', () => {
                        style = {
                                    width:'80vw',
                                    height:'70vh',
                                    background:'#fff',
                                    padding: '15px 20px',
                                    justifySelf: 'center',
                                    alignSelf: 'center',
                                    overflowY:'auto'
                                };
                        

                        newPopup(document.body, style, async function(){
                            let memberSecret = await getLoanTransaction(__mpc_uri__(), member.getAttribute('data-action-iyakise'), member.getAttribute('data-action-phone')); 
                           let dwrap = document.querySelector('.popContentWrap');
                               dwrap.innerHTML = `
                                    <h2 class="sticky-top bg-white p-2">${member.getAttribute('data-action-name')} Loan transaction information</h2>
                                    <hr class="mpcHr">

                                <!---------->
                                    <div class="currentSection sectionData loan-balance">
                                        <div class="balance-card debit-card">
                                            <div class="label">Total Debit</div>
                                            <div class="value debitAll">₦${memberSecret.data.total_debit}</div>
                                        </div>

                                        <div class="balance-card credit-card">
                                            <div class="label">Total Credit</div>
                                            <div class="value creditAll">₦${memberSecret.data.total_credit}</div>
                                        </div>

                                        <div class="balance-card balance-card-total">
                                            <div class="label">Current Balance</div>
                                            <div class="value balanceAll">₦${memberSecret.data.current_balance}</div>
                                        </div>

                                        <div class="balance-card date-card">
                                            <div class="label">Last Transaction</div>
                                            <div class="value lastDate">${memberSecret.data.last_transaction}</div>
                                        </div>
                                    </div>


                                    <!-- Transaction Input Wrapper -->
                                    <section class="transaction-form-section">
                                        <div class="transaction-form-card">
                                            <h2 class="form-title">🧾 Record Member Transaction</h2>

                                            <form class="transaction-form dumpDatayes saveFormData" id="mpc-transaction-form">
                                            <!-- Row 1 -->
                                            <div class="form-group">
                                                <label for="member_id">Member ID</label>
                                                <input type="text" disabled value="${member.getAttribute('data-tk')}" id="member_id" name="member_id" placeholder="Enter Member ID" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="member_phone">Member Phone</label>
                                                <input type="tel" disabled value="${member.getAttribute('data-action-phone')}" id="member_phone" name="member_phone" placeholder="Enter Member Phone" required>
                                            </div>

                                            <!-- Row 2 -->
                                            <div class="form-group">
                                                <label for="debit">Debit (₦)</label>
                                                <input type="number" step="0.01" id="debit" name="debit" placeholder="0.00">
                                            </div>

                                            <div class="form-group">
                                                <label for="credit">Credit (₦)</label>
                                                <input type="number" step="0.01" id="credit" name="credit" placeholder="0.00">
                                            </div>

                                            <!-- Row 3 -->
                                            <div class="form-group full">
                                                <label for="balance">Balance (₦)</label>
                                                <input type="number" step="0.01" id="balance" name="balance" placeholder="0.00">
                                            </div>

                                            <!-- Row 4 -->
                                            <div class="form-group full">
                                                <label for="created_at">Transaction Date</label>
                                                <input type="date" id="created_at" name="created_at" required>
                                            </div>

                                            <!-- Submit Button -->
                                            <div class="form-btn-wrap" style="flex-direction:column;">
                                                <button type="submit" class="btn-save dumpDatayes clearout" member-phone="${memberSecret.data.member_phone}" member-uid="${memberSecret.data.member_id}">
                                                <i class="fas fa-save"></i> Save Transaction
                                                </button>
                                                <strong class="fail error errstatus"></strong>
                                            </div>
                                            </form>
                                        </div>
                                    </section>

                                <!---------->

<style>
.loan-balance {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 1rem;
  padding: 1.5rem;
  background: #f9fafb;
  border-radius: 1rem;
}

.loan-balance .balance-card {
  background: #fff;
  border-radius: 1rem;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
  padding: 1.2rem 1rem;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  transition: transform 0.25s ease, box-shadow 0.25s ease;
  border-top: 4px solid var(--card-color, #007bff);
}

.loan-balance .balance-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 6px 15px rgba(0, 0, 0, 0.12);
}

.loan-balance .balance-card .label {
  font-size: 0.95rem;
  font-weight: 600;
  color: #555;
}

.loan-balance .balance-card .value {
  font-size: 1.5rem;
  font-weight: 700;
  margin-top: 0.5rem;
}

.loan-balance .debit-card {
  --card-color: #e63946;
}

.loan-balance .credit-card {
  --card-color: #06d6a0;
}

.loan-balance .balance-card-total {
  --card-color: #457b9d;
}

.loan-balance .date-card {
  --card-color: #f4a261;
}

@media (max-width: 480px) {
  .loan-balance {
    grid-template-columns: 1fr 1fr;
    gap: 0.8rem;
  }

  .loan-balance .balance-card .value {
    font-size: 1.2rem;
  }
}


.transaction-form-section {
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 2rem 1rem;
}

.transaction-form-card {
  background: #fff;
  border-radius: 16px;
  box-shadow: 0 4px 20px rgba(0,0,0,0.08);
  padding: 2rem;
  width: 100%;
  max-width: 650px;
}

.form-title {
  font-size: 1.5rem;
  font-weight: 600;
  color: #333;
  text-align: center;
  margin-bottom: 1.5rem;
}

.transaction-form {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 1.2rem;
}

.form-group {
  display: flex;
  flex-direction: column;
}

.form-group.full {
  grid-column: 1 / -1;
}

.form-group label {
  font-size: 0.95rem;
  font-weight: 500;
  color: #555;
  margin-bottom: 6px;
}

.form-group input {
  padding: 10px 14px;
  border: 1px solid #ddd;
  border-radius: 8px;
  font-size: 1rem;
  transition: all 0.2s ease;
}

.form-group input:focus {
  border-color: #007bff;
  outline: none;
  box-shadow: 0 0 0 3px rgba(0,123,255,0.1);
}

.form-btn-wrap {
  grid-column: 1 / -1;
  display: flex;
  justify-content: center;
  margin-top: 1rem;
}

.btn-save {
  background: linear-gradient(135deg, #007bff, #0056d2);
  color: #fff;
  border: none;
  padding: 12px 28px;
  border-radius: 10px;
  font-size: 1rem;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.25s ease;
  display: flex;
  align-items: center;
  gap: 8px;
}

.btn-save:hover {
  background: linear-gradient(135deg, #0069d9, #004bb5);
  transform: translateY(-2px);
}

@media (max-width: 480px) {
  .transaction-form-card {
    padding: 1.2rem;
  }
  .form-title {
    font-size: 1.2rem;
  }
}


</style>

`;
    ///save data request
    let saveBtn = document.querySelector('.saveFormData');
        saveBtn.addEventListener('submit', async function(event){
            event.preventDefault();

            const debit = document.querySelector('#debit')?.value ?? null;
            const credit = document.querySelector('#credit')?.value ?? null;
            const balance = document.querySelector('#balance')?.value ?? null;
            const createdAt = document.querySelector('#created_at')?.value ?? null;
            const errorStatus = document.querySelector('.errstatus');
            const actionBtn   = document.querySelector('.clearout');

            //current balance data
            var debitAll    =  document.querySelector('.debitAll');
            var creditAll   =  document.querySelector('.creditAll');
            var balanceAll  =  document.querySelector('.balanceAll');
            var LastBalance  =  document.querySelector('.lastDate');

  
            if(debit < 0 && credit < 0 && balance < 0){
                errrorStatus.innerHTML = 'Enter correct values';
                errorStatus.classList.add('text-danger');
                setTimeout(() => {
                    errorStatus.innerHTML = '';
                    errorStatus.classList.remove('text-danger');
                }, 3000);
            }

            if(balance <= 0){
                    showToast('Enter valid amount please');
                    return;
            }

            const record = {
                    member_id: actionBtn.getAttribute('member-uid'),
                    member_phone: actionBtn.getAttribute('member-phone'),
                    debit: debit,
                    credit: credit,
                    balance: balance,
                    date: createdAt
                };
            const SaveRequest = await fetchDataPost(__mpc_uri__(), 'addLoanTransaction', record);
                // console.log(SaveRequest);
                if(SaveRequest.status === 'success'){
                    //update balance to new
                        debitAll.innerHTML = `₦${SaveRequest.data.debit}`;
                        creditAll.innerHTML = `₦${SaveRequest.data.credit}`;
                        balanceAll.innerHTML = `₦${SaveRequest.data.balance}`;
                        LastBalance.innerHTML = `${SaveRequest.data.date}`;

                     errorStatus.innerHTML = SaveRequest.message;
                     errorStatus.classList.add('text-success');

                    showToast(SaveRequest.message);
                    saveBtn.reset();
                    setTimeout(() => {
                        errorStatus.innerHTML = '';
                        errorStatus.classList.remove('text-danger');
                    }, 3000);
                    return;
                }

                 errorStatus.innerHTML = SaveRequest.message || 'Unexpected error occur.';
                errorStatus.classList.add('text-error');
                
        })
                        });
                    });
                  })






        }catch(error){
            showToast(error + ' Some module fail to load, contact developer' || 'Unexpected error')
        }



    

        window.normalPopup = normalPopup;
    // console.log(await getLoanTransaction(__mpc_uri__(), 2, '09069053009'));
    // console.log(await getMembers(__mpc_uri__()))
        // var listMembers, xhr, rtn;
        //     listMembers = document.querySelector('.avail-groupGet');
        //     listMembers.onchange = function(){
        //         rtn = document.querySelector('.mpc-mpc-group');
        //         __mpcShowAnimation__();

        //         xhr = new XMLHttpRequest();
        //         xhr.open('GET', __mpc_uri__() + 'functions/mpc-ajax-action.php?PERM=CHECKGROUPMEMBER&mpcs='+ this.value, true);
        //         xhr.onreadystatechange = function(){
        //             if(this.readyState == 4 && this.status == 200){
        //                 //if(this.response == 'LOADED'){

        //                // }
        //                __mpcAnimaitonOff__();
        //                rtn.innerHTML = this.response;

        //                __mpc_calCulateInterest__();//calculate loan interest
        //                __mpcCreatGroupLoan();//group create function

        //             }
        //         }
        //         xhr.send();
        //     }

    //BELOW I AM TRYING TO REMOVE RED BORDER FROM LOAN RUNNING
    //MONTH IF ANY
    // var loanMonthgoup = document.querySelector('.gmonth');
    //     loanMonthgoup.addEventListener('blur', function(){
            

    //         if(this.value !== ''){
    //             this.style.border = 'none';
    //             this.disabled = true;
    //         }
    //     })
    
        /*
        var loanIntRateGroup = document.querySelector('.glrate');
            loanIntRateGroup.addEventListener('blur', function(){
                this.style.border = 'none';
                this.disabled = true;

               // alert('manful computer')
            })
            */
/**CREATING GROUP LOAN FOR MEMBERS START HERE
 * goup loan
 * 
 */
    
    //mpc-disabled if you are not secretary
// let previ = <?php echo $prev?>;
// let staffId = <?php echo $id?>;

// if(previ !== 2){
// __mpc_disabled__('mpc-disabled', 'ADMIN'); ///disabled all the input here
// }
</script>
</div>

<?php
                                    }else{
                                        if($_GET['action'] === 'AssignGroupMember'){
                    $grpId = $_GET['grpId'];
?>
<i class="mpc-admMsg">Assigned Member to group</i><br><br>
<hr class="mpcHr">

<h5><?php echo $fn .' ' .$ln?>, currently this group <span class="HighLight">" <?php echo __mpc_group_Info($conn, $grpId)[1]?>"</span> has <?php echo __groupMemberCount__($conn, $grpId)?> member(s)</h5>
<hr class="mpcHr">

<div class="table-responsive">
    <table class="table table-bordered border-dark table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Profile</th>
                <th>Action</th>
            </tr>
        </thead>

        <?php 
    /**GOODLIFE MEMBER WITHOUT GROUP WILL APPEAR HERE
     * 
     */
    __get__mpcMemberWithoutGroup__($conn, $grpId);
?>
    
    </table>

    <script>
        var assignButt, xhr, groupId, memberid, memPhone, rtn, ddata;
            assignButt = document.querySelectorAll('.mpc-assigned-member-group'); //assigned butt
            
            for (let i = 0; i < assignButt.length; i++) {

                assignButt[i].addEventListener('click', function(){
                    rtn = document.querySelector('.mpc-admin-ds-notify');
                        
                        memberid = this.getAttribute('member-id');
                        groupId = this.getAttribute('mpc-group-id');
                        memPhone = this.getAttribute('mpc-mem-phone');
                        this.disabled = true; //disabled button to prevent double clicking
                        
                        ddata = "PERM=aDDMEMbeRtOMPCGROUP&groupId="+groupId + '&memberId='+memberid + '&membPhone=' +memPhone;

                        xhr = new XMLHttpRequest();
                        xhr.open('POST', __mpc_uri__()+ 'functions/mpc-ajax-action.php', true);
                        
                        xhr.onreadystatechange = function(){
                            if(this.readyState == 4 && this.status == 200){
                                if(this.response == 'mpc-ADDED'){
                                    rtn.innerHTML = "Member add to group successful";

                                    setTimeout(function(){
                                        window.location.reload();
                                    }, 3000)
                                }else {
                                    rtn.innerHTML = this.response;
                                    console.log(this.response);
                                }
                            }
                        }
                        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                        xhr.send(ddata);
                       
                    })
                
            }
    </script>
</div>
<?php
    }else if($_GET['action'] === 'Settings' && $_GET['r'] === 'ContactUs'){
?>
    <i class="mpc-admMsg">Contact us</i><br><br>
    <hr class="mpcHr">
    <h5><?php echo $fn . ' '. $ln?>, This page will allowed you to add contact us information to <?php print getSystemName($conn)[1]?> website!</h5>

    <div class="mpc-adm-contact-us">
        <div class="mpc-adm-contact-usInput">
            <input type="checkbox" class="mpc-checkbox allowed-form" title="TOGGLE ON/OFF CONTACT US FORM" <?php echo __mpc_contact_usStatus__($conn)?>>
        </div>

        <div class="mpc-contact-editor">
            <form action="<?php echo __mpc_root__()?>user/dashboard.php/?action=Settings&r=ContactUs&rtn=settings" method="post">
                <textarea name="mpcContactTxt" placeholder="<?php print getSystemName($conn)[0]?> EDITOR" id="contus" cols="30" rows="10"><?php echo _mpc_returnContactUs_forEdit__($conn, 1)[2]?></textarea>

                <button type="submit" name="mpc-contact-usButton" class="mpc-btn  mpc-btn-middiumWidth" style="margin-top:15px">Saved</button>
            </form>
            
        </div>
    </div>
<?php 
if(isset($_POST['mpc-contact-usButton'])){
    /**CONTACT US INPUT RECEIVED HERE
     * THIS FUNCTION RESPONSIBLE FOR SENDING
     * CONTACT US INFORMATION TO PHP BEFORE
     * SAVING
     */
     $contactUs = $_POST['mpcContactTxt'];


     __save_mpc_ContAbout__($conn, 1, $contactUs, 'Contact us'); //COLLECTING CONTACT US INFORMATION HERE
?>
<script>

</script>
<?php
}

?>

    <script>
        var link, whatto, item2, script, script1;

        script = document.createElement('SCRIPT');
        script1 = document.createElement('SCRIPT');
        script.src = __mpc_uri__() + 'script/jquery.min.js';
        script1.src = __mpc_uri__() + 'asset/tinymce.min.js';

       /// document.head.appendChild(script);
        //document.head.appendChild(script1);


        //load tiny editor module here
        tinymce.init({
          selector: '#contus'
        });
        
        

        var inputBox, choice;
            inputBox = document.querySelector('.allowed-form');
            inputBox.addEventListener('click', function(){
                if(this.checked === true){
                    choice = 'ON';
                }else {
                    choice = 'OFF';
                }

                let xhr, rtn, Senddata;
                rtn = document.querySelector('.mpc-admin-ds-notify');
                xhr = new XMLHttpRequest();
                xhr.open('GET', __mpc_uri__() + 'functions/mpc-ajax-action.php?PERM=TOGGLEb&Xquery='+choice, true);
                xhr.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        //if(this.response == 'OKay'){
                            rtn.innerHTML = this.response;
                       // }else {
                        //    rtn.innerHTML = this.response;
                        //}
                    }
                }
                xhr.send();
            })
    </script>
<?php
            }else if($_GET['action'] === 'Bugsfixed' && $_GET['r'] === 'fbugs'){
?>
    <i class="mpc-admMsg">Fix Errors</i><br><br>
    <hr class="mpcHr">
<style type="text/css">
    
    *{

        transition: 0.5s linear;
    }
    .searchKeyInvokers{
        width: 40%;
        outline: none;
        border: none;
    }

    .xuffx3333{
        width: 100%;
/*        border: 2px solid blue;*/
        height: auto;
    }

    .dta0wrapperLoaduer{
        width: 50%;
        height: 500px;
        margin: auto;
/*        border: 2px dashed teal;*/
    }
    .spacer{
        height: 30px;
    }

    ._nme_,
    .load-fff32{
        width: 50%;
/*        border: 2px solid red;*/
    }
    .pfile,
    .load-fstats{
        width: 20%;
/*        border: 2px solid teal;*/
    }
    ._action,
    .load-fxbtn{
        width: 30%;
/*        border: 2px solid teal;*/
    }

    .load-23232{
        height: 60px;
        width: 100%;
        border-bottom: 1.3px solid gainsboro;
    }

    .flx{
        display: flex;
        align-items: center;
        justify-content: start;
    }

    .upfiled{
        width: 40px;
        height: 40px;
    }

    @media only screen and (max-width:700px){
        .dta0wrapperLoaduer{width: 100%}
        .searchKeyInvokers{width: 70%}
    }

    @media only screen and (max-width:500px){
        .searchKeyInvokers{width: 100%}
    }
</style>

        <div class="data-wrapper">
            
            <div class="container">
                <h5>Affected members are listed here.</h5>

                <div class="searchWinpuWrapper">
                    
                    <input type="text" placeholder="Search member by Name, Phone StaffID" class="setStyle no-border searchKeyInvokers p-2">
                </div>
                <div class="spacer"></div>
                <div class="xuffx3333">
                    
                    <div class="dta0wrapperLoaduer">
                        <div class="_topNameSpecifier d-flex ">
                            <div class="_nme_">
                                <h5>Name</h5>
                            </div>
                            <div class="pfile">
                                <h5>Profile</h5>
                            </div>
                            <div class="_action">
                                <h5>Action</h5>
                            </div>
                        </div>

                        <div class="__eltonUsr-433rr">

                            <?php echo memberWithErr($conn)?>
                        </div>
                        

                    </div>

                </div>

            </div>
        </div>
<script>loopErrorFix()</script>
<?php

            }else if($_GET['action'] === 'Settings' && $_GET['r'] === 'AboutUs'){
?>
    <i class="mpc-admMsg">About us</i><br><br>
    <hr class="mpcHr">

    <h5><?php echo $fn . ' '. $ln?>, This page will allowed you to add about us information to <?php print getSystemName($conn)[1]?> website!</h5>
    <p>Editor below will allowed you to write, style, position text anyway on the page</p>

    <div class="mpc-adm-contact-us">
        <!--div class="mpc-adm-contact-usInput">
            <input type="checkbox" class="mpc-checkbox allowed-form" title="TOGGLE ON/OFF CONTACT US FORM" <?php //echo __mpc_contact_usStatus__($conn)?>>
        </div-->

        <div class="mpc-contact-editor">
            <form action="<?php echo __mpc_root__()?>user/dashboard.php/?action=Settings&r=AboutUs&rtn=settings" method="post">
                <textarea name="mpcAboutTxt" placeholder="GOODLIFE MPCS EDITOR" id="contus" cols="30" rows="10"><?php echo _mpc_returnContactUs_forEdit__($conn, 3)[2]?></textarea>

                <button type="submit" name="mpc-about-usButton" class="mpc-btn  mpc-btn-middiumWidth" style="margin-top:15px">Saved</button>
            </form>
            
        </div>
    </div>
    <?php 
if(isset($_POST['mpc-about-usButton'])){
    /**CONTACT US INPUT RECEIVED HERE
     * THIS FUNCTION RESPONSIBLE FOR SENDING
     * CONTACT US INFORMATION TO PHP BEFORE
     * SAVING
     */
     $AboutUs = $_POST['mpcAboutTxt'];
    __save_mpc_ContAbout__($conn, 3, $AboutUs, 'About us'); //COLLECTING ABOUT US INFORMATION HERE
}
?>
    <script>
        //load tiny editor module here
        tinymce.init({
          selector: '#contus'
        });
    </script>
<?php
}else if($_GET['action'] === 'Settings' && $_GET['r'] === 'memberInfo'){
    ?>
    <i class="mpc-admMsg">Add members information</i><br><br>
    <hr class="mpcHr">
        <div class="mpc-input-wrap">
            <div class="mpc-member-others">
                <div class="set1-one mpc-partition">
                    <!--MPC SELECT IS USED TO GET MEMBER USING ADMIN PREFERED QUERY PARAM-->
                    <select class="adm-select queryfort createLoanInput">
                        <option value="">-----</option>
                        <option value="ACCOUNT">ACCOUNT NO.</option>
                        <option value="PHONE">PHONE NO.</option>
                        <option value="EMAIL">EMAIL</option>
                    </select>

                    <input type="text" class="setStyle createLoanInput memberInfoSearch" placeholder="Search" title="SEARCH QUERY">
                    
                </div>

                <div class="set1-one  queryReturnMpcs " title="SEARCH PARAMETER">
                    <?php __mpcMembers_withIncomplete__($conn)?>
                </div>
            </div>
<?php 
if(isset($_GET['showInput']) && $_GET['showInput'] === 'true' && !empty($_GET['showInput'])){
    //trying to create user declaration here
   // $declaration =  'I, ' .__mpcReturnByPhoneMember($conn, $_GET['k1'])[4] . ', Solemnly  swear that I will abide by the rules and regulations of GOOODLIFE UYP MULTI-PURPOSE COOPERATIVE SOCIETY, and that all the informations provided here is true and legal.';
    $branch = __mpcReturnByPhoneMember($conn, $_GET['k1'])[16];

    $memberPhone = $_GET['k1'];
    $memberId = $_GET['k2'];

    $nextOfKin = nextOfKin($conn, $memberPhone, $memberId)[2] . '/' .nextOfKin($conn, $memberPhone, $memberId)[3];
?>
<div class="mpc-memberUpdate">
    <div class="memberwrap-inner">
        <h6><?php echo __mpcReturnByPhoneMember($conn, $_GET['k1'])[4]?></h6>

        <img src="<?php echo __mpc_root__()?>asset/img/<?php echo __mpcReturnByPhoneMember($conn, $_GET['k1'])[18]?>" alt="profile" srcset="<?php echo __mpc_root__()?>asset/img/<?php echo __mpcReturnByPhoneMember($conn, $_GET['k1'])[18]?>" title="pics" class="dboard-img">
    </div>
</div>

            <div class="input-inner-wrapper">
<input type="text" title="TITLE" placeholder="Title" class="mpc-disabled setStyle mpc-memb-info mpc-memb-title" value="<?php echo __mpcReturnByPhoneMember($conn, $_GET['k1'])[1]?>">

<input type="text" value="<?php echo __mpcReturnByPhoneMember($conn, $_GET['k1'])[4]?>" title="Name" placeholder="Name" class="mpc-disabled setStyle mpc-memb-info mpc-memb-name">

<input type="text" value="<?php echo __mpcReturnByPhoneMember($conn, $_GET['k1'])[5]?>" title="Phone Number" placeholder="Member Phone" class="mpc-disabled setStyle mpc-memb-info mpc-memb-phone">

<input type="text" value="<?php echo __mpcReturnByPhoneMember($conn, $_GET['k1'])[2]?>" title="GENDER" placeholder="Gender" class="mpc-disabled setStyle mpc-memb-info mpc-memb-gender">

<input type="text" value="<?php echo __mpcReturnByPhoneMember($conn, $_GET['k1'])[3]?>" title="DATE OF BIRTH" placeholder="Date of birth" class="mpc-disabled setStyle mpc-memb-info mpc-memb-dob">

<input type="text" value="<?php echo __mpcReturnByPhoneMember($conn, $_GET['k1'])[19]?>" title="POOLING MDA" placeholder="POOLING MDA" class="mpc-disabled setStyle mpc-memb-info mpc-memb-pAdd">

<input type="text" value="<?php echo __mpcReturnByPhoneMember($conn, $_GET['k1'])[20]?>" title="PRESENT MDA/DEPARTMENT" placeholder="PRESENT MDA/DEPARTMENT" class="mpc-disabled setStyle mpc-memb-info mpc-memb-lga">

<input type="text" value="<?php echo __mpcReturnByPhoneMember($conn, $_GET['k1'])[7]?>" title="RANK/GRADLE LEVEL" placeholder="RANK/GRADLE LEVEL" class="mpc-disabled setStyle mpc-memb-info mpc-memb-pbirth">

<input type="text" value="<?php echo __mpcReturnByPhoneMember($conn, $_GET['k1'])[21]?>" title="DATE OF FIRST APPOINTMENT" placeholder="DATE OF FIRST APPOINTMENT" class="mpc-disabled setStyle mpc-memb-info mpc-memb-religion">

<input type="text" value="<?php echo __mpcReturnByPhoneMember($conn, $_GET['k1'])[8]?>" title="EMAIL" placeholder="Email" class="mpc-disabled setStyle mpc-memb-info mpc-memb-email">

<input type="text" value="<?php echo __mpcReturnByPhoneMember($conn, $_GET['k1'])[9]?>" title="DATE OF RETIREMENT" placeholder="DATE OF RETIREMENT" class="mpc-disabled setStyle mpc-memb-info mpc-memb-occup">

<input type="text" value="<?php echo __mpcReturnByPhoneMember($conn, $_GET['k1'])[22]?>" title="MARITAL STATUS" placeholder="MARITAL STATUS" class="mpc-disabled setStyle mpc-memb-info mpc-memb-buz">

<input type="text" value="<?php echo $nextOfKin?>" title="NEXT OF KIN/ RELATIONSHIP" placeholder="NEXT OF KIN/RELATIONSHIP" class="mpc-disabled setStyle mpc-memb-info mpc-memb-church">

<input type="text" value="<?php echo nextOfKin($conn, $memberPhone, $memberId)[4]?>" title="NEXT OF KIN ADDRESS" placeholder="NEXT OF KIN ADDRESS" class="mpc-disabled setStyle mpc-memb-info mpc-NextOfkinAdre">

                <!-- <input type="checkbox" value="<?php //echo __mpcReturnByPhoneMember($conn, $_GET['k1'])[0]?>" title="IS THIS PERSON MEMBER OF ANY OTHER COOPERATIVE?" placeholder="Any Other cooperative ?" class="mpc-disabled mpc-checkbox setStyle cooperative-yesNo"> -->
                <!-- <input type="text" value="" disabled title="COOPERATIVE NAME" placeholder="Cooperative name if any?" class="mpc-disabled setStyle mpc-memb-info thatDisabled mpc-memb-other-coopName"> -->
                <!-- <input type="text" value="<?php //echo $declaration?>" title="DECLARATION" placeholder="Declaration" class="mpc-disabled setStyle mpc-memb-info mpc-memb-declaration"> -->
                <input type="text" value="<?php echo __mpcReturnByPhoneMember($conn, $_GET['k1'])[10]?>" title="STAFF ID NO." placeholder="STAFF ID NO" class="mpc-disabled setStyle mpc-memb-info mpc-memb-account">
                <!--input type="text" value="<?php //echo __mpcReturnByPhoneMember($conn, $_GET['k1'])[0]?>" title="Branch" placeholder="Title" class="setStyle mpc-memb-info"-->
                
                <!-- <select class="mpc-disabled adm-select LoanType mpc-branches" title="AVAILALBE BRANCH">
                    <option value="">----</option>
                        <?php //print __mpc_branchesName($conn, 'mpc_branches', 'branch_name', 'branch_id');?>
                </select> -->

                <button class="mpc-disabled mpc-btn mpc-save-member-update mpc-btn-middiumWidth" style="margin-top:20px">Save Infomation</button>
        
        </div>

        <div class="dash-board-data">
                <div class="mpc-db-one dsh-board-light-mode shadow">
                    <div class="part1">
                        <span class="totalNum"><i class="fas fa-car-crash fa-2x"></i></span>    
                        <p><a href="<?php print __mpc_root__()?>user/dashboard.php/?action=Settings&r=memberInfo&k1=<?php echo $memberPhone?>&k2=<?php echo $memberId?>&showInput=true&rtn=settings&yakise=ShowNextofKin" class="Setting-link"> Next of kin</a></p>
                    </div>
                </div>

                <div class="mpc-db-one dsh-board-light-mode shadow">
                    <div class="part1">
                        <span class="totalNum"><i class="fas fa-gas-pump fa-2x"></i></span>    

                        <p><a href="<?php print __mpc_root__()?>user/dashboard.php/?action=Settings&r=memberInfo&k1=<?php echo $memberPhone?>&k2=<?php echo $memberId?>&showInput=true&rtn=settings&yakise=showMandateForm" class="Setting-link"> mandate form</a></p>
                    </div>
                </div>

                <div class="mpc-db-one dsh-board-light-mode shadow">
                    <div class="part1">
                        <span class="totalNum"><i class="fas fa-truck-pickup fa-2x"></i></span>
                        <p><a href="<?php print __mpc_root__()?>user/dashboard.php/?action=Settings&r=memberInfo&k1=<?php echo $memberPhone?>&k2=<?php echo $memberId?>&showInput=true&rtn=settings&yakise=DeclarationOfNominee" class="Setting-link">Declaration of Nominee</a></p>
                    </div>
                </div>
        </div>

        <h4 class="text-center"><b>DECLARATION:</b> <?php print __mpcReturnByPhoneMember($conn, $_GET['k1'])[24]?></h4>
<?php 
if(isset($_GET['yakise']) && $_GET['yakise'] !== '')
{
    if($_GET['yakise'] === 'ShowNextofKin')
    {
        $name = __mpcReturnByPhoneMember($conn, $_GET['k1'])[4];
        $systemName = getSystemName($conn)[0];
?>
    <div class="mpc-popup-anytime">
        <div class="mpc-popup-bg">
            <div class="close-mpc-popup" title="CLOSE MODAL BOX HERE">
                <i class="fas fa-xmark fa-3x"></i>
            </div>
            <span class="Upload-status"><?php print nextOfKin($conn, $_GET['k1'], $_GET['k2'])[2]?> is a "<?php print nextOfKin($conn, $_GET['k1'], $_GET['k2'])[3]?>" to <?php echo $name?> who is a member of <?php echo $systemName?></span>

            <div class="mpc-popup-inner">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <tr>
                            <td>Name:</td>
                            <td><?php print nextOfKin($conn, $_GET['k1'], $_GET['k2'])[2]?></td>
                        </tr>

                        <tr>
                            <td>Address:</td>
                            <td><?php print nextOfKin($conn, $_GET['k1'], $_GET['k2'])[4]?></td>
                        </tr>

                        <tr>
                            <td>Relationship:</td>
                            <td><?php print nextOfKin($conn, $_GET['k1'], $_GET['k2'])[3]?></td>
                        </tr>

                        <tr>
                            <td>Phone No:</td>
                            <td><?php print nextOfKin($conn, $_GET['k1'], $_GET['k2'])[5]?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php
    }
    else if($_GET['yakise'] === 'showMandateForm')
    {
$name = __mpcReturnByPhoneMember($conn, $_GET['k1'])[4];
    $department = __mpcReturnByPhoneMember($conn, $_GET['k1'])[20];

    $date = __getmemberMandate($conn, $_GET['k2'], $_GET['k1'])[3];
?>
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
                            <li>Shares: <span style="font-weight: 800;">&#8358;</span> <?php echo __getmemberMandate($conn, $_GET['k2'], $_GET['k1'])[0]?> </li>
                            <li>Thrift Savings: <span style="font-weight: 800;">&#8358;</span> <?php echo __getmemberMandate($conn, $_GET['k2'], $_GET['k1'])[1]?></li>
                            <li>Special Savings: <span style="font-weight: 800;">&#8358;</span> <?php echo __getmemberMandate($conn, $_GET['k2'], $_GET['k1'])[2]?></li>
                        </ol>

                        <div class="mandate-name">
                            <h4>Name: <?php echo $name?></h4>
                            <h4>Department: <?php echo $department?></h4>
                            <h4>Signature:..............................................</h4>
                            <h4>Date:......<?php echo __getmemberMandate($conn, $_GET['k2'], $_GET['k1'])[3]?> .......</h4>
                        </div>
                    <?php ?>
                    </div>
                </div>
                <button class="mpc-btn print-mpc-page" title="print <?php print getSystemName($conn)[0]?> MANDATE FORM"><i class="fas fa-print"></i></button>

            </div>

            <div class="mpc-popup-inner">
                <div class="table-responsive">
                    <input type="text" placeholder="Shares" class="sharesAccount setStyle createLoanInput">
                    <input type="text" placeholder="THRIFT Saving" class="ThriftSaving setStyle createLoanInput">
                    <input type="text" placeholder="Special Saving" class="SpecialSaving setStyle createLoanInput">

                    <button class="mpc-btn setDeductionRate">Deduction Rate</button>
                    <p class="__notice_msg"></p>
                </div>
            </div>
<script>
    let btnclick = document.querySelector('.setDeductionRate');
    let shares = document.querySelector('.sharesAccount');
    let thrift = document.querySelector('.ThriftSaving');
    let special = document.querySelector('.SpecialSaving');
    let noticeMsg = document.querySelector('.__notice_msg');
    let personId = "<?php echo $_GET['k2']?>";
    let personPhone = "<?php echo $_GET['k1']?>";

        btnclick.onclick = function(){

            if(shares.value === ''){
                noticeMsg.innerHTML = 'PLEASE ENTER DEBIT AMOUNT FOR SHARES';
                noticeMsg.classList.add('to-red-color');
                noticeMsg.classList.add('fa-fade');
                shares.style.border = '1px solid red';
                return;
            }

            if(thrift.value === ''){
                noticeMsg.innerHTML = 'PLEASE ENTER DEBIT AMOUNT FOR THRIFT';
                noticeMsg.classList.add('to-red-color');
                noticeMsg.classList.add('fa-fade');
                thrift.style.border = '1px solid red';
                return;
            }

            if(special.value === ''){
                noticeMsg.innerHTML = 'PLEASE ENTER DEBIT AMOUNT FOR SPECIAL SAVING';
                noticeMsg.classList.add('to-red-color');
                noticeMsg.classList.add('fa-fade');
                special.style.border = '1px solid red';
                return;
            }

            if(special.value.search(/[^0-9]/i) !== -1 || shares.value.search(/[^0-9]/i) !== -1 || thrift.value.search(/[^0-9]/i) !== -1){
                noticeMsg.innerHTML = 'INVALID CHARACTER DETECTED';
                noticeMsg.classList.add('to-red-color');
                noticeMsg.classList.add('fa-fade');

                return;
            }

            shares.style.border = 'none';
            thrift.style.border = 'none';
            special.style.border = 'none';

            noticeMsg.innerHTML = 'PLEASE WAIT... LOADING';

            let url = __mpc_uri__();
            let data = JSON.stringify({
                        'shares': shares.value,
                        'thrift': thrift.value,
                        'special': special.value,
                        'memberId': personId,
                        'memberPhone': personPhone,
                        'perm':'PleaseAllowUs'                  
                        });
            let xhr = new XMLHttpRequest();
                xhr.open('POST', url + 'functions/mpc-ajax-action.php', true);
                xhr.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        noticeMsg.innerHTML = 'OKAY, Returning response now';


                        if(this.response == 'Success'){
                            window.location.reload();

                        }else{
                            noticeMsg.innerHTML = this.response;
                        }

                    }
                }
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.send('requestSender='+data);
        }
</script>
        </div>
    </div>
<?php
    }
    else if($_GET['yakise'] === 'DeclarationOfNominee')
    {
?>
    <div class="mpc-popup-anytime">
        <div class="mpc-popup-bg">
            <div class="close-mpc-popup" title="CLOSE MODAL BOX HERE">
                <i class="fas fa-xmark fa-3x"></i>
            </div>
            <!-- <span class="Upload-status">Mandatory Form</span> -->
            <div class="mpc-prnter mpc-document-print">
                <h1 style="font-family: monospace;color:#999;text-decoration:underline;" class="text-center"><?php print getSystemName($conn)[1]?> DECLARATION OF NOMINEE</h1>

                <div class="mpc-justice-mandatory-fm">
                    <?php print mpcWitness($conn, $memberPhone, $memberId)[3]?>
                </div>

                <button class="mpc-btn print-mpc-page" title="print this DECLARATION NOMINEE"><i class="fas fa-print"></i></button>
            </div>


        </div>
    </div>
<?php
    }
echo "<style>". '.mpc-adm-info{z-index:-1}'."</style>";
}
?>
<script>


    //bewlow i will be checking for member branch
    //if has been assigned already to member
    //then the branch drop down box will be disabled
   var checkMemberBranch, BranchSelector;
    checkMemberBranch = "<?php echo $branch?>"; //getting branch here
    BranchSelector = document.querySelector('.mpc-branches'); //member branchSelector

    // if(checkMemberBranch !== 'pending'){
    //     BranchSelector.disabled = true;
    // }

    // let accountNumber = document.querySelector('.mpc-memb-account');
    //     if(accountNumber.value !== 'pending'){
    //         accountNumber.disabled = true;
    //     }

    
    // var yesNo = document.querySelector('.cooperative-yesNo');
    //     yesNo.addEventListener('click', function(){
    //     var disabledEnable = document.querySelector('.thatDisabled');
    //         if(this.checked){
    //             disabledEnable.disabled = false;
    //             disabledEnable.style.background = '#484848';
    //         }else{
    //             disabledEnable.value = '';
    //             disabledEnable.disabled = true;
    //             disabledEnable.style.background = 'rgb(61, 57, 57)';
    //             disabledEnable.innerHTML = '';
    //         }
    //     })

//member account information update start here
var memberUpateButton = document.querySelector('.mpc-save-member-update');
    memberUpateButton.addEventListener('click', function(){
        let memberTitle, memberGender, memberDob, memberPaddr, memberLga, 
            memberPbirth, memberReligion, memberEmail, memberOccupation, memberBuz, 
            memberChurch, memberCoop, memberDeclare, memberBranc, rtn, xhr, accountdigit, memberNphone, membername;
            rtn = document.querySelector('.mpc-admin-ds-notify');

            memberTitle = document.querySelector('.mpc-memb-title'); //member title
            memberGender = document.querySelector('.mpc-memb-gender'); //member memberGender
            memberDob = document.querySelector('.mpc-memb-dob'); //member dob
            memberPaddr = document.querySelector('.mpc-memb-pAdd'); //member permanent addr
            memberLga = document.querySelector('.mpc-memb-lga'); //member lga
            memberPbirth = document.querySelector('.mpc-memb-pbirth'); //member place of birth
            memberReligion = document.querySelector('.mpc-memb-religion'); //member religion
            memberEmail = document.querySelector('.mpc-memb-email'); //member email
            memberOccupation = document.querySelector('.mpc-memb-occup'); //member occupation
            memberBuz = document.querySelector('.mpc-memb-buz'); //member buz
            membername = document.querySelector('.mpc-memb-name'); //member name update
            memberNphone = document.querySelector('.mpc-memb-phone'); //member phone


            memberChurch = document.querySelector('.mpc-memb-church'); //member NOW HOLD NEXT OF KIN

            memberNextOfKinAddre = document.querySelector('.mpc-NextOfkinAdre'); //member memberGender  mpc-NextOfkinAdre
            // memberCoop = document.querySelector('.mpc-memb-other-coopName'); //member any other cooperative name
            // memberDeclare = document.querySelector('.mpc-memb-declaration'); //member declaration
            // memberBranc = document.querySelector('.mpc-branches'); //member declaration
             accountdigit = document.querySelector('.mpc-memb-account');
        //alert(memberChurch.value);
         //   return;

         if(memberChurch.value.search(/[/]/) == -1){
            rtn.innerHTML = 'PLEASE USE "/" TO SEPARATE NEXT OF KIN WITH RELATIONSHIP!';
            rtn.classList.add('to-red-color');
            rtn.classList.add('fa-fade');

            return;
         }


        if(memberTitle.value === '' ){
            rtn.innerHTML = 'Enter member prefered Title';
            rtn.classList.add('fa-fade');
            rtn.classList.add('to-red-color');

        }else if(memberGender.value === ''){
            rtn.innerHTML = 'Enter member gender';
            rtn.classList.add('fa-fade');
            rtn.classList.add('to-red-color');
        }else if(memberDob.value === ''){
            rtn.innerHTML = 'Enter member date of birth';
            rtn.classList.add('fa-fade');
            rtn.classList.add('to-red-color');
        }else if(memberPaddr.value === ''){
            rtn.innerHTML = 'Enter member pooling MDA';
            rtn.classList.add('fa-fade');
            rtn.classList.add('to-red-color');
        }else if(memberLga.value === ''){
            rtn.innerHTML = 'Enter member Present MDA/DEPARTMENT';
            rtn.classList.add('fa-fade');
            rtn.classList.add('to-red-color');
        }else if(memberPbirth.value === ''){
            rtn.innerHTML = 'Enter member Rank/Gradle level';
            rtn.classList.add('fa-fade');
            rtn.classList.add('to-red-color');
        }else if(memberReligion.value === ''){
            rtn.innerHTML = 'Enter member Date of Appointment!';
            rtn.classList.add('fa-fade');
            rtn.classList.add('to-red-color');
        }else if(memberEmail.value === ''){
            rtn.innerHTML = 'Enter member Email address';
            rtn.classList.add('fa-fade');
            rtn.classList.add('to-red-color');
        }else if(memberOccupation.value === ''){
            rtn.innerHTML = 'Enter member Date of Retirement!';
            rtn.classList.add('fa-fade');
            rtn.classList.add('to-red-color');
        }else if(memberBuz.value === ''){
            rtn.innerHTML = 'Enter member marital Status';
            rtn.classList.add('fa-fade');
            rtn.classList.add('to-red-color');
        }else if(memberChurch.value === ''){
            rtn.innerHTML = 'Enter member next of kin';
            rtn.classList.add('fa-fade');
            rtn.classList.add('to-red-color');
        }
        // else if(memberDeclare.value === ''){
        //     rtn.innerHTML = 'Enter member Declaration!';
        //     rtn.classList.add('fa-fade');
        //     rtn.classList.add('to-red-color');
        // }
        else if(memberNextOfKinAddre.value === ''){
            rtn.innerHTML = 'Enter next of kin address!';
            rtn.classList.add('fa-fade');
            rtn.classList.add('to-red-color');
        }
        else if(accountdigit.value === ''){
            rtn.innerHTML = 'Enter member Staff ID!';
            rtn.classList.add('fa-fade');
            rtn.classList.add('to-red-color'); //membername
        }
        else if(membername.value === ''){
            rtn.innerHTML = 'Enter member Name!';
            rtn.classList.add('fa-fade');
            rtn.classList.add('to-red-color'); 
        }
        else if(memberNphone.value === ''){
            rtn.innerHTML = 'Enter member Phone!';
            rtn.classList.add('fa-fade');
            rtn.classList.add('to-red-color'); //memberNphone
        }
        else {
            rtn.innerHTML = ''; //clearout any 
            rtn.classList.remove('fa-fade');
//memberNextOfKinAddre
            var anyCooperative, cooperativeName, memberNewBranch, SendRequest, memberPhone, memberId;
            // if(memberCoop.value == ''){
            //     anyCooperative = 'NO';
            //     cooperativeName = 'N/A';
            // }else {
            //     anyCooperative = 'Yes';
            //     cooperativeName = memberCoop.value;
            // }

            // //to prevent any unwanted error i did this for branch buttoon
            // if(memberBranc.value == ''){
            //     memberNewBranch = 'pending';
            // }else {
            //     memberNewBranch = memberBranc.value; 
            // }

            //check if next of kin has / 
         let slash = memberChurch.value.lastIndexOf('/');
         let NextOfKinName = memberChurch.value.split('/', 1)[0]; //extract name from relationship
         let relationship = memberChurch.value.substring(slash +1); //extracting relation from name

            memberPhone = "<?php echo $memberPhone?>"; //member phone
            memberId = "<?php echo $memberId?>"; //member id


            // SendRequest = "PERM=PLEASeaLlowUpdaTE&branch="+memberNewBranch + '&anycoop=' +anyCooperative +'&coopName='+cooperativeName+'&title='+
            // memberTitle.value +'&gender='+memberGender.value+'&dob='+memberDob.value + '&permAdd='+memberPaddr.value+'&lga='+memberLga.value+'&pbirth='+memberPbirth.value+ '&Religion='+
            // memberReligion.value +'&email='+memberEmail.value+'&occupation=' +memberOccupation.value + '&buzAddr='+memberBuz.value+ '&church='+memberChurch.value+'&declaration='+
            // memberDeclare.value +'&memberPhone=' + memberPhone + '&memberId=' +memberId+'&accountDigit=' + accountdigit.value;
            
            SendRequest = JSON.stringify({
                title: memberTitle.value, //member title
                gender: memberGender.value, //member gender
                dob: memberDob.value, //member date of birth
                poolingMda: memberPaddr.value, //member pooling mda
                preMda: memberLga.value, //member present mda
                RnkGradle: memberPbirth.value, //member rank and gradle
                DAppointment: memberReligion.value, //member date of appointment
                email:memberEmail.value, //member email if any
                DRetirement: memberOccupation.value, //member date of retirement
                MaritalStatus: memberBuz.value, //member marital status
                MnextofKin: NextOfKinName, //member next of kin name
                nextofKinAddr: memberNextOfKinAddre.value, //next of kin address
                relationshipWithNextOfKin:relationship, //relationship with next of kin
                memberName: membername.value,
                memberNewPhone: memberNphone.value,
                // memberName: accountdigit.value,
                memberStaffId: accountdigit.value,
                memberPhone: memberPhone, //member phone
                memberId: memberId //member id


            });
            
            xhr = new XMLHttpRequest();
            xhr.open('POST', __mpc_uri__() + 'functions/mpc-ajax-action.php', true);
            xhr.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    if(this.response == 'Info Updated'){
                        rtn.innerHTML = 'Member infomation updated... PLEASE WAIT';
                        setTimeout(function(){
                            window.location.replace(__mpc_uri__() + 'user/dashboard.php/?action=Settings&r=memberInfo&rtn=settings'); //return back to member info
                        }, 3000)
                    }else {
                        rtn.innerHTML = this.response;
                        console.log(this.status)
                        setTimeout(function(){
                            window.location.replace(__mpc_uri__() + 'user/dashboard.php/?action=Settings&r=memberInfo&rtn=settings'); //return back to member info
                        }, 3000)
                    }
                }
            }
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.send('UPDATEMEMBERINFO=' +SendRequest);
        }

    })

    //mpc-disabled if you are not secretary
let previ = <?php echo $prev?>;
let staffId = <?php echo $id?>;

if(previ !== 5 && previ !== 2 && previ !== 1  && previ !== 4){
__mpc_disabled__('mpc-disabled', 'SECRETARY, ADMIN, SUPER ADMIN'); ///disabled all the input here
}

var popUpClose = document.querySelectorAll('.close-mpc-popup');
        for (let x = 0; x < popUpClose.length; x++) {
            popUpClose[x].addEventListener('click', () =>{
            //let close all
            var close = document.querySelectorAll('.mpc-popup-anytime');
                close.forEach(
                    element => {
                        element.remove();
                    }
                )
        })
            
        }


        __mpcPrinter__(); //RINTPER
</script>
<style>
    .mpc-member-others{
        display: none;
    }
</style>
<?php
}
?>
        </div>
<script>
    /*TRYING TO CHECK IF ADMIN CHECK THIS CHECKBOX
    *IF CHECKBOX IS CHECKED IT MEANS THAT THIS PERSON IS A
    *MEMBER OF 
    */
    __mpcAutoFire__(); //THIS FUNCTION WILL FIRE AUTOMATIC WHEN ADMIN CHANG THE VALUE OF THE SELECT ELEMENT IN THIS FILE
</script>

    <?php
    
}else if($_GET['action'] == 'chkRetirement'){
?>
<i class="mpc-admMsg"><?php echo getSystemName($conn)[1]?> Members due for Retirement.</i><br><br>
<hr class="mpcHr"><br><br><br>
    <div class="mpc-dure-retirement">
        <input type="search" class="setStyle boxMedium createLoanInput etirement" placeholder="Search Here">
        <hr class="mpcHr">
        <div class="table-responsive livsdkexkkdk5keedff">
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <td>#</td>
                        <td>Name</td>
                        <td>profile</td>
                        <td>Date Appointed</td>
                        <td>Years worked</td>
                        <td>Yrs. Remaining</td>
                        <td>Status</td>
                        <!-- <td>Name</td> -->
                    </tr>
                </thead>
                <tbody>
                    <?php __checkAllForRetirement($conn)?>
                </tbody>
            </table>
        </div>
<script>
    let inputSearch = document.querySelector('.etirement');
    let rtnData = document.querySelector('.livsdkexkkdk5keedff');
        inputSearch.oninput = function(){
            if(this.value !== null){
                let data = JSON.stringify({queryStringRetire:this.value});
                let xhr = new XMLHttpRequest();
                    xhr.open('POST', __mpc_uri__() + 'functions/mpc-ajax-action.php', true);
                    xhr.onreadystatechange = function(){
                        if(this.readyState == 4 && this.status == 200){
                            rtnData.innerHTML = this.response;
                        }
                    }
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.send('sendData=' + data);
            }
        }
</script>
    </div>
<?php
}else if($_GET['action'] == 'moveFunds'){
?>
<style>
    *{
        transition: 0.5s linear;
    }
    .border-sm{
        border: 1px solid silver;
    }

    .mpc-popup-bg{
        overflow: hidden;
    }

    .sm-tr{
        width: 40%;
        height: 40vh;
        margin: 10px auto;
        align-items: center;
        justify-content: space-evenly;
        flex-direction: column;
        border: 2px silver solid;
    }
    .moveFunds{
        width: 40%;
        height: auto;
    }

    .fromAcountWrap{
        align-items: center;
        justify-content: space-evenly;
    }
@media only screen and (max-width: 970px){
    .sm-tr{
        width: 60%;
    }
}

@media only screen and (max-width: 700px){
    .moveFunds{
        width: 60%;
        height: auto;
    }

    }

@media only screen and (max-width: 600px){
    .moveFunds{
        width: 60%;
        height: auto;
    }

    .sm-tr{
        width: 80%;
/*        border:2px dashed yellow;*/
    }

}
@media only screen and (max-width: 500px){
    .sm-tr{
        width: 100%;
        border:2px dashed yellow;
    }
    .moveFunds{
        width: 80%;
        height: auto;
    }


}

</style>
<i class="mpc-admMsg"><?php echo getSystemName($conn)[1]?>, Move members Funds.</i><br><br>
<hr class="mpcHr">
<section class="__moveFundWrapper Iyakise Raphael Etim">
    <div class="inwrappper">
        <input type="search" class="setStyle boxMedium createLoanInput" placeholder="Search Here...">
    </div>
<hr class="mpcHr">
<div class="load-members">
    <div class="table-responsive">
        <table class="table table-bordered border-dark table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Profile</th>
                    <th>Registration No.</th>
                    <th>Rank/Grade</th>
                    <th>Pooling MDA</th>
                    <th>Check Funds</th>
                </tr>
            </thead>

            <?php checkToMoveFund($conn)?>
        </table>
    </div>
</div>
<script>
    checkFunds(); /////CHECK MEMBERS FUNDS
</script>
</section>
<?php
}else if($_GET['action'] == 'ActivateLoan'){
?>
<style>
    .trackingId{
        display: none;
    }
    .mpc-blur{
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter:blur(10px);
        -moz-backdrop-filter:blur(10px);
    }
    .Cmmt{
        background: rgb(51, 57, 57)!important;
        outline: none;
        border: none;
    }

 body {
    background: #f5f6fa;
    font-family: "Inter", sans-serif;
}

.members-container {
    width: 95%;
    max-width: 800px;
    margin: 40px auto;
}

.members-container h2 {
    font-size: 22px;
    margin-bottom: 20px;
    font-weight: 600;
}

/* Search Bar */
.top-bar {
    margin-bottom: 20px;
}

.top-bar input {
    width: 100%;
    padding: 12px 15px;
    border-radius: 10px;
    border: 1px solid #dcdcdc;
    background: #fff;
    font-size: 15px;
}

/* Member List */
.member-list {
    margin-top: 10px;
}

.member-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #fff;
    padding: 15px;
    border-radius: 14px;
    margin-bottom: 12px;
    box-shadow: 0 4px 16px rgba(0,0,0,0.06);
    transition: transform .2s;
}

.member-row:hover {
    transform: translateY(-3px);
}

/* Left Info */
.info {
    display: flex;
    align-items: center;
    gap: 12px;
}

.avatar {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    background: linear-gradient(135deg, #4f8df9, #6ab0ff);
}

.name {
    font-size: 16px;
    font-weight: 600;
    margin: 0;
}

.meta {
    margin: 0;
    font-size: 13px;
    color: #666;
}

/* Loan Info */
.loan-info {
    text-align: right;
}

.amount {
    font-size: 16px;
    font-weight: 700;
    margin: 0;
}

/* Status badge */
.badge {
    display: inline-block;
    padding: 4px 10px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 600;
    margin-top: 4px;
}

.badge.active {
    background: #e8f3ff;
    color: #3b82f6;
}

.badge.approved {
    background: var(--bs-success);
    color: #3b82f6;
}

.badge.rejected {
    background: var(--bs-danger);
    color: #3b82f6;
}

.badge.pending {
    background: var(--bs-info);
    color: #3b82f6;
}

.badge.completed {
    background: #e6ffed;
    color: #22c55e;
}

/* View Button */
.view-btn {
    padding: 10px 14px;
    background: #4f8df9;
    color: #fff;
    border: none;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
}

@media (max-width:450px){
    .loan-info{
        display:none;
    }
}
</style>
<i class="mpc-admMsg">Repayment Screen</i><br><br>
<hr class="mpcHr">
    <div class="mpc-loan-activator" adm-uid="<?php echo $id?>">
        
        <!-- 


    
        -->
        <div class="members-container">
    <h2>Loan Members</h2>

    <div class="top-bar">
        <input type="text" placeholder="Search members...">
    </div>

    <div class="member-list">

        <div class="member-row">
            <div class="info">
                <div class="avatar"></div>
                <div>
                    <p class="name">John Doe</p>
                    <p class="meta">Member ID: 10023</p>
                </div>
            </div>
            <div class="loan-info">
                <p class="amount">₦450,000</p>
                <span class="badge active">Active Loan</span>
            </div>
            <button class="view-btn">View</button>
        </div>

        <div class="member-row">
            <div class="info">
                <div class="avatar"></div>
                <div>
                    <p class="name">Mary Johnson</p>
                    <p class="meta">Member ID: 10024</p>
                </div>
            </div>
            <div class="loan-info">
                <p class="amount">₦120,000</p>
                <span class="badge completed">Completed</span>
            </div>
            <button class="view-btn">View</button>
        </div>

        <div class="member-row">
            <div class="info">
                <div class="avatar"></div>
                <div>
                    <p class="name">Mary Johnson</p>
                    <p class="meta">Member ID: 10024</p>
                </div>
            </div>
            <div class="loan-info">
                <p class="amount">₦120,000</p>
                <span class="badge completed">Completed</span>
            </div>
            <button class="view-btn">View</button>
        </div>

        <div class="member-row">
            <div class="info">
                <div class="avatar"></div>
                <div>
                    <p class="name">Mary Johnson</p>
                    <p class="meta">Member ID: 10024</p>
                </div>
            </div>
            <div class="loan-info">
                <p class="amount">₦120,000</p>
                <span class="badge completed">Completed</span>
            </div>
            <button class="view-btn">View</button>
        </div>

        <div class="member-row">
            <div class="info">
                <div class="avatar"></div>
                <div>
                    <p class="name">Mary Johnson</p>
                    <p class="meta">Member ID: 10024</p>
                </div>
            </div>
            <div class="loan-info">
                <p class="amount">₦120,000</p>
                <span class="badge completed">Completed</span>
            </div>
            <button class="view-btn">View</button>
        </div>

        <div class="member-row">
            <div class="info">
                <div class="avatar"></div>
                <div>
                    <p class="name">Mary Johnson</p>
                    <p class="meta">Member ID: 10024</p>
                </div>
            </div>
            <div class="loan-info">
                <p class="amount">₦120,000</p>
                <span class="badge completed">Completed</span>
            </div>
            <button class="view-btn">View</button>
        </div>

    </div>
</div>




    </div>


    </div>
    <script type="module">

        import * as api from '../../script/api.js';
    //mpc-disabled if you are not secretary
let previ = <?php echo $prev?>;
let staffId = <?php echo $id?>;


    const loanMembers = await api.normalLoan();
    let  list = api.selector('.member-list');

        if(loanMembers.status !== "success"){
            api.showToast('No loan member found');
            // return;
        }else{

        list.innerHTML = '';
        loanMembers.loans.forEach(loan => {
            let lnWrap = document.createElement('div');
                lnWrap.classList.add('member-row');
                lnWrap.innerHTML = `
                
                <div class="info">
                    <div class="avatar"></div>
                    <div>
                        <p class="name">${loan.member_name}</p>
                        <p class="meta">Member ID: ${loan.member_id}</p>
                    </div>
                </div>
                <div class="loan-info">
                    <p class="amount">₦${loan.total_payable}</p>
                    <span class="badge ${loan.status} text-dark">${loan.status}</span>
                </div>
                <button memb-name="${loan.member_name}" class="view-btn chkdsk-ln" tracking-id="${loan.tracking_code}">View</button>
                
                `;
            list.appendChild(lnWrap);
        })

    }
    // console.log(loanMembers);

    //view loan details
    let AllViewBtn = api.selectorAll('.chkdsk-ln');
    AllViewBtn.forEach(btn => {
        btn.addEventListener('click', async function(){
            let trackingId = this.getAttribute('tracking-id');
            let memberName = this.getAttribute('memb-name');
            //fetch loan details here
            //scroll to top of the page
            window.scrollTo({ top: 0, behavior: 'smooth' });
        //    api.showToast('Loading loan details, please wait...');
            let style = {
                width: '70%',
                height: '80vh',
                overflowY: 'auto'
            };
            api.newPopup('', style, async function() {
                let currSingleLoan = await api.getSingleLoanRequest(trackingId);
                console.log(currSingleLoan);
                let popupWrap = api.selector('.popContentWrap');
                    popupWrap.innerHTML = `
 
<style>
.repay-container {
    width: 90%;
    max-width: 480px;
    margin: 40px auto;
    background: #fff;
    padding: 25px;
    border-radius: 16px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.08);
}

.repay-container h2 {
    font-size: 20px;
    margin-bottom: 20px;
    font-weight: 600;
    color: #222;
}

/* Member Profile Box */
.member-box {
    display: flex;
    align-items: center;
    background: #f0f3f9;
    padding: 15px;
    border-radius: 12px;
    margin-bottom: 20px;
}

.avatar {
    width: 55px;
    height: 55px;
    background: linear-gradient(135deg, #4f8df9, #6ab0ff);
    border-radius: 50%;
}

.details {
    margin-left: 15px;
}

.name {
    font-size: 18px;
    font-weight: 600;
    color: #111;
}

.meta {
    font-size: 14px;
    color: #555;
}

/* Form Elements */
.form-group {
    margin-bottom: 18px;
}

.form-group label {
    display: block;
    margin-bottom: 6px;
    font-weight: 500;
    color: #333;
}

input, select, textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #dcdcdc;
    border-radius: 10px;
    font-size: 15px;
    background: #fafafa;
    transition: border .3s;
}

input:focus,
select:focus,
textarea:focus {
    border-color: #4f8df9;
    outline: none;
}

textarea {
    height: 90px;
    resize: none;
}

/* Buttons */
.btn-row {
    display: flex;
    justify-content: space-between;
    margin-top: 25px;
}

.__sum__mandina:disabled{
    background: #ccc !important;
    cursor: not-allowed;
}

button {
    padding: 12px 18px;
    border: none;
    border-radius: 10px;
    font-size: 15px;
    cursor: pointer;
    font-weight: 600;
}

.cancel {
    background: #e1e1e1;
    color: #333;
}

.submit {
    background: #4f8df9;
    color: #fff;
}

</style>


<div class="repay-container">
            <h2>Record Member Repayment</h2>

            <div class="member-box">
                <div class="avatar"></div>
                <div class="details">
                    <p class="name">${memberName}</p>
                    <p class="meta">Member ID: 00${currSingleLoan.data.member_id}</p>
                    <p class="meta">Loan: ₦${currSingleLoan.data.loan_amount}</p>
                    <p class="meta">Loan paid: ₦${currSingleLoan.data.amount_paid}</p>
                    <p class="meta">Monthly Repayment: ${currSingleLoan.data.monthly_payment}</p>
                    <p class="meta">Frequency: ${currSingleLoan.data.repayment_frequency}</p>
                    
                    <p class="meta">Total Payable: ₦${currSingleLoan.data.total_payable}</p>
                    <p class="meta">Loan Duration: ${currSingleLoan.data.duration_months} Months</p>
                    <p class="meta">Loan Due date: ${currSingleLoan.data.due_date}</p>
                </div>
            </div>

            <div class="form-group">
                <label>Repayment Amount (₦)</label>
                <input type="number" placeholder="Enter amount paid">
            </div>

            <div class="form-group">
                <label>Payment Date</label>
                <input type="date">
            </div>

            <div class="form-group">
                <label>Payment Method</label>
                <select>
                    <option>Cash</option>
                    <option>Transfer</option>
                    <option>POS</option>
                </select>
            </div>

            <div class="form-group">
                <label>Notes (optional)</label>
                <textarea placeholder="Enter additional details..."></textarea>
            </div>

            <div class="btn-row">
                <button class="cancel">Cancel</button>
                <button data-0-track="${trackingId}" ${currSingleLoan.data.status !== 'active' && currSingleLoan.data.status !== 'approved' ? 'disabled' : '' } class="submit __sum__mandina">Submit Repayment</button>
            </div>
        </div>

                    `;
                //cancel Btn

                api.selector('.cancel').addEventListener('click', () => {
                    api.selector('.closeData').click();
                })


                // submit Btn
                api.selector('.__sum__mandina').addEventListener('click', async () => {
                    api.showToast('Submitting repayment, please wait...');
                    //gather all data here
                    let repayAmount = api.selector('.repay-container input[type="number"]').value;
                    let payDate = api.selector('.repay-container input[type="date"]').value;
                    let payMethod = api.selector('.repay-container select').value;
                    let notes = api.selector('.repay-container textarea').value;

                    console.log(trackingId)

                    let repayData = JSON.stringify({
                        tracking_code: trackingId,
                        repayment_amount: repayAmount,
                        payment_method: 'Cash',
                        payment_reference: payMethod,
                        notes: notes
                    });


                    let submitRepay = await api.submitRepayment(repayData);
                    console.log(submitRepay);
                    if(submitRepay.status === 'success'){
                        api.showToast('Repayment recorded successfully');
                        setTimeout(() => {
                            window.location.reload();
                        }, 2000);
                    }else {
                        api.showToast(submitRepay.message);
                    }

                })
            })
        })
    })


    </script>
<?php
}else if($_GET['action'] == 'Settings' && $_GET['r'] == 'guarantor'){
                                            ?>
    <i class="mpc-admMsg">Declaration of Nominee</i><br><br>
    <hr class="mpcHr">
    <div class="mpc-quarantor-data">
        <div class="mpc-quarantor-top-tool">
            
            <input type="search" class="setStyle createLoanInput searchMember-4-quarantor" placeholder="Search here">

            <span class="mpc-refresh">
                <i class="fa-refresh fas"></i>
            </span>
        </div>

        <div class="mpc-4quarantor-load-return">
            <?php __mpcAllmembers__($conn)?>
        </div>
    </div>
<script>
//mpc-disabled if you are not secretary
let previ = <?php echo $prev?>;
let staffId = <?php echo $id?>;

    var memberSearchKey = document.querySelector('.searchMember-4-quarantor');
        memberSearchKey.oninput = function(){

            var val, xhr, rtnRespone;
            rtnRespone = document.querySelector('.mpc-4quarantor-load-return');
            val = this.value;
            if(val !== ''){
                
                xhr = new XMLHttpRequest();
                xhr.open('GET', __mpc_uri__() + 'functions/mpc-ajax-action.php?PERMQ=loadMembersForguarantor&gquery='+val, true);
                xhr.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        
                        rtnRespone.innerHTML = this.response;

                        __mpc_member_guarantor(); //member guarantor processor  

                        if(previ !== 5 && previ !== 4){
                            __mpc_disabled__('mpc-disabled', 'SECRETARY'); ///disabled all the input here
                        }
                    }
                }
                xhr.send();
            }
        }

  // 
        
__mpc_member_guarantor(); //member guarantor processor, function is from file mpc-url.min.js
__mpcForceReload(); //



if(previ !== 5 && previ !== 4){
    __mpc_disabled__('mpc-disabled', 'SECRETARY'); ///disabled all the input here
}
</script>

                                            <?php
    }else if($_GET['action'] === 'Settings' && $_GET['r'] === 'bulksms'){
        ?>
    <i class="mpc-admMsg"><?php print getSystemName($conn)[0]?> Bulk SMS configuration</i><br><br>
    <hr class="mpcHr">

    <!-- BULK SMS CONFIGURATION START HERE -->
    <div class="mpc-general-settings">
        <div class="general-settings-tool">
            <!----GENERAL SETTINGS TOOLS START HERE --->
        <div class="gToolSection">
            <div class="g-settings-tool-wrap">
                <span class="g-tool-icons">Multi-texter API
                    <i class="fas fa-m fa-2x"></i>
                </span>

                <div class="g-setting-tool">
                    
                    <div class="mpc-general-item1">
                        <h6>Public key</h6>
                    </div>

                    <div class="mpc-general-item2">
                        <div class="mpc-adm-contact-usInput">
                            <input title="PUBLIC KEY" class="adm-select PUPBLICKEY MPC-PROJECT-INPUT" placeholder="BULK SMS PUBLIC KEY" style="padding-left: 10px;" value="<?php //print$sociallink->getSocialLinks($conn)[2]?>">
                        </div>
                    </div>
                </div>

                <div class="g-setting-tool">
                    <div class="mpc-general-item1">
                        <h6>Private key</h6>
                    </div>

                    <div class="mpc-general-item2">
                        <div class="mpc-adm-contact-usInput">
                            <input title="PRIVATE KEY" class="adm-select PRIVATEKEY MPC-PROJECT-INPUT" placeholder="BULK SMS PRIVATE KEY" style="padding-left: 10px;" value="<?php //print$sociallink->getSocialLinks($conn)[2]?>">
                        </div>
                    </div>
                </div>

                <div class="g-setting-tool">
                    <div class="mpc-general-item1">
                        <!-- <h6>Private key</h6> -->
                    </div>

                    <div class="mpc-general-item2">
                        <div class="mpc-adm-contact-usInput">
                            <button class="mpc-btn use-multiTexter">Use MultiTexter</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!-- TWILLIO API -->
        <div class="gToolSection">
            <div class="g-settings-tool-wrap">
                <span class="g-tool-icons">Twillio API
                    <i class="fas fa-t fa-2x"></i>
                </span>

                <div class="g-setting-tool">
                    
                    <div class="mpc-general-item1">
                        <h6>Public key</h6>
                    </div>

                    <div class="mpc-general-item2">
                        <div class="mpc-adm-contact-usInput">
                            <input title="PUBLIC KEY" class="adm-select PUPBLICKEY MPC-PROJECT-INPUT" placeholder="BULK SMS PUBLIC KEY" style="padding-left: 10px;" value="<?php //print$sociallink->getSocialLinks($conn)[2]?>">
                        </div>
                    </div>
                </div>

                <div class="g-setting-tool">
                    <div class="mpc-general-item1">
                        <h6>Private key</h6>
                    </div>

                    <div class="mpc-general-item2">
                        <div class="mpc-adm-contact-usInput">
                            <input title="PRIVATE KEY" class="adm-select PRIVATEKEY MPC-PROJECT-INPUT" placeholder="BULK SMS PRIVATE KEY" style="padding-left: 10px;" value="<?php //print$sociallink->getSocialLinks($conn)[2]?>">
                        </div>
                    </div>
                </div>

                <div class="g-setting-tool">
                    <div class="mpc-general-item1">
                        <!-- <h6>Private key</h6> -->
                    </div>

                    <div class="mpc-general-item2">
                        <div class="mpc-adm-contact-usInput">
                            <button class="mpc-btn Use-Twillio">Use Twillio</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="gToolSection">
            <div class="g-settings-tool-wrap">
                <span class="g-tool-icons">Temii API
                    <i class="fas fa-t fa-2x"></i>
                </span>

                <div class="g-setting-tool">
                    
                    <div class="mpc-general-item1">
                        <h6>Public key</h6>
                    </div>

                    <div class="mpc-general-item2">
                        <div class="mpc-adm-contact-usInput">
                            <input title="PUBLIC KEY" class="adm-select PUPBLICKEY MPC-PROJECT-INPUT" placeholder="BULK SMS PUBLIC KEY" style="padding-left: 10px;" value="<?php //print$sociallink->getSocialLinks($conn)[2]?>">
                        </div>
                    </div>
                </div>

                <div class="g-setting-tool">
                    <div class="mpc-general-item1">
                        <h6>Private key</h6>
                    </div>

                    <div class="mpc-general-item2">
                        <div class="mpc-adm-contact-usInput">
                            <input title="PRIVATE KEY" class="adm-select PRIVATEKEY MPC-PROJECT-INPUT" placeholder="BULK SMS PRIVATE KEY" style="padding-left: 10px;" value="<?php //print$sociallink->getSocialLinks($conn)[2]?>">
                        </div>
                    </div>
                </div>

                <div class="g-setting-tool">
                    <div class="mpc-general-item1">
                        <!-- <h6>Private key</h6> -->
                    </div>

                    <div class="mpc-general-item2">
                        <div class="mpc-adm-contact-usInput">
                            <button class="mpc-btn use-temii">Use Temii</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        </div>
    </div>

    <!-- BULK SMS CONFIGURATION END HERE -->

<?php

    }else if($_GET['action'] === 'GeneralSettings'){
    $sociallink = new SocialLink;
?>
    <i class="mpc-admMsg"><?php print getSystemName($conn)[0]?> General Settings</i><br><br>
    <hr class="mpcHr">

    <div class="mpc-general-settings">
        <div class="general-settings-tool">
            <!----GENERAL SETTINGS TOOLS START HERE --->
        <div class="gToolSection">
            <div class="g-settings-tool-wrap">
                <span class="g-tool-icons">SEO
                    <i class="fas fa-fighter-jet fa-2x"></i>
                </span>
                <div class="g-setting-tool">
                    
                    <div class="mpc-general-item1">
                        <h6>Search Result Appearance</h6>
                    </div>

                    <div class="mpc-general-item2">
                        <div class="mpc-adm-contact-usInput">
                            <input type="checkbox" class="mpc-checkbox showup-result" title="TOGGLE ON/OFF CONTACT US FORM" <?php echo __mpc_contact_usStatus__($conn)?>>
                        </div>
                    </div>
                </div>
            </div>

            <div class="g-settings-tool-wrap">
                <span class="g-tool-icons">REVISIT AFTER
                    <i class="fas fa-pen fa-2x"></i>
                </span>
                <div class="g-setting-tool">
                    
                    <div class="mpc-general-item1">
                        <h6>CRAWLER REVISIT</h6>
                    </div>

                    <div class="mpc-general-item2">
                        <div class="mpc-adm-contact-usInput mediumWidth">
                            <select class="adm-select createLoanInput SeoRevisitAfter seo-select">
                                <option value="">------</option>
                                <option value="daily" selected>Daily</option>
                                <option value="1">After 1 day</option>
                                <option value="3">After 3 day</option>
                                <option value="1 week">After 1 week</option>
                                <option value="1 month">After 1 month</option>
                                <option value="1 year">After 1 year</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                
        <div class="gToolSection">
            <div class="g-settings-tool-wrap">
                <span class="g-tool-icons">ADVERTISMENT
                    <i class="fas far fa-map fa-2x"></i>
                </span>
                <div class="g-setting-tool">
                    
                    <div class="mpc-general-item1">
                        <h6 style="margin:0">Show ads</h6>
                        <span class="gsetting-smalltxt">Show ads on member dashboard</span>
                    </div>

                    <div class="mpc-general-item2">
                        <div class="mpc-adm-contact-usInput">
                            <input type="checkbox" class="mpc-checkbox showup-result" title="TOGGLE ON/OFF CONTACT US FORM" <?php echo __mpc_contact_usStatus__($conn)?>>
                        </div>
                    </div>
                </div>
            </div>

            

            <div class="g-settings-tool-wrap">
                
                <div class="g-setting-tool">
                    
                    <div class="mpc-general-item1">
                        <h6>Ads in a row</h6>
                    </div>

                    <div class="mpc-general-item2">
                        <div class="mpc-adm-contact-usInput mediumWidth">
                            <select class="adm-select createLoanInput SeoRevisitAfter seo-select">
                                <option value="">------</option>
                                <option value="1">1 item</option>
                                <option value="2">2 item</option>
                                <option value="3">3 item</option>
                                <option value="4">4 item</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <!-- web application shortName -->
            <div class="gToolSection">
                <div class="g-settings-tool-wrap">
                
                <div class="g-setting-tool">
                    
                    <div class="mpc-general-item1">
                        <h6>Application Name (SHORT)</h6>
                    </div>

                    <div class="mpc-general-item2">
                        <div class="mpc-adm-contact-usInput mediumWidth">
                            
                            <input class="adm-select MPC-PROJECT-INPUT mpc-applicationNameShort" placeholder="Enter Application Name" style="padding-left: 10px;" value="<?php echo getSystemName($conn)[1]?>">
                        </div>
                    </div>
                </div>
            </div>

            <div class="g-settings-tool-wrap">
                
                <div class="g-setting-tool">
                    
                    <div class="mpc-general-item1">
                        <h6>Application Name (LONG)</h6>
                    </div>

                    <div class="mpc-general-item2">
                        <div class="mpc-adm-contact-usInput mediumWidth">
                            
                            <input class="adm-select MPC-PROJECT-INPUT mpc-applicationNameLong" placeholder="Enter Application Name(LONG)" style="padding-left: 10px;" value="<?php echo getSystemName($conn)[0]?>">
                        </div>
                    </div>
                </div>
            </div>

            <div class="g-settings-tool-wrap">
                
                <div class="g-setting-tool">
                    
                    <div class="mpc-general-item1">
                        <h6>Application Title</h6>
                    </div>

                    <div class="mpc-general-item2">
                        <div class="mpc-adm-contact-usInput mediumWidth">
                            
                            <input class="adm-select MPC-PROJECT-title MPC-PROJECT-INPUT" placeholder="Application Title" style="padding-left: 10px;" value="<?php echo getSystemName($conn)[2]?>">
                        </div>
                    </div>
                </div>
            </div>

            <div class="g-settings-tool-wrap">
                
                <div class="g-setting-tool">
                    
                    <div class="mpc-general-item1">
                        <h6></h6>
                    </div>

                    <div class="mpc-general-item2">
                        <div class="mpc-adm-contact-usInput mediumWidth">
                            
                            <button class="mpc-btn mpc-btn-fullWidth App-info">Save</button>
                        </div>
                    </div>
                </div>
            </div>


            </div>


            <div class="gToolSection">
                <div class="g-settings-tool-wrap">
                     <span class="g-tool-icons">Application ID
                        <i class="fas fa-image fa-2x"></i>
                    </span>
                    <div class="g-setting-tool">
                        
                        <div class="mpc-general-item1">
                            <h6>Company Logo</h6>
                        </div>

                        <div class="mpc-general-item2">
                            <div class="mpc-adm-contact-usInput mediumWidth">
                                
                                <input type="file" class="uploadWebbLogo mpc-inp-file" accept="image/*" id="cmpLogo">
                                <label for="cmpLogo" class="mpc-btn uploadLogo"><!--button class="mpc-btn uploadLogo"-->Upload Logo <i class="fab fa-cloudsmith fa-2x"></i><!--/button--></label>
                            </div>
                        </div>
                    </div>

                    <div class="g-setting-tool">
                        
                        <div class="mpc-general-item1">
                            <!-- <h6>Company Logo</h6> -->
                        </div>

                        <div class="mpc-general-item2">
                            <div class="mpc-adm-contact-usInput mediumWidth new-uploadPreview">
                                
                                <!-- -->
                            </div>
                        </div>
                    </div>

                    <div class="g-setting-tool">
                        
                        <div class="mpc-general-item1">
                            <h6>Company Logo (FAVICON)</h6>
                        </div>

                        <div class="mpc-general-item2">
                            <div class="mpc-adm-contact-usInput mediumWidth">
                                
                                <input type="file" class="FAVICON-MPC mpc-inp-file" accept="image/x-icon" id="mpc-favicon">
                                <label class="mpc-btn faviconUpload" for="mpc-favicon">Favicon <i class="fab fa-codiepie fa-2x"></i></label>
                            </div>
                        </div>
                    </div>

                    <div class="g-setting-tool">
                        
                        <div class="mpc-general-item1">
                            <!-- <h6>Company Logo</h6> -->
                        </div>

                        <div class="mpc-general-item2">
                            <div class="mpc-adm-contact-usInput mediumWidth new-iconPreview">
                                
                                
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="gToolSection">
                <div class="g-settings-tool-wrap">
                     <span class="g-tool-icons">Social Link
                        <i class="fas fa-link fa-2x"></i>
                    </span>

                    <div class="g-setting-tool">
                        
                        <div class="mpc-general-item1">
                            <h6>Facebook Url</h6>
                        </div>

                        <div class="mpc-general-item2">
                            <div class="mpc-adm-contact-usInput mediumWidth">
                                
                                <input title="COMPANY FACEBOOK PAGE" class="adm-select fbookURL MPC-PROJECT-INPUT" placeholder="Company facebook Page url" style="padding-left: 10px;" value="<?php print$sociallink->getSocialLinks($conn)[0]?>">
                            </div>
                        </div>
                    </div>

                    <div class="g-setting-tool">
                        
                        <div class="mpc-general-item1">
                            <h6>Whatsapp Url</h6>
                        </div>

                        <div class="mpc-general-item2">
                            <div class="mpc-adm-contact-usInput mediumWidth">
                                
                                <input title="COMPANY WHATSAPP GROUP" class="adm-select whtsppURL MPC-PROJECT-INPUT" placeholder="Company facebook Page url" style="padding-left: 10px;" value="<?php print$sociallink->getSocialLinks($conn)[1]?>">
                            </div>
                        </div>
                    </div>

                    <div class="g-setting-tool">
                        
                        <div class="mpc-general-item1">
                            <h6>Instagram page Url</h6>
                        </div>

                        <div class="mpc-general-item2">
                            <div class="mpc-adm-contact-usInput mediumWidth">
                                
                                <input title="COMPANY INSTAGRAM HANDLE" class="adm-select instaURL MPC-PROJECT-INPUT" placeholder="Company INSTAGRAM HANDLE" style="padding-left: 10px;" value="<?php print$sociallink->getSocialLinks($conn)[2]?>">
                            </div>
                        </div>
                    </div>

                    <div class="g-setting-tool">
                        
                        <div class="mpc-general-item1">
                            <h6>Twitter(X) url</h6>
                        </div>

                        <div class="mpc-general-item2">
                            <div class="mpc-adm-contact-usInput mediumWidth">
                                
                                <input title="COMPANY TWITTER(X) URL" class="adm-select TwterURL MPC-PROJECT-INPUT" placeholder="Company TWITTER(X) URL" style="padding-left: 10px;" value="<?php print$sociallink->getSocialLinks($conn)[3]?>">
                            </div>
                        </div>
                    </div>

                    <div class="g-setting-tool">
                        
                        <div class="mpc-general-item1">
                            <h6>Youtube channel url</h6>
                        </div>

                        <div class="mpc-general-item2">
                            <div class="mpc-adm-contact-usInput mediumWidth">
                                
                                <input title="Enter youtube channel URL" class="adm-select ytbeURL MPC-PROJECT-INPUT" placeholder="Company YOUTUBE CHANNEL URL" style="padding-left: 10px;" value="<?php print$sociallink->getSocialLinks($conn)[4]?>">
                            </div>
                        </div>
                    </div>

                    <div class="g-setting-tool">
                        
                        <div class="mpc-general-item1">
                            <h6>Linkedin url</h6>
                        </div>

                        <div class="mpc-general-item2">
                            <div class="mpc-adm-contact-usInput mediumWidth">
                                
                                <input title="Enter Linkedin URL" class="adm-select linkedinUrl MPC-PROJECT-INPUT" placeholder="Company LINKEDIN Page url" style="padding-left: 10px;" value="<?php print$sociallink->getSocialLinks($conn)[5]?>">
                            </div>
                        </div>
                    </div>

                    <div class="g-setting-tool">
                        
                        <div class="mpc-general-item1">
                            <!-- <h6>Linkedin url</h6> -->
                        </div>

                        <div class="mpc-general-item2">
                            <div class="mpc-adm-contact-usInput mediumWidth">
                                <button class="mpc-btn-fullWidth mpc-btn mpcs-urlSaver">save</button>
                                <!-- <input class="adm-select MPC-PROJECT-title MPC-PROJECT-INPUT" placeholder="Company facebook Page url" style="padding-left: 10px;" value="<?php print$sociallink->getSocialLinks($conn)[5]?>"> -->
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            

            <!----GENERAL SETTINGS TOOLS STOP HERE --->
        </div>
    </div>

    <div class="mpc-ads-showPrev">
        <h6>Ads preview show up here</h6>
    </div>

<script>
    wepAppInfo(); //application name, short name and title;
    companyLogo() //logo;
    faviconUpload()// FAVICON UPLOAD
    saveCompanySocial(); //update company url here


</script>
<?php
                                        }
                                    }
                                }
                             }
                        }
                    }
                }
            }
        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
