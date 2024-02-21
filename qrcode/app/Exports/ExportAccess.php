<?php

namespace App\Exports;

use App\Models\AccessModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

// class ExportAccess implements FromCollection, WithHeadings
// {
//     /**
//     * @return \Illuminate\Support\Collection
//     */

//     public $batch;

//     public function __construct($batch)
//     {
//         $this->batch = $batch;
//     }

//     public function collection()
//     {
//         $accessList = AccessModel::where('batch', $this->batch)
//                             ->select('batch', 'product_id', 'product_name', 'quantity', 'agent', 'year_create')
//                             ->get();
//         foreach ($accessList as $row) {
//             $access[] = array(
//                 '0' => $row->batch,
//                 '1' => $row->product_id,
//                 '2' => $row->product_name,
//                 '3' => $row->quantity,
//                 '4' => $row->agent,
//                 '5' => $row->year_create,
//             );
//         }

//         return (collect($access));
//     }

//     public function headings(): array
//     {
//         return [
//             'Mã lô hàng',
//             'Mã sản phẩm',
//             'Tên sản phẩm',
//             'Số lượng',
//             'Nhà sản xuất',
//             'Năm sản xuất',
//         ];
//     }
// }
