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
    $request->validate([
        'name'          => 'required|string|max:255',
        'email'         => 'nullable|email|max:255',
        'phone'         => 'required|string|max:20',
        'address'       => 'nullable|string|max:500',
        'product_id'    => 'nullable|integer|exists:products,id',
        'sanphamphu_id' => 'nullable|integer|exists:sanphamphus,id',
        'product_name'  => 'nullable|string|max:255',
        'quantity'      => 'required|integer|min:1',
        'subscribe'     => 'nullable|boolean',
        'note'          => 'nullable|string|max:500',
    ]);

    $total = 0;
    $productName = null;

    // Nếu chọn sản phẩm phụ → ưu tiên sản phẩm phụ
    if ($request->filled('sanphamphu_id')) {
        $spp = \App\Models\Sanphamphu::find($request->sanphamphu_id);

        if ($spp) {
            $productName = $spp->title;
            $total = ($spp->price ?? 0) * $request->quantity;
        }
    }
    // Nếu không có sản phẩm phụ → kiểm tra sản phẩm chính
    elseif ($request->filled('product_id')) {
        $product = \App\Models\Product::find($request->product_id);

        if ($product) {
            $productName = $product->title;
            $total = ($product->price ?? 0) * $request->quantity;
        }
    }

    // Nếu cả product lẫn sanphamphu đều không có → fallback product_name
    if (!$productName) {
        $productName = $request->product_name ?? 'Sản phẩm không xác định';
    }

    // Tạo đơn hàng
    $order = Order::create([
        'name'         => $request->name,
        'email'        => $request->email,
        'phone'        => $request->phone,
        'address'      => $request->address,
        'product_id'   => $request->product_id,
        'sanphamphu_id'=> $request->sanphamphu_id,
        'product_name' => $productName,
        'quantity'     => $request->quantity,
        'total'        => $total,
        'status'       => 'pending',
        'subscribe'    => $request->boolean('subscribe'),
    ]);

    // Lưu newsletter nếu có đăng ký
    if ($request->boolean('subscribe') && $request->filled('email')) {
        NewsLetter::updateOrCreate(
            ['email' => $request->email],
            ['subscribed' => true]
        );
    }

    return back()->with('success', 'Cảm ơn bạn! Đơn hàng của bạn đã được gửi thành công.');
}

}
