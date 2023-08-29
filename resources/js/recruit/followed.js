import Swiper from "swiper/bundle";
import 'swiper/css/bundle';
import { Modal } from "flowbite";
import 'bootstrap-icons/font/bootstrap-icons.css';
import '../app.js';
import '../../css/recruit/followed.css';
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
        loading.classList.add('hidden');
    }, 1500);
}
window.addEventListener('load', windowInit);

document.querySelectorAll('.follow-btn').forEach(el => {
    el.addEventListener('click', () => {
        followChange(el);
    })
});
