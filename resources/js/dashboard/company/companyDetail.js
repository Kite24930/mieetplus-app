import { Editor } from "@toast-ui/editor";
import '@toast-ui/editor/dist/i18n/ja-jp';
import ProgressBar from 'progressbar.js';
import { loader } from "../../module/googlemap.js";
import '../../app.js';

let map, marker, geocoder;
window.addEventListener('load', (e) => {
    loader.load().then(() => {
        geocoder = new google.maps.Geocoder();
        const mapCenter = { lat: 34.744477243417535, lng: 136.52422411122325 };
        map = new google.maps.Map(document.getElementById('map'), {
            center: mapCenter,
            zoom: 18,
            // mapId: 'c9f7c1f1b4c9a2c3',
            mapTypeControl: false,
            fullscreenControl: false,
            streetViewControl: false,
        });
        if (document.getElementById('location_lat').value !== '' && document.getElementById('location_lng').value !== '') {
            mapCenter.lat = parseFloat(document.getElementById('location_lat').value);
            mapCenter.lng = parseFloat(document.getElementById('location_lng').value);
            map.setCenter(mapCenter);
        }
        marker = new google.maps.Marker({
            position: mapCenter,
            map: map,
        });

        window.scrollTo(0, 0);
    });

    const viewerClass = document.querySelectorAll('.viewer');
    viewerClass.forEach((viewer) => {
        const editorInstance = new Editor.factory({
            el: viewer,
            viewer: true,
            // height: '300px',
            initialValue: document.getElementById(viewer.getAttribute('data-target')).value,
        });
    });

    document.querySelectorAll('.tellers-img').forEach((img) => {
        const target = img.getAttribute('data-bs-target');
        const preview = document.getElementById(target);
        preview.style.backgroundImage = 'url(' + img.src + ')';
    });
});

let barOption = {
    strokeWidth: 3,
    duration: 10000,
    color: '#B5DECC',
    trailColor: '#aaa',
    trailWidth: 4,
    svgStyle: {width: '100%', height: '100%'},
};

document.querySelectorAll('.progress-bar').forEach((bar) => {
    const line = new ProgressBar.Line(bar, barOption);
});
