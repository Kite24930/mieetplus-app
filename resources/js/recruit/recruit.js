import Swiper from "swiper/bundle";
import 'swiper/css/bundle';
import { Editor } from "@toast-ui/editor";
import '@toast-ui/editor/dist/i18n/ja-jp';
import { Modal } from "flowbite";
import ProgressBar from 'progressbar.js';
import 'bootstrap-icons/font/bootstrap-icons.css';
import '@toast-ui/editor/dist/toastui-editor-viewer.css';
import '../app.js';
import '../../css/recruit/recruit.css';
import axios from "axios";
import followChange from "../module/followed.js";

const root = window.location.protocol + '//' + window.location.hostname + '/';
const loading = document.getElementById('loading');
const container = document.getElementById('container');

let swiper = new Swiper("#tellers", {
    slidesPerView: "auto",
    spaceBetween: 15,
    freeMode: true,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
});

let barOption = {
    strokeWidth: 3,
    duration: 10000,
    color: '#B5DECC',
    trailColor: '#aaa',
    trailWidth: 4,
    svgStyle: {width: '100%', height: '100%'},
};

let bar1 = new ProgressBar.Line('#progress-1', barOption);
let bar2 = new ProgressBar.Line('#progress-2', barOption);
let bar3 = new ProgressBar.Line('#progress-3', barOption);

const modalElement = document.getElementById('modalEl');
const modal = new Modal(modalElement, {
    backdropClasses: 'modal-backdrop bg-dark',
});

let tellerSwiper = new Swiper("#tellerSwiper", {
    spaceBetween: 15,
    on: {
        slideChange: () => {
            bar1.set(0);
            bar1.animate(1.0);
            bar2.set(0);
            bar3.set(0);
            if (tellerSwiper.progress === 1) {
                tellersAdd();
            }
        },
    }
});

let insideSwiper = [];

const insideSwiperInit = (el) => {
    let swiper = new Swiper(el, {
        spaceBetween: 15,
        pagination: {
            el: '.swiper-pagination',
            type: 'fraction'
        },
        on: {
            slideChange: () => {
                switch (swiper.activeIndex) {
                    case 0:
                        bar1.animate(1.0);
                        bar2.set(0);
                        bar3.set(0);
                        break;
                    case 1:
                        bar1.set(1);
                        bar2.animate(1.0);
                        bar3.set(0);
                        break;
                    case 2:
                        bar1.set(1);
                        bar2.set(1);
                        bar3.animate(1.0);
                        break;
                }
            },
        }
    });
    insideSwiper.push(swiper);
}
document.querySelectorAll('.insideSwiper').forEach((el) => {
    insideSwiperInit(el)
});
document.querySelectorAll('.viewer-content').forEach((el) => {
    const target = document.getElementById(el.getAttribute('data-target'));
    const viewer = new Editor.factory({
        el: target,
        viewer: true,
        initialValue: el.value,
    });
    el.remove();
});

const tellersBtnInit = (el) => {
    el.addEventListener('click', () => {
        const targetNum = Number(el.getAttribute('data-bs-target'));
        bar1.set(0);
        bar1.animate(1.0);
        bar2.set(0);
        bar3.set(0);
        tellerSwiper.slideTo(targetNum);
        insideSwiper[targetNum].slideTo(0);
        modal.show();
    });
}
document.querySelectorAll('.teller-btn').forEach((el) => {
    tellersBtnInit(el);
});

document.getElementById('modalClose').addEventListener('click', () => {
    modal.hide();
    bar1.stop();
    bar2.stop();
    bar3.stop();
});

document.getElementById('modalLeft').addEventListener('click', () => {
    const insideSwiperTarget = insideSwiper[tellerSwiper.activeIndex];
    if (insideSwiperTarget.activeIndex === 0) {
        tellerSwiper.slidePrev();
        insideSwiper[tellerSwiper.activeIndex].slideTo(0);
    } else {
        bar1.set(0);
        bar2.set(0);
        insideSwiperTarget.slidePrev();
    }
});
document.getElementById('modalRight').addEventListener('click', () => {
    const insideSwiperTarget = insideSwiper[tellerSwiper.activeIndex];
    if (insideSwiperTarget.activeIndex === 2) {
        if (tellerSwiper.progress === 1) {
            modal.hide();
        } else {
            tellerSwiper.slideNext();
            insideSwiper[tellerSwiper.activeIndex].slideTo(0);
        }
    } else {
        insideSwiperTarget.slideNext();
    }
});

