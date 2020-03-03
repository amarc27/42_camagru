// var colors = ['#ADD8E6', '#00ff00', '#ADD8E6'];
var colors = [
    {'background': '#ADD8E6', 'color': '#5F9EA0'},
    {'background': '#FFB6C1', 'color': '#8B0000'},
    {'background': '#FAF0E6', 'color': '#008B8B'},
    {'background': '#FAEBD7', 'color': '#6495ED'},
    {'background': '#90EE90', 'color': '#068F8B'},
    {'background': '#90EE90', 'color': '#006400'},
];

function changeColor() {
    var random_color = colors[Math.floor(Math.random() * colors.length)];

    var bg = random_color.background;
    var text = random_color.color;

    document.getElementById('colored-pp').style.backgroundColor = bg;
    document.getElementById('colored-pp').style.color = text;
}

setTimeout(changeColor(), 2);