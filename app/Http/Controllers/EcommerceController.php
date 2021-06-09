<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use App\Brand;
use App\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Controllers\Controller;

class EcommerceController extends Controller
{
    public function index()
    {
        if (!Auth::guard('customer')->check()) {
            return redirect()->route('index')->with('customernull', '-');
        }
    	$id = Auth::guard('customer')->user()->id;
    	$orders = Order::where('customer_id', $id)->orderByDesc('id')->paginate(5);

    	return view('history_purchase', compact('orders'));
    }

    public function saveReview(Request $request)
    {
	    $rating = $request->rating;
    	$review = $request->review;
    	$order_id = $request->order_id;
    	$product_id = $request->product_id;
    	$customer_id = Auth::guard('customer')->user()->id;

    	$order = Order::find($order_id);
    	$product = Product::find($product_id);

    	$order->cart->products()->updateExistingPivot($product->id, [
    	    		'rating' => $rating,
    	    		'review' => $review,
    	    		'reviewed_at' => now()->format('Y-m-d H:i:s'),
    	    		'review_status' => 'รอการตรวจสอบ',
    	    	]);

    	return response()->json(['rating' => $rating]);
    }

    public function review()
    {
        $types = Product::select('products.type')
                ->join('cart_product as cp', 'products.id', '=', 'cp.product_id')
                ->where('review_status', 'Approved')
                ->where('products.status', '1')
                ->groupBy('products.type')
                ->orderBy('products.type')
                ->get();

        $brands = Product::select('b.id as brand_id', 'b.brand_name')
                ->join('cart_product as cp', 'products.id', '=', 'cp.product_id')
                ->join('brands as b', 'products.brand_id', '=', 'b.id')
                ->where('review_status', 'Approved')
                ->where('products.status', '1')
                ->groupBy('b.brand_name')
                ->orderBy('b.brand_name')
                ->get();

        $products = Product::select('products.id', 'products.title_th', 'products.title_en')
                ->join('cart_product as cp', 'products.id', '=', 'cp.product_id')
                ->where('review_status', 'Approved')
                ->where('products.status', '1')
                ->groupBy('products.id')
                ->orderBy('products.title_th')
                ->get();

        return view('review', compact('brands', 'types', 'products'));
    }

    public function getBrandReview(Request $request)
    {
        if ($request->type == 'ทั้งหมด') {
            $brands = Product::select('b.id as brand_id', 'b.brand_name')
                    ->join('cart_product as cp', 'products.id', '=', 'cp.product_id')
                    ->join('brands as b', 'products.brand_id', '=', 'b.id')
                    ->where('cp.review_status', 'Approved')
                    ->where('products.status', '1')
                    ->groupBy('b.brand_name')
                    ->orderBy('b.brand_name')
                    ->get();
        } else {
            $brands = Product::select('b.id as brand_id', 'b.brand_name')
                    ->join('cart_product as cp', 'products.id', '=', 'cp.product_id')
                    ->join('brands as b', 'products.brand_id', '=', 'b.id')
                    ->where('cp.review_status', 'Approved')
                    ->where('products.type', $request->type)
                    ->where('products.status', '1')
                    ->groupBy('b.brand_name')
                    ->orderBy('b.brand_name')
                    ->get();
        }

        return response()->json($brands);
    }

