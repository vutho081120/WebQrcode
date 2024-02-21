<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatchModel extends Model
{
    use HasFactory;

    protected $table = "batch";

    protected $fillable = [
        'batch_code', 
        'batch_name',
        'year_create',
        'made_in',
        'description',
        'quantity_product',
        'quantity_product_list',
        'batch_qrcode_verify',
        'batch_qrcode_access',
        'batch_qrcode_verify_img',
        'batch_qrcode_access_img',
        'status',
    ];
}
