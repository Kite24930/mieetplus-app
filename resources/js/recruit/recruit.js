import Swiper from "swiper/bundle";
import 'swiper/css/bundle';
import { Modal } from "flowbite";
import ProgressBar from 'progressbar.js';
import 'bootstrap-icons/font/bootstrap-icons.css';
import '../app.js';
import '../../css/recruit/recruit.css';

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
        realIndexChange: () => {
            bar1.set(0);
            bar1.animate(1.0);
            bar2.set(0);
            bar3.set(0);
        },
    }
});

let insideSwiper = [];

document.querySelectorAll('.insideSwiper').forEach((el) => {
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
});

document.querySelectorAll('.teller-btn').forEach((el) => {
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
});

document.getElementById('modalClose').addEventListener('click', () => {
    modal.hide();
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
window.addEventListener('load', frameFunction);

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