const frameFunction = () => {
    if (modal.isVisible()) {
        const targetSwiperNum = tellerSwiper.activeIndex;
        if (bar1.value() === 1 && bar2.value() === 0 && insideSwiper[targetSwiperNum].activeIndex === 0) {
            insideSwiper[targetSwiperNum].slideNext();
        }
        if (bar2.value() === 1 && bar3.value() === 0 && insideSwiper[targetSwiperNum].activeIndex === 1) {
            insideSwiper[targetSwiperNum].slideNext();
        }
        if (bar3.value() === 1 && insideSwiper[targetSwiperNum].activeIndex === 2) {
            if (tellerSwiper.progress === 1) {
                modal.hide();
            } else {
                tellerSwiper.slideNext();
            }
        }
    }
    window.requestAnimationFrame(frameFunction);
}
const windowInit = () => {
    // console.log(Laravel);
    container.classList.add('flex');
    container.classList.remove('hidden');
    setTimeout(() => {
        loading.style.opacity = 0;
    }, 1000)
    setTimeout(() => {
        loading.classList.add('hidden');
    }, 1500);
    frameFunction();
}
window.addEventListener('load', windowInit);

const moreBtn = document.getElementById('more');
const tellerSwiperEl = document.querySelector('#tellerSwiper .swiper-wrapper');

