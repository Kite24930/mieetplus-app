import Swiper from "swiper/bundle";
import 'swiper/css/bundle';
import { Modal } from "flowbite";
import '../app.js';
import axios from "axios";
import followChange from "../module/followed.js";

const root = window.location.protocol + '//' + window.location.hostname + '/';
const container = document.getElementById('container');

const windowInit = () => {

}
window.addEventListener('load', windowInit);

document.querySelectorAll('.follow-btn').forEach(el => {
    el.addEventListener('click', () => {
        followChange(el);
    })
});
