let x = {}
function updateAmount(amount) {
    let rupiah = convertToRupiah(amount);
    $('.quantity-amount').html(`Rp${rupiah}`)    
    console.log(x)
}

$('.quantity-plus').click(function() {
    let count = parseInt($(this).prev().val())+1;
    $(this).prev().val(count)
    let p = $(this).parent().find('.quantity-id').val()

    var amount = 0
    for (let i = 0; i < $('.quantity-number').length; i++) {
        let _x = $($('.quantity-id')[i]).val()
        if(p == _x) {
            if(x[$($('.quantity-id')[i]).val()] == undefined || x[$($('.quantity-id')[i]).val()] == 0) {
                x[$($('.quantity-id')[i]).val()] = 1
            }else{
                x[$($('.quantity-id')[i]).val()]++
            }
        }
        var c = $('.quantity-number')[i];
        c= c.value

        for (let j = 0; j < $('.price').length; j++) {
            var k = $('.price')[j];
            k = k.textContent
            k =k.replace("Rp ","");
            k =k.replaceAll(".","");
          
            if (i == j) {
                var a = Number(k)*Number(c)
                amount = a+amount;
            }
            
        }
    }

    updateAmount(amount)
    
})

$('.quantity-minus').click(function() {
    var val = 0;
    let p = $(this).parent().find('.quantity-id').val()

    for (let i = 0; i < $('.quantity-number').length; i++) {
        let _x = $($('.quantity-id')[i]).val()
        if(p == _x) {
            if(x[$($('.quantity-id')[i]).val()] > 0) {
                x[$($('.quantity-id')[i]).val()]--
            }
        }
        var c = $('.quantity-number')[i];
        var c = c.value
       val = Number(c) + Number(val)
    }
       
    if(parseInt($(this).next().val()) > 0) {
        
        let count = parseInt($(this).next().val())-1;
        $(this).next().val(count)

        updateAmount($(this).next().data('amount')*(val-1))
    }
})

$('.execute').click(function () {
    let amount = $('.quantity-amount').html()
    amount = amount.replace('Rp','')
    amount = amount.replaceAll('.','')
    en = ('nominal?n='+amount)+'&q='+btoa(JSON.stringify(x))
    location.href = '/qurban/pay/'+en
})

