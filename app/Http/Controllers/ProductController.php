<?php
namespace App\Http\Controllers;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{
 /**
 * Display a listing of the resource.
 */
 public function index() : View
 {
 return view('products.index', [
 'products' => Product::latest()->paginate(4)
 ]);
 }
 /**
 * Show the form for creating a new resource.
 */
 public function create() : View
 {
 return view('products.create');
 }
 /**
 * Store a newly created resource in storage.
 */
 public function store(StoreProductRequest $request) : RedirectResponse
 {
    $request->validate([
        'code' => 'required|unique:products',
        'name' => 'required',
        'quantity' => 'required|integer|min:0',
        'price' => 'required|numeric|min:0',
        'description' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
    ]);

    $data = $request->all();

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $destinationPath = public_path('images/products');
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }
        $image->move($destinationPath, $imageName);
        $data['image'] = 'images/products/' . $imageName;
    }

    Product::create($data);
    return redirect()->route('products.index')->with('success', 'Product created successfully.');
}

 /**
 * Display the specified resource.
 */
 public function show(Product $product) : View
 {
 return view('products.show', compact('product'));
 }
 /**
 * Show the form for editing the specified resource.
 */
 public function edit(Product $product) : View
 {
 return view('products.edit', compact('product'));
 }
 /**
 * Update the specified resource in storage.
 */
 public function update(UpdateProductRequest $request, Product $product) : RedirectResponse
 {
    $request->validate([
        'code' => 'required|unique:products,code,' . $product->id,
        'name' => 'required',
        'quantity' => 'required|integer|min:0',
        'price' => 'required|numeric|min:0',
        'description' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
    ]);

    $data = $request->all();

    if ($request->hasFile('image')) {
        // Delete old image if exists
        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }
        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $destinationPath = public_path('images/products');
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }
        $image->move($destinationPath, $imageName);
        $data['image'] = 'images/products/' . $imageName;
    }

    $product->update($data);
    return redirect()->route('products.index')->with('success', 'Product updated successfully.');
}
 /**
 * Remove the specified resource from storage.
 */
 public function destroy(Product $product) : RedirectResponse
 {
    if ($product->image && Storage::exists('public/' . $product->image)) {
        Storage::delete('public/' . $product->image);
    }

    $product->delete();
    return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
}

}