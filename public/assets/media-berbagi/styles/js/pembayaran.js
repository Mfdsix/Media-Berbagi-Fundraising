// COPY NOMINAL & REKENING
function copyToClipboard(inputClass) {
    const copyText = document.querySelector(`.${inputClass}`);
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    let copyed = copyText.value.replace('.','')
    navigator.clipboard.writeText(copyed);
    if(inputClass == 'page-main-va__input__nominal') {
      $('.disalin').toast('show');
    }else{
      $('.nomorva').toast('show')
    }
  }

// TOGGLE ACCORDION
$(".page-main-va__accordion-trigger").click(function () {
  $(this).parent().siblings().find("svg").css({ transform: "rotate(0deg)" });
  $(this)
    .parent()
    .siblings()
    .find(".page-main-va__accordion__item")
    .slideUp(200);
  $(this).find("svg").css({ transform: "rotate(180deg)" });
  $(this).next().slideDown(200);
});
