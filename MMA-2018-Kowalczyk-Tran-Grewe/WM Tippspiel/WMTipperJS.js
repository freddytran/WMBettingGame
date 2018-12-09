var canvas = document.getElementById("myCanvas");
/*var canvasWidth = 1100;
var canvasHeight = 200;*/
/*canvas.setAttribute('width', canvasWidth);
canvas.setAttribute('height', canvasHeight);*/
var cv = canvas.getContext("2d");
//Options Grid
var graphGridSize = 20;
var graphGridX = (canvas.width / graphGridSize).toFixed();
//Draw Grid
for(var i = 0; i < graphGridX; i ++){
	cv.moveTo(canvas.width, graphGridSize*i);
	cv.lineTo(0, graphGridSize*i);
}
cv.strokeStyle = "#000000";
cv.stroke();


function landwahlSubmit(){
     document.getElementById('landwahl').submit();    
};

