
var xmlhttp = new XMLHttpRequest();
var url = "home/nextService";

xmlhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
		var myArr = JSON.parse(this.responseText);
		myFunction(myArr);
	}
};
xmlhttp.open("GET", url, true);
xmlhttp.send();

function myFunction(arr) {

	console.log(arr);
	var out = "";
	out = out +  'test <a href="' + arr.id + '">' + arr.title + '</a><br>';

	document.getElementById("nextservice").innerHTML = "test"+ out;
}
