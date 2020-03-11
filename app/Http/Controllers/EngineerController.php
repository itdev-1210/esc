<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Engineer;
use App\Subscription;
use Auth;

class EngineerController extends Controller
{
    public function allEngineer(Request $request)
    {
        $engineers = Engineer::where('user_id', Auth::user()->id)->get();

        return $engineers;
    }

    public function addEngineer(Request $request)
    {
        if ($request->user()->is_trial == 0) {
            $subscription = Subscription::where('user_id', Auth::user()->id)->first();
            if ($subscription->stripe_plan == 'Monthly1' || $subscription->stripe_plan == 'Yearly1') {
                $engineer_count = Engineer::where('user_id', Auth::user()->id)->count();
                if ($engineer_count > 0) {
                    return [
                        'success' => false,
                        'message' => 'Engineer Count Limited! Please check your subscription plan.',
                    ];
                }
            } elseif ($subscription->stripe_plan == 'Monthly2' || $subscription->stripe_plan == 'Yearly2') {
                $engineer_count = Engineer::all()->count();
                if ($engineer_count > 4) {
                    return [
                        'success' => false,
                        'message' => 'Engineer Count Limited! Please check your subscription plan.',
                    ];
                }
            }
        }

        $data = json_decode(request()->engineer);
        $engineer = Engineer::where('email', $data->email)->where('user_id', Auth::user()->id)->first();
        if ($engineer) {
            return [
                'success' => false,
                'message' => 'Email is already exist.',
            ];
        }

        $engineer = new Engineer();
        $engineer->user_id = Auth::user()->id;
        $engineer->title = $data->title;
        $engineer->first_name = $data->first_name;
        $engineer->surname = $data->surname;
        $engineer->email = $data->email;
        $engineer->phone = $data->phone;
        $engineer->address1 = $data->address1;
        $engineer->address2 = $data->address2;
        $engineer->city = $data->city;
        $engineer->county = $data->county;
        $engineer->postcode = $data->postcode;
        $engineer->country = $data->country;
        // var_dump(request()->signature);
        // exit;
        if (request()->signature !== 'null') {
            $logoName = Auth::user()->id.'_signature_'.time().'.'.request()->signature->getClientOriginalExtension();
            $request->signature->storeAs('public/logos', $logoName);
            $engineer->signature = $logoName;
        }

        $engineer->save();

        return [
            'success' => true,
        ];
    }

    public function engineerDetail(Request $request, $id)
    {
        return Engineer::with(['jobs'])->findOrFail($id);
    }

    public function updateEngineer(Request $request, Engineer $engineer)
    {
        $data = json_decode(request()->engineer);
        $tmp = Engineer::where('email', $data->email)
            ->where('user_id', Auth::user()->id)
            ->where('id', '!=', $engineer->id)
            ->first();
        if ($tmp) {
            return [
                'success' => false,
                'message' => 'Email is already exist.',
            ];
        }

        $engineer->title = $data->title;
        $engineer->first_name = $data->first_name;
        $engineer->surname = $data->surname;
        $engineer->email = $data->email;
        $engineer->phone = $data->phone;
        $engineer->address1 = $data->address1;
        $engineer->address2 = $data->address2;
        $engineer->city = $data->city;
        $engineer->county = $data->county;
        $engineer->postcode = $data->postcode;
        $engineer->country = $data->country;
        if (request()->signature !== 'null') {
            $logoName = Auth::user()->id.'_signature_'.time().'.'.request()->signature->getClientOriginalExtension();
            $request->signature->storeAs('public/logos', $logoName);
            $engineer->signature = $logoName;
        }

        $engineer->save();

        return [
            'success' => true,
        ];
    }

    public function deleteEngineer(Request $request, $id)
    {
        $engineer = Engineer::findOrFail($id);
        $engineer->delete();

        return [
            'success' => true,
        ];
    }

    public function deleteEngineers(Request $request)
    {
        Engineer::whereIn('id', $request->ids)->delete();

        return [
            'success' => true,
        ];
    }
}
