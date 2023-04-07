let order = []
const categorySlider = new Swiper('#swiper-category', {
    slidesPerView: 'auto',
    spaceBetween: 12,
    loop: false,
});

const sizeSlider = new Swiper('#swiper-size', {
    slidesPerView: 'auto',
    spaceBetween: 12,
    loop: false,
});


const imagesSlider = new Swiper('#images-slider', {
    pagination: {
        el: '.swiper-pagination',
        type: 'bullets',
    },
});

$('.btn-view-more-detail').click(function() {
    if ($('.products-content-text').hasClass('short')) {
        $(this).html('Lihat Lebih Ringkas')
    } else {
        $(this).html('Lihat Selengkapnya')

    }
    $('.products-content-text').toggleClass('short')
})

var custom = {}

$('.variant-block').click(function(x) {
    $('.variant-block').each((e,f) => {
        if(x.target.parentNode.parentNode == f.parentNode.parentNode) {
            $(f).removeClass('selected')
        }
    })
    custom[$(this).attr('data-variant')] = $(this).html()
    $(this).toggleClass('selected')
})

$('.close-popup-notification').click(function() {
    $('.popup-notification-wrapper').toggleClass('d-none')
})

$('.buy-now').click(function() {
    let i = 0
    let text = ''
    let name = $('.products-detail-name').html()
    let url = $(this).attr('data-whatsapp')

    $('.variant-block').each((e,f) => {
        i += $(f).hasClass('selected') ? 1 : 0
    })
    if($('.category-section').length != i) {
        alert('Pilihan Tidak Boleh Kosong!')
    }else{
        let variations = ''
        Object.keys(custom).forEach((e,f) => {
            variations+= `${e} ${custom[e]}\n`
        })

        text = `Halo min, Apakah *${name}* Masih Ready?\nSaya Ingin membeli *${name}* dengan variasi : \n${variations}`

        window.location.href = url+'?text='+text
    }
})

$('#add-to-cart').click(function() {
    let i = 0
    let name = $('.products-detail-name').html()
    let url = $(this).attr('data-whatsapp')

    $('.variant-block').each((e,f) => {
        i += $(f).hasClass('selected') ? 1 : 0
    })
    if($('.category-section').length != i) {
        alert('Pilihan Tidak Boleh Kosong!')
    }else{
        let id = $('.product-detail-id').html()
        let cart = window.localStorage.getItem('data-cart')
        cart = JSON.parse(cart)

        newCart = {}
        newCart[id] = custom
        
        if(cart == null) {
            cart = JSON.stringify([newCart])
        }else{
            cart.push(newCart)
            cart = JSON.stringify(cart)
        }

        if(token == null) {

        }else{

            // ajax to api add cart
            $.ajax({
                url: location.origin+'/api/cart',
                type:'post',
                dataType:'json',
                data:{cart:cart},
                headers:{
                    Authorization: 'Bearer '+token
                },
                success: function(res) {
                    
                    console.log(res)
                    window.localStorage.setItem('data-cart', cart)

                },error: function(err) {
                    console.log(err)
                }
            })

        }

        $('.popup-notification-wrapper').toggleClass('d-none')
    }
})

$('#check-all').change(function() {
    $('input:checkbox').prop('checked', this.checked);
    updateAmountTotal()
})

$('.check-item').click(e=>{
    let t = $('.zakat-main-value').html()
    t = t.replace('Rp','').replace('.','')
    updateAmountTotal()
})

function updateAmountTotal() {
    let total = 0
    let y = []
    
    $('.check-product').each((k,x)=>{
        let p = $(x).parent().find('.order-item-green').html()
        let q = $(x).parent().find('.quantity-number').val()
        let o = $(x).parent().find('.order-item-name').html()
        let v = $(x).parent().find('.order-variations').html()
        p = p.replace('Rp ','').replace('.','')
        if($(x).prop('checked')) {
            y.push({
                name: o,
                quantity: q,
                nominal: p,
                variation: v,
            })
            total += (parseInt(p) * parseInt(q))
        }
    })
    order = y

    $('.zakat-main-value').html('Rp'+convertToRupiah(total))
}

$('.btn-pay-donation').click(e=>{
    let url = $(e.target).attr('data-whatsapp')
    let chat = 'Halo min, Apakah Masih Ready?\n'
    order.forEach((x,k)=>{
        chat += `Saya Ingin membeli *${x.name}* sebanyak *${x.quantity}* `
        if(x.variation != '') {
            chat += `dengan variasi *${x.variation}*`
        }
        if(k == order.length -1 == false) {
            chat += 'dan juga'
        }
        chat += `\n`
    })

    window.location.href = url+'?text='+chat
})