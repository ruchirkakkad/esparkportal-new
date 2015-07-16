<?php

class CalendarController extends \BaseController
{

    public function getIndexView()
    {

        return View::make('calendar.index');
    }

    public function getCalenderdataView()
    {
        $returndata = [];
        $holidays = Holiday::all();

        $returndata = [];
        $k = 0;
        foreach ($holidays as $v) {
            $returndata[$k]['title'] = $v->holidays_name;
            $returndata[$k]['start'] = $v->holidays_date;
            $returndata[$k]['className'] = 'b-l b-r b-5x b-warning';
            $k++;
        }
        $users = User::with('user_personal')->get();

        foreach ($users as $v) {

            $startyear = date('Y') - 5;
            $endyear = date('Y') + 5;
            $year = $startyear;
            while ($year <= $endyear) {
                if ($this->validateDate($v->user_personal['dob'], 'Y-m-d')) {
                    $returndata[$k]['title'] = $v->first_name . " " . $v->last_name."'s Birthday";
                    $returndata[$k]['start'] = date($year . '-m-d', strtotime($v->user_personal['dob']));
                    $returndata[$k]['className'] = 'b-l b-r b-5x b-success';
                    $k++;
                }
                if ($this->validateDate($v->user_personal['aniversary_date'], 'Y-m-d') && date('Y-m-d',strtotime($v->user_personal['aniversary_date'])) != '1970-01-01') {
                    $returndata[$k]['title'] = $v->first_name . " " . $v->last_name."'s Anniversary";
                    $returndata[$k]['start'] = date($year . '-m-d', strtotime($v->user_personal['aniversary_date']));
                    $returndata[$k]['className'] = 'b-l b-r b-5x b-danger';
                    $k++;
                }
                $year++;
            }

        }
        $data['calendar_data'] = $returndata;

        $data['total'] = count($returndata);
        return $data;
    }

    public function validateDate($date, $format = 'Y-m-d H:i:s')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }
}