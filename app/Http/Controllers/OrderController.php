<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Supplier;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        dd(session('success'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $customer = Customer::create($request->customer);
                $supplier = Supplier::create($request->supplier);

                $orderDetails = [];
                $totalAmount = 0;
                foreach ($request->products as $key => $product) {

                    $product['supplier_id'] = $supplier->id;

                    if ($request->hasFile("products.$key.image")) {
                        $product['image'] = Storage::put('products', $request->file("products.$key.image"));
                    }

                    $tmp = Product::query()->create($product);

                    $orderDetails[$tmp->id] = [
                        'qty' => $request->order_details[$key]['qty'],
                        'price' => $tmp->price
                    ];

                    $totalAmount += $request->order_details[$key]['qty'] * $tmp->price;
                }

                $order = Order::query()->create([
                    'customer_id' => $customer->id,
                    'total_amount' => $totalAmount,
                ]);

                $order->products()->attach($orderDetails);
            }, 3);

            return redirect()
                ->route('orders.index')
                ->with('success', 'Thao tác thành công!');
        } catch (Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