    public function filter_review($type, $brand, $product)
    {
        if ($product == 'ทั้งหมด') {
            if ($brand == 'ทั้งหมด') {
                if ($type == 'ทั้งหมด') {
                    $products = Product::select('products.id', 'products.type', 'products.title_th', 'products.title_en', 'products.thumbnail', 'b.brand_logo', 'b.brand_name', 'products.slug_url_en')
                            ->withCount(['carts' => function (Builder $query){
                                $query->where('review_status', '=', 'Approved');
                            }])
                            ->join('cart_product as cp', 'products.id', '=', 'cp.product_id')
                            ->join('brands as b', 'products.brand_id', '=', 'b.id')
                            ->where('cp.review_status', 'Approved')
                            ->where('products.status', '1')
                            ->groupBy('products.id')
                            ->orderBy('products.title_th')
                            ->paginate(10);
                } else {
                    $products = Product::select('products.id', 'products.type', 'products.title_th', 'products.title_en', 'products.thumbnail', 'b.brand_logo', 'b.brand_name', 'products.slug_url_en')
                            ->withCount(['carts' => function (Builder $query){
                                $query->where('review_status', '=', 'Approved');
                            }])
                            ->join('cart_product as cp', 'products.id', '=', 'cp.product_id')
                            ->join('brands as b', 'products.brand_id', '=', 'b.id')
                            ->where('cp.review_status', 'Approved')
                            ->where('products.type', $type)
                            ->where('products.status', '1')
                            ->groupBy('products.id')
                            ->orderBy('products.title_th')
                            ->paginate(10);                
                }

            } else {
                if ($type == 'ทั้งหมด') {
                    $products = Product::select('products.id', 'products.type', 'products.title_th', 'products.title_en', 'products.thumbnail', 'b.brand_logo', 'b.brand_name', 'products.slug_url_en')
                        ->withCount(['carts' => function (Builder $query){
                            $query->where('review_status', '=', 'Approved');
                        }])
                        ->join('cart_product as cp', 'products.id', '=', 'cp.product_id')
                        ->join('brands as b', 'products.brand_id', '=', 'b.id')
                        ->where('cp.review_status', 'Approved')
                        ->where('products.brand_id', $brand)
                        ->where('products.status', '1')
                        ->groupBy('products.id')
                        ->orderBy('products.title_th')
                        ->paginate(10); 
                }else{
                    $products = Product::select('products.id', 'products.type', 'products.title_th', 'products.title_en', 'products.thumbnail', 'b.brand_logo', 'b.brand_name', 'products.slug_url_en')
                        ->withCount(['carts' => function (Builder $query){
                            $query->where('review_status', '=', 'Approved');
                        }])
                        ->join('cart_product as cp', 'products.id', '=', 'cp.product_id')
                        ->join('brands as b', 'products.brand_id', '=', 'b.id')
                        ->where('cp.review_status', 'Approved')
                        ->where('products.type', $type)
                        ->where('products.brand_id', $brand)
                        ->where('products.status', '1')
                        ->groupBy('products.id')
                        ->orderBy('products.title_th')
                        ->paginate(10); 
                }
            }
        } else {
            $products = Product::select('products.id', 'products.type', 'products.title_th', 'products.title_en', 'products.thumbnail', 'b.brand_logo', 'b.brand_name', 'products.slug_url_en')
                    ->withCount(['carts' => function (Builder $query){
                        $query->where('review_status', '=', 'Approved');
                    }])
                    ->join('cart_product as cp', 'products.id', '=', 'cp.product_id')
                    ->join('brands as b', 'products.brand_id', '=', 'b.id')
                    ->where('cp.review_status', 'Approved')
                    ->where('products.id', '=', $product)
                    ->where('products.status', '1')
                    ->groupBy('products.id')
                    ->orderBy('products.title_th')
                    ->paginate(10);
        }

        return view('review_show', compact('products'));
    }

    public function getProductReview(Request $request)
    {
        if ($request->type == 'ทั้งหมด') {
            if ($request->brand == 'ทั้งหมด') {
                $products = Product::select('products.id', 'products.title_th', 'products.title_en')
                        ->join('cart_product as cp', 'products.id', '=', 'cp.product_id')
                        ->join('brands as b', 'products.brand_id', '=', 'b.id')
                        ->where('cp.review_status', 'Approved')
                        ->where('products.status', '1')
                        ->groupBy('products.id')
                        ->orderBy('products.title_th')
                        ->get();
            } else {
                $products = Product::select('products.id', 'products.title_th', 'products.title_en')
                    ->join('cart_product as cp', 'products.id', '=', 'cp.product_id')
                    ->join('brands as b', 'products.brand_id', '=', 'b.id')
                    ->where('cp.review_status', 'Approved')
                    ->where('products.brand_id', $request->brand)
                    ->where('products.status', '1')
                    ->groupBy('products.id')
                    ->orderBy('products.title_th')
                    ->get();            
            }
        } else {
            if ($request->brand == 'ทั้งหมด') {
                $products = Product::select('products.id', 'products.title_th', 'products.title_en')
                        ->join('cart_product as cp', 'products.id', '=', 'cp.product_id')
                        ->join('brands as b', 'products.brand_id', '=', 'b.id')
                        ->where('cp.review_status', 'Approved')
                        ->where('products.status', '1')
                        ->where('products.type', $request->type)
                        ->groupBy('products.id')
                        ->orderBy('products.title_th')
                        ->get();
            } else {
                $products = Product::select('products.id', 'products.title_th', 'products.title_en')
                    ->join('cart_product as cp', 'products.id', '=', 'cp.product_id')
                    ->join('brands as b', 'products.brand_id', '=', 'b.id')
                    ->where('cp.review_status', 'Approved')
                    ->where('products.brand_id', $request->brand)
                    ->where('products.status', '1')
                    ->where('products.type', $request->type)
                    ->groupBy('products.id')
                    ->orderBy('products.title_th')
                    ->get();            
            }
        }
        return response()->json($products);
    }

