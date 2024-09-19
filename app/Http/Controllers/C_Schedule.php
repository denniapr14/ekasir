<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use App\Models\User;
use App\Models\DateSchedule;


class C_Schedule extends Controller
{
    public $user;
    public $dateSchedule;
    public function __construct() {
        $this->user = new User();
        $this->dateSchedule = new DateSchedule();
    }
    //
    public function index() {
        $userData = $this->user->firstUser(['id_user' => Session::get('user')]);
        $getDateScheduleAll = $this->dateSchedule->getDateScheduleAll();
        $getDateSchedule = $this->dateSchedule->getDateScheduleWhere(
            [
                ['dateDS', '>=', Carbon::now()->startOfMonth()],
                ['dateDS', '<=', Carbon::now()->endOfMonth()],
            ]
        );


        // $getLiburan = $this->getAllDaysInYear(2024);
        // dd($getLiburan);
        if (session()->has('user')) {
            # code...

            return view('Dashboard.schedule',
                compact(
                'userData',
                'getDateSchedule',
                'getDateScheduleAll'
                )
            );
        }else{
            return redirect()->route('login');
        }
    }
    public function getAllDateSchedule() {
        $userData = $this->user->firstUser(['id_user' => Session::get('user')]);
        $getDateSchedule = $this->dateSchedule->getDateScheduleWhere(
            [

            ]
        );


        // $getLiburan = $this->getAllDaysInYear(2024);
        // dd($getLiburan);
        if (session()->has('user')) {
            # code...

            return view('Dashboard.schedule',
                compact(
                'userData',
                'getDateSchedule'
                )
            );
        }else{
            return redirect()->route('login');
        }
    }

    public function addScheduleAction(Request $request){
        $dataDate = $this->getAllDaysInYear($request->years);
        if (session()->has('user')) {
            # code...

            $inputDateSchedule = array();
            foreach ($dataDate as $data) {
                $inputDateSchedule[] = array(
                    'dayNameDS' => $data['day'],
                    'statusDS'  => $data['status'],
                    'dateDS'    => $data['date']
                );
            }
            // dd($inputDateSchedule);

            $this->dateSchedule->insertDateSchedule(
                $inputDateSchedule
            );

            return redirect()->route('schedule')->with('success','data tahun '.$request->years.' berhasil di simpan');
        }else{
            return redirect()->route('login');
        }
    }

    public function changeSchedule($id, $status) {

        if (session()->has('user')) {
            # code...
            $decryptedID = Crypt::decrypt($id);
            $decryptedStatus = Crypt::decrypt($status);

            DB::table('dateSchedule')
            ->where('id_dateSchedule', $decryptedID) // Assuming $productId is the ID of the product you want to update
            ->update([
                'statusDS'          => $decryptedStatus,
                ]);

            return redirect()->route('schedule')->with('success','Status telah menjadi '.$decryptedStatus);
        }else{
            return redirect()->route('login');
        }

    }

    public function getAllDaysInYear($year)
    {
        $startDate = Carbon::createFromDate($year, 1, 1); // Start from January 1st
        $endDate = Carbon::createFromDate($year, 12, 31); // End on December 31st

        $datesArray = [];

        // Loop through each day and add it to the array
        for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
            $status = ($date->dayOfWeek == Carbon::SUNDAY) ? 'holiday' : 'work';

            $datesArray[] = [
                'day' => $date->format('l'), // Full day name (e.g., Monday)
                'status' => $status,
                'date' => $date->toDateString(), // Date in 'Y-m-d' format
            ];
        }

        return $datesArray;
    }

}
