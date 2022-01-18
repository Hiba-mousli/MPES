<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\category;
use Carbon\Carbon;

class ProductController extends Controller
{

    
    public function Update($id, Request $request)
    {

        $product = product::find($id)->get();
        if($request->product_name != null)
        {
            DB::table('products')
            ->where('id', $id)
            ->update(['product_name'=>$request->product_name]);
        }
        if($request->price != null)
        {
            DB::table('products')
            ->where('id', $id)
            ->update(['price'=>$request->price]);
        }
        if($request->image != null)
        {
            DB::table('products')
            ->where('id', $id)
            ->update(['image'=>$request->image]);
        }
        if($request->type != null)
        {
            DB::table('products')
            ->where('id', $id)
            ->update(['type'=>$request->type]);
        }
        if($request->amount_products != null)
        {
            DB::table('products')
            ->where('id', $id)
            ->update(['amount_products'=>$request->amount_products]);
        }

        return ['Update done...'];
        }

    public function ShowDetails($id)
    {
           $product = Product::find($id);
           $product->view +=1 ;
           $product->update();  
           return  $product;//->load(['user']);
    }

    
    public function Pagination(){

        $product = product::all();
        $product = product::paginate(3);
        return $product ;
    }

    public function UserProduct($user_id){

       return Product::where('user_id','like','%'.$user_id.'%')->get();

    }
    public function ShowDetailsWithEmail($id)
    {
           $product = Product::find($id);
           $product->view +=1 ;
           $product->update();  
           return  $product;//->load(['user']);
    }


    
    public function addproduct(Request $request)
    {
        # Done.....

        $validator = Validator::make($request->all(), [
            'product_name'=>['string'],
            'expiry_date'=>['required'],
            'image'=>['required','string'],
            'type'=>['required','string'],
            'num_likes'=>['required','numeric'],
            'price'=>['required','numeric'],
            'amount_products'=>['required','numeric'],
            'user_id'=>['required','numeric'],
            'category_id'=>['required','numeric'],

        ]);

        if($validator->fails()){
            return $validator->errors()->all();
        }

        $product = Product::query()->create([
            'product_name' => $request->product_name,
            'expiry_date' => $request->expiry_date,
            'discount_value' => $request->discount_value,
            'image' => $request->image,
            'type' => $request->type,
            'num_likes' => $request->num_likes,
            'price' => $request->price,
            'amount_products' => $request->amount_products,
            'user_id' => $request->user_id,
            'category_id' => $request->category_id,



        ]);
        foreach ($request->discounts as $discount){
            $product->discounts()->create([
                'name' => $discount['name'],
                'discount' => $discount['discount'],
                'discount_date' => $discount['discount_date'],


           ]);
         }
        if($product->save())
        return ['status'=>'Product created successfully.'];

    }


    // public function addProduct(Request $request)
    // {
    //     # Done.....
    //   //  return response($request->get('image'));
    //     $validator = Validator::make($request->all(), [
    //         'product_name'=>['string'],
    //         'expiry_date'=>['required'],
    //         'image'=>['required','string'],
    //         'type'=>['required','string'],
    //         'num_likes'=>['required','numeric'],
    //         'price'=>['required','numeric'],
    //         'amount_products'=>['required','numeric'],
    //         'user_id'=>['required','numeric'],
    //         'category_id'=>['required','numeric'],
    //     ]);
    //     if($validator->fails()){
    //         return $validator->errors()->all();
    //     }
    //     $product = Product::query()->create([
    //         'product_name' => $request->get('json')['product_name'],
    //         'expiry_date' => $request->expiry_date,
    //         'discount_value' => $request->discount_value,
    //         'image' => $request->image,
    //         'type' => $request->type,
    //         'num_likes' => $request->num_likes,
    //         'price' => $request->price,
    //         'amount_products' => $request->amount_products,
    //         'user_id' => $request->user_id,
    //         'category_id' => $request->category_id,
    //          $image =  $request->file("img")->get()
    //     ]);
    //     // $imagePath = public_path()."//images";
    //     // $image->move($imagePath,$image->getClientOrginalExtension);
    //     foreach ($request->discounts as $discount){
    //         $product->discounts()->create([
    //             'name' => $discount['name'],
    //             'discount' => $discount['discount'],
    //             'discount_date' => $discount['discount_date'],
    //        ]);
    //      }
    //     if($product->save())
    //     return ['status'=>'Product created successfully.'];
    // }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function searchByName(string $product_name)
    {
            # Done...

        // dd(product::where('product_name', $product_name)->get());
        return  product::where('product_name', $product_name)->get();

    }

    public function searchByType( $type)
    {
            # Done...

        // dd(product::where('product_name', $product_name)->get());
        return  product::where('type', $type)->get();

    }

    public function searchByExpiry_date($expiry_date)
    {   #Done
        $current = Carbon::parse($expiry_date);
        return  product::where('expiry_date', $current)->get();

       /* to return product after compare the current date with the date in the request
        and return all the product have the date and all grater than
        return product:: whereDate('expiry_date', '>', Carbon::now())->get();
       */

    }

    public function sortingByCategory( $category_id)
    {
        # Done...

        return Category::find( $category_id)->product()->get();
    }

    public function sortingByType( $type)
    {
        # Done...

        return product::orderBy('type')->product()->get();
    }




   public function addLike( $id, Request $request)
   {
        #Done
        $product=Product::find($id)->get();
        if($request->num_likes!=null)
        {        DB::table('products')
                    ->where('id', $id)
                    ->update(['num_likes'=>$request->num_likes]);
        }
        return['Update like done'];
    }

    public function destroy($id)
    {
        # Done...

            $product =Product::find($id); $product->delete(); return $product;
    }

    public function getProducts()
     {
         # Done...
         $product=product::query()->with(['user'])->get();
         return $product;

    }




    public function malaz(){


        return response('mmmm');
    }





    public function show( $id)
    {
        # Done...

           $product = Product::find($id);
           $discounts = $product->discounts()->get();
           $maxDiscount = null;
            foreach ($discounts as $discount)
            {
                if (Carbon::parse($discount['discount_date']) <= now())
                {
                $maxDiscount = $discount;
                }
            }
            if (!is_null($maxDiscount))
            {
                $discount_value =
                ($product->price*$maxDiscount['discount'])/100;
                // ex: 1000*(22/100)=220->1000-220=780
                $product['current_price'] = $product->price - $discount_value;
            }
                 //dd($product['current_price'] );
                 $product->view +=1 ;
                 $product->update();  
           return  $product->load(['user']);
    }



}
