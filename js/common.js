(function() {
  'use strict';




/* card04
------------------------------*/

(function() {
  let mySwiper = null;
  const mediaQuery = window.matchMedia('(max-width: 1024px)');

  const checkBreakpoint = (e) => {
    if (e.matches) {
      initSwiper();
    } else if (mySwiper) {
      mySwiper.destroy(false, true);
    }
  }

  const initSwiper = () => {
    mySwiper = new Swiper('.card04 .swiper-a', {
      slidesPerView: 1,
      spaceBetween: 16,
      loop: true,
      loopAdditionalSlides: 1,
      speed: 1000,
      autoplay: {
        delay: 4000,
        disableOnInteraction: false,
      },
      grabCursor: true,
      navigation: {
        nextEl: '.card04 .swiper-a .swiper-button-next',
        prevEl: '.card04 .swiper-a .swiper-button-prev',
      },
      breakpoints: {
        600: {
          slidesPerView: 2,
        }
      },
    });
  };

  mediaQuery.addListener(checkBreakpoint);
  checkBreakpoint(mediaQuery);
}());


(function() {
  let mySwiper, mySlidesPerView;
  let isInited = false;
  const slideLength = document.querySelectorAll('.card04 .swiper-b .swiper-slide').length;

  const breakpoints = [
    {
      breakpoint: 0,
      slidesPerView: 1,
    },
    {
      breakpoint: 600,
      slidesPerView: 2,
    },
    {
      breakpoint: 1025,
      slidesPerView: 4,
    }
  ];
  breakpoints.reverse();

  const checkBreakpoint = () => {
    for (let key in breakpoints) {
      let bp = breakpoints[key]['breakpoint'];
      if (window.matchMedia('(min-width:' + bp + 'px)').matches) {
        mySlidesPerView = breakpoints[key]['slidesPerView'];
        break;
      }
    }

    if (slideLength > mySlidesPerView) {
      if (!isInited) {
        initSwiper();
        isInited = true;
      }
    } else {
      if (isInited) {
        mySwiper.destroy(false, true);
        isInited = false;
      }
    }
  };

  const initSwiper = () => {
    mySwiper = new Swiper('.card04 .swiper-b', {
      slidesPerView: 1,
      spaceBetween: 16,
      loop: true,
      loopAdditionalSlides: 1,
      speed: 1000,
      autoplay: {
        delay: 4000,
        disableOnInteraction: false,
      },
      grabCursor: true,
      navigation: {
        nextEl: '.card04 .swiper-b .swiper-button-next',
        prevEl: '.card04 .swiper-b .swiper-button-prev',
      },
      breakpoints: {
        600: {
          slidesPerView: 2,
        },
        1025: {
          slidesPerView: 4,
          spaceBetween: 32,
        }
      },
    });
  };

  window.addEventListener('resize', function() {
    checkBreakpoint();
  });
  checkBreakpoint();
}());





/* gallery01
------------------------------*/

(function() {
  const mySwiper_thumb = new Swiper('.gallery01 .swiper-thumb', {
    slidesPerView: 5,
    spaceBetween: 8,
    grabCursor: true,
    scrollbar: {
      el: '.gallery01 .swiper-scrollbar',
      draggable: true,
    },
    breakpoints: {
      600: {
        slidesPerView: 7,
      },
    },
  });

  const mySwiper_main = new Swiper('.gallery01 .swiper-main', {
    effect: 'fade',
    fadeEffect: {
      crossFade: true,
    },
    speed: 500,
    navigation: {
      nextEl: '.gallery01 .swiper-button-next',
      prevEl: '.gallery01 .swiper-button-prev',
    },
    thumbs: {
      swiper: mySwiper_thumb,
    },
  });
}());


/* gallery02
------------------------------*/

(function() {
  const thumb = document.querySelectorAll('.gallery02 .thumb-media');

  const switchThumb = (index) => {
    document.querySelector('.gallery02 .thumb-media-active').classList.remove('thumb-media-active');
    thumb[index].classList.add('thumb-media-active');
  }

  const mySwiper = new Swiper('.gallery02 .swiper', {
    effect: 'fade',
    fadeEffect: {
      crossFade: true,
    },
    speed: 500,
    navigation: {
      nextEl: '.gallery02 .swiper-button-next',
      prevEl: '.gallery02 .swiper-button-prev',
    },
    on: {
      afterInit: (swiper) => {
        thumb[swiper.realIndex].classList.add('thumb-media-active');
        for (let i = 0; i < thumb.length; i++) {
          thumb[i].onclick = () => {
            swiper.slideTo(i);
          };
        }
      },
      slideChange: (swiper) => {
        switchThumb(swiper.realIndex);
      },
    }
  });
}());


/* gallery03
------------------------------*/

(function() {
  const slideLength = document.querySelectorAll('.gallery03 .swiper-a .swiper-slide').length;

  const params = {
    slidesPerView: 'auto',
    loop: true,
    loopedSlides: slideLength,
    speed: 6000,
    autoplay: {
      delay: 0,
      disableOnInteraction: false,
    },
    freeMode: {
      enabled: true,
      momentum: false,
    },
    grabCursor: true,
  }

  const initSwiper = () => {
    const mySwiper_a = new Swiper('.gallery03 .swiper-a', {
      ...params,
      on: {
        touchEnd: (swiper) => {
          swiper.slideTo(swiper.activeIndex + 1);
        }
      }
    });

    const mySwiper_b = new Swiper('.gallery03 .swiper-b', {
      ...params,
      autoplay: {
        ...params.autoplay,
        reverseDirection: true
      },
      on: {
        touchEnd: (swiper) => {
          swiper.slideTo(swiper.activeIndex - 1);
        }
      }
    });
  };

  window.addEventListener('load', function(){
    initSwiper();
  });
}());


/* flow01
------------------------------*/

(function() {
  const mySwiper_sub = new Swiper('.flow01 .swiper-sub', {
    spaceBetween: 24,
    grabCursor: true,
    nested: true,
    pagination: {
      el: '.flow01 .swiper-pagination-sub',
      clickable: true,
    },
  });

  const mySwiper_main = new Swiper('.flow01 .swiper-main', {
    spaceBetween: 24,
    centeredSlides: true,
    grabCursor: true,
    pagination: {
      el: '.flow01 .swiper-pagination-main',
      clickable: true,
      renderBullet: (index, className) => {
        let num = ('00' + (index + 1)).slice(-2);
        return '<span class="' + className + '"><span class="step">STEP.</span>' + num + '</span>';
      },
    },
    navigation: {
      nextEl: '.flow01 .swiper-button-next',
      prevEl: '.flow01 .swiper-button-prev',
    },
    breakpoints: {
      1025: {
        spaceBetween: 80,
      }
    },
  });
}());


/* mv01
------------------------------*/

(function() {
  const mySwiper = new Swiper('.mv01 .swiper', {
    effect: 'fade',
    fadeEffect: {
      crossFade: true,
    },
    loop: true,
    loopAdditionalSlides: 1,
    speed: 2000,
    autoplay: {
      delay: 7000,
      disableOnInteraction: false,
      waitForTransition: false,
    },
    followFinger: false,
    pagination: {
      el: '.mv01 .swiper-pagination',
      clickable: true,
    },
  });
}());


/* mv02
------------------------------*/

(function() {
  const myDelay = 7000;
  let timer;

  const switchAnimation = () => {
    clearTimeout(timer);
    let activeSlide = document.querySelectorAll('.mv02 .swiper-slide[class*=-active]');
    for (let i = 0; i < activeSlide.length; i++) {
      activeSlide[i].classList.remove('anm-finished');
      activeSlide[i].classList.add('anm-started');
    }
    timer =  setTimeout(() => {
      for (let i = 0; i < activeSlide.length; i++) {
        activeSlide[i].classList.remove('anm-started');
        activeSlide[i].classList.add('anm-finished');
      }
    }, myDelay - 1000);
  }

  const finishAnimation = () => {
    let activeSlide = document.querySelectorAll('.mv02 .swiper-slide.anm-started');
    for (let i = 0; i < activeSlide.length; i++) {
      activeSlide[i].classList.remove('anm-started');
      activeSlide[i].classList.add('anm-finished');
    }
  }

  const mySwiper = new Swiper('.mv02 .swiper', {
    effect: 'fade',
    fadeEffect: {
      crossFade: true,
    },
    loop: true,
    loopAdditionalSlides: 1,
    speed: 2000,
    autoplay: {
      delay: myDelay,
      disableOnInteraction: false,
      waitForTransition: false,
    },
    followFinger: false,
    pagination: {
      el: '.mv02 .swiper-pagination',
      clickable: true,
    },
    on: {
      slideChange: () => {
        finishAnimation();
      },
      slideChangeTransitionStart: () => {
        switchAnimation();
      },
    }
  });
}());


/* mv03
------------------------------*/

(function() {
  let mySwiper_main;

  const mySwiper_thumb = new Swiper('.mv03 .swiper-thumb', {
    slidesPerView: 4,
    spaceBetween: 0,
    direction: 'vertical',
    roundLengths: true,
    speed: 1000,
    grabCursor: true,
    slideToClickedSlide: true,
    breakpoints: {
      600: {
        spaceBetween: 8,
      },
      1025: {
        spaceBetween: 16,
      }
    },
    thumbs: {
      swiper: mySwiper_main,
    },
  });

  mySwiper_main = new Swiper('.mv03 .swiper-main', {
    direction: 'vertical',
    loop: true,
    loopAdditionalSlides: 1,
    speed: 2000,
    allowTouchMove: false,
    autoplay: {
      delay: 7000,
      disableOnInteraction: false,
      waitForTransition: false,
    },
    thumbs: {
      swiper: mySwiper_thumb,
    },
  });
}());


/* mv04
------------------------------*/

(function() {
  const myDelay = 7000;

  const slide = document.querySelectorAll('.mv04 .swiper-slide');
  const slideLength = slide.length;

  const fraction = document.querySelectorAll('.mv04 .slide-fraction');
  const fractionEl = '<span class="circle"><svg viewBox="0 0 64 64"><circle class="circle-01" cx="50%" cy="50%" r="31"></circle><circle class="circle-02" cx="50%" cy="50%" r="31"></circle></svg></span><span class="current"></span><span class="total">' + slideLength + '</span>';
  for (let i = 0; i < fraction.length; i++) {
    fraction[i].insertAdjacentHTML('beforeend', fractionEl);
  }

  const slideDelay = [];
  for (let i = 0; i < slideLength; i++) {
    let delay = Number(slide[i].getAttribute('data-swiper-autoplay'));
    slideDelay[i] = delay ? delay : myDelay;
    slide[i].querySelector('img').style.transitionDuration = slideDelay[i] + 'ms';
    slide[i].querySelector('.circle-02').style.animationDuration = slideDelay[i] + 'ms';
    slide[i].querySelector('.current').textContent = i + 1;
  }

  const progressBar = document.querySelector('.mv04 .progressbar-fill');
  const updateProgress = (index) => {
    let start = Math.floor(index / slideLength * 100) / 100;
    let end = Math.floor((index + 1) / slideLength * 100) / 100;

    progressBar.style.transition = '';
    progressBar.style.transform = 'scaleX(' + start + ')';
    setTimeout(() => {
      progressBar.style.transition = slideDelay[index] + 'ms linear';
      progressBar.style.transform = 'scaleX(' + end + ')';
    }, 100);
  }

  const mySwiper = new Swiper('.mv04 .swiper', {
    effect: 'fade',
    fadeEffect: {
      crossFade: true,
    },
    loop: true,
    loopAdditionalSlides: 1,
    speed: 1000,
    autoplay: {
      delay: myDelay,
      disableOnInteraction: false,
      waitForTransition: false,
    },
    followFinger: false,
    navigation: {
      nextEl: '.mv04 .swiper-button-next',
      prevEl: '.mv04 .swiper-button-prev',
    },
    on: {
      afterInit: () => {
        updateProgress(0);
      },
      realIndexChange: (swiper) => {
        updateProgress(swiper.realIndex);
      },
    }
  });

}());


/* mv05
------------------------------*/

(function() {
  const myDelay = 7000;

  const slideLength = document.querySelectorAll('.mv05 .swiper-slide').length;
  const total = ('00' + slideLength).slice(-2);

  const fractionNum = document.querySelector('.mv05 .fraction .num');
  const fractionTotal = document.querySelector('.mv05 .fraction .total');
  fractionTotal.textContent = total;

  const updateFraction = (index) => {
    let current = ('00' + (index + 1)).slice(-2);
    fractionNum.classList.add('anm-started');
    setTimeout(() => {
      fractionNum.textContent = current;
    }, 400);
  }

  const startAnimation = (index) => {
    let activeSlide = document.querySelectorAll('.mv05 .content')[index];
    activeSlide.classList.remove('anm-finished');
    activeSlide.classList.add('anm-started');
  }

  const finishAnimation = () => {
    let activeSlide = document.querySelector('.mv05 .content.anm-started');
    if (activeSlide) {
      activeSlide.classList.remove('anm-started');
      activeSlide.classList.add('anm-finished');
    }
  }

  const mySwiper = new Swiper('.mv05 .swiper', {
    loop: true,
    loopAdditionalSlides: 1,
    speed: 3000,
    autoplay: {
      delay: myDelay,
      disableOnInteraction: false,
      waitForTransition: false,
    },
    followFinger: false,
    observeParents: true,
    on: {
      slideChange: (swiper) => {
        updateFraction(swiper.realIndex);
        finishAnimation();
      },
      slideChangeTransitionStart: (swiper) => {
        startAnimation(swiper.realIndex);
      },
      slideChangeTransitionEnd: () => {
        fractionNum.classList.remove('anm-started');
      },
    }
  });

}());

})();
