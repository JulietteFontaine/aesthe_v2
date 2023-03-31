// fixed scrollbar
// if(window.innerWidth>1024 && !is_touch_device() && document.querySelector('body').scrollWidth>document.querySelector('body').offsetWidth) document.querySelector('html').classList.add('widthFixedScrollbar');

window.addEventListener("DOMContentLoaded", function () {
// MENU HEADER
    document.querySelectorAll('.page_item_has_children').forEach((item, index) => {
        item.addEventListener('click', event => {
        if(window.innerWidth <= 810){
            if(document.querySelector('.page_item_has_children.open') && !item.classList.contains('open')){
                document.querySelector('.page_item_has_children.open').classList.remove('open')
                setTimeout(()=>{
                    item.classList.toggle('open')
                }, 600)
            } else item.classList.toggle('open')
        }
    })
})

    const burger = document.querySelector('.burger');
    const items = document.querySelectorAll('.menu-full-header-container');
    const body =  document.querySelector('body');

    burger.addEventListener('click', (e)=>{

        if(burger.classList.contains('close')){
        burger.classList.toggle('open');
        burger.classList.remove('close');
        body.classList.add('fixed-position');

        items.forEach(e => {
            e.classList.toggle('open');
            e.classList.remove('close');
        });
        
        }
        else if(burger.classList.contains('open')){
        burger.classList.toggle('close');
        burger.classList.remove('open');
        body.classList.remove('fixed-position');

        items.forEach(e => {
            e.classList.toggle('close');
            e.classList.remove('open');  
        });
    }

})
// END MENU HEADER

// PRESTATIONS
if (document.querySelector('.offreTop')) {
    var zonePrestation = tns({ controls:false, container: document.querySelector('.offreTop__informations'), mode: "gallery", speed: 800});
        
    zonePrestation.events.on('indexChanged', ()=>{
        let index = zonePrestation.getInfo().index
        let slides = document.querySelectorAll('.offreTop__controls li')
        document.querySelector('.offreTop__controls li.active').classList.remove('active')
        
        slides[index%slides.length].classList.add('active')

    });

    document.querySelectorAll('.offreTop__controls li').forEach((item, index) => {
        item.addEventListener('click', event => {
            if(!item.classList.contains('active')){
                zonePrestation.goTo(index);
            }
        })
    })
}
// END PRESTATION

// FAQ
if(document.querySelector('.faq')){
    const faq = document.querySelectorAll('.faq li');
    Array.prototype.forEach.call(document.querySelectorAll('.faq li'), function (el, i) {
        el.addEventListener('click', function () {

            faq.forEach(e => {
                if ((el != e) && (e.classList.contains('on'))) {
                    e.classList.remove('on');
                    e.classList.add('close');
                    }
            });

            if (el.classList.contains('on')) {

                el.classList.remove('on')
                el.classList.add('close')
            }
            else {
                el.classList.remove('close')
                el.classList.add('on')
            }
        })
    })
}
// END FAQ
// QUESTIONS TABS
if(document.querySelector('.questionsTabs__list')){
    const tabs = document.querySelectorAll('.questionsTabs__list');
    Array.prototype.forEach.call(document.querySelectorAll('.questionsTabs__list'), function (el, i) {
        
        el.addEventListener('click', function () {
            
            tabs.forEach(e => {
                if ((el != e) && (e.classList.contains('on'))) {
                    e.classList.remove('on');
                    e.classList.add('close');
                    }
            });
    
            if (el.classList.contains('on')) {
    
                el.classList.remove('on')
                el.classList.add('close')
            }
            else {
                el.classList.remove('close')
                el.classList.add('on')
            }
        })
    })
    }
    // END QUESTIONS TABS
    
    // MOSAIC POP UP
    if (document.querySelector('.mosaic') && screen.width <= 990) {
    const triggers = document.getElementsByClassName("mosaic__controls__case");
    const triggerArray = Array.from(triggers).entries();
    
    const modals = document.getElementsByClassName("mosaic__informations");
    
    const closeBtns = document.getElementsByClassName("btn-close");
    // const body =  document.querySelector('body');
    
    for (let [index, trigger] of triggerArray) {
        const toggleModal = () => {
    
        modals[index].classList.toggle('show-modal');
        closeBtns[index].classList.toggle('show-modal');
        modals[index].classList.toggle('fixed-position');
        }
    
        trigger.addEventListener("click", toggleModal);
        closeBtns[index].addEventListener("click", toggleModal);
      }
    }
    // END MOSAIC POP UP
    if (document.querySelector('.mosaic') && screen.width >= 1000) {
        var mosaic = tns({ controls:false, container: document.querySelector('.mosaic__informations__slider'), mode: "gallery", speed: 800});
            
        mosaic.events.on('indexChanged', ()=>{
            let index = mosaic.getInfo().index
            let slides = document.querySelectorAll('.mosaic__controls li')
            document.querySelector('.mosaic__controls li.active').classList.remove('active')
            
            slides[index%slides.length].classList.add('active')
    
        });
    
        document.querySelectorAll('.mosaic__controls li').forEach((item, index) => {
            item.addEventListener('click', event => {
                if(!item.classList.contains('active')){
                    mosaic.goTo(index);
                }
            })
        })
    }
    
    // CARDS
    if(document.querySelector('.card')){
    
        const cards = document.querySelectorAll(".card");
        
        cards.forEach(card => {
            
            const btn = card.children[0]
            const content = card.children[1].children[1].children[1]
            const circle = card.children[1].children[0].children[0]
    
            card.onclick = function () {
    
               cards.forEach(e => {
                    if ((card != e) && e.children[0].classList.contains('on')) {
                        e.children[0].classList.remove('on');
                        e.children[1].children[1].children[1].classList.remove('show');
                        e.children[1].children[0].children[0].remove('show')
                        }
                });
    
                btn.classList.toggle('on');
                content.classList.toggle('show');
                circle.classList.toggle('show');
    
            }
        });
    
    }
    // END CARDS
    
    // SLIDER CARDS
    var sliderCardsThree = [];
    if(document.querySelector('.sliderCards')){
            var sliderCardsTwo = [];
            //three items
            document.querySelectorAll('.sliderCards.three').forEach((item, i)=>{
            sliderCardsThree[i] = tns({
                container: item.querySelector('.sliderCards__container.three'),
                controlsPosition : "bottom",
                loop: false,
                controls: true,
                controlsContainer : item.querySelector(".sliderCards__controls.three"),
                preventScrollOnTouch: "auto",
                nav: false,
                responsive: {
                        0: {
                            mouseDrag: true,
                            edgePadding: 40,
                        },
                        1000: {
                            mouseDrag: false,
                            items : 3,
                            edgePadding: 5,
                            },
                    },
            });
            });
    
            //two items
            document.querySelectorAll('.sliderCards.two').forEach((item, i)=>{
                console.log(item.querySelector('.sliderCards__controls'));
                console.log(item.querySelector('.sliderCards__container.two'));
                sliderCardsTwo[i] = tns({
                    container: item.querySelector('.sliderCards__container.two'),
                    controlsPosition : "bottom",
                    controls: true,
                    loop: false,
                    controlsContainer : item.querySelector('.sliderCards__controls'),
                    prevButton: item.querySelector('.sliderCards__controls--prev'),
                    nextButton: item.querySelector('.sliderCards__controls--next'),
                    preventScrollOnTouch: "auto",
                    nav: false,
                    responsive: {
                            0: {
                                mouseDrag: true,
                                edgePadding: 40,
                            },
                            1000: {
                                mouseDrag: false,
                                items: 2,
                                edgePadding: 5,
                                },
                        },
                });
                });
        }
    // END SLIDER CARDS
    
    // SITE REVIEWS
    if(document.querySelector('.glsr')){
        let reviewsEl = document.querySelector('.give-review')
        if(reviewsEl){
            reviewsEl.addEventListener('click', event => {
            let form = document.querySelector('form.customised-review-form')
            let separator = document.querySelector('.glsr-form-wrap-separator');
            
            form.classList.toggle('on');
    
            if (form.classList.contains('on')) {
            form.style.maxHeight = form.scrollHeight + 90 +'px'
            form.style.paddingTop = '30px'
            form.style.paddingBottom = '30px'
            separator.style.width = '77px';
            } else if (!(form.classList.contains('on'))) {
            form.style.maxHeight = '0px'
            form.style.paddingTop = '0px'
            form.style.paddingBottom = '0px'
            separator.style.width = '0px';
            }
    
        })}
    }
    // END SITE REVIEWS
    
    // AVANT APRES
    if(document.querySelector('.avantApres')){
        var divisor = document.querySelector(".avantApres__image__after"),
            slider = document.getElementById("avantApres__range");
            slider.addEventListener('input', event => {
            divisor.style.width = slider.value+"%";
        })
    }
    // END AVANT APRES
    
    // TARIFF CARDS
        if (document.querySelector('.tarifsCards')) {
    
            let tarifcards = document.querySelectorAll(".tarifsCard");
    
            let i = 1;
            tarifcards.forEach(tcard => {
                
                tcard.onclick = function () {
                    
                    tarifcards.forEach(e => {
                        if (tcard != e) {
                            e.children[1].classList.remove("on");
                            }
                    });
    
                    tcard.children[1].classList.toggle("on");
                    tcard.classList.remove("on");
    
                    
                }
                
                let prevcard = tarifcards[i - 1];
                console.log(prevcard.offsetHeight);
    
                if (window.screen.width > 1000) {
                    tcard.onmouseover = function () {
                        if (tcard.lastElementChild.classList.contains('on') === false) {
                            tcard.classList.add("on");
                        }
                    }
    
                    tcard.onmouseout = function () {
                        tcard.classList.remove("on");
                    }
                };
    
                i++;
            })
        }
    // END TARIFF CARDS
    
    // SMOOTH SCROLL
    $('a[href*="#"]')
      .not('[href="#"]')
      .not('[href="#0"]')
      .click(function(event) {
        // On-page links
        if (
          location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
          && 
          location.hostname == this.hostname
        ) {
          // Figure out element to scroll to
          var target = $(this.hash);
          target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
          // Does a scroll target exist?
          if (target.length) {
            // Only prevent default if animation is actually gonna happen
            event.preventDefault();
            $('html, body').animate({
              scrollTop: target.offset().top
            }, 1000, function() {
              // Callback after animation
              // Must change focus!
              var $target = $(target);
              $target.focus();
              if ($target.is(":focus")) { // Checking if the target was focused
                return false;
              } else {
                $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
                $target.focus(); // Set focus again
              };
            });
          }
        }
      });
    // END SMOOTH SCROLL
    
    // BUTTON RDV ON SCROLL
    if (document.querySelector('.offreTop')) {
    
    let scrollpos = window.scrollY
    const button = document.querySelector(".cta-onscroll")
    const scrollChange = 1000;
    
    const add_class_on_scroll = () => {
        button.classList.add("-translate-x-0")
        button.classList.remove("-translate-x-full")
    }
    
    const remove_class_on_scroll = () => {
        button.classList.add("-translate-x-full")
        button.classList.remove("-translate-x-0")
    }
    
    window.addEventListener('scroll', function() { 
      scrollpos = window.scrollY;
    
        if (scrollpos >= scrollChange) {
            add_class_on_scroll()
        }
        else { remove_class_on_scroll() }
    })
    }
    // END BUTTON RDV ON SCROLL
    
    // CIRCLE PAGE CONSEIL & BLOG 
      if (document.querySelector('.conseilPage') || document.querySelector('.blogPage')) {
    
        let scrollpos = window.scrollY
        
        const circleOne = document.querySelector(".circle--one")
        const circleTwo = document.querySelector(".circle--two")
        const circleThree = document.querySelector(".circle--three")
    
        const scrollChange = 200;
        
        const add_class_on_scroll = (el) => {
            el.classList.add("-translate-x-0")
            el.classList.remove("-translate-x-full")
        }
    
        const remove_class_on_scroll = (el) => {
            el.classList.add("-translate-x-full")
            el.classList.remove("-translate-x-0")
        }
        
        window.addEventListener('scroll', function() { 
          scrollpos = window.scrollY;
        
            if (scrollpos >= scrollChange) {
                add_class_on_scroll(circleOne);
            }
            else {
                remove_class_on_scroll(circleOne);
                remove_class_on_scroll(circleThree);
            }
    
            if (scrollpos >= (scrollChange + 400) ) {
                add_class_on_scroll(circleTwo);
            }
            else {
                remove_class_on_scroll(circleTwo);
            }
    
            if (scrollpos >= (scrollChange + 800) ) {
                add_class_on_scroll(circleThree);
            }
            else {
                remove_class_on_scroll(circleThree);
            }
    
        })
        }
    // END CIRCLE PAGE CONSEIL & BLOG
    
// BLOCK UNIVERS 
    gsap.registerPlugin(ScrollTrigger);
    // Block univers
    if (document.querySelector('.universScrolling')) {
    // MOBILE
    if  (screen.width <= 990) {
        for(let i=0; i<10; i++) {
    
            let triggerItem =".universScrolling__title.--0" + (i+1) ;
    
            if(i%2 == 0) {
                gsap.to( triggerItem, {
                    scrollTrigger: {
                        trigger : triggerItem ,
                        toggleActions : "play",
                        star : "top center",
                        // markers : true
                    },
                    xPercent: 65,
                    duration: 2
                })
    
            } else {
                gsap.to(triggerItem, {
                    scrollTrigger: {
                        trigger : triggerItem ,
                        toggleActions : "play",
                        star : "top center"
                    },
                    xPercent: -155,
                    duration: 2.5
                })
            }
        }
    }
    // WEB
    if  (screen.width >= 1000) {
        for(let i=0; i<10; i++) {
    
            let triggerItem =".universScrolling__title.--0" + (i+1) ;
    
            if(i%2 == 0) {
                gsap.to( triggerItem, {
                    scrollTrigger: {
                        trigger : triggerItem ,
                        toggleActions : "play",
                        star : "top center",
                        // markers : true
                    },
                    xPercent: 40,
                    duration: 2
                })
    
            } else {
                gsap.to(triggerItem, {
                    scrollTrigger: {
                        trigger : triggerItem ,
                        toggleActions : "play",
                        star : "top center"
                    },
                    xPercent: -105,
                    duration: 2.5
                })
            }
        }
    }
        const item = document.querySelectorAll('.universScrolling__title');
        Array.prototype.forEach.call(document.querySelectorAll('.universScrolling__title'), function (el, i) {
            
            el.addEventListener('click', function () {
    
                item.forEach(i => {
                    if ((i != el) && i.children[2].classList.contains('on')) {
                        i.children[2].classList.remove('on');
                        i.children[2].classList.add('close');
                    }
                    });
    
                    if (el.children[2].classList.contains('on')) {
    
                        el.children[2].classList.remove('on');
                        el.children[2].classList.add('close');
    
                        }
                        
                    else 
                    {
                        el.children[2].classList.add('on');
                        el.children[2].classList.remove('close');
                    }
                    // else {
                    //     el.children[2].classList.add('on');
                    //     el.children[2].classList.remove('close');
                    // }
    
            })
        })
    
    }
// End Block univers
   
// Block univers image parallax
    $('.img-parallax').each(function(){
        var img = $(this);
        var imgParent = $(this).parent();
        function parallaxImg () {
          var speed = img.data('speed');
          var imgY = imgParent.offset().top;
          var winY = $(this).scrollTop();
          var winH = $(this).height();
          var parentH = imgParent.innerHeight();
      
          // The next pixel to show on screen      
          var winBottom = winY + winH;
      
          // If block is shown on screen
          if (winBottom > imgY && winY < imgY + parentH) {
            // Number of pixels shown after block appear
            var imgBottom = ((winBottom - imgY) * speed);
            // Max number of pixels until block disappear
            var imgTop = winH + parentH;
            // Porcentage between start showing until disappearing
            var imgPercent = ((imgBottom / imgTop) * 100) + (50 - (speed * 50));
          }
          img.css({
            top: imgPercent + '%',
            transform: 'translate(-50%, -' + imgPercent + '%)'
          });
        }
        $(document).on({
          scroll: function () {
            parallaxImg();
          }, ready: function () {
            parallaxImg();
          }
        });
      });
// End Block univers image parallax

// PRESENTATION CARDS
    if(document.querySelector('.presentationCards__card__focus__tab')){
        const pres_tab = document.querySelectorAll('.presentationCards__card__focus__tab');
        Array.prototype.forEach.call(document.querySelectorAll('.presentationCards__card__focus__tab'), function (el, i) {
            el.addEventListener('click', function () {

                pres_tab.forEach(e => {
                    if ((el != e) && (e.classList.contains('on'))) {
                        e.classList.remove('on');
                        e.classList.add('close');
                        }
                });

                if (el.classList.contains('on')) {

                    el.classList.remove('on')
                    el.classList.add('close')
                }
                else {
                    el.classList.remove('close')
                    el.classList.add('on')
                }
            })
        })

        if(window.innerWidth <= 999) {

            var SliderCardPres = document.querySelectorAll('.presentationCards__cards');
        
            SliderCardPres.forEach.call(document.querySelectorAll('.presentationCards'), function(el, i){
                console.log(SliderCardPres[i]);
                SliderCardPres[i] = tns({
                container: el.querySelector(".presentationCards__cards"),
                controls: true,
                loop: false,
                controlsContainer: el.querySelector(".presentationCards__controls"),
                preventScrollOnTouch: "auto",
                nav: false,
            });
        });
        }
    }
// END PRESENTATION CARDS

// BADGES CONFIANCE
if (document.querySelector('.sliderBadgesGallery')) {
    const sliderBadges = tns({
        container: '.sliderBadgesGallery',
        slideBy: 1,
        autoplay: true,
        speed: 700,
        loop: true,
        nav: false,
        controls: false,
        preventScrollOnTouch: "auto",
        touch: false,
        mouseDrag: false,
        controls: false,
                    responsive: {
                0: {
                    items: 2,
                    gutter: 20,
                },
                1000: {
                    items: 5,
                    // gutter: 100,
                    // fixedWidth: 100
                    },
            },
    });

}
// END BADGES CONFIANCE

})
