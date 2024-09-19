<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeSchedule extends Model
{
    protected $primaryKey = "id_schedule";
    protected $table = "schedule";

    public function insertSchedule($data){
        return EmployeeSchedule::insert($data);
    }
    public function getEmployeeSchedule(){
        return EmployeeSchedule::select('*')
        ->join('user','schedule.id_user','user.id_user')
        ->get();
    }
    public function getEmployeeScheduleDate(){
        return EmployeeSchedule::select('*')

        ->join('dateSchedule','schedule.id_dateSchedule','dateSchedule.id_dateSchedule')
        ->get();
    }
}
