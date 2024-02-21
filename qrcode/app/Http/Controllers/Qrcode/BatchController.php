<?php

namespace App\Http\Controllers\Qrcode;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpWord\PhpWord;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;

use App\Models\BatchModel;
use App\Models\ProductListModel;

class BatchController extends Controller
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

    public function batchShow()
    {
        $batch = new BatchModel();
        $batchList = $batch::orderBy('created_at', 'desc')->paginate(5);

        return view('Qrcode.pages.batch', compact('batchList'));
    }

    public function batchCreateShow()
    {
        return view('Qrcode.pages.batchCreate');
    }

    public function batchCreate(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'batch_code'=>'required|min:3',
            'batch_name'=>'required|min:3',
            'year_create'=>'required',
            // 'description'=>'min:3',
            'quantity_product_list'=>'required',
            'quantity_product'=>'required',
        ],[
            'batch_code.required'=>'Bạn chưa nhập mã lô hàng',
            'batch_code.min'=>'Mã lô hàng phải có ít nhất 3 kí tự',
            'batch_name.required'=>'Bạn chưa nhập tên lô hàng',
            'batch_name.min'=>'Tên lô hàng phải có ít nhất 3 kí tự',
            'year_create.required'=>'Bạn chưa nhập năm sản xuất',
            //'description.required'=>'Bạn chưa nhập mô tả lô hàng',
            //'description.min'=>'Mô tả lô hàng phải có ít nhất 3 kí tự',
            'quantity_product_list.required'=>'Bạn chưa nhập số lượng',
            'quantity_product.required'=>'Bạn chưa nhập số lượng',
        ]);
    
        if($validator->fails()){
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $batch = new BatchModel();
        $batch_check = $batch::where('batch_code', $request->batch_code)->get();

        if (isset($batch_check) && count($batch_check) > 0) {
            return redirect('lo-hang/them')->with('error', 'Lô hàng đã tồn tại');
        } elseif ($request->quantity_product_list > $request->quantity_product) {
            return redirect('lo-hang/them')->with('error', 'Số lượng sản phẩm không đúng');
        } else {
            $newBatch = new BatchModel();

            $newBatch->batch_code = $request->batch_code;
            $newBatch->batch_name = $request->batch_name;
            $newBatch->year_create = $request->year_create;
            $newBatch->made_in = $request->made_in;
            $newBatch->description = $request->description;
            $newBatch->quantity_product_list = $request->quantity_product_list;
            $newBatch->quantity_product = $request->quantity_product;

            do {
                $code_verify = $this->generateRandomString();
                $verify = new BatchModel();
                $verifyItem = $verify::where('batch_qrcode_verify', $code_verify)->first();
            } while(!empty($verifyItem));
            $newBatch->batch_qrcode_verify = $code_verify;

            do {
                $code_access = $this->generateRandomString();
                $access= new BatchModel();
                $accessItem = $access::where('batch_qrcode_access', $code_access)->first();
            } while(!empty($accessItem));
            $newBatch->batch_qrcode_access = $code_access;

            $newBatch->batch_qrcode_verify_img = "verify-".$code_verify.".png";
            $newBatch->batch_qrcode_access_img = "access-".$code_access.".png";

            $newBatch->save();
            
            return redirect('lo-hang/them')->with('status', 'Thêm lô hàng thành công');
        }

        //return redirect('lo-hang/them')->with('status', 'Thêm lô hàng thành công');
    }

    public function batchDetail($id)
    {
        $batch = new BatchModel();
        $batchItem = $batch::find($id);

        return view('Qrcode.pages.batchDetail', compact('batchItem'));
    }

    public function batchUpdateShow($id)
    {
        $batch = new BatchModel();
        $batchItem = $batch::find($id);

        return view('Qrcode.pages.batchUpdate', compact('batchItem'));
    }

    public function batchUpdate(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'batch_code'=>'required|min:3',
            'batch_name'=>'required|min:3',
            'year_create'=>'required',
            // 'description'=>'required|min:3',
            'quantity_product_list'=>'required',
            'quantity_product'=>'required',
        ],[
            'batch_code.required'=>'Bạn chưa nhập mã lô hàng',
            'batch_code.min'=>'Mã lô hàng phải có ít nhất 3 kí tự',
            'batch_name.required'=>'Bạn chưa nhập tên lô hàng',
            'batch_name.min'=>'Tên lô hàng phải có ít nhất 3 kí tự',
            'year_create.required'=>'Bạn chưa nhập năm sản xuất',
            // 'description.required'=>'Bạn chưa nhập mô tả lô hàng',
            // 'description.min'=>'Mô tả lô hàng phải có ít nhất 3 kí tự',
            'quantity_product_list.required'=>'Bạn chưa nhập số lượng',
            'quantity_product.required'=>'Bạn chưa nhập số lượng',
        ]);
    
        if($validator->fails()){
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $batch = new BatchModel();
        $batchItem = $batch::find($id);

        $batchItem->batch_code = $request->batch_code;
        $batchItem->batch_name = $request->batch_name;
        $batchItem->year_create = $request->year_create;
        $batchItem->made_in = $request->made_in;
        $batchItem->description = $request->description;
        $batchItem->quantity_product_list = $request->quantity_product_list;
        $batchItem->quantity_product = $request->quantity_product;

        $batchItem->save();
        
        return redirect('lo-hang/sua/'.$id)->with('status', 'Sửa lô hàng thành công');
    }

    public function batchDelete(Request $request)
    {
        $productList = new ProductListModel();
        $batch_check =  $productList::whereIn('batch_id', $request->delete)->get();

        if (isset($batch_check) && count($batch_check) > 0) {
            return redirect('lo-hang')->with('error', 'Bạn chưa xoá sản phẩm thuộc lô hàng');
        } else {
            $batch = new BatchModel();
            $batch::whereIn('id', $request->delete)->delete();

            return redirect('lo-hang')->with('status', 'Xóa thành công');
        }
    }

    public function createAccessWord($id)
    {
        $phpWord = new PhpWord();
        $section = $phpWord->addSection();

        $batch = new BatchModel();
        $batchItem = $batch::find($id);
        $section->addText("QRCode truy xuất lô hàng ".$batchItem->batch_code, array('bold' => true));
        $tableAccessBatch = $section->addTable();
        $tableAccessBatch->addRow();
        $imageAccessBatch = QrCode::format('png')->size(60)->generate('http://localhost:8000/ab/'.$batchItem->batch_qrcode_access);
        Storage::disk('local')->put('/public/images/QrcodeBatch/batch-'.$batchItem->batch_code.'/access-'.$batchItem->batch_qrcode_access.'.png', $imageAccessBatch);
        $tableAccessBatch->addCell()->addImage(storage_path().'\app\public\images\QrcodeBatch\batch-'.$batchItem->batch_code.'\access-'.$batchItem->batch_qrcode_access.'.png', array('width' => 60, 'height' => 60));

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');

        Storage::disk('local')->put('/public/words/QrcodeBatch/batch-'.$batchItem->batch_code.'/access-'.$batchItem->batch_code.'.docx', "");

        $path = storage_path().'\app\public\words\QrcodeBatch\batch-'.$batchItem->batch_code.'\access-'.$batchItem->batch_code.'.docx';
        $objWriter->save($path);

        return response()->download($path, 'QrcodeBatchAccess-'.$batchItem->batch_code.'.docx');

        //return redirect('them-xac-minh')->with('status', 'Xuất file Word thành công');
    }

    public function createVerifyWord($id)
    {
        $phpWord = new PhpWord();
        $section = $phpWord->addSection();

        $batch = new BatchModel();
        $batchItem = $batch::find($id);
        $batchItem->status = 0;
        $batchItem->save();
        $section->addText("QRCode xác minh lô hàng ".$batchItem->batch_code, array('bold' => true));
        $tableVerifyBatch = $section->addTable();
        $tableVerifyBatch->addRow();
        $imageVerifyBatch = QrCode::format('png')->size(60)->generate('http://localhost:8000/vb/'.$batchItem->batch_qrcode_verify);
        Storage::disk('local')->put('/public/images/QrcodeBatch/batch-'.$batchItem->batch_code.'/verify-'.$batchItem->batch_qrcode_verify.'.png', $imageVerifyBatch);
        $tableVerifyBatch->addCell()->addImage(storage_path().'\app\public\images\QrcodeBatch\batch-'.$batchItem->batch_code.'\verify-'.$batchItem->batch_qrcode_verify.'.png', array('width' => 60, 'height' => 60));

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');

        Storage::disk('local')->put('/public/words/QrcodeBatch/batch-'.$batchItem->batch_code.'/verify-'.$batchItem->batch_code.'.docx', "");

        $path = storage_path().'\app\public\words\QrcodeBatch\batch-'.$batchItem->batch_code.'\verify-'.$batchItem->batch_code.'.docx';
        $objWriter->save($path);

        return response()->download($path, 'QrcodeBatchVerify-'.$batchItem->batch_code.'.docx');

        //return redirect('them-xac-minh')->with('status', 'Xuất file Word thành công');
    }
}
