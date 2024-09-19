<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DateSchedule extends Model
{
    protected $primaryKey = "id_dateSchedule";
    protected $table = "dateschedule";

    public function insertDateSchedule($data) {
        return DateSchedule::insert($data);
    }

    public function getDateScheduleAll() {
        return DateSchedule::select('*')
        ->get();

    }
    public function getDateScheduleWhere($where)  {
        return DateSchedule::select('*')
        ->where($where)
        ->get();

    }
}