const tellersAdd = () => {
    let tellersNum = 0;
    document.querySelectorAll('.teller-btn').forEach((el) => {
        if (el.getAttribute('data-bs-target') !== null && el.getAttribute('data-bs-target') !== 'more') {
            if (tellersNum < Number(el.getAttribute('data-bs-target'))) {
                tellersNum = Number(el.getAttribute('data-bs-target'));
            }
        }
    });
    tellersNum++;
    const swiperPagination = document.createElement('div');
    swiperPagination.classList.add('swiper-pagination');
    for (let i = Laravel.tellers_num; i < Laravel.tellers_num + 10; i++) {
        if (typeof Laravel.tellers_list[i] !== 'undefined') {
            const data = Laravel.tellers_list[i];
            const swiperSlide = document.createElement('div');
            swiperSlide.classList.add('swiper-slide', 'flex', 'flex-col');
            const tellerBtn = document.createElement('div');
            tellerBtn.classList.add('teller-btn', 'flex', 'flex-col', 'justify-center', 'items-center');
            tellerBtn.setAttribute('data-bs-target', tellersNum);
            tellersBtnInit(tellerBtn);
            const tellerImg = document.createElement('img');
            tellerImg.classList.add('rounded-full', 'w-20', 'h-20', 'object-cover');
            if (data.logo !== null) {
                tellerImg.setAttribute('src', root + 'storage/company/' + data.user_id + '/' + data.logo);
            } else {
                tellerImg.setAttribute('src', root + 'storage/company/' + data.user_id + '/' + data.top_img);
            }
            tellerBtn.appendChild(tellerImg);
            const companyName = document.createElement('div');
            companyName.classList.add('company-name', 'text-center');
            companyName.textContent = data.name;
            tellerBtn.appendChild(companyName);
            swiperSlide.appendChild(tellerBtn);
            moreBtn.before(swiperSlide);
            const companyWrapper = document.createElement('div');
            companyWrapper.classList.add('company-wrapper', 'w-full', 'h-full', 'swiper-slide');
            const companyHeader = document.createElement('div');
            companyHeader.classList.add('company-header', 'w-full', 'absolute', 'left-0', 'flex', 'justify-between', 'z-750', 'mt-7', 'ml-2');
            const companyInfo = document.createElement('div');
            companyInfo.classList.add('company-info', 'flex', 'flex-col', 'items-center');
            const companyName2 = document.createElement('div');
            companyName2.classList.add('flex', 'items-center');
            const companyImg = document.createElement('img');
            companyImg.classList.add('company-img', 'rounded-full');
            if (data.logo !== null) {
                companyImg.setAttribute('src', root + 'storage/company/' + data.user_id + '/' + data.logo);
            } else {
                companyImg.setAttribute('src', root + 'storage/company/' + data.user_id + '/' + data.top_img);
            }
            companyName2.appendChild(companyImg);
            const companyName3 = document.createElement('div');
            companyName3.classList.add('company-name', 'px-2');
            companyName3.textContent = data.name;
            companyName2.appendChild(companyName3);
            companyInfo.appendChild(companyName2);
            const followBtn = document.createElement('div');
            followBtn.classList.add('mt-3');
            if (typeof Laravel.followed !== 'undefined') {
                const followBtnIcon = document.createElement('button');
                followBtnIcon.classList.add('follow-btn', 'border', 'rounded', 'px-2', 'py-1');
                followBtnIcon.setAttribute('data-bs-target', data.user_id);
                const icon = document.createElement('i');
                icon.classList.add('bi', 'bi-balloon-heart-fill');
                followBtnIcon.appendChild(icon);
                if (Laravel.followed.includes(data.user_id)) {
                    followBtnIcon.classList.add('followed');
                    followBtnIcon.innerHTML += 'フォロー中'
                } else {
                    followBtnIcon.innerHTML += 'フォローする'
                }
                followBtn.appendChild(followBtnIcon);
            }
            companyInfo.appendChild(followBtn);
            companyHeader.appendChild(companyInfo);
            companyWrapper.appendChild(companyHeader);
            const insideSwiper = document.createElement('div');
            insideSwiper.classList.add('insideSwiper', 'w-full', 'h-full');
            const swiperWrapper = document.createElement('div');
            swiperWrapper.classList.add('swiper-wrapper', 'relative', 'w-5/6');
            const swiperSlide1 = document.createElement('div');
            swiperSlide1.classList.add('swiper-slide', 'flex', 'flex-col', 'justify-center', 'items-center');
            if (data.tellers_img_1 !== null) {
                swiperSlide1.style.backgroundImage = 'url(' + root + 'storage/company/' + data.user_id + '/' + data.tellers_img_1 + ')';
            } else {
                swiperSlide1.style.backgroundImage = 'url(' + root + 'storage/office.jpg)';
            }
            const contentContainer1 = document.createElement('div');
            contentContainer1.classList.add('content-container', 'w-5/6');
            const title1 = document.createElement('div');
            title1.classList.add('title', 'text-3xl', 'my-4', 'font-bold');
            title1.textContent = '[実際の仕事内容]';
            contentContainer1.appendChild(title1);
            const content1 = document.createElement('div');
            content1.classList.add('content');
            const viewer1 = new Editor.factory({
                el: content1,
                viewer: true,
                initialValue: data.job_description_tellers,
            });
            contentContainer1.appendChild(content1);
            swiperSlide1.appendChild(contentContainer1);
            swiperWrapper.appendChild(swiperSlide1);
            const swiperSlide2 = document.createElement('div');
            swiperSlide2.classList.add('swiper-slide', 'flex', 'flex-col', 'justify-center', 'items-center');
            if (data.tellers_img_2 !== null) {
                swiperSlide2.style.backgroundImage = 'url(' + root + 'storage/company/' + data.user_id + '/' + data.tellers_img_2 + ')';
            } else {
                swiperSlide2.style.backgroundImage = 'url(' + root + 'storage/meeting_room.jpg)';
            }
            const contentContainer2 = document.createElement('div');
            contentContainer2.classList.add('content-container', 'w-5/6');
            const title2 = document.createElement('div');
            title2.classList.add('title', 'text-3xl', 'my-4', 'font-bold');
            title2.textContent = '[社内の雰囲気・社風]';
            contentContainer2.appendChild(title2);
            const content2 = document.createElement('div');
            content2.classList.add('content');
            const viewer2 = new Editor.factory({
                el: content2,
                viewer: true,
                initialValue: data.culture_tellers,
            });
            contentContainer2.appendChild(content2);
            swiperSlide2.appendChild(contentContainer2);
            swiperWrapper.appendChild(swiperSlide2);
            const swiperSlide3 = document.createElement('div');
            swiperSlide3.classList.add('swiper-slide', 'flex', 'flex-col', 'justify-center', 'items-center');
            if (data.tellers_img_3 !== null) {
                swiperSlide3.style.backgroundImage = 'url(' + root + 'storage/company/' + data.user_id + '/' + data.tellers_img_3 + ')';
            } else {
                swiperSlide3.style.backgroundImage = 'url(' + root + 'storage/building.jpg)';
            }
            const contentContainer3 = document.createElement('div');
            contentContainer3.classList.add('content-container', 'w-5/6');
            const title3 = document.createElement('div');
            title3.classList.add('title', 'text-3xl', 'my-4', 'font-bold');
            title3.textContent = '[会社の特徴]';
            contentContainer3.appendChild(title3);
            const content3 = document.createElement('div');
            content3.classList.add('content');
            const viewer3 = new Editor.factory({
                el: content3,
                viewer: true,
                initialValue: data.environment_tellers,
            });
            contentContainer3.appendChild(content3);
            swiperSlide3.appendChild(contentContainer3);
            swiperWrapper.appendChild(swiperSlide3);
            swiperWrapper.appendChild(swiperPagination.cloneNode(true));
            insideSwiper.appendChild(swiperWrapper);
            insideSwiperInit(insideSwiper);
            companyWrapper.appendChild(insideSwiper);
            tellerSwiperEl.appendChild(companyWrapper);
            tellerSwiper.update();
            tellersNum++;
        } else {
            moreBtn.remove();
            break;
        }
    }
    Laravel.tellers_num += 10;
}

