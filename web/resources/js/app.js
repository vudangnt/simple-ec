import _ from 'lodash';
const toastr = require('toastr');
require('./bootstrap');
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
window.storageUrl = $('meta[name="storage-url"]').attr('content');
window.baseUrl = $('base').attr('href');
window.cacheKeys = {
    cartItems: 'cartItems'
}
export function formatNumber(number) {
    return new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'EUR' }).format(number);
}
// render html minicart
export function minicartHtml() {
    // get item on cart from localStorage
    const cartItems = JSON.parse(localStorage.getItem(cacheKeys.cartItems));
    let miniCartWrapperHtml = '';
    if(Array.isArray(cartItems) && cartItems.length) {
        let miniCartItemHtml = '';
        let subGrandTotal = 0;
        (cartItems || []).forEach((item) => {
            let itemHtml = $.trim($('#miniCartItem').html());
            itemHtml = itemHtml.replace(/tmpl_url/ig, baseUrl + '/' + item.slug);
            itemHtml = itemHtml.replace(/tmpl_name/ig, item.name);
            itemHtml = itemHtml.replace(/tmpl_image/ig, item.image);
            itemHtml = itemHtml.replace(/tmpl_price/ig, formatNumber(item.subTotal));
            itemHtml = itemHtml.replace(/tmpl_qty/ig, item.qty);
            itemHtml = itemHtml.replace(/tmpl_id/ig, item.id);
            miniCartItemHtml += '<hr class="dropdown-divider">' + itemHtml;
            subGrandTotal = subGrandTotal + item.subTotal;
        });
        miniCartWrapperHtml = $('#miniCartWrapper').html();
        miniCartWrapperHtml = miniCartWrapperHtml.replace(/tmpl_itemCart/ig, miniCartItemHtml);
        miniCartWrapperHtml = miniCartWrapperHtml.replace(/tmpl_totalItem/ig, cartItems.length);
        miniCartWrapperHtml = miniCartWrapperHtml.replace(/tmpl_subGrandTotal/ig, formatNumber(subGrandTotal));
    }
    $('.minicart-wrapper').html(miniCartWrapperHtml)
}

//function add to cart
export function addCart(qty, productId){
    let cartItems = JSON.parse(localStorage.getItem(cacheKeys.cartItems)) || [];
    const productCart = (listProducts || []).find((f) => f.id === productId);
    const image = productCart.images[0].image;
    const itemCart = {
        id: productCart.id,
        name: productCart.name,
        slug: productCart.slug,
        price: _.toNumber(productCart.price),
        subTotal: _.toNumber(productCart.price) * _.toNumber(qty),
        qty: _.toNumber(qty),
        image: storageUrl + '/' + image.replace(/public\//ig, '')
    };
    if((!Array.isArray(cartItems) || !cartItems.length) && productCart) {
        cartItems = (cartItems || []).concat(itemCart);
    } else {
        const itemInCart = (cartItems || []).find(f => f.id === productId);
        if(itemInCart) {
            itemInCart.qty = itemInCart.qty  + _.toNumber(qty);
            itemInCart.subTotal = itemInCart.qty * itemInCart.price;
            itemInCart.image = itemInCart.image.replace(/public\//ig, '')
        } else {
            cartItems = cartItems.concat(itemCart);
        }
    }
    localStorage.setItem(cacheKeys.cartItems, JSON.stringify(cartItems));
    minicartHtml();
}
// decrease button
$(document).on('click', '.decrease', function(e) {
    e.preventDefault();
    const elementQty = $(this).next('input').first();
    const qty = _.toNumber(elementQty.val()) - 1;
    if(qty > 1){
        elementQty.val(qty);
        const updateCart = $(this).data('update-cart');
        if(updateCart) {
            const productId = $(this).data('id');
            addCart( -1, productId);
            toastr.success('Qty already updated in cart');
        }
    }
});
// increase button
$(document).on('click', '.increase', function(e) {
    e.preventDefault();
    const elementQty = $(this).prev('input').first();
    const qty = _.toNumber(elementQty.val()) + 1;
    elementQty.val(qty);
    const updateCart = $(this).data('update-cart');
    if(updateCart) {
        const productId = $(this).data('id');
        addCart(1, productId);
        toastr.success('Qty already updated in cart');
    }
});
// add to cart
$(document).on('click', '.btn-add-to-cart', function(e) {
    e.preventDefault();
    const qty = $(this).prevAll().find('input').first().val() || 1;
    const productId = $(this).data('id');
    addCart(_.toNumber(qty), productId);
    toastr.success('Item already added to cart');
});
// delete item in cart
$(document).on('click', '.delete-cart', function(e) {
    e.preventDefault();
    const productId = $(this).data('id');
    let cartItems = JSON.parse(localStorage.getItem(cacheKeys.cartItems));
    cartItems = (cartItems || []).filter(f => f.id !== productId);
    localStorage.setItem(cacheKeys.cartItems, JSON.stringify(cartItems));
    toastr.error('Item already deleted in cart');
    minicartHtml();
})
$(function() {
    minicartHtml();
});
