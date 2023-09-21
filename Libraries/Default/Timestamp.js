function complete_date(){
	let date = new Date();
	return date.toDateString();
}

function complete_time(){
	let date = new Date();
	let hour = date.getHours();
	let minutes = date.getMinutes();
	let seconds = date.getSeconds();
	let AMPM = date.getHours();

	hour.toString().length === 1 ? hour = "0" + hour : 0;
	minutes.toString().length === 1 ? minutes = "0" + minutes : 0;
	seconds.toString().length === 1 ? seconds = "0" + seconds : 0;

	hour === 13 ? hour = "01" : hour = hour;
	hour === 14 ? hour = "02" : hour = hour;
	hour === 15 ? hour = "03" : hour = hour;
	hour === 16 ? hour = "04" : hour = hour;
	hour === 17 ? hour = "05" : hour = hour;
	hour === 18 ? hour = "06" : hour = hour;
	hour === 19 ? hour = "07" : hour = hour;
	hour === 20 ? hour = "08" : hour = hour;
	hour === 21 ? hour = "09" : hour = hour;
	hour === 22 ? hour = "10" : hour = hour;
	hour === 23 ? hour = "11" : hour = hour;
	hour === 24 ? hour = "12" : hour = hour;

	// am/pm
	let indicator;
	parseInt(AMPM) >= 12 ? indicator = "PM" : indicator = "AM";

	return hour + ":" + minutes + ":" + seconds + " " + indicator;
}

console.log("Last reload: " + complete_date() + " " + complete_time());