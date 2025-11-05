<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Firefly\FilamentBlog\Models\NewsLetter;
use App\Models\Order;
use App\Models\Product;

class OrderController extends Controller
{
    public function show($id)
{
    $product = Product::findOrFail($id);
    $products = Product::orderBy('name')->get();

    return view('components.layouts.app', compact('product', 'products'));
}
    /**
     * Xử lý khi người dùng submit form đặt hàng.
     */
    public function submit(Request $request)
    {
        // ✅ Kiểm tra dữ liệu từ form
        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'nullable|email|max:255',
            'phone'         => 'required|string|max:20',
            'address'       => 'nullable|string|max:500',
            'product_id'    => 'nullable|integer|exists:products,id',
            'product_name'  => 'nullable|string|max:255',
            'quantity'      => 'required|integer|min:1',
            'subscribe'     => 'nullable|boolean',
            'note'          => 'nullable|string|max:500',
        ]);

        // ✅ Tính tổng giá nếu có thông tin sản phẩm
        $total = null;
        if ($request->filled('product_id')) {
            $product = \App\Models\Product::find($request->product_id);
            if ($product && isset($product->price)) {
                $total = $product->price * $request->quantity;
            }
        }

 // ✅ Tạo đơn hàng mới
$order = Order::create([
    'name'         => $request->name,
    'email'        => $request->email,
    'phone'        => $request->phone,
    'address'      => $request->address,
    'product_id'   => $request->product_id,
    'product_name' => $request->filled('product_id')
        ? (\App\Models\Product::find($request->product_id)?->title ?? $request->product_name)
        : $request->product_name, // fallback nếu người dùng chỉ nhập tên cá
    'quantity'     => $request->quantity,
    'total'        => $total,
    'status'       => 'pending',
    'subscribe'    => $request->boolean('subscribe'),
]);
        // ✅ Nếu người dùng chọn “nhận tin”, thêm email vào newsletter
        if ($request->boolean('subscribe') && $request->filled('email')) {
            NewsLetter::updateOrCreate(
                ['email' => $request->email],
                ['subscribed' => true]
            );
        }

        // ✅ Phản hồi lại — có thể đổi sang popup hoặc redirect
        return back()->with('success', 'Cảm ơn bạn! Đơn hàng của bạn đã được gửi thành công.');
    }
}
