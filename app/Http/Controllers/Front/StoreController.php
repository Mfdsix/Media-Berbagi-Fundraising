<?php

namespace App\Http\Controllers\front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Auth;
use App\User;

class StoreController extends Controller
{
    public function index(){
    	$product = Product::all();
		return view('front.store.index')->with([
			'product' => $product,
		]);
	}

	public function cart(){
		if(Auth::user() == null) {
			abort(404);
		}
		$carts = Auth::user()->cart;
		$products = [];

		$carts = json_decode($carts,1);


		// foreach(json_decode($carts, 1) as $cart){
		// 	$key = array_keys($cart)[0]; // this is id from product
		// 	$value = $cart[$key];
		// 	if(isset($products[$key])) {
		// 		$products[$key]['quantity'];
		// 	}else{
		// 		$products[$key]['quantity'] = 1;
		// 	}
		// }

		// dd(json_decode($carts, 1));


		return view('front.store.cart')->with([
			'carts' => $carts,
		]);
	}

	public function detail($id){
		$product = Product::findOrFail($id);
		return view('front.store.detail')->with([
			'product' => $product,
		]);
	}

	public function delete($id) {
		$carts = Auth::user()->cart;

		$carts = json_decode($carts,1);
		unset($carts[$id]);
		$user_id = Auth::user()->id;
		$user = User::findOrFail($user_id);
		$user->cart = json_encode($carts);
        $user->save();

        echo "<script>window.localStorage.setItem('data-cart', '".json_encode($carts)."');window.location.href='/product/cart'</script>";

        Auth::setUser($user);

        // return redirect('/product/cart');
	}
}
