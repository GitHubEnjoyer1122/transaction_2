<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Product;
use App\Models\Student;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function login(){
        return view('login');
    }

    public function product(){
        return view('product');
    }

    public function qr(){
        return view('qr');
    }

    public function table(){
        $transactions = Transaction::all();
        $transaction_details = TransactionDetail::all();
        $datas = [];
        $dirtyTotal = 0;
        $cleanTotal = 0;

        foreach ($transaction_details as $details) {
                $product = Product::where('id', $details->product_id)->first();

                $productStart = $product->product_capital_price;
                $productSell = $product->product_sell_price;

                $productSellQty = ($productSell * $details->quantity);

                $productCleanQty = ($productSell - $productStart) * $details->quantity;

                $dirtyTotal = $dirtyTotal + $productSellQty;
                $cleanTotal = $cleanTotal + $productCleanQty;
        }
        
        foreach($transactions as $transaction){
            $student = Student::where('id', $transaction->student_id)->first();
            $studentName = $student->nama_siswa;

            $classId = Classroom::where('id_kelas', $student->id_kelas_siswa)->first();
            

            $grade =  $classId->kelas;
            if($student->tahun_angkatan == "2021/2022"){
                $grade = $grade.'II';
            }else if($student->tahun_angkatan == "2022/2023"){
                $grade = $grade.'I';
            }

            $classroom_name = $classId->nama_kelas;
            $classroom = $grade.' '.$classroom_name;
            $formatTime = $transaction->date_time;

            $mergedData = array_merge(['classroom' => $classroom], ['student'=> $studentName], ['transaction_id'=> $transaction->id], ['date'=> $formatTime]);
            $datas[] = $mergedData;
        }
        $dirtyTotalFormat = number_format($dirtyTotal, 0, ',', '.');
        $cleanTotalFormat = number_format($cleanTotal, 0, ',', '.');

        return view('profit_table', compact(['datas', 'dirtyTotalFormat', 'cleanTotalFormat']));
    }

    public function transaction(){
        $studentsAll = Student::all();
        $products = Product::all();
        $students = [];
        $classesid = [];
        $classes = [];
        $classesChild = [];

        foreach($studentsAll as $stu){
            $year1 = substr($stu->tahun_angkatan, 0, 4);
            $year2 = substr($stu->tahun_angkatan, 5, 4);
            $yearAll = $year1.$year2;

            if(intval($yearAll) > 20202021){
                $students[] = $stu;
            }
        }
/* */
        foreach($students as $stud){
            if($stud->id_kelas_siswa == 74){
                continue;
            }

            if(!in_array($stud->id_kelas_siswa, $classesid)){
                $classesid[] = $stud->id_kelas_siswa;
            }
        }
/** */
        foreach($classesid as $classu){
            $classFind = Classroom::where('id_kelas', $classu)->first();
            $studentTarget = Student::where('id_kelas_siswa', $classu)->first();

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
        }

        return view('transaction', compact(['students', 'classes', 'products']));
    }
}
