import { Editor } from "@toast-ui/editor";
import '@toast-ui/editor/dist/i18n/ja-jp';
import { Modal } from "flowbite";
import 'bootstrap-icons/font/bootstrap-icons.css';
import '@toast-ui/editor/dist/toastui-editor-viewer.css';
import '../app.js';
import '../../css/recruit/detail.css';
import axios from "axios";

const loading = document.getElementById('loading');
const container = document.getElementById('container');
const root = window.location.protocol + '//' + window.location.hostname + '/';

const contentSet = () => {
    document.querySelectorAll('.content-img').forEach((el) => {
        const target = el.getAttribute('data-bs-target');
        const modal = new Modal(document.getElementById(target), {
            backdrop: true,
        });
        el.addEventListener('click', () => {
            modal.show();
        })
        document.getElementById(target + 'Close').addEventListener('click', () => {
            modal.hide();
        })
    })
    document.querySelectorAll('.viewer-content').forEach(el => {
        const viewer = new Editor.factory({
            el: document.getElementById(el.getAttribute('data-target')),
            viewer: true,
            initialValue: el.value,
        })
        el.remove();
    })
}

const windowInit = () => {
    container.classList.add('flex');
    container.classList.remove('hidden');
    setTimeout(() => {
        loading.style.opacity = 0;
    }, 1000);
    setTimeout(() => {
        loading.classList.add('hidden');
    }, 1500);
    contentSet();
}
window.addEventListener('load', windowInit);