    public function getMoreReview(Request $request)
    {
        $slug = $request->slug;
        $row = $request->row;
        $rowPerPage = 6;

        $reviews = DB::table('products as p')
        ->select('cp.rating', 'cp.review', 'cp.reviewed_at', DB::raw("CONCAT(cus.fname,' ', cus.lname) AS full_name"))
        ->where('p.slug_url_en','LIKE',$slug)
        ->join('cart_product as cp', 'p.id', 'cp.product_id')
        ->join('carts as c', 'cp.cart_id', 'c.id')
        ->join('orders as o', 'c.id', 'o.cart_id')
        ->join('customers as cus', 'o.customer_id', 'cus.id')
        ->where('cp.review_status', 'Approved')
        ->orderByDesc('cp.reviewed_at')
        ->offset($row)
        ->limit($rowPerPage)
        ->get();

        return view('review_more', compact('reviews', 'row'));
    }

    public function reviewBranch()
    {
        $provinces = DB::table('branches')->select('province')->groupBy('province')->orderBy('province')->get();
        $branches = DB::table('branches')->select('id', 'name_th', 'name_en')->orderBy('name_th')->get();
        
        return view('review_branch', compact('provinces', 'branches'));
    }

    public function reviewBranchProvince($province)
    {
        if ($province == 'ทั้งหมด') {
            $branches = Branch::where('status', '1')->orderBy('name_th')->paginate(10);
        } else {
            $branches = Branch::where('province', $province)->where('status', '1')->orderBy('name_th')->paginate(10);
        }
        
        return view('review_branch_show', compact('branches'));
    }

    public function reviewGetBranch($province, $id)
    {
        if ($id == 'ทั้งหมด') {
            if ($province == 'ทั้งหมด') {
                $branches = Branch::where('status', '1')->orderBy('name_th')->paginate(10);
            } else {
                $branches = Branch::where('province', $province)->where('status', '1')->orderBy('name_th')->paginate(10);
            }
        } else {
            $branches = Branch::where('id', $id)->paginate(10);
        }

        return view('review_branch_show', compact('branches'));
    }

    public function getAllProductDetailReview($slug)
    {
        $all_reviews = DB::table('products as p')
        ->select('cp.rating')
        ->where('p.slug_url_en','LIKE',$slug)
        ->join('cart_product as cp', 'p.id', 'cp.product_id')
        ->where('cp.review_status', 'Approved')
        ->get();

        return $all_reviews;
    }

    public function getLimitProductDetailReview($slug, $limit)
    {
        $reviews = DB::table('products as p')
        ->select('cp.rating', 'cp.review', 'cp.reviewed_at', DB::raw("CONCAT(cus.fname,' ', cus.lname) AS full_name"))
        ->where('p.slug_url_en','LIKE',$slug)
        ->join('cart_product as cp', 'p.id', 'cp.product_id')
        ->join('carts as c', 'cp.cart_id', 'c.id')
        ->join('orders as o', 'c.id', 'o.cart_id')
        ->join('customers as cus', 'o.customer_id', 'cus.id')
        ->where('cp.review_status', 'Approved')
        ->orderByDesc('cp.reviewed_at')
        ->limit($limit)
        ->get();

        return $reviews;
    }

    public function getReviewAvg($reviews)
    {
        $count = count($reviews);
        $avg = 0;
        if ($count > 0) {
            $total = 0;
            foreach ($reviews as $review) {
                $total += $review->rating;
            }
            $total_avg = $total / $count;

            $avg1 = round($total_avg, 1, PHP_ROUND_HALF_UP);
            $split = explode('.', $avg1);
            if (count($split) > 1) {
                if ( $split[1] >= 3 && $split[1] <= 5 ) {
                    $decimal = 5;
                    $avg = $split[0].'.'.$decimal;
                } else {
                    $avg = round($avg1, 0, PHP_ROUND_HALF_UP);
                }            
            } else {
                $avg = $split[0];
            }
        }

        return $avg;
    }
}
