<script
src="https://code.jquery.com/jquery-3.2.1.min.js"
integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
crossorigin="anonymous">
</script>
<canvas id="myCanvas" width="1100" height="600" style="border:1px solid #000000;">
</canvas>
<button onclick="send()">Send</button>
<script>
var dernierX = "";
var dernierY = "";
var c = document.getElementById("myCanvas");
c.width = $("#myCanvas").width();
c.height = $("#myCanvas").height();
$(window).resize(function(){
var c = document.getElementById("myCanvas");
c.width = $("#myCanvas").width();
c.height = $("#myCanvas").height();
});
var path = [];
var myMouse = false;
function drawPath() {
	var c = document.getElementById("myCanvas");
	var ctx = c.getContext("2d");
	ctx.moveTo(dernierX,dernierY);
	ctx.lineTo(event.clientX,event.clientY);
	ctx.strokeStyle = "#FF0000";
	ctx.lineWidth = 1;
	ctx.stroke();
	dernierX = event.clientX;
	dernierY = event.clientY;
};
$("#myCanvas").mousemove(function(){
	if (myMouse === true) {
		console.log('test')
		path.push([event.offsetX, event.offsetY]);
		drawPath();
	}
})
.mousedown(function() {
	path = [];
	myMouse = true;
	dernierX = event.clientX;
	dernierY = event.clientY;
})
.mouseup(function() {
	myMouse = false;
	var data = {
		path: path
	};
	var query = {
		url: 'http://draw.api.niamor.com/paths/add',
		method: 'POST',
		data: data
	};
});
function send() {
	$.ajax ({
		url: 'http://draw.api.niamor.com/paths/add',
		method: 'POST',
		data: {
			path: path,
	"strockeColor": "#FF0000",
		"lineWidth": 1
}})
}
</script>