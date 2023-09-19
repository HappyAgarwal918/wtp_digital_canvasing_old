<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected $itemPerPage = 25;

    public function formatDate($date)
    {
        if ($date) {
            $date = explode('/', $date);
            $date = $date[2] . '-' . $date[0] . '-' . $date[1];
        }
        return $date ?? null;
    }

    public function undoFormatDate($date)
    {
        if ($date) {
            $date_time = explode(' ', $date);
            $date = explode('-', $date_time[0]);
            $date = $date[1] . '/' . $date[2] . '/' . $date[0];
        }
        return $date ?? null;
    }

    public function accessLabels($id = null)
    {
        $status = (object)array(
            '1' => (object)[
                'id' => '1',
                'title' => 'Approve Investgator',
                'value' => '1',
            ],
            '2' => (object)[
                'id' => '2',
                'title' => 'Work Review',
                'value' => '8',
            ],
            '3' => (object)[
                'id' => '3',
                'title' => 'User Maintenance',
                'value' => '2',
            ],
            '4' => (object)[
                'id' => '4',
                'title' => 'Cohort Design',
                'value' => '16',
            ],
            '5' => (object)[
                'id' => '5',
                'title' => 'Works Assignments',
                'value' => '4',
            ],
            '6' => (object)[
                'id' => '6',
                'title' => 'Exporting/Reporting',
                'value' => '32',
            ],
        );

        if ($id) {
            foreach ($status as $item) {
                if ($item->id == $id) {
                    return $item;
                }
            }
        }

        return $status;
    }
}
