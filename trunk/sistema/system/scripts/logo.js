
$(function() {
    
    canvas = document.getElementById('canvas');
    ctx = canvas.getContext('2d');
    
    r = 0;
    setInterval(function() {
        //animarCirculo(50, 50, 0, "#999");
        r = animarCirculo(20, 20, r, "#999");
        //animarCirculo(60, 20, r, "#999");
    }, 1000 / 24); 
    //animarCirculo(20, 20, 0, "#999");
    //animarCirculo(40, 20, 0, "#999");
    r = 0;
    setInterval(function() { r = animarCirculo(80, 20, r, "#999"); }, 1000); 
    
});

function dibujarCirculo(x, y, r, color) {
    //ctx.clearRect(x - r, y - r, x + r, y + r);
    ctx.beginPath();
    ctx.arc(x, y, r, 0, Math.PI * 2, false);
    ctx.closePath();
    ctx.fillStyle = color;
    ctx.fill();
}

function animarCirculo(x, y, r, color) {
    if (r > 8) return;
    r = incrementarRadio(r);
    dibujarCirculo(x, y, r, color);
    return r;
}

function incrementarRadio(r) {
    return r += (r > 14 ? 1 : 2);
}