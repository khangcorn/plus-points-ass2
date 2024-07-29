@extends('admin.master')

@section('title')
    Danh sách đơn hàng
@endsection

@section('content')
    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
    @endif

    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">

            <a href="{{ route('orders.create') }}" class="btn btn-primary mb-3">Create</a>

            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>ID</th>
                        <th>Customer Info</th>
                        <th>Total Amount</th>
                        <th>Order Detail</th>
    
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th>Action</th>
                    </tr>

                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>
                                <ul>
                                    <li>{{ $order->customer->name }}</li>
                                    <li>{{ $order->customer->email }}</li>
                                    <li>{{ $order->customer->address }}</li>
                                    <li>{{ $order->customer->phone }}</li>
                                </ul>
                            </td>
                            <td>{{ number_format($order->total_amount) }}</td>
                            <td>

                                
                                @foreach ($order->products as $product)
                                    <h6>Sản phẩm: {{ $product->name }}</h6>
                                    <ul>
                                        <li>Giá: {{ number_format($product->pivot->price) }}</li>
                                        <li>Số lượng: {{ $product->pivot->qty }}</li>
                                        @if ($product->image && \Storage::exists($product->image))
                                            <li>
                                                <img width="100px" src="{{ \Storage::url($product->image) }}" alt="">
                                            </li>
                                        @endif
                                    </ul>
                                @endforeach
                            </td>
                            <td>{{ $order->created_at }}</td>
                            <td>{{ $order->updated_at }}</td>
                            <td>
                                <a href="{{ route('orders.edit', $order) }}" class="btn btn-warning mt-3">Edit</a>

                                <form action="{{ route('orders.destroy', $order) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" onclick="return confirm('Are you sure!')"
                                        class="btn btn-danger mt-3">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>

            {{ $orders->links() }}
        </div>
    </div>
@endsection
