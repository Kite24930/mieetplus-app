import '../app.js';

document.getElementById('search').addEventListener('click', () => {
    const target = document.getElementById('search-input').value;
    let applicable = 0;
    if (target !== '') {
        document.querySelectorAll('.student-item').forEach((item) => {
            const name = item.getAttribute('data-bs-name');
            item.classList.remove('hidden');
            if (name.includes(target)) {
                applicable++;
            } else {
                item.classList.add('hidden');
            }
        });
    } else {
        document.querySelectorAll('.student-item').forEach((item) => {
            item.classList.remove('hidden');
            applicable++;
        });
    }
    document.getElementById('applicable').textContent = applicable;
});
