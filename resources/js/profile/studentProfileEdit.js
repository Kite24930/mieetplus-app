import 'bootstrap-icons/font/bootstrap-icons.css';
import '../app.js';
import '../../css/profile/studentProfile.css';

const loading = document.getElementById('loading');
const container = document.getElementById('container');
const root = window.location.protocol + '//' + window.location.hostname + '/';

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

const img = document.getElementById('img');
img.addEventListener('change', () => {
    const topImg = document.getElementById('topImg');
    const label = document.getElementById('img_file');
    const reader = new FileReader();
    reader.addEventListener('load', (e) => {
        topImg.src = e.target.result;
    });
    reader.readAsDataURL(img.files[0]);
    label.innerText = img.files[0].name;
})
