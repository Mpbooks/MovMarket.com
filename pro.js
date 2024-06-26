function copyMenu(){
    var dptCategory= document.querySelector('.dpt-cat');
    var dptPlace = document.querySelector('.departments')
    dptPlace.innerHTML=dptCategory.innerHTML;

    var mainNav = document.querySelector('.header-nav nav');
    var navPlace = document.querySelector('.off-canvas nav')
    navPlace.innerHTML= mainNav.innerHTML;

    var topNav = document.querySelector('.header-top .wrapper');
    var topPlace = document.querySelector('.off-canvas .thetop-nav')
    topPlace.innerHTML = topNav.innerHTML
}
copyMenu();

//mostrar menu
const menuButton = document.querySelector('.trigger'),
    closeButton = document.querySelector('.t-close'),
    addclass = document.querySelector(".site");
menuButton.addEventListener('click', function(){
    addclass.classList.toggle('showmenu')
})
closeButton.addEventListener('click', function(){
    addclass.classList.remove('showmenu')
})

//menu completo
const submenu = document.querySelectorAll('.has-child .icon-small');
submenu.forEach(menu => menu.addEventListener('click', toggle));

function toggle(e){
    e.preventDefault();
    submenu.forEach((item) => item != this ? item.closest('.has-child').classList.remove('expand') : null);
    if (this.closest('.has-child').classList !='expand');
    this.closest('.has-child').classList.toggle('expand')
}

//slider
const swiper = new Swiper('.swiper', {
    // Optional parameters
    direction: 'horizontal',
    loop: true,
  
    // If we need pagination
    pagination: {
      el: '.swiper-pagination',
    },
  
    // Navigation arrows
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
  
    // And if we need scrollbar
    scrollbar: {
      el: '.swiper-scrollbar',
    },

      // Configurações de autoplay
      autoplay: {
        delay: 9000, // Tempo em milissegundos (5 segundos neste exemplo)
        disableOnInteraction: false, // Para a reprodução automática ao interagir com o swiper
      },

      // Configurações de transição
    speed: 1000, // Tempo da transição em milissegundos (1 segundo neste exemplo)
  });