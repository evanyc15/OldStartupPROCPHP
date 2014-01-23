var canvasBackground = document.getElementById("background-pic");
var contextBackground = canvasBackground.getContext('2d');
 
//var canvasHeader = document.getElementById("headerbar");
//var contextHeader = canvasHeader.getContext('2d');
 
var background_Image = new Image();
background_Image.addEventListener('load',start);
background_Image.src = "/globalref/images/scrolling_anilum2.jpg";
var offSetX = 0;
var scrollingInterval;
 
function start()
{
        scrollingInterval = setInterval(drawInterval,10);
}
 
function drawInterval()
{
        if(offSetX == -background_Image.width)
        {
                offSetX = 0;
        }
        else
        {
                offSetX--;
        }
       
        contextBackground.drawImage(background_Image,0,0,background_Image.width,background_Image.height,offSetX,0,background_Image.width,background_Image.height);
        contextBackground.drawImage(background_Image,0,0,background_Image.width,background_Image.height,background_Image.width + offSetX,0,background_Image.width,background_Image.height);
}