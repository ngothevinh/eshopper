<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Jobs\SendMail;
use App\Models\Bills;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    protected $customer;
    protected $bill;
    protected $product;
    protected $productImage;
    protected $category;

    public function __construct(Customer $customer, Bills $bill, Product $product,ProductImage $productImage,Category $category)
    {
        $this->customer = $customer;
        $this->bill = $bill;
        $this->product = $product;
        $this->productImage = $productImage;
        $this->category = $category;
    }

    public function showCart()
    {
        $categoriesLimit = $this->category->where('parent_id', 0)->take(3)->get();
        $carts = session()->get('cart');
        return view('cart.index', compact('categoriesLimit', 'carts'));
    }

    public function addCart($id)
    {
        $product = $this->product->find($id);
        $cart = session()->get('cart');
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $cart[$id]['quantity'] + 1;
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->feature_image_path
            ];
        }

        session()->put('cart', $cart);
        return response()->json([
            'code' => 200,
            'message' => 'success'
        ], 200);
    }

    public function updateCart(Request $request)
    {
        if ($request->id && $request->quantity) {
            $carts = session()->get('cart');
            $carts[$request->id]['quantity'] = $request->quantity;
            session()->put('cart', $carts);
            //dùng để mỗi lần update không bị load lại trang
            $cartUpdate = view('cart.index', compact('carts'))->render();
            return response()->json([
                'cart_update' => $cartUpdate,
                'code' => 200
            ], 200);
        }
    }

    public function deleteCart(Request $request)
    {
        if ($request->id) {
            $carts = session()->get('cart');
            unset($carts[$request->id]);
            session()->put('cart', $carts);
            //dùng để mỗi lần update không bị load lại trang
            $cartUpdate = view('cart.index', compact('carts'))->render();
            return response()->json([
                'cart_update' => $cartUpdate,
                'code' => 200
            ], 200);
        }
    }

    public function postCheckout(CustomerRequest $request)
    {
        try {
            DB::beginTransaction();
            $carts = session()->get('cart');
            $customerId = array_keys($carts);

            $dataCustomer = ([
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'phone' => $request->phone,
                'description' => $request->description,
            ]);
            $customer = $this->customer->create($dataCustomer);
            foreach ($carts as $id => $customerBill) {
                $customer->customersFk()->create([
                    'customer_id' => $this->customer->id,
                    'date_order' => date('Y-m-d H:i:s'),
                    'product_id' => $id,
                    'quantity' => $customerBill['quantity'],
                    'price' => number_format($customerBill['price']),
                    'total_bill' => number_format($customerBill['quantity'] * $customerBill['price']),
                    'product_name' => $customerBill['name'],
                    'product_image' => $customerBill['image']
                ]);
            }

            DB::commit();
            #Queue
            SendMail::dispatch($request->input('email'))->delay(now()->addSecond(2));
            Session::flush();
            return redirect()->route('home');

        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('message' . $exception->getMessage() . '  line' . $exception->getLine());
        }
    }

    public function detailProduct($id){
        $categoriesLimit = $this->category->where('parent_id', 0)->take(3)->get();
        $categories=$this->category->where('parent_id',0)->get();
        $productsRecommend=$this->product->latest('views_count','desc')->take(12)->get();
        $products=$this->product->latest()->get();
        $productsDetail=$this->product->find($id)->where('id',$id)->get();
        $productImage=$this->productImage->where('product_id',$id)->get();
        return view('product.detailProduct',compact('categoriesLimit','categories','productsRecommend','products','productsDetail','productImage'));
    }
    public function productAll(){
        $categories=$this->category->where('parent_id',0)->get();
        $productsRecommend=$this->product->latest('views_count','desc')->take(12)->get();
        $categoriesLimit = $this->category->where('parent_id', 0)->take(3)->get();
        $products=$this->product->latest()->get();
        return view('product.productAll',compact('categories','productsRecommend','categoriesLimit','products'));
    }

}


