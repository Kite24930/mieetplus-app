import './app.js';
import '../css/auth.css';

document.querySelectorAll('select').forEach((select) => {
    select.addEventListener('change', (e) => {
        if (e.target.value === 'placeholder') {
            select.style.color = '#ACB6BE';
        } else {
            select.style.color = '#586C61';
        }
    });
})
