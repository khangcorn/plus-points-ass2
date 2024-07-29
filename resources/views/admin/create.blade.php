 @extends('admin.master')

@section('title')
    Thêm mới đơn hàng
@endsection

@section('content')
    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
    @endif

    <form action="{{ route('orders.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-md-6">
                <h2 class="mt-3 mb-3">Customer</h2>
                <div class="mt-3">
                    <label for="customer_name">Name</label>
                    <input type="text" name="customer[name]" value="{{ old('customer.name') }}" id="customer_name"
                        class="form-control">
                    @error('customer.name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-3">
                    <label for="customer_address">Address</label>
                    <input type="text" name="customer[address]" value="{{ old('customer.address') }}"
                        id="customer_address" class="form-control">
                    @error('customer.address')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-3">
                    <label for="customer_phone">Phone</label>
                    <input type="tel" name="customer[phone]" value="{{ old('customer.phone') }}" id="customer_phone"
                        class="form-control">
                    @error('customer.phone')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-3">
                    <label for="customer_email">Email</label>
                    <input type="email" name="customer[email]" value="{{ old('customer.email') }}" id="customer_email"
                        class="form-control">
                    @error('customer.email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <h2 class="mt-3 mb-3">Suppiler</h2>
                <div class="mt-3">
                    <label for="suppiler_name">Name</label>
                    <input type="text" name="supplier[name]" value="{{ old('supplier.name') }}" id="suppiler_name"
                        class="form-control">
                    @error('supplier.name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-3">
                    <label for="suppiler_address">Address</label>
                    <input type="text" name="supplier[address]" value="{{ old('supplier.address') }}"
                        id="suppiler_address" class="form-control">
                    @error('supplier.address')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-3">
                    <label for="suppiler_phone">Phone</label>
                    <input type="tel" name="supplier[phone]" value="{{ old('supplier.phone') }}" id="suppiler_phone"
                        class="form-control">
                    @error('supplier.phone')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-3">
                    <label for="suppiler_email">Email</label>
                    <input type="email" name="supplier[email]" value="{{ old('supplier.email') }}" id="suppiler_email"
                        class="form-control">
                    @error('supplier.email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-md-12">
                <h2 class="mt-3 mb-3">Danh sách sản phẩm</h2>
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Stock Qty</th>
                            <th>Qty (số lượng bán)</th>
                        </tr>
                        @for ($i = 0; $i < 2; $i++)
                            <tr>
                                <td>
                                    <input type="text" class="form-control" name="products[{{ $i }}][name]"
                                        value="{{ old("products.$i.name") }}">

                                    @error("products.$i.name")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td>
                                    <input type="file" class="form-control" name="products[{{ $i }}][image]">
                                    @error("products.$i.image")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td>
                                    <input type="text" class="form-control"
                                        name="products[{{ $i }}][description]"
                                        value="{{ old("products.$i.description") }}">
                                    @error("products.$i.description")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td>
                                    <input type="number" class="form-control" name="products[{{ $i }}][price]"
                                        value="{{ old("products.$i.price") }}">
                                    @error("products.$i.price")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td>
                                    <input type="number" class="form-control"
                                        name="products[{{ $i }}][stock_qty]"
                                        value="{{ old("products.$i.stock_qty") }}">
                                    @error("products.$i.stock_qty")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>

                                <td>
                                    <input type="number" class="form-control"
                                        name="order_details[{{ $i }}][qty]"
                                        value="{{ old("order_details.$i.qty") }}">
                                    @error("order_details.$i.qty")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                            </tr>
                        @endfor

                    </table>
                </div>
            </div>

            <button type="submit" class="mt-3 btn btn-primary">Submit</button>
        </div>

    </form>
@endsection
