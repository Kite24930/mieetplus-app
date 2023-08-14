import 'bootstrap-icons/font/bootstrap-icons.css';
import '../app.js';
import '../../css/dashboard/companyList.css';

document.getElementById('search').addEventListener('click', () => {
    const target = document.getElementById('search-input').value;
    let applicable = 0;
    if (target !== '') {
        document.querySelectorAll('.company-item').forEach((item) => {
            const name = item.getAttribute('data-bs-name');
            item.classList.remove('hidden');
            if (name.includes(target)) {
                applicable++;
            } else {
                item.classList.add('hidden');
            }
        });
    } else {
        document.querySelectorAll('.company-item').forEach((item) => {
            item.classList.remove('hidden');
            applicable++;
        });
    }
    document.getElementById('applicable').textContent = applicable;
});
