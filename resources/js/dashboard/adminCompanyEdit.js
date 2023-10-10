import Editor from "@toast-ui/editor";
import '@toast-ui/editor/dist/i18n/ja-jp';
import colorPlugin from "@toast-ui/editor-plugin-color-syntax";
import tableMergedCellPlugin from "@toast-ui/editor-plugin-table-merged-cell";
import ProgressBar from 'progressbar.js';
import { loader } from "../module/googlemap.js";
import '../app.js';

document.querySelectorAll('select').forEach((select) => {
    if (select.value !== 'placeholder') {
        select.style.color = '#586C61';
    }
    select.addEventListener('change', (e) => {
        if (e.target.value === 'placeholder') {
            select.style.color = '#ACB6BE';
        } else {
            select.style.color = '#586C61';
        }
    });
})
let map, marker, geocoder, editors = [], tellersEditor = [];
window.addEventListener('load', (e) => {
    loader.load().then(() => {
        geocoder = new google.maps.Geocoder();
        const mapCenter = { lat: 34.744477243417535, lng: 136.52422411122325 };
        map = new google.maps.Map(document.getElementById('map'), {
            center: mapCenter,
            zoom: 18,
            // mapId: 'c9f7c1f1b4c9a2c3',
            mapTypeControl: false,
            fullscreenControl: false,
            streetViewControl: false,
        });
        if (document.getElementById('location_lat').value !== '' && document.getElementById('location_lng').value !== '') {
            mapCenter.lat = parseFloat(document.getElementById('location_lat').value);
            mapCenter.lng = parseFloat(document.getElementById('location_lng').value);
            map.setCenter(mapCenter);
        }
        marker = new google.maps.Marker({
            position: mapCenter,
            map: map,
            draggable: true,
        });

        marker.addListener('dragend', (e) => {
            document.getElementById('location_lat').value = e.latLng.lat();
            document.getElementById('location_lng').value = e.latLng.lng();
        });

        window.scrollTo(0, 0);
    });

    const editorClass = document.querySelectorAll('.editor');
    editorClass.forEach((editor) => {
        const editorInstance = new Editor({
            el: editor,
            initialEditType: 'wysiwyg',
            previewStyle: 'vertical',
            height: '300px',
            language: 'ja',
            toolbarItems: [
                ['heading', 'bold', 'italic', 'strike'],
                ['hr', 'quote'],
                ['ul', 'ol', 'task', 'indent', 'outdent'],
                ['table', 'image'],
                ['code', 'codeblock'],
                ['scrollSync'],
            ],
            plugins: [colorPlugin, tableMergedCellPlugin],
        });
        const obj = {
            editorInstance: editorInstance,
            editor: editor,
        }
        editors.push(obj);
    });

    editors.forEach((editor, i) => {
        const target = editor.editor.getAttribute('data-target');
        editor.editorInstance.setMarkdown(document.getElementById(target).value);
    });

    const tellersEditorClass = document.querySelectorAll('.tellers-editor');
    tellersEditorClass.forEach((editor) => {
        const editorInstance = new Editor({
            el: editor,
            initialEditType: 'wysiwyg',
            previewStyle: 'vertical',
            height: '300px',
            language: 'ja',
            toolbarItems: [
                ['heading', 'bold', 'italic', 'strike'],
                ['hr', 'quote'],
                ['ul', 'ol', 'task', 'indent', 'outdent'],
                ['table', 'image'],
                ['code', 'codeblock'],
                ['scrollSync'],
            ],
            plugins: [colorPlugin, tableMergedCellPlugin],
        });
        const obj = {
            editorInstance: editorInstance,
            editor: editor,
            container: editor.getAttribute('data-bs-target'),
            btn: editor.getAttribute('data-bs-button'),
            imgUrl: editor.getAttribute('data-bs-background'),
            preview: editor.getAttribute('data-bs-preview'),
        }
        tellersEditor.push(obj);
    });

    tellersEditor.forEach((editor) => {
        const previewBtn = document.getElementById(editor.btn);
        const previewContainer = document.getElementById(editor.container);
        const backImgUrl = document.getElementById(editor.imgUrl);
        const preview = document.getElementById(editor.preview);
        preview.style.backgroundImage = 'url(' + backImgUrl.value + ')';
        previewBtn.addEventListener('click', (e) => {
            previewContainer.innerHTML = editor.editorInstance.getHTML();
        });
        const target = editor.editor.getAttribute('data-target');
        editor.editorInstance.setMarkdown(document.getElementById(target).value);
        previewContainer.innerHTML = editor.editorInstance.getHTML();
    });

    document.querySelectorAll('.tellers-img').forEach((img) => {
        const target = img.getAttribute('data-bs-target');
        const preview = document.getElementById(target);
        const label = document.getElementById(img.getAttribute('data-bs-label'));
        img.addEventListener('change', (e) => {
            const reader = new FileReader();
            const file = e.target.files[0];
            reader.addEventListener('load', (e) => {
                preview.style.backgroundImage = 'url(' + e.target.result + ')';
            });
            reader.readAsDataURL(file);
            label.innerHTML = file.name;
        });
    });
    const faculties = document.getElementById('faculties').value.split(',');
    document.querySelectorAll('.faculties').forEach((faculty) => {
        if (faculties.includes(faculty.value)) {
            faculty.checked = true;
        }
    });
});

let barOption = {
    strokeWidth: 3,
    duration: 10000,
    color: '#B5DECC',
    trailColor: '#aaa',
    trailWidth: 4,
    svgStyle: {width: '100%', height: '100%'},
};

