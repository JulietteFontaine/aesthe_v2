// fixed scrollbar
// if(window.innerWidth>1024 && !is_touch_device() && document.querySelector('body').scrollWidth>document.querySelector('body').offsetWidth) document.querySelector('html').classList.add('widthFixedScrollbar');

window.addEventListener("DOMContentLoaded", function () {

    //MENU HEADER
    document.querySelectorAll('.menu-item-has-children').forEach((item, index) => {
        item.addEventListener('click', event => {
        console.log(item.classList);
        if(window.innerWidth <= 810){
            if(document.querySelector('.menu-item-has-children.open') && !item.classList.contains('open')){
                document.querySelector('.menu-item-has-children.open').classList.remove('open')
                setTimeout(()=>{
                    item.classList.toggle('open')
                }, 600)
            } else item.classList.toggle('open')
        }
    })
})

const burger = document.querySelector('.burger');
const items = document.querySelector('.menu-mobile-header-container')

burger.addEventListener('click', (e)=>{
    if(burger.classList.contains('open')){
        burger.classList.remove('open')
        burger.classList.add('close')
        items.classList.remove('open')
        items.classList.add('close')
    }else if(burger.classList.contains('close')){
        burger.classList.add('open')
        burger.classList.remove('close')
        items.classList.remove('close')
        items.classList.add('open')
    }else{
        burger.classList.add('open')
        items.classList.add('open')
    }
//     document.querySelector('.siteHeader__nav__container').classList.toggle('open')
//     document.querySelector('.menu-item-has-children.open')? document.querySelector('.menu-item-has-children.open').classList.remove('open'): false ;
})

// window.addEventListener('click', function(e){
//     if (!document.querySelector('.siteHeader').contains(e.target) && document.querySelector('.siteHeader__nav__container').classList.contains('open') ){
//         document.querySelector('.siteHeader__nav__container').classList.toggle('open')
//         if (document.querySelector('.menu-item-has-children.open')) document.querySelector('.menu-item-has-children.open').classList.remove('open')
//         document.querySelector('.burger').classList.remove('open')
//         document.querySelector('.burger').classList.add('close')
//     }
// })
// END MENU HEADER

})