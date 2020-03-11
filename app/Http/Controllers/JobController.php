<?php

namespace App\Http\Controllers;

use App\Job;
use App\Property;
use App\Client;
use App\Engineer;
use App\Timesheet;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class JobController extends Controller
{
    const DAY_OF_WEEK = [
        'MON', 'TUE', 'WED', 'THUR', 'FRI', 'SAT', 'SUN',
    ];

    public function allJob(Request $request)
    {
        $jobs = Job::with([
            'client',
            'property',
            'engineer',
        ])->where('user_id', Auth::user()->id)->get();

        return $jobs;
    }

    public function jobData(Request $request)
    {
        $usersData = Client::where('user_id', Auth::user()->id)->get();
        $engineerData = Engineer::where('user_id', Auth::user()->id)->get();
        $propertyData = [];
        if (isset($request['propertyId'])) {
            $property = Property::findOrFail($request['propertyId']);
            $propertyData = Property::where('user_id', Auth::user()->id)->where('client_id', $property->client_id)->get();
        }

        return [
            'usersData' => $usersData,
            'engineerData' => $engineerData,
            'propertyData' => $propertyData,
        ];
    }

    public function propertyData(Request $request)
    {
        $propertyData = Property::where('user_id', Auth::user()->id)->where('client_id', $request->client_id)->get();

        return [
            'propertyData' => $propertyData,
        ];
    }

    public function addJob(Request $request)
    {
        $data = json_decode(request()->job);
        $job = new Job();
        $job->user_id = Auth::user()->id;
        $job->client_id = $data->client;
        $job->property_id = $data->property;
        $job->engineer_id = $data->engineer;
        $job->start_date = Carbon::parse($data->start_date)->toDate();
        $job->job_ref = $data->job_ref;
        $job->description = $data->description;
        $job->material_use = $data->material_use;
        $job->customer_name = $data->customer_name;
        if ($data->customer_complete_date) {
            $job->customer_complete_date = Carbon::parse($data->customer_complete_date)->toDate();
        }
        if (request()->signature !== 'null') {
            $logoName = Auth::user()->id.'_custom_sign_'.time().'.'.request()->signature->getClientOriginalExtension();
            $request->signature->storeAs('public/logos', $logoName);
            $job->signature = $logoName;
        }
        $job->save();

        $timesheets = [];
        $data = json_decode(request()->timesheets);
        foreach ($data as $tmp) {
            $timesheet = [];
            $timesheet['job_id'] = $job->id;
            $timesheet['start_date'] = Carbon::createFromFormat('d/m/Y', $tmp->start_date)->toDate();
            $timesheet['start_time'] = Carbon::parse($tmp->start_time)->toTimeString();
            $timesheet['end_time'] = Carbon::parse($tmp->end_time)->toTimeString();
            $timesheets[] = $timesheet;
        }
        Timesheet::insert($timesheets);

        return [
            'success' => true,
        ];
    }

    public function JobDetail(Request $request, $id)
    {
        return Job::with([
            'client',
            'property',
            'engineer',
            'timesheets',
        ])->findOrFail($id);
    }

    public function getJob(Request $request, $id)
    {
        $job = Job::with([
            'client',
            'property',
            'engineer',
        ])->findOrFail($id);

        $timesheets = Timesheet::where('job_id', $job->id)
            // ->where('start_date', '>=', $weeks->first()['date'])
            // ->where('start_date', '<=', $weeks->last()['date'])
            ->get();

        $collection = collect($timesheets);
        $timesheets = $timesheets->groupBy('start_date')->toArray();
        $min_date = $collection->min('start_date');
        $max_date = $collection->max('start_date');
        $newTimesheets = [];
        $resTimesheets = [];
        $maxCount = 0;

        $data = [];
        $resData = [];

        if (count($timesheets) < 1) {
            return [
                'job' => $job,
                'data' => [],
            ];
        }
        $weeks = $this->getWeeksList($min_date, $max_date);

        foreach ($weeks as $week) {
            $data['weeks'] = $week;
            foreach ($week as $day) {
                $newTimesheet = [];
                if (array_key_exists($day['date'], $timesheets)) {
                    $newTimesheet = $timesheets[$day['date']];
                }
                $newTimesheets[$day['str']] = $newTimesheet;
                if ($maxCount < count($newTimesheet)) {
                    $maxCount = count($newTimesheet);
                }
            }

            foreach ($newTimesheets as $key => $timesheet) {
                for ($i = count($timesheet); $i < $maxCount; ++$i) {
                    $newTimesheets[$key][$i]['start_time'] = null;
                    $newTimesheets[$key][$i]['end_time'] = null;
                }
            }

            for ($i = 0; $i < $maxCount; ++$i) {
                $resTimesheet = [];
                foreach ($newTimesheets as $key => $timesheet) {
                    $resTimesheet[$key] = $timesheet[$i];
                }
                $resTimesheets[] = $resTimesheet;
            }
            $data['timesheets'] = $resTimesheets;
            $resTimesheets = $newTimesheets = [];
            $resData[] = $data;
        }

        return [
            'job' => $job,
            'data' => $resData,
        ];
    }

    public function updateJob(Request $request, Job $job)
    {
        $data = json_decode(request()->post('job'));
        $job->client_id = $data->client;
        $job->property_id = $data->property;
        $job->engineer_id = $data->engineer;
        $job->start_date = Carbon::parse($data->start_date)->toDate();
        $job->job_ref = $data->job_ref;
        $job->description = $data->description;
        $job->material_use = $data->material_use;
        $job->customer_name = $data->customer_name;
        $job->customer_complete_date = Carbon::parse($data->customer_complete_date)->toDate();
        if (request()->signature !== 'null') {
            $logoName = Auth::user()->id.'_custom_sign_'.time().'.'.request()->signature->getClientOriginalExtension();
            $request->signature->storeAs('public/logos', $logoName);
            $job->signature = $logoName;
        }
        $job->save();

        $timesheets = [];
        $ids = [];
        $data = json_decode(request()->timesheets);
        foreach ($data as $tmp) {
            if (isset($tmp->id)) {
                $ids[] = $tmp->id;
            }
            $timesheet = [];
            $timesheet['job_id'] = $job->id;
            $timesheet['start_date'] = Carbon::createFromFormat('d/m/Y', $tmp->start_date)->toDate();
            $timesheet['start_time'] = Carbon::parse($tmp->start_time)->toTimeString();
            $timesheet['end_time'] = Carbon::parse($tmp->end_time)->toTimeString();
            $timesheets[] = $timesheet;
        }
        Timesheet::whereIn('id', $ids)->delete();
        Timesheet::insert($timesheets);

        return [
            'success' => true,
        ];
    }

    public function deleteJob(Request $request, $id)
    {
        $job = Job::findOrFail($id);
        $job->delete();

        return [
            'success' => true,
        ];
    }

    public function deleteJobs(Request $request)
    {
        Job::whereIn('id', $request->ids)->delete();

        return [
            'success' => true,
        ];
    }

    public function getWeeksList($min_date, $max_date)
    {
        $start_date = Carbon::createFromFormat('d/m/Y', $min_date)->startOfWeek(Carbon::MONDAY);
        $end_date = Carbon::createFromFormat('d/m/Y', $max_date)->endOfWeek(Carbon::SUNDAY);

        $date_pivot = $start_date->copy();
        $days = [];
        while ($date_pivot->lt($end_date)) {
            $days[] = $this->getWeekList($date_pivot);
            $date_pivot->addDays(7);
        }

        return collect($days);
    }

    public function getWeekList($start_date)
    {
        $date_pivot = $start_date->copy();
        $end_date = $start_date->copy()->addDays(6);
        $days = [];
        while ($date_pivot->lte($end_date)) {
            $days[] = [
                'date' => Carbon::parse($date_pivot)->format('d/m/Y'),
                // 'date_tmp' => $date_pivot->toDateString(),
                'str' => self::DAY_OF_WEEK[($date_pivot->dayOfWeek + 6) % 7],
            ];
            $date_pivot->addDay();
        }

        return collect($days);
    }
}
