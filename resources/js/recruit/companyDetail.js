import { Editor } from "@toast-ui/editor";
import '@toast-ui/editor/dist/i18n/ja-jp';
import { Modal } from "flowbite";
import '../app.js';
import axios from "axios";
import followChange from "../module/followed.js";

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

function historyAdd() {
    const sendData = new URLSearchParams({
        student_id: Laravel.user_id,
        company_id: Laravel.company_id,
    });
    axios.post('/api/history', sendData)
        .then((res) => {
            console.log(res);
        })
        .catch((err) => {
            console.log(err);
        })
}

const windowInit = () => {
    container.classList.add('flex');
    container.classList.remove('hidden');
    contentSet();
    if (typeof Laravel.user_id !== 'undefined') {
        historyAdd();
    }
}
window.addEventListener('load', windowInit);

document.querySelectorAll('.follow-btn').forEach(el => {
    el.addEventListener('click', () => {
        followChange(el);
    })
});

document.querySelectorAll('.not-login').forEach(el => {
    el.addEventListener('click', () => {
        alert('ログインしてください');
    })
});
