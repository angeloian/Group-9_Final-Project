let userBox = document.querySelector('.header .flex .account-box');

document.querySelector('#user-btn').onclick = () =>{
    userBox.classList.toggle('active');
    navbar.classList.remove('active');
}

let navbar = document.querySelector('.header .flex .navbar');

document.querySelector('#menu-btn').onclick = () =>{
    navbar.classList.toggle('active');
    userBox.classList.remove('active');
}

window.onscroll = () =>{
    userBox.classList.remove('active');
    navbar.classList.remove('active');
}

document.addEventListener("DOMContentLoaded", function() {
  var visaRadio = document.getElementById("visa");
  var mastercardRadio = document.getElementById("mastercard");

  visaRadio.addEventListener("click", function() {
    window.location.href = "checkout.php";
  });

  mastercardRadio.addEventListener("click", function() {
    window.location.href = "onlinepayment.php";
  });
});

document.addEventListener("DOMContentLoaded", function() {
  var codRadio = document.getElementById("cod");
  var onlinepaymentRadio = document.getElementById("onlinepayment");

  codRadio.addEventListener("click", function() {
    window.location.href = "customize.php"; 
  });

  onlinepaymentRadio.addEventListener("click", function() {
    window.location.href = "customized_onlinepayment.php";
  });
});

var containerSwiper = new Swiper(".container-slide", {
    spaceBetween: 30,
    centeredSlides: true,
    autoplay: {
      delay: 7500,
      disableOnInteraction: false,
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    loop: true
  });
  
  var reviewSwiper = new Swiper(".review-slider", {
    spaceBetween: 20,
    centeredSlides: true,
    autoplay: {
      delay: 3000,
      disableOnInteraction: false,
    },
    loop: true,
    breakpoints: {
      0: {
        slidesPerView: 1,
      },
      640: {
        slidesPerView: 2,
      },
      768: {
        slidesPerView: 2,
      },
      1024: {
        slidesPerView: 3,
      }
    }
  });

  