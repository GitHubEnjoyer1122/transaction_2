<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Product;
use App\Models\Student;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function filter(Request $request){
        $studentFilter = Student::where('id_kelas_siswa', $request->idClassroom)->get();
        
        return response()->json([
            'datas' => $studentFilter
        ]);
    }

    public function detail(Request $request){
        $transaction_detail = TransactionDetail::where('transaction_id', $request->id_transaction)->get();
        $orders = [];

        foreach($transaction_detail as $detail){
            $product = Product::where('id', $detail->product_id)->first();

            $productName = $product->product_name;
            $productFirstPrice = $product->product_capital_price;
            $productSellPrice = $product->product_sell_price;

            $mergedArray = array_merge(["prod_name"=>$productName], ["prod_first"=>$productFirstPrice], ["prod_sell"=>$productSellPrice], ["prod_qty"=>$detail->quantity]);
            $orders[] = $mergedArray;
        }
        
        return response()->json([
            "datas" => $orders
        ]);
    }

    public function payment(Request $request){
        $timeNow = Carbon::now('Asia/Makassar');
        $transaction = Transaction::create([
            "date_time" => $timeNow
        ]);

        $studentData = Student::where('id', $request->student)->first();
        $transaction->student()->associate($studentData);
        $transaction->save();

        foreach($request->orders as $order){

            $transaction_detail = TransactionDetail::create([
                "quantity" => $order['product_qty']
            ]);

            $productData = Product::where('id', $order['product_id'])->first();
            $transaction_detail->product()->associate($productData);
            $transaction_detail->save();

            $transaction_detail->transaction()->associate($transaction);
            $transaction_detail->save();
        }

        return redirect()->intended('table');
    }

    public function filter_student(Request $request){
        $classFind = Classroom::where('id_kelas', $request->idStudent)->first();
        $studentTarget = Student::where('id_kelas_siswa', $classFind->id_kelas)->first();

            $classes = [];

            if($studentTarget->tahun_angkatan == '2021/2022'){
                $className = $classFind->nama_kelas;
                $classGrade = $classFind->kelas;
                $classGradeTrue = $classGrade."II";

                $classId = ["classId"=> $classFind->id_kelas];

                $classes[] = array_merge($classId, ['className' => $classGradeTrue. ' '. $className]);
            }else if($studentTarget->tahun_angkatan == '2022/2023'){
                $className = $classFind->nama_kelas;
                $classGrade = $classFind->kelas;
                $classGradeTrue = $classGrade."I";

                $classId = ["classId"=> $classFind->id_kelas];

                $classes[] = array_merge($classId, ['className' => $classGradeTrue. ' '. $className]);

            }else if($studentTarget->tahun_angkatan == '2023/2024'){
                $className = $classFind->nama_kelas;
                $classGrade = $classFind->kelas;

                $classId = ["classId"=> $classFind->id_kelas];

                $classes[] = array_merge($classId, ['className' => $classGrade. ' '. $className]);
            }
        
        return response()->json([
            'datas' => $classes
        ]);
    }
    //foreach($requst->product_name as $product){

    // }
}
