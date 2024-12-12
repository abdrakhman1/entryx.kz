ymaps3.ready.then(init);

function init() {
    const map = new ymaps3.YMap(document.getElementById('map'), {
        location: {
            center: [73.103196, 49.812761],
            zoom: 7
        }
    });
    const layer = new ymaps3.YMapDefaultSchemeLayer();
    map.addChild(layer);

    map.addChild(new ymaps3.YMapDefaultFeaturesLayer()); // В этом слое будут маркеры.
    // DOM-элемент должен быть создан заранее, но его содержимое можно задать в любой момент.
    const content = document.createElement('div');
    content.classList.add("marker-map");
    const marker = new ymaps3.YMapMarker({
        coordinates: [71.410074, 51.138483],
    }, content);
    map.addChild(marker);


    const content1 = document.createElement('div');
    content1.classList.add("marker-map");
    const marker1 = new ymaps3.YMapMarker({
        coordinates: [73.141933, 49.787252],
    }, content1);
    map.addChild(marker1);

    const content2 = document.createElement('div');
    content2.classList.add("marker-map");
    const marker2 = new ymaps3.YMapMarker({
        coordinates: [ 73.101722, 49.815952],
    }, content2);
    map.addChild(marker2);
}