import 'bootstrap-icons/font/bootstrap-icons.css';
import '../../app.js';
import '../../../css/dashboard/companySetting.css';

const id = document.getElementById('id').value;

document.getElementById('mailToggle').addEventListener('click', () => {
    const mailPermission = document.getElementById('mailPermission');
    let mailPermissionValue = 1;
    if (mailPermission.checked) {
        mailPermissionValue = 0;
    }
    axios.post('/api/company/mailPermission', {
        id: id,
        permission: mailPermissionValue
    })
        .then((response) => {
            if (response.data.msg === 'ok') {
                alert("設定を更新しました。");
            } else {
                alert("設定の更新が失敗しました。\n何度もエラーが繰り返される場合は、お問い合わせください。");
            }
        }).catch((error) => {
            console.log(error);
        });
});
