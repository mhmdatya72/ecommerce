<x-front-layout title="Cart">
    <x-slot:breadcrumb>
        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title">Home</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <ul class="breadcrumb-nav">
                            <li><a href="{{ route('home') }}"><i class="lni lni-home"></i> Home</a></li>
                            <li><a href="{{ route('products.index') }}">Shop</a></li>
                            <li>{{ $product->name }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </x-slot:breadcrumb>
    <!-- Shopping Summery -->
    <table class="table shopping-summery">
        <thead>
            <tr class="main-hading">
                <th>PRODUCT</th>
                <th>NAME</th>
                <th class="text-center">UNIT PRICE</th>
                <th class="text-center">QUANTITY</th>
                <th class="text-center">TOTAL</th>
                <th class="text-center"><i class="ti-trash remove-icon"></i></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="image" data-title="No"><img src="https://via.placeholder.com/100x100" alt="#"></td>
                <td class="product-des" data-title="Description">
                    <p class="product-name"><a href="#">Women Dress</a></p>
                    <p class="product-des">Maboriosam in a tonto nesciung eget distingy magndapibus.</p>
                </td>
                <td class="price" data-title="Price"><span>$110.00 </span></td>
                <td class="qty" data-title="Qty">
                    <!-- Input Order -->
                    <div class="input-group">
                        <div class="button minus">
                            <button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
                                <i class="ti-minus"></i>
                            </button>
                        </div>
                        <input type="text" name="quant[1]" class="input-number" data-min="1" data-max="100" value="1">
                        <div class="button plus">
                            <button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[1]">
                                <i class="ti-plus"></i>
                            </button>
                        </div>
                    </div>
                    <!--/ End Input Order -->
                </td>
                <td class="total-amount" data-title="Total"><span>$220.88</span></td>
                <td class="action" data-title="Remove"><a href="#"><i class="ti-trash remove-icon"></i></a></td>
            </tr>
            <tr>
                <td class="image" data-title="No"><img src="https://via.placeholder.com/100x100" alt="#"></td>
                <td class="product-des" data-title="Description">
                    <p class="product-name"><a href="#">Women Dress</a></p>
                    <p class="product-des">Maboriosam in a tonto nesciung eget distingy magndapibus.</p>
                </td>
                <td class="price" data-title="Price"><span>$110.00 </span></td>
                <td class="qty" data-title="Qty">
                    <!-- Input Order -->
                    <div class="input-group">
                        <div class="button minus">
                            <button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="quant[2]">
                                <i class="ti-minus"></i>
                            </button>
                        </div>
                        <input type="text" name="quant[2]" class="input-number" data-min="1" data-max="100" value="2">
                        <div class="button plus">
                            <button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[2]">
                                <i class="ti-plus"></i>
                            </button>
                        </div>
                    </div>
                    <!--/ End Input Order -->
                </td>
                <td class="total-amount" data-title="Total"><span>$220.88</span></td>
                <td class="action" data-title="Remove"><a href="#"><i class="ti-trash remove-icon"></i></a></td>
            </tr>
            <tr>
                <td class="image" data-title="No"><img src="https://via.placeholder.com/100x100" alt="#"></td>
                <td class="product-des" data-title="Description">
                    <p class="product-name"><a href="#">Women Dress</a></p>
                    <p class="product-des">Maboriosam in a tonto nesciung eget distingy magndapibus.</p>
                </td>
                <td class="price" data-title="Price"><span>$110.00 </span></td>
                <td class="qty" data-title="Qty">
                    <!-- Input Order -->
                    <div class="input-group">
                        <div class="button minus">
                            <button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="quant[3]">
                                <i class="ti-minus"></i>
                            </button>
                        </div>
                        <input type="text" name="quant[3]" class="input-number" data-min="1" data-max="100" value="3">
                        <div class="button plus">
                            <button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[3]">
                                <i class="ti-plus"></i>
                            </button>
                        </div>
                    </div>
                    <!--/ End Input Order -->
                </td>
                <td class="total-amount" data-title="Total"><span>$220.88</span></td>
                <td class="action" data-title="Remove"><a href="#"><i class="ti-trash remove-icon"></i></a></td>
            </tr>
        </tbody>
    </table>
    <!--/ End Shopping Summery -->
</x-front-layout>
