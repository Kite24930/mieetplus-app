import { Modal } from 'flowbite';
import '../app.js';
import axios from "axios";

const root = window.location.protocol + '//' + window.location.hostname + '/';
const loading = document.getElementById('loading');
const container = document.getElementById('container');

const windowInit = () => {
    // container.classList.add('flex');
    // container.classList.remove('hidden');
    setTimeout(() => {
        loading.style.opacity = 0;
    }, 1000)
    setTimeout(() => {
        loading.style.display = 'none';
    }, 1500);
}
window.addEventListener('load', windowInit);

const filterMerge = (valEl, className) => {
    document.querySelectorAll('.' + className).forEach((el) => {
        el.addEventListener('change', () => {
            let val = '';
            document.querySelectorAll('.' + className + ':checked').forEach((el) => {
                val += el.value + ',';
            });
            valEl.value = val.slice(0, -1);
        })
    })
}
const filterMergeList = [
    'category',
    'location',
    'work_location',
    'faculty',
]
filterMergeList.forEach(target => {
    filterMerge(document.getElementById(target), 'search-' + target);
});
document.getElementById('search_free_word').addEventListener('change', (el) => {
    document.getElementById('free_word').value = el.target.value;
});
