<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductListModel extends Model
{
    use HasFactory;

    protected $table = "product_list";

    protected $fillable = [
        'batch_id',
        'product_list_code',
        'product_list_name',
        'quantity',
        'quantity_s',
        'quantity_m',
        'quantity_l',
        'quantity_xl',
        'quantity_xxl',
        'material',
        'description',
        'product_list_img',
    ];
}