moreBtn.addEventListener('click', tellersAdd);

window.addEventListener('touchstart', () => {
    if (modal.isVisible()) {
        bar1.stop();
        bar2.stop();
        bar3.stop();
    }
})

window.addEventListener('touchend', () => {
    if (modal.isVisible()) {
        const targetSwiperNum = tellerSwiper.activeIndex;
        switch (insideSwiper[targetSwiperNum].activeIndex) {
            case 0:
                bar1.animate(1.0);
                bar2.set(0);
                bar3.set(0);
                break;
            case 1:
                bar1.set(1);
                bar2.animate(1.0);
                bar3.set(0);
                break;
            case 2:
                bar1.set(1);
                bar2.set(1);
                bar3.animate(1.0);
                break;
        }
    }
})

const postsExpand = (el) => {
    el.addEventListener('click', () => {
        const target = el.getAttribute('data-bs-target');
        const targetEl = document.getElementById(target);
        targetEl.classList.remove('folded', 'h-10');
        el.remove();
    });
}
document.querySelectorAll('.posts-expand').forEach((el) => {
    postsExpand(el)
});

const posts = document.getElementById('posts');
const postsAdd = () => {
    for (let i = Laravel.posts_num; i < Laravel.posts_num + 10; i++) {
        if (typeof Laravel.posts_list[i] !== 'undefined') {
            const data = Laravel.posts_list[i];
            const postsContainer = document.createElement('div');
            postsContainer.classList.add('w-full', 'flex', 'flex-col');
            const postsHeader = document.createElement('div');
            postsHeader.classList.add('posts-header', 'w-full', 'px-2', 'py-1');
            const postsCompanyLink = document.createElement('a');
            postsCompanyLink.classList.add('inline-flex', 'items-center');
            postsCompanyLink.setAttribute('href', root + 'recruit/company/' + data.user_id);
            const postsCompanyImg = document.createElement('img');
            postsCompanyImg.classList.add('logo', 'rounded-full', 'w-[36px]', 'h-[36px]');
            if (data.logo !== null) {
                postsCompanyImg.setAttribute('src', root + 'storage/company/' + data.user_id + '/' + data.logo);
            } else {
                postsCompanyImg.setAttribute('src', root + 'storage/company/' + data.user_id + '/' + data.top_img);
            }
            postsCompanyLink.appendChild(postsCompanyImg);
            const postsCompanyName = document.createElement('div');
            postsCompanyName.classList.add('company-name', 'ml-3');
            postsCompanyName.textContent = data.name;
            postsCompanyLink.appendChild(postsCompanyName);
            postsHeader.appendChild(postsCompanyLink);
            postsContainer.appendChild(postsHeader);
            const postsBody = document.createElement('div');
            postsBody.classList.add('posts-body', 'w-full', 'flex', 'flex-col');
            const postsImgContainer = document.createElement('div');
            postsImgContainer.classList.add('posts-img-container', 'relative');
            const postsImg = document.createElement('img');
            postsImg.classList.add('posts-img', 'w-full', 'h-full', 'absolute', 'top-0', 'left-0');
            postsImg.setAttribute('src', root + 'storage/company/' + data.user_id + '/' + data.top_img);
            postsImgContainer.appendChild(postsImg);
            postsBody.appendChild(postsImgContainer);
            const postsContent = document.createElement('div');
            postsContent.classList.add('flex', 'justify-between', 'items-center', 'p-3', 'text-sm');
            const followBtn = document.createElement('button');
            followBtn.classList.add('border', 'rounded', 'px-2', 'py-1');
            followBtn.setAttribute('data-bs-target', data.user_id);
            const icon = document.createElement('i');
            icon.classList.add('bi', 'bi-balloon-heart-fill');
            followBtn.appendChild(icon);
            if (typeof Laravel.followed !== 'undefined') {
                if (Laravel.followed.includes(data.user_id)) {
                    followBtn.classList.add('follow-btn', 'followed');
                    followBtn.innerHTML += 'フォロー中'
                } else {
                    followBtn.classList.add('follow-btn');
                    followBtn.innerHTML += 'フォローする'
                }
            } else {
                followBtn.classList.add('not-login');
                followBtn.innerHTML += 'フォローする'
            }
            postsContent.appendChild(followBtn);
            postsBody.appendChild(postsContent);
            const postsText = document.createElement('div');
            postsText.classList.add('text-sm');
            const postsContentType = document.createElement('div');
            postsContentType.classList.add('font-bold');
            if (data.notice !== null) {
                postsContentType.textContent = '【お知らせ】';
            } else if (data.pr !== null) {
                postsContentType.textContent = '【PR】';
            } else if (data.content !== null) {
                postsContentType.textContent = '【事業内容】';
            }
            postsText.appendChild(postsContentType);
            const postsContentText = document.createElement('div');
            postsContentText.classList.add('posts-content', 'content', 'folded', 'px-3', 'h-10');
            postsContentText.setAttribute('id', 'posts-content-' + data.user_id)
            let content;
            if (data.notice !== null) {
                content = data.notice;
            } else if (data.pr !== null) {
                content = data.pr;
            } else if (data.content !== null) {
                content = data.content;
            }
            const viewer = new Editor.factory({
                el: postsContentText,
                viewer: true,
                initialValue: content,
            });
            postsText.appendChild(postsContentText);
            const expandBtnArea = document.createElement('div');
            expandBtnArea.classList.add('p-3', 'text-grey-500');
            const expandBtn = document.createElement('button');
            expandBtn.classList.add('posts-expand');
            expandBtn.setAttribute('data-bs-target', 'posts-content-' + data.user_id);
            expandBtn.innerHTML = '続きを読む';
            postsExpand(expandBtn);
            expandBtnArea.appendChild(expandBtn);
            postsText.appendChild(expandBtnArea);
            postsBody.appendChild(postsText);
            postsContainer.appendChild(postsBody);
            posts.appendChild(postsContainer);
        }
    }
    Laravel.posts_num += 10;
}
window.addEventListener('scroll', () => {
    if (window.scrollY + window.innerHeight >= document.body.clientHeight) {
        postsAdd();
    }
});

document.querySelectorAll('.follow-btn').forEach((el) => {
    el.addEventListener('click', () => {
        followChange(el);
    });
});

document.querySelectorAll('.not-login').forEach((el) => {
    el.addEventListener('click', () => {
        alert('ログインしてください。');
    });
});

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
    filterMerge(document.getElementById('filter_' + target), 'filter-' + target);
});
