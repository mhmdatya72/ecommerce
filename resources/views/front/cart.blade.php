<x-front-layout title="Cart">
    <x-slot:breadcrumb>
        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title">Cart</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <ul class="breadcrumb-nav">
                            <li><a href="{{ route('home') }}"><i class="lni lni-home"></i> Home</a></li>
                            <li><a href="{{ route('products.index') }}">Shop</a></li>
                            <li>Cart</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </x-slot:breadcrumb>

    <!-- Shopping Cart -->
    <div class="shopping-cart section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Shopping Summary -->
                    <table class="table table-bordered shopping-summary">
                        <thead class="thead-light">
                            <tr class="main-heading">
                                <th class="text-center">PRODUCT</th>
                                <th class="text-center">NAME</th>
                                <th class="text-center">UNIT PRICE</th>
                                <th class="text-center">QUANTITY</th>
                                <th class="text-center">TOTAL</th>
                                <th class="text-center"><i class="ti-trash remove-icon"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart->get() as $item)
                            <tr id="item-{{ $item->id }}">
                                <td class="text-center image" data-title="No">
                                    <img src="{{ $item->product->image_url }}" alt="#" style="width: 80px; height: auto;">
                                </td>
                                <td class="product-des" data-title="Description">
                                    <p class="product-name">
                                        <a href="{{ route('products.show', $item->product->slug) }}">
                                            <strong>{{ $item->product->name }}</strong>
                                        </a>
                                    </p>
                                    <p class="product-des">{{ $item->product->description }}</p>
                                </td>
                                <td class="price text-center" data-title="Price">
                                    <span>{{ Currency::format($item->product->price) }}</span>
                                </td>
                                <td class="text-center">
                                    <div class="count-input d-flex justify-content-center align-items-center">
                                        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="decreaseQuantity({{ $item->id }}, {{ $item->product->price }})">-</button>
                                        <input class="form-control text-center mx-2 item-quantity" data-id="{{ $item->id }}" value="{{ $item->quantity }}" id="quantity-{{ $item->id }}" style="font-size: 1.5rem; width: 60px;">
                                        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="increaseQuantity({{ $item->id }}, {{ $item->product->price }})">+</button>
                                    </div>
                                </td>
                                <td class="total-amount text-center" data-title="Total">
                                    <span id="total-{{ $item->id }}">{{ Currency::format($item->quantity * $item->product->price) }}</span>
                                </td>
                                <td>
                                    <a href="javascript:void(0)" data-id="{{ $item->id }}" class="remove-item" title="Remove this item">
                                        <i class="lni lni-close"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Coupon and Total Amount Section -->
            <div class="row mt-4">
                <div class="col-lg-8 col-md-6">
                    <div class="left">
                        <div class="coupon mb-3">
                            <form action="#" class="d-flex w-100">
                                <input type="text" class="form-control mr-2" placeholder="Enter Your Coupon">
                                <button class="btn btn-primary">Apply</button>
                            </form>
                        </div>
                        <div class="checkbox">
                            <label class="checkbox-inline" for="shippingCheck">
                                <input type="checkbox" id="shippingCheck"> Shipping (+$10)
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="right">
                        <ul class="list-unstyled">
                            <li>Cart Subtotal <span>{{ Currency::format($cart->total()) }}</span></li>
                            <li>Shipping <span>Free</span></li>
                            <li>You Save <span class="text-success">{{ Currency::format(0) }}</span></li>
                            <li class="font-weight-bold">You Pay <span>{{ Currency::format($cart->total()) }}</span></li>
                        </ul>
                        <div class="button5 mt-3">
                            <a href="#" class="btn btn-primary btn-block mb-2">Checkout</a>
                            <a href="#" class="btn btn-secondary btn-block">Continue Shopping</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function decreaseQuantity(itemId, price) {
            let quantityInput = document.getElementById(`quantity-${itemId}`);
            let totalElement = document.getElementById(`total-${itemId}`);
            let currentQuantity = parseInt(quantityInput.value);

            if (currentQuantity > 1) {
                quantityInput.value = currentQuantity - 1;
                updateTotal(totalElement, quantityInput.value, price);
            }
        }

        function increaseQuantity(itemId, price) {
            let quantityInput = document.getElementById(`quantity-${itemId}`);
            let totalElement = document.getElementById(`total-${itemId}`);
            let currentQuantity = parseInt(quantityInput.value);

            quantityInput.value = currentQuantity + 1;
            updateTotal(totalElement, quantityInput.value, price);
        }

        function updateTotal(totalElement, quantity, price) {
            let newTotal = quantity * price;
            totalElement.innerText = new Intl.NumberFormat('en-US', {
                style: 'currency',
                currency: 'USD'
            }).format(newTotal);
        }
    </script>

    @push('scripts')
    <script>
        const csrf_token = "{{ csrf_token() }}";
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('js/cart.js') }}"></script>
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    @endpush
</x-front-layout>
