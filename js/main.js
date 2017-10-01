
function init() {

    var map = L.map('map');
    var attrib = 'Map data copyright OpenStreetMap contributors, ' +
            'Open Database License';
    
    map.setView ([52.4862, -1.8904], 14);
    L.tileLayer('http://47.91.91.133/hot/{z}/{x}/{y}.png',
        { attribution: attrib } 
        ).addTo(map);

    
}

