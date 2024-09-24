const form = document.querySelector('form');
const result = document.querySelector('#result');
const calculateBtn = document.querySelector('#calculate-btn');

calculateBtn.addEventListener('click', () => {
	const hours = parseFloat(document.querySelector('#hours-worked').value);
	const rate = parseFloat(document.querySelector('#hourly-rate').value);
	let basePayAmount, overtimePayAmount, totalPayAmount;
	
	if (hours < 0 || rate < 0) {
		alert("Hours worked and hourly rate cannot be negative.");
		return;
	}
	
	if (hours <= 40) {
		basePayAmount = hours * rate;
		overtimePayAmount = 0;
	} else {
		const overtimeHours = hours - 40;
		basePayAmount = 40 * rate;
		overtimePayAmount = overtimeHours * (rate * 1.5);
	}
	
	totalPayAmount = basePayAmount + overtimePayAmount;
	
	result.innerHTML = `
		<h2>Paycheck Breakdown</h2>
		<p>Base Pay: $${basePayAmount.toFixed(2)}</p>
		<p>Overtime Pay: $${overtimePayAmount.toFixed(2)}</p>
		<p>Total Pay: $${totalPayAmount.toFixed(2)}</p>
	`;
});
