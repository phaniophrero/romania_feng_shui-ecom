var mapLat = 44.4576958;
var mapLng = 26.068092;
var mapDefaultZoom = 15;

var map = new ol.Map({
    target: "map",
    layers: [
        new ol.layer.Tile({
            source: new ol.source.OSM()
        })
    ],
    view: new ol.View({
        center: ol.proj.fromLonLat([mapLng, mapLat]),
        zoom: mapDefaultZoom
    })
});

//Adding marker on the map
var marker = new ol.Feature({
    geometry: new ol.geom.Point(ol.proj.fromLonLat([mapLng, mapLat]))
});

marker.setStyle(
    new ol.style.Style({
        image: new ol.style.Icon({
            anchor: [0.8, 120],
            anchorXUnits: "fraction",
            anchorYUnits: "pixels",
            color: "#ffcd46",
            crossOrigin: "anonymous",
            src: "/img/map-pin.png",
            scale: 0.2
        })
    })
);

var vectorSource = new ol.source.Vector({
    features: [marker]
});

var markerVectorLayer = new ol.layer.Vector({
    source: vectorSource
});
map.addLayer(markerVectorLayer);
