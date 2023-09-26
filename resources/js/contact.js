import 'bootstrap-icons/font/bootstrap-icons.css';
import './app.js'
import '../css/contact.css';

const corporationRadio = document.getElementById('corporation');
const individualRadio = document.getElementById('individual');
const corporate = document.querySelectorAll('.corporate');
const individual = document.querySelectorAll('.individual');

function typesChange() {
    if (corporationRadio.checked) {
        corporate.forEach(element => {
            element.classList.remove('hidden');
            if (element.classList.contains('required')) {
                const target = document.getElementById(element.getAttribute('data-target'));
                target.required = true;
            }
        });
        individual.forEach(element => {
            element.classList.add('hidden');
            if (element.classList.contains('required')) {
                const target = document.getElementById(element.getAttribute('data-target'));
                target.required = false;
            }
        });
    } else {
        corporate.forEach(element => {
            element.classList.add('hidden');
            if (element.classList.contains('required')) {
                const target = document.getElementById(element.getAttribute('data-target'));
                target.required = false;
            }
        });
        individual.forEach(element => {
            element.classList.remove('hidden');
            if (element.classList.contains('required')) {
                const target = document.getElementById(element.getAttribute('data-target'));
                target.required = true;
            }
        });
    }
}
corporationRadio.addEventListener('change', typesChange);
individualRadio.addEventListener('change', typesChange);
