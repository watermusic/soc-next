const mobileMenuId = "mobile-menu";

const mobileMenuClickHandler = document.querySelector('[aria-controls="' + mobileMenuId + '"]');

mobileMenuClickHandler.addEventListener('click', e => {
    document.querySelector('#' + mobileMenuId).classList.toggle('hidden')
})
