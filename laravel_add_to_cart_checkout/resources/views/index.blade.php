@extends('layouts.app')

@section('content')
    <section class="h-100 gradient-custom">
        <div class="container py-5">
            <div class="row d-flex justify-content-center my-4">
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-header py-3">
                            <h5 class="mb-0">Cart</h5>
                        </div>
                        <div class="card-body">
                            <!-- Single item -->
                            @foreach ($products as $key => $product)
                                <div class="row">

                                    <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                                        <!-- Data -->
                                        <p><strong>{{ $product->item_name }}</strong></p>
                                        <button type="button" class="btn btn-primary btn-sm me-1 mb-2"
                                            data-mdb-toggle="tooltip" title="Remove item">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm mb-2" data-mdb-toggle="tooltip"
                                            title="Move to the wish list">
                                            <i class="fas fa-heart"></i>
                                        </button>
                                        <!-- Data -->
                                    </div>

                                    <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                                        <!-- Quantity -->
                                        <div class="d-flex mb-4" style="max-width: 300px">
                                            <button class="btn btn-primary px-3 me-2"
                                                onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                                <i class="fas fa-minus"></i>
                                            </button>

                                            <div class="form-outline">
                                                <input id="form1" min="0" name="quantity" value="1"
                                                    type="number" class="form-control" />
                                                <label class="form-label" for="form1">Quantity</label>
                                            </div>

                                            <button class="btn btn-primary px-3 ms-2"
                                                onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                        <!-- Quantity -->

                                        <!-- Price -->
                                        <p class="text-start text-md-center">
                                            <strong>{{ $product->item_price }}</strong>
                                        </p>
                                        <!-- Price -->
                                    </div>
                                </div>
                                <!-- Single item -->

                                <hr class="my-4" />
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-header py-3">
                            <h5 class="mb-0">Summary</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li
                                    class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                    Products
                                    <span>$53.98</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    Shipping
                                    <span>Gratis</span>
                                </li>
                                <li
                                    class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                    <div>
                                        <strong>Total amount</strong>
                                        <strong>
                                            <p class="mb-0">(including VAT)</p>
                                        </strong>
                                    </div>
                                    <span><strong>$53.98</strong></span>
                                </li>
                            </ul>

                            <button type="button" class="btn btn-primary btn-lg btn-block">
                                Go to checkout
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
