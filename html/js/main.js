
function init() {

    var map = L.map('map');
    var attrib = 'Map data copyright OpenStreetMap contributors, ' +
            'Open Database License';
    
    map.setView ([51.05, -0.72], 14);
    L.tileLayer('/osm_tiles/{z}/{x}/{y}.png',
        { attribution: attrib } 
        ).addTo(map);

    
}

