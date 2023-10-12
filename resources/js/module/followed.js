import axios from "axios";

const followChange = (el) => {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const company_id = el.getAttribute('data-bs-target');
    const student_id = el.getAttribute('data-bs-student');
    const classList = el.classList;
    if (classList.contains('followed')) {
        axios.delete('/api/follow/' + company_id + '/' + student_id)
            .then(res => {
                el.classList.remove('followed');
                el.innerHTML = '<i class="bi bi-balloon-heart-fill"></i>フォローする';
            })
            .catch(err => {
                console.log(err);
            });
    } else {
        const sendData = new URLSearchParams({
            company_id: company_id,
            student_id: student_id,
        });
        axios.post('/api/follow', sendData)
            .then(res => {
                el.classList.add('followed');
                el.innerHTML = '<i class="bi bi-balloon-heart-fill text-white"></i>フォロー中';
                if (res.data.msg === 'not_verified') {
                    window.alert("メールアドレスの認証が完了していません。\nメールアドレスの認証が完了後にフォローリストの閲覧が可能になります。\nメールアドレスの認証はマイページから行えます。");
                }
            })
            .catch(err => {
                console.log(err);
            });
    }
}

export default followChange;
