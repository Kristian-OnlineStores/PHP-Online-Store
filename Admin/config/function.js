// functions.js

                          //////// Goods /////////

function toggleDiscountField() {
    var checkbox = document.getElementById('saleCheckbox');
    var discountField = document.getElementById('discountField');
    var pricePreview = document.getElementById('pricePreview');
    
    if (checkbox && checkbox.checked) {
        if (discountField) discountField.style.display = 'block';
        if (pricePreview) pricePreview.style.display = 'block';
    } else {
        if (discountField) discountField.style.display = 'none';
        if (pricePreview) pricePreview.style.display = 'none';
        var finalPrice = document.getElementById('finalPrice');
        if (finalPrice) finalPrice.innerHTML = '';
    }
}

function updatePricePreview() {
    var checkbox = document.getElementById('saleCheckbox');
    var priceInput  = document.getElementById('originalPrice');
    var discountSelect = document.getElementById('discountPercent');
    //var price = document.querySelector('input[name="price"]');
    //var discountSelect = document.querySelector('select[name="discountPercent"]');
    var finalPrice = document.getElementById('finalPrice');
    
    if (!checkbox || !priceInput  || !discountSelect || !finalPrice) return;
    
    if (checkbox.checked && discountSelect.value) {
        var originalPrice  = parseFloat(priceInput .value) || 0;
        var discount = parseFloat(discountSelect.value);
        var newPrice  = originalPrice  - (originalPrice  * discount / 100);
        
        finalPrice.innerHTML = newPrice.toFixed(2)
        
    } else if (checkbox.checked) {
        finalPrice.innerHTML = `<strong style="color: #ffc107e0;" class="text-warning">Please select discount percentage</strong>`;
    } else {
        finalPrice.innerHTML = '';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    var priceInput = document.querySelector('input[name="price"]');
    var discountSelect = document.getElementById('discountPercent');
    var saleCheckbox = document.getElementById('saleCheckbox');
   // var discountSelect = document.querySelector('select[name="discountPercent"]');
    //var saleCheckbox = document.getElementById('saleCheckbox');
    
    if (priceInput) {
        priceInput.addEventListener('input', updatePricePreview);
    }
    
    if (discountSelect) {
        discountSelect.addEventListener('change', updatePricePreview);
    }
    
    if (saleCheckbox) {
        saleCheckbox.addEventListener('click', toggleDiscountField);
        saleCheckbox.addEventListener('click', updatePricePreview);
    }

    if (saleCheckbox && saleCheckbox.checked) {
        toggleDiscountField();
        updatePricePreview();
    }

});


// assets/js/orderedItem.js


                        ////////// Ordered Items //////////

document.addEventListener('DOMContentLoaded', function() {
    const goodsSelect = document.getElementById('goods_id');
    const quantityInput = document.getElementById('quantity');
    const priceInput = document.getElementById('price');
    const subtotalInput = document.getElementById('subtotal');

    if (goodsSelect) {
        goodsSelect.addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var price = selectedOption.getAttribute('data-price');
            if (price) {
                priceInput.value = '€' + parseFloat(price).toFixed(2);
            } else {
                priceInput.value = '';
            }
            calculateSubtotal();
        });
    }

    if (quantityInput) {
        quantityInput.addEventListener('input', function() {
            calculateSubtotal();
        });
    }

    function calculateSubtotal() {
        var quantity = quantityInput.value;
        var priceText = priceInput.value;
        var price = parseFloat(priceText.replace('€', ''));

        if (quantity && price && !isNaN(price)) {
            var subtotal = quantity * price;
            subtotalInput.value = '€' + subtotal.toFixed(2);
        } else {
            subtotalInput.value = '';
        }
    }
});
