export async function getMembers(root){
    try {
        const req = await fetch(`${root}functions/get-members.php`);

            if(!req.ok){
                let td = await req.text();

                throw new Error("Error: Server Responded with " + td);
                
            }

        const result = await req.json();

            return result;

    } catch (error) {
        console.error(error);
    }
}

export async function getLoanTransaction(root, memId, memPh){
    try {
        const req = await fetch(`${root}functions/loan0transaction.php`, {
            method: 'post',
            headers: {
                'Content-type': 'application/json'
            },
            body: JSON.stringify({member_id: memId, member_phone: memPh})
        });

            if(!req.ok){
                let td = await req.text();

                throw new Error("Error: Server Responded with " + td);
                
            }

        const result = await req.json();
        //   console.log(result)
            return result;

    } catch (error) {
        console.error(error);
    }
}


export async function fetchDataPost(root, file, data = {}) {
    try {
        const req = await fetch(`${root}functions/${file}.php`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data) // ✅ Use the data object you passed in
        });

        if (!req.ok) {
            const text = await req.text();
            throw new Error(`Error: Server responded with ${text}`);
        }

        const result = await req.json();
        return result;

    } catch (error) {
        console.error('Fetch Error:', error);
        return { success: false, message: error.message };
    }
}


export function showToast(txt, time = 3000, type = 'info'){
	Toastify({
	  text: txt,
	  className: type,
	  duration:time,
	  style: {
		background: "linear-gradient(to right, #00b09b, #96c93d)",
	  }
	}).showToast();
 }


export function newPopup(el, style = {}, callback) {
    let bdy = document.querySelector('.mpc-body-class');
    if (!bdy) return console.error('Element .mpc-body-class not found');

    let wraper = document.createElement('div');
    wraper.className = 'popover mpc-pop mpc-popup top-0 start-0 iyakise-2025';

    wraper.innerHTML = `

        <div class="_wrp_wk">
            <div class="btn-wraper">
                <button class="btn closeData btn-danger" style="justify--self:flex-start;">
                    <i class="fas fa-xmark" title="close"></i>
                </button>
            </div>
            <div class="popContentWrap pop-data">adfasdfasd</div>
        </div>
    `;

    bdy.appendChild(wraper);
    bdy.classList.add('position-relative');

    // ✅ Apply style object
    const content = wraper.querySelector('.popContentWrap');
    Object.assign(content.style, style);

    const close = wraper.querySelector('.closeData');
    close.addEventListener('click', () =>{
        // document.body.classList.remove('position-relative');
        bdy.classList.remove('position-relative');

        wraper.remove();
    });

    if (callback) callback();
}


export async function getRecent(root, memId, memPh){
    try {
        const req = await fetch(`${root}functions/member.loan.recent.php`, {
            method: 'POST',
            headers: {
                'Content-type': 'application/json'
            },
            body: JSON.stringify({member_id: memId, member_phone: memPh})
        });

            if(!req.ok){
                let td = await req.text();

                throw new Error("Error: Server Responded with " + td);
                
            }

        const result = await req.json();
        //   console.log(result)
            return result;

    } catch (error) {
        console.error(error);
    }
}

//admin search
export async function adminSearch(root, search){
    try {
        const req = await fetch(`${root}functions/search-member.php`, {
            method: 'POST',
            headers: {
                'Content-type': 'application/json'
            },
            body: JSON.stringify({search: search})
        });

            if(!req.ok){
                let td = await req.text();

                throw new Error("Error: Server Responded with " + td);
                
            }

        const result = await req.json();
        //   console.log(result)
            return result;

    } catch (error) {
        console.error(error);
    }
}


export async function getRcent20(root, memId, memPh){
    try {
        const req = await fetch(`${root}functions/get.member.transaction.sum.php`, {
            method: 'POST',
            headers: {
                'Content-type': 'application/json'
            },
            body: JSON.stringify({member_id: memId, member_phone: memPh})
        });

            if(!req.ok){
                let td = await req.text();

                throw new Error("Error: Server Responded with " + td);
                
            }

        const result = await req.json();
        //   console.log(result)
            return result;

    } catch (error) {
        console.error(error);
    }
}


//reent
export async function recent5each(root, memId, memPh){
    try {
        const req = await fetch(`${root}functions/member.recent.php`, {
            method: 'POST',
            headers: {
                'Content-type': 'application/json'
            },
            body: JSON.stringify({member_id: memId, member_phone: memPh})
        });

            if(!req.ok){
                let td = await req.text();

                throw new Error("Error: Server Responded with " + td);
                
            }

        const result = await req.json();
        //   console.log(result)
            return result;

    } catch (error) {
        console.error(error);
    }
}



export function normalPopup(){
        // starterd
                        //memb btn
            const btn = document.querySelectorAll('._jkksj_');
                  btn.forEach((member, i) => {
                    member.addEventListener('click', () => {
                       let style = {
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
                            console.log(memberSecret);
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

}