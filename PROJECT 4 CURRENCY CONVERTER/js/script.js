const amountInput = document.getElementById('amount');
const currencySelect = document.getElementById('currency');
const rateInput = document.getElementById('rate');
const resultLabel = document.getElementById('resultLabel');
const convertBtn = document.getElementById('convertBtn');

function updatePlaceholder() {
    const currency = currencySelect.value;
    const amount = amountInput.value || 'FRW amount';
    rateInput.placeholder = `${amount} FRW = ? ${currency}`;
}

function convert() {
    const amount = parseFloat(amountInput.value);
    const rate = parseFloat(rateInput.value);

    if (!isNaN(amount) && !isNaN(rate) && rate > 0) {
        const converted = amount * rate;
        const currency = currencySelect.value;
        resultLabel.textContent = `${currency} ${converted.toFixed(2)}`;
    } else {
        resultLabel.textContent = 'Result';
    }
}

convertBtn.addEventListener('click', convert);
amountInput.addEventListener('input', updatePlaceholder);
currencySelect.addEventListener('change', updatePlaceholder);
updatePlaceholder();
