<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use App\Models\DateSchedule;
use App\Models\EmployeeSchedule;
use Carbon\Carbon;

class C_EmployeSchedule extends Controller
{
    public $user;
    public $dateSchedule;
    public $employeeSchedule;
    public function __construct()
    {
        $this->user = new User();
        $this->dateSchedule = new DateSchedule();
        $this->employeeSchedule = new EmployeeSchedule();
    }

    function index()
    {
        $userData = $this->user->firstUser(['id_user' => Session::get('user')]);

        $getDateSchedule = $this->dateSchedule->getDateScheduleWhere(
            [
                ['dateDS', '>=', Carbon::now()->startOfMonth()],
                ['dateDS', '<=', Carbon::now()->endOfMonth()],
            ]
        );
        $getEmployee = $this->user->getUserWhere([
            'levelUser' => 'kasir '
        ]);

        $getEmployeeSchedule = $this->employeeSchedule->getEmployeeSchedule();
        $getEmployeeScheduleDate = $this->employeeSchedule->getEmployeeScheduleDate();
                // $getLiburan = $this->getAllDaysInYear(2024);
        // dd($getEmployeeSchedule);
        if (session()->has('user')) {
            # code...

            return view('Dashboard.employeSchedule',
                compact(
                    'userData',
                    'getDateSchedule',
                    'getEmployee',
                    'getEmployeeSchedule',
                    'getEmployeeScheduleDate'
                )
            );
        } else {
            return redirect()->route('login');
        }
    }
    public function getEmployeeSchedule()  {
        $userData = $this->user->firstUser(['id_user' => Session::get('user')]);

        $getEmployee = $this->user->getUserWhere([
            'levelUser' => 'kasir '
        ]);
        $getDateSchedule = $this->dateSchedule->getDateScheduleWhere(
            [
                ['dateDS', '>=', Carbon::now()->startOfMonth()],
                ['dateDS', '<=', Carbon::now()->endOfMonth()],
            ]
        );
        $getEmployeeScheduleDate = $this->employeeSchedule->getEmployeeScheduleDate();
        $getEmployeeSchedule = $this->employeeSchedule->getEmployeeSchedule();

        if (session()->has('user')) {
            # code...

            return view('Dashboard.employeScheduleAll',
                compact(
                    'userData',
                    'getDateSchedule',
                    'getEmployee',
                    'getEmployeeSchedule',
                    'getEmployeeScheduleDate'

                )
            );
        } else {
            return redirect()->route('login');
        }
    }
    public function addEmployeeScheduleAction(Request $request)
    {



        $userData = $this->user->firstUser(['id_user' => Session::get('user')]);
        $getDateSchedule = $this->dateSchedule->getDateScheduleWhere(
            [
                ['dateDS', '>=', $request->dateStart],
                ['dateDS', '<=', $request->dateStop],
            ]
        );

        // dd($request->fullWeek);

        if (session()->has('user')) {

            $dataInput = []; // Initialize $dataInput as an empty array

            if ($request->fullWeek == "yes") {
                foreach ($getDateSchedule as $dateSchedule) {
                    $dataInput[] = array(
                        'id_dateSchedule' => $dateSchedule->id_dateSchedule,
                        'id_user'         => $request->user,
                        'shiftMorning'    => $request->morning ?? "false",
                        'shiftAfternoon'  => $request->afternoon ?? "false",
                        'shiftNight'      => $request->night ?? "false"
                    );
                }
            } else {
                foreach ($getDateSchedule as $dateSchedule) {
                    $isHoliday = $dateSchedule->statusDS == "holiday";

                    $dataInput[] = array(
                        'id_dateSchedule' => $dateSchedule->id_dateSchedule,
                        'id_user'         => $request->user,
                        'shiftMorning'    => $isHoliday ? "false" : ($request->morning ?? "false"),
                        'shiftAfternoon'  => $isHoliday ? "false" : ($request->afternoon ?? "false"),
                        'shiftNight'      => $isHoliday ? "false" : ($request->night ?? "false")
                    );
                }
                // Check if it's a holiday, set shifts to "false" if true
            }

            // $dataInput should now be populated based on your conditions

            // dd($dataInput);
            $this->employeeSchedule->insertSchedule($dataInput);
            return redirect()->back()->with('success', 'Jadwal kasir telah disimpan!');
        } else {
            return redirect()->route('login');
        }
    }
    public function editEmployeeScheduleAction(Request $request, $id_schedule) {
        $decryptedID = Crypt::decrypt($id_schedule);
        // dd($request);


            // dd($request);
            DB::table('schedule')
            ->where('id_schedule', $decryptedID) // Assuming $productId is the ID of the product you want to update
            ->update([
                'shiftMorning'    => $request->editMorning ?? "false",
                'shiftAfternoon'  => $request->editAfternoon ?? "false",
                'shiftNight'      => $request->editNight ?? "false"
                ]);

            // $dataInput should now be populated based on your conditions

            // dd($dataInput);

            return redirect()->back()->with('success', 'Jadwal kasir telah disimpan!');



    }

    public function deleteEmployeeSchedule( $id_schedule) {
        $decryptedID = Crypt::decrypt($id_schedule);
        // dd($request);


            // dd($request);
            DB::table('schedule')
            ->where('id_schedule', $decryptedID) // Assuming $productId is the ID of the product you want to update
            ->update([
                'shiftMorning'    =>  "false",
                'shiftAfternoon'  =>  "false",
                'shiftNight'      =>  "false"
                ]);

            // $dataInput should now be populated based on your conditions

            // dd($dataInput);

            return redirect()->back()->with('success', 'Jadwal kasir telah disimpan!');



    }
    //
}
