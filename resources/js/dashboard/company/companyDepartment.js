import '../../app.js';
import axios from "axios";

document.querySelectorAll('.statusToggle').forEach(item => {
    item.addEventListener('change', event => {
        let target_id = item.getAttribute('data-target-id');
        let target_status = item.getAttribute('data-status');
        let status = 0;
        if (item.checked) {
            status = 1;
        }
        if (Number(target_status) !== status) {
            console.log(target_id, status);
            item.setAttribute('data-status', status);
            axios.post('/api/company/status', {
                id: target_id,
                status: status
            })
                .then(res => {
                    console.log(res.data);
                }).catch(err => {
                    console.log(err);
            })
        }
    })
})
