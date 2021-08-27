<script id="miniCartItem" type="template">
    <li class="item p-3 d-flex align-items-center">
            <div class="image me-3">
                <a href="tmpl_url">
                    <img src="tmpl_image" alt="">
                </a>
            </div>
            <div class="description">
                <p class="title"><a href="tmpl_url">tmpl_name</a></p>
                <p class="price"><span>Price</span> <span class="price ms-3 fw-bolder">tmpl_price</span></p>
                <div class="qty d-flex justify-content-between align-items-center">
                    <span>Quantity: </span>
                    <div class="qty-input d-flex align-items-center ms-3">
                        <button class="decrease border border-light pe-auto" data-update-cart="true" data-id="tmpl_id">-</button>
                        <input type="text" class="form-control text-center size-sm" name="qty" value="tmpl_qty" readonly>
                        <button class="increase border border-light pe-auto" data-update-cart="true" data-id="tmpl_id">+</button>
                    </div>
                </div>
                <button class="btn btn-danger delete-cart" data-id="tmpl_id">Del</button>
            </div>
    </li>
</script>
<script id="miniCartWrapper" type="template">
        <div class="d-flex justify-content-between p-3">
            <span class="total-cart">tmpl_totalItem item in cart</span>
            <span class="total-price">tmpl_subGrandTotal</span>
        </div>
        <a href="" class="btn btn-dark mt-3 mb-3">View basket</a>
        <ul class="cart-items">
            tmpl_itemCart
        </ul>
</script>
<div class="minicart-wrapper"></div>
