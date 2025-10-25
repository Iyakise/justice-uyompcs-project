/**calculator start here 
 * let's do this people
 * 
*/

var buttonCalculator = document.querySelector('.calculate-loan');
    buttonCalculator.addEventListener('click', function() {
        var inp1, inp2, inp3, result, interest, payment, company, amountRtn, borrowedAmount;

            //start to select all order input
            inp1 = document.querySelector('.SetAmount');
            inp2 = document.querySelector('.Loan-interest-rate');
            inp3 = document.querySelector('.repayment');
            result = document.querySelector('.mpc-monthlyPayment');
            company = document.querySelector('.companyIntrest');
            amountRtn = document.querySelector('.borrowedAmount'); //borrowed amount

            //check and validate
            if(inp1.value === ''){
                result.innerHTML = 'Please Enter your prefered loan amount!.';
                result.classList.add('err');
            }else if(inp2.value === ''){
                result.innerHTML = 'Select your Interest rate.';
                result.classList.add('err');
            }else if(inp3.value === ''){
                result.innerHTML = "Please Enter Loan tenure";
                result.classList.add('err');
            }else{
                amount = inp1.value;
                interest_rate = inp2.value;
                months = inp3.value;
                result.classList.remove('err');
                result.classList.add('succ');

                interest = (amount * (interest_rate * .01)) / months; //company interest
                payment = ((amount / months) + interest).toFixed(2); // payment
                payment = payment.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                interest = interest.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                amount = amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                company.innerHTML = "&#8358;"+interest;
                result.innerHTML = "&#8358;"+payment;
                amountRtn.innerHTML = "&#8358;"+amount;


                
            }
    })

//select listen to rate change
var rateChange = document.querySelector('.Loan-interest-rate');
    rateChange.addEventListener('change', function(){
        var rtn = document.querySelector('.mpc-rate-charge');
            rtn.innerHTML = this.value + '%';
    })