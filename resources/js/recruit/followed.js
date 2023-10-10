import Swiper from "swiper/bundle";
import 'swiper/css/bundle';
import { Modal } from "flowbite";
import '../app.js';
import axios from "axios";
import followChange from "../module/followed.js";

const root = window.location.protocol + '//' + window.location.hostname + '/';
const loading = document.getElementById('loading');
const container = document.getElementById('container');

const windowInit = () => {
    container.classList.add('flex');
    container.classList.remove('hidden');
    setTimeout(() => {
        loading.style.opacity = 0;
    }, 1000);
    setTimeout(() => {
        loading.style.display = 'none';
    }, 1500);
}
window.addEventListener('load', windowInit);

document.querySelectorAll('.follow-btn').forEach(el => {
    el.addEventListener('click', () => {
        followChange(el);
    })
});
