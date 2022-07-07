const mobileMenuId = "mobile-menu";

const mobileMenuClickHandler = document.querySelector('[aria-controls="' + mobileMenuId + '"]');

if (mobileMenuClickHandler) {
    mobileMenuClickHandler.addEventListener('click', e => {
        document.querySelector('#' + mobileMenuId).classList.toggle('hidden')
    })
}
