<?php

namespace App\Http\Controllers\Qrcode;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\PhpWord;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Models\BatchModel;
use App\Models\ProductListModel;
use App\Models\ProductModel;

class ProductController extends Controller
{
    function generateRandomString($length = 6) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    public function productListShow()
    {
        $productList = new ProductListModel();
        $productListAll = $productList::join('batch', 'batch.id', 'product_list.batch_id')
                        ->select('product_list.*', 'batch.batch_code')
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);

        return view('Qrcode.pages.productList', compact('productListAll'));
    }

    public function productListCreateShow()
    {
        $batch = new BatchModel();
        $batchList = $batch::all();

        return view('Qrcode.pages.productListCreate', compact('batchList'));
    }

    public function productListCreate(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'product_list_code'=>'required|min:3',
            'product_list_name'=>'required|min:3',
            'quantity'=>'required',
            // 'quantity_s'=>'required',
            // 'quantity_m'=>'required',
            // 'quantity_l'=>'required',
            // 'quantity_xl'=>'required',
            // 'quantity_xxl'=>'required',
            // 'describe'=>'required|min:3',
            'product_list_img'=>'required|mimes:jpeg,jpg,png,gif',
        ],[
            'product_list_code.required'=>'Bạn chưa nhập mã danh sách sản phẩm',
            'product_list_code.min'=>'Mã danh sách sản phẩm phải có ít nhất 3 kí tự',
            'product_list_name.required'=>'Bạn chưa nhập tên danh sách sản phẩm',
            'product_list_name.min'=>'Tên danh sách sản phẩm phải có ít nhất 3 kí tự',
            'quantity.required'=>'Bạn chưa nhập số lượng',
            // 'quantity_s.required'=>'Bạn chưa nhập số lượng',
            // 'quantity_m.required'=>'Bạn chưa nhập số lượng',
            // 'quantity_l.required'=>'Bạn chưa nhập số lượng',
            // 'quantity_xl.required'=>'Bạn chưa nhập số lượng',
            // 'quantity_xxl.required'=>'Bạn chưa nhập số lượng',
            // 'describe.required'=>'Bạn chưa nhập mô tả sản phẩm',
            // 'describe.min'=>'Mô tả sản phẩm phải có ít nhất 3 kí tự',
            'product_list_img.required'=>'Bạn chưa chọn ảnh',
            'product_list_img.mimes'=>'Bạn chọn không phải file ảnh',
        ]);
    
        if($validator->fails()){
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $productList = new ProductListModel();
        $productList_check = $productList::where('batch_id', $request->batch_id)->where('product_list_code', $request->product_list_code)->get();

        if (isset($productList_check) && count($productList_check) > 0) {
            return redirect('san-pham/them')->with('error', 'Trong lô hàng danh sách sản phẩm đã tồn tại');
        } elseif ($request->batch_id == "Chưa có lô hàng nào") {
            return redirect('san-pham/them')->with('error', 'Chưa tạo lô hàng của danh sách sản phẩm');
        } else {
            $newProductList = new ProductListModel();

            $newProductList->batch_id = $request->batch_id;
            $newProductList->product_list_code = $request->product_list_code;
            $newProductList->product_list_name = $request->product_list_name;
            $newProductList->quantity = $request->quantity;
            $newProductList->quantity_s = $request->quantity_s;
            $newProductList->quantity_m = $request->quantity_m;
            $newProductList->quantity_l = $request->quantity_l;
            $newProductList->quantity_xl = $request->quantity_xl;
            $newProductList->quantity_xxl = $request->quantity_xxl;
            $newProductList->material = $request->material;
            $newProductList->description = $request->description;
            $imgName = $request->product_list_img->getClientOriginalName();
            $request->product_list_img->move('images/product', $imgName);
            $newProductList->product_list_img = $imgName;

            $newProductList->save();

            do {
                $code_access = $this->generateRandomString();
                $access= new ProductModel();
                $accessItem = $access::where('product_qrcode_access', $code_access)->first();
            } while(!empty($accessItem));
            

            for ($i = 0; $i < $request->quantity; $i++) {
                $newProduct = new ProductModel();

                $newProduct->product_list_id = $newProductList->id;
                $newProduct->product_qrcode_access = $code_access;
                do {
                    $code_verify = $this->generateRandomString();
                    $verify = new ProductModel();
                    $verifyItem = $verify::where('product_qrcode_verify', $code_verify)->first();
                } while(!empty($verifyItem));
                $newProduct->product_qrcode_verify = $code_verify;

                $newProduct->product_qrcode_verify_img = "verify-".$code_verify.".png";
                $newProduct->product_qrcode_access_img = "access-".$code_access.".png";

                $newProduct->save();
            }

            return redirect('san-pham/them')->with('status', 'Thêm danh sách sản phẩm thành công');
        }
        //return redirect('san-pham/them')->with('status', 'Thêm sản phẩm thành công');
        //return redirect('san-pham/them')->with('error', 'Trong lô hàng sản phẩm đã tồn tại');
    }

    public function productListDetail($id)
    {
        $productList = new ProductListModel();
        $productListItem = $productList::join('batch', 'batch.id', 'product_list.batch_id')
                        ->select('product_list.*', 'batch.batch_code')
                        ->find($id);

        return view('Qrcode.pages.productListDetail', compact('productListItem'));
    }

    public function productListUpdateShow($id)
    {
        $productList = new ProductListModel();
        $productListItem = $productList::join('batch', 'batch.id', 'product_list.batch_id')
                        ->select('product_list.*', 'batch.batch_code')
                        ->find($id);

        return view('Qrcode.pages.productListUpdate', compact('productListItem'));
    }

    public function productListUpdate(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'product_list_code'=>'required|min:3',
            'product_list_name'=>'required|min:3',
            'quantity'=>'required',
            // 'quantity_s'=>'required',
            // 'quantity_m'=>'required',
            // 'quantity_l'=>'required',
            // 'quantity_xl'=>'required',
            // 'quantity_xxl'=>'required',
            // 'describe'=>'required|min:3',
            'product_list_img'=>'mimes:jpeg,jpg,png,gif',
        ],[
            'product_list_code.required'=>'Bạn chưa nhập mã sản phẩm',
            'product_list_code.min'=>'Mã sản phẩm phải có ít nhất 3 kí tự',
            'product_list_name.required'=>'Bạn chưa nhập tên sản phẩm',
            'product_list_name.min'=>'Tên sản phẩm phải có ít nhất 3 kí tự',
            // 'quantity.required'=>'Bạn chưa nhập số lượng',
            // 'quantity_s.required'=>'Bạn chưa nhập số lượng',
            // 'quantity_m.required'=>'Bạn chưa nhập số lượng',
            // 'quantity_l.required'=>'Bạn chưa nhập số lượng',
            // 'quantity_xl.required'=>'Bạn chưa nhập số lượng',
            // 'quantity_xxl.required'=>'Bạn chưa nhập số lượng',
            // 'describe.required'=>'Bạn chưa nhập mô tả sản phẩm',
            // 'describe.min'=>'Mô tả sản phẩm phải có ít nhất 3 kí tự',
            'product_list_img.mimes'=>'Bạn chọn không phải file ảnh',
        ]);

        if($validator->fails()){
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $productList = new ProductListModel();
        $productListItem = $productList::find($id);

        $productListItem->batch_id = $request->batch_id;
        $productListItem->product_list_code = $request->product_list_code;
        $productListItem->product_list_name = $request->product_list_name;
        $productListItem->quantity = $request->quantity;
        $productListItem->quantity_s = $request->quantity_s;
        $productListItem->quantity_m = $request->quantity_m;
        $productListItem->quantity_l = $request->quantity_l;
        $productListItem->quantity_xl = $request->quantity_xl;
        $productListItem->quantity_xxl = $request->quantity_xxl;
        $productListItem->material = $request->material;
        $productListItem->description = $request->description;
       
        if(isset($request->product_list_img)) {
            $imgName = $request->product_list_img->getClientOriginalName();
            $request->product_list_img->move('images/product', $imgName);
            $productListItem->product_list_img = $imgName;
        }

        $productListItem->save();

        $product = new ProductModel();
        $product::where('product_list_id',  $productListItem->id)->delete();

        do {
            $code_access = $this->generateRandomString();
            $access= new ProductModel();
            $accessItem = $access::where('product_qrcode_access', $code_access)->first();
        } while(!empty($accessItem));
        

        for ($i = 0; $i < $request->quantity; $i++) {
            $newProduct = new ProductModel();

            $newProduct->product_list_id = $productListItem->id;
            $newProduct->product_qrcode_access = $code_access;
            do {
                $code_verify = $this->generateRandomString();
                $verify = new ProductModel();
                $verifyItem = $verify::where('product_qrcode_verify', $code_verify)->first();
            } while(!empty($verifyItem));
            $newProduct->product_qrcode_verify = $code_verify;

            $newProduct->product_qrcode_verify_img = "verify-".$code_verify.".png";
            $newProduct->product_qrcode_access_img = "access-".$code_access.".png";

            $newProduct->save();
        }

        return redirect('san-pham/sua/'.$id)->with('status', 'Sửa sản phẩm thành công');
    }

   public function productListDelete(Request $request)
    {
        $product = new ProductModel();
        $product::whereIn('product_list_id', $request->delete)->delete();

        $productList = new ProductListModel();
        $productList::whereIn('id', $request->delete)->delete();

        return redirect('san-pham')->with('status', 'Xóa thành công');
    }

    public function createAccessWord($id)
    {
        $phpWord = new PhpWord();
        $section = $phpWord->addSection();

        $productList = new ProductListModel();
        $producListItem = $productList::join('product', 'product_list.id', 'product.product_list_id')
                        ->select('product_list.product_list_code', 'product_list.quantity','product.product_qrcode_access')
                        ->find($id);

        $section->addText("QRCode truy xuất sản phẩm ".$producListItem->product_list_code, array('bold' => true));
        $tableAccessProduct = $section->addTable(['cellMargin'  => 80]);
        $tableAccessProduct->addRow();

        Storage::disk('local')->deleteDirectory('/public/images/QrcodeProduct/product-'.$producListItem->product_list_code.'/access');
        
        $imageAccessProduct = QrCode::format('png')->size(60)->generate('http://localhost:8000/ap/'.$producListItem->product_qrcode_access);
        Storage::disk('local')->put('/public/images/QrcodeProduct/product-'.$producListItem->product_list_code.'/access/access-'.$producListItem->product_qrcode_access.'.png', $imageAccessProduct);
        Storage::disk('public')->put('/images/QrcodeProduct/product-'.$producListItem->product_list_code.'/access/access-'.$producListItem->product_qrcode_access.'.png', $imageAccessProduct);

        $temp = 0;
        for ($i = 0; $i < $producListItem->quantity; $i++) {
            $temp++;

            if($temp  > 6) {
                $temp = 1;
                $tableAccessProduct->addRow();
            }

            $tableAccessProduct->addCell()->addImage(storage_path().'\app\public\images\QrcodeProduct\product-'.$producListItem->product_list_code.'\access\access-'.$producListItem->product_qrcode_access.'.png', array('width' => 60, 'height' => 60));
        }

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');

        Storage::disk('local')->put('/public/words/QrcodeProduct/product-'.$producListItem->product_list_code.'/access-'.$producListItem->product_list_code.'.docx', "");

        $path = storage_path().'\app\public\words\QrcodeProduct\product-'.$producListItem->product_list_code.'\access-'.$producListItem->product_list_code.'.docx';
        $objWriter->save($path);

        return response()->download($path, 'QrcodeProductAccess-'.$producListItem->product_list_code.'.docx');

        //return redirect('them-xac-minh')->with('status', 'Xuất file Word thành công');
    }

    public function createVerifyWord($id)
    {
        $phpWord = new PhpWord();
        $section = $phpWord->addSection();

        $product = new ProductModel();
        $producList = $product::where('product_list_id', $id)->get();
        foreach ($producList as $value) {
            $value->status = 0;
            $value->save();
        }

        $productList = new ProductListModel();
        $producListItem = $productList::select('product_list.product_list_code')->find($id);
        $producMany = $productList::join('product', 'product_list.id', 'product.product_list_id')
                        ->select('product_list.product_list_code', 'product.product_qrcode_verify', 'product.status')
                        ->where('product_list.id' ,$id)
                        ->get();

        $section->addText("QRCode xác minh sản phẩm ".$producListItem->product_list_code, array('bold' => true));
        $tableVerifyProduct = $section->addTable(['cellMargin'  => 80]);
        $tableVerifyProduct->addRow();

        Storage::disk('local')->deleteDirectory('/public/images/QrcodeProduct/product-'.$producListItem->product_list_code.'/verify');

        $temp = 0;
        foreach ($producMany as $value) {

            $temp++;

            if($temp  > 6) {
                $temp = 1;
                $tableVerifyProduct->addRow();
            }

            $imageVerifyProduct = QrCode::format('png')->size(60)->generate('http://localhost:8000/vp/'.$value->product_qrcode_verify);
            Storage::disk('local')->put('/public/images/QrcodeProduct/product-'.$value->product_list_code.'/verify/verify-'.$value->product_qrcode_verify.'.png', $imageVerifyProduct);

            $tableVerifyProduct->addCell()->addImage(storage_path().'\app\public\images\QrcodeProduct\product-'.$value->product_list_code.'/verify/verify-'.$value->product_qrcode_verify.'.png', array('width' => 60, 'height' => 60));
        }

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');

        Storage::disk('local')->put('/public/words/QrcodeProduct/product-'.$producListItem->product_list_code.'/verify-'.$producListItem->product_list_code.'.docx', "");

        $path = storage_path().'\app\public\words\QrcodeProduct\product-'.$producListItem->product_list_code.'\verify-'.$producListItem->product_list_code.'.docx';
        $objWriter->save($path);

        return response()->download($path, 'QrcodeProductVerify-'.$producListItem->product_list_code.'.docx');

        //return redirect('them-xac-minh')->with('status', 'Xuất file Word thành công');
    }
}
