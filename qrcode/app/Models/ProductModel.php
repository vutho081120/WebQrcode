<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use HasFactory;

    protected $table = "product";

    protected $fillable = [
        'product_list_id',
        'product_qrcode_verify',
        'product_qrcode_access',
        'product_qrcode_verify_img',
        'product_qrcode_access_img',
        'status',
    ];
}
