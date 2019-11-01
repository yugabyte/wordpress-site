function polarToCartesian(centerX, centerY, radius, angleInDegrees) {
  var angleInRadians = (angleInDegrees-90) * Math.PI / 180.0;

  return {
    x: centerX + (radius * Math.cos(angleInRadians)),
    y: centerY + (radius * Math.sin(angleInRadians))
  };
}

function describeArc(x, y, radius, startAngle, endAngle){

    var start = polarToCartesian(x, y, radius, endAngle);
    var end = polarToCartesian(x, y, radius, startAngle);

    var arcSweep = endAngle - startAngle <= 180 ? "0" : "1";

    var d = [
        "M", start.x, start.y, 
        "A", radius, radius, 0, arcSweep, 0, end.x, end.y
    ].join(" ");

    return d;       
}

var drawArcs = function() {
  graphic = { 
    groups: [
      [
        { x: 120, y: 120, radius: 15, start: 0, end: 72, width: 30, color: "#E64A19" },
        { x: 120, y: 120, radius: 60, start: 0, end: 66, width: 20, color: "#E64A19" },
        { x: 120, y: 120, radius: 100, start: 0, end: 66, width: 20, color: "#E64A19"},
      ],
      [
        { x: 120, y: 120, radius: 15, start: 72, end: 144, width: 30, color: "#303F9F" },
        { x: 120, y: 120, radius: 60, start: 72, end: 136, width: 20, color: "#303F9F" },
        { x: 120, y: 120, radius: 100, start: 72, end: 136, width: 20, color: "#303F9F"},
      ],
      [
        { x: 120, y: 120, radius: 15, start: 144, end: 216, width: 30, color: "#7C4DFF" },
        { x: 120, y: 120, radius: 60, start: 144, end: 210, width: 20, color: "#7C4DFF" },
        { x: 120, y: 120, radius: 100, start: 144, end: 210, width: 20, color: "#7C4DFF"},
      ],
      [
        { x: 120, y: 120, radius: 15, start: 216, end: 288, width: 30, color: "#CDDC39" },
        { x: 120, y: 120, radius: 60, start: 216, end: 282, width: 20, color: "#CDDC39" },
        { x: 120, y: 120, radius: 100, start: 216, end: 282, width: 20, color: "#CDDC39"},
      ],
      [
        { x: 120, y: 120, radius: 15, start: 288, end: 354, width: 30, color: "#00796B" },
        { x: 120, y: 120, radius: 60, start: 288, end: 354, width: 20, color: "#00796B" },
        { x: 120, y: 120, radius: 100, start: 288, end: 354, width: 20, color: "#00796B"},
      ],
    ]
  };
  
  var svg = document.getElementById('graphic');

  var count = 0;
  graphic.groups.forEach(function(arcs, i){
    arcs.forEach(function(arc, ii){
      var path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
      path.id = 'arc-' + count++;
      path.setAttribute('class', 'arc');
      path.setAttribute('data-group', i);
      path.setAttribute('data-level', ii);
      
      var rotateStart = arc.start + 6; // + gap

      path.setAttribute('data-start', rotateStart);
      path.style.fill = 'none';
      path.style.stroke = arc.color;
      path.style.strokeWidth = arc.width;
 
      var d = describeArc(arc.x, arc.y, arc.radius, arc.start, arc.end);
      path.setAttribute('d', d);
      
      svg.appendChild(path);
    })
  });
}


window.onload = drawArcs;