<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BatchModel;
use App\Models\ProductListModel;
use App\Models\ProductModel;

class HomeController extends Controller
{
    public function homeShow()
    {
        $productList = new ProductListModel();
        $productListAll = $productList::join('product', 'product.product_list_id', 'product_list.id')
                        ->groupBy('product_list.product_list_code', 'product_list.product_list_img','product_list.product_list_name', 'product.product_qrcode_access_img')
                        ->select('product_list.product_list_code', 'product_list.product_list_img','product_list.product_list_name', 'product.product_qrcode_access_img')
                        ->paginate(12);

        return view('Site.pages.home', compact('productListAll'));
    }

    public function accessBatch($id)
    {
        $batch = new BatchModel();
        $batchItem = $batch::where('batch_qrcode_access' ,$id)->first();

        return view('Site.pages.accessBatch', compact('batchItem'));

    }

    public function verifyBatch($id)
    {
        $verify = new BatchModel();
        $verifyItem = $verify::where('batch_qrcode_verify', $id)->first();

        if($verifyItem->status == 0) {
            $verifyItem->status = 1;
            $verifyItem->save();
            return view('Site.pages.verifyBatchFirst');
        }

        return view('Site.pages.verifyBatchMany');

    }

    public function accessProduct($id)
    {
        $productList = new ProductListModel();
        $producListItem = $productList::join('product', 'product_list.id', 'product.product_list_id')
                        ->join('batch', 'batch.id', 'product_list.batch_id')
                        ->where('product.product_qrcode_access', $id)
                        ->select('product_list.*', 'batch.batch_code')
                        ->first();

        return view('Site.pages.accessProduct', compact('producListItem'));

    }

    public function verifyProduct($id)
    {
        $product = new ProductModel();
        $verifyItem = $product::where('product_qrcode_verify', $id)->first();

        if($verifyItem->status == 0) {
            $verifyItem->status = 1;
            $verifyItem->save();
            return view('Site.pages.verifyProductFirst');
        }

        return view('Site.pages.verifyProductMany');

    }

    public function contactShow()
    {
        return view('Site.pages.contact');
    }

    public function policyShow()
    {
        return view('Site.pages.policy');
    }

    public function find(Request $request)
    {
        $productList = new ProductListModel();
        if ($request->year_create != 0 && $request->made_in != 0) {
            $productListAll = $productList::join('product', 'product.product_list_id', 'product_list.id')
                        ->join('batch', 'batch.id', 'product_list.batch_id')
                        ->where('batch.year_create', $request->year_create)
                        ->where('batch.made_in', $request->made_in)
                        ->groupBy('product_list.product_list_code', 'product_list.product_list_img','product_list.product_list_name', 'product.product_qrcode_access_img')
                        ->select('product_list.product_list_code', 'product_list.product_list_img','product_list.product_list_name', 'product.product_qrcode_access_img')
                        //->paginate(12);
                        ->get();
        } elseif ($request->year_create == 0 && $request->made_in != 0) {
            $productListAll = $productList::join('product', 'product.product_list_id', 'product_list.id')
                        ->join('batch', 'batch.id', 'product_list.batch_id')
                        ->where('batch.made_in', $request->made_in)
                        ->groupBy('product_list.product_list_code', 'product_list.product_list_img','product_list.product_list_name', 'product.product_qrcode_access_img')
                        ->select('product_list.product_list_code', 'product_list.product_list_img','product_list.product_list_name', 'product.product_qrcode_access_img')
                        //->paginate(12);
                        ->get();
        } elseif ($request->year_create != 0 && $request->made_in == 0) {
            $productListAll = $productList::join('product', 'product.product_list_id', 'product_list.id')
                        ->join('batch', 'batch.id', 'product_list.batch_id')
                        ->where('batch.year_create', $request->year_create)
                        ->groupBy('product_list.product_list_code', 'product_list.product_list_img','product_list.product_list_name', 'product.product_qrcode_access_img')
                        ->select('product_list.product_list_code', 'product_list.product_list_img','product_list.product_list_name', 'product.product_qrcode_access_img')
                        //->paginate(12);
                        ->get();
        } elseif ($request->year_create == 0 && $request->made_in == 0) {
            $productListAll = $productList::join('product', 'product.product_list_id', 'product_list.id')
                        ->groupBy('product_list.product_list_code', 'product_list.product_list_img','product_list.product_list_name', 'product.product_qrcode_access_img')
                        ->select('product_list.product_list_code', 'product_list.product_list_img','product_list.product_list_name', 'product.product_qrcode_access_img')
                        //->paginate(12);
                        ->get();
        }

        return view('Site.pages.find', compact('productListAll'));
    }
}