document.querySelectorAll('.progress-bar').forEach((bar) => {
    const line = new ProgressBar.Line(bar, barOption);
});

document.getElementById('url').addEventListener('keyup', (e) => {
    document.getElementById('urlLink').innerHTML = e.target.value;
    document.getElementById('urlCheck').href = e.target.value;
});

document.getElementById('addressToMap').addEventListener('click', (e) => {
    const address = document.getElementById('location').value;
    geocoder.geocode({address: address}, (results, status) => {
        if (status === 'OK') {
            map.setCenter(results[0].geometry.location);
            marker.setPosition(results[0].geometry.location);
            document.getElementById('location_lat').value = results[0].geometry.location.lat();
            document.getElementById('location_lng').value = results[0].geometry.location.lng();
            alert("検索に成功しました。\n地図上のマーカーをドラッグして位置を調整してください。");
        } else {
            alert("検索に失敗しました。\n住所を再確認してください。");
        }
    });
});

const facultiesClass = document.querySelectorAll('.faculties');
const faculties = document.getElementById('faculties');
facultiesClass.forEach((faculty) => {
    faculty.addEventListener('change', (e) => {
        let facultyList = [];
        facultiesClass.forEach((faculty) => {
            if (faculty.checked) {
                facultyList.push(faculty.value);
            }
        });
        faculties.value = facultyList.join(',');
    });
});

document.getElementById('top_img').addEventListener('change', (e) => {
    const file = e.target.files[0];
    document.getElementById('top_img_file').innerHTML = file.name;
    document.querySelectorAll('.top_img').forEach((img) => {
        const reader = new FileReader();
        reader.addEventListener('load', (e) => {
            img.src = e.target.result;
        });
        reader.readAsDataURL(file);
    });
});

document.getElementById('logo').addEventListener('change', (e) => {
    const file = e.target.files[0];
    document.getElementById('logo_file').innerHTML = file.name;
    document.querySelectorAll('.logo').forEach((img) => {
        const reader = new FileReader();
        reader.addEventListener('load', (e) => {
            img.src = e.target.result;
        });
        reader.readAsDataURL(file);
    });
});

document.getElementById('movie_request').addEventListener('click', (e) => {
    const to = 'contact@mie-projectm.com';
    const subject = '【Mieet Plus 就活部】動画掲載依頼';
    const body = 'Mieet Plus 就活部宛%0D%0A%0D%0A企業名：%0D%0A担当者：%0D%0A担当者連絡先TEL：%0D%0A動画送信方法：メールに添付・ダウンロードURLの指定%0D%0A動画のURL：%0D%0A動画の概要：%0D%0AYouTubeにアップロードする際の説明書：%0D%0AYouTubeにアップロードする際の注意点(ありましたら)：%0D%0A%0D%0A動画の掲載を依頼します。';
    window.location.href = `mailto:${to}?subject=${subject}&body=${body}`;
});

document.getElementById('submit').addEventListener('click', (e) => {
    editors.forEach((editor, i) => {
        const target = editor.editor.getAttribute('data-target');
        document.getElementById(target).value = editor.editorInstance.getMarkdown();
    });
    tellersEditor.forEach((editor, i) => {
        const target = editor.editor.getAttribute('data-target');
        document.getElementById(target).value = editor.editorInstance.getMarkdown();
    });
    let msg = '', check = true;
    if (document.getElementById('name').value === '') {
        msg += "企業名を入力してください。\n";
        check = false;
    }
    if (document.getElementById('ruby').value === '') {
        msg += "企業名(ふりがな)を入力してください。\n";
        check = false;
    }
    if (document.getElementById('category').value === 'placeholder') {
        msg += "業種を選択してください。\n";
        check = false;
    }
    if (document.getElementById('location').value === '') {
        msg += "本社所在地を入力してください。\n";
        check = false;
    }
    if (document.getElementById('work_location').value === '') {
        msg += "勤務地を入力してください。\n";
        check = false;
    }
    if (document.getElementById('establishment_date').value === '') {
        msg += "設立年月日を入力してください。\n";
        check = false;
    }
    if (document.getElementById('capital').value === '') {
        msg += "資本金を入力してください。\n";
        check = false;
    }
    if (document.getElementById('employee_number').value === '') {
        msg += "従業員数を入力してください。\n";
        check = false;
    }
    if (document.getElementById('contents').value === '') {
        msg += "事業内容を入力してください。\n";
        check = false;
    }
    if (document.getElementById('feature').value === '') {
        msg += "他社と比べた強み・弱みを入力してください。\n";
        check = false;
    }
    if (document.getElementById('career_path').value === '') {
        msg += "キャリアパスを入力してください。\n";
        check = false;
    }
    if (document.getElementById('desired_person').value === '') {
        msg += "求める人物像を入力してください。\n";
        check = false;
    }
    if (document.getElementById('transfer').value === '') {
        msg += "転勤・異動を入力してください。\n";
        check = false;
    }
    if (document.getElementById('top_img').files.length === 0 && document.getElementById('top_img_check').src === 'http://via.placeholder.com/240x240') {
        msg += "トップ画像を選択してください。\n";
        check = false;
    }
    if (document.getElementById('job_description_tellers').value === '') {
        msg += "Tellersの実際の仕事内容を入力してください。\n";
        check = false;
    }
    if (document.getElementById('culture_tellers').value === '') {
        msg += "Tellersの社内の雰囲気・社風を入力してください。\n";
        check = false;
    }
    if (document.getElementById('environment_tellers').value === '') {
        msg += "Tellersの労働環境を入力してください。\n";
        check = false;
    }
    if (check) {
        document.getElementById('form').submit();
    } else {
        alert(msg);
    }
});
