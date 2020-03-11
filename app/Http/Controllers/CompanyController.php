<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\Subscription;
use Auth;

class CompanyController extends Controller
{
    public function __construct()
    {
    }

    public function showRegister(Request $request)
    {
        return view('application');
    }

    public function registerCompany(Request $request)
    {
        $company = new Company();
        $company->user_id = $request->user()->id;
        $company->name = $request->company['name'];
        $company->first_name = $request->company['first_name'];
        $company->surname = $request->company['surname'];
        $company->address_1 = $request->company['address_1'];
        $company->address_2 = $request->company['address_2'];
        $company->city = $request->company['city'];
        $company->county = $request->company['county'];
        $company->postcode = $request->company['postcode'];
        $company->country = $request->company['country'];
        $company->save();

        return [
            // 'company' => $company->toArray(),
            'redirectTo' => '/',
        ];
    }

    public function updateCompany(Request $request)
    {
        $data = json_decode(request()->company);
        $company = Company::findOrFail($data->id);
        if (!$company) {
            return [
                'success' => false,
                'message' => 'Company not found',
            ];
        }

        $company->first_name = $data->first_name;
        $company->name = $data->name;
        $company->surname = $data->surname;
        $company->address_1 = $data->address_1;
        $company->address_2 = $data->address_2;
        $company->city = $data->city;
        $company->county = $data->county;
        $company->postcode = $data->postcode;
        $company->country = $data->country;
        $company->email = $data->email;
        $company->contact_title = $data->contact_title;
        $company->website = $data->website;
        $company->reg_number = $data->reg_number;
        $company->vat_number = $data->vat_number;
        $company->phone = $data->phone;
        if ($data->password) {
            $company->password = $data->password;
        }

        if (request()->company_logo !== 'null') {
            $logoName = $data->id.'_logo_'.time().'.'.request()->company_logo->getClientOriginalExtension();
            $request->company_logo->storeAs('public/logos', $logoName);
            $company->company_logo = $logoName;
        }

        if (request()->logo1 !== 'null') {
            $logoName1 = $data->id.'_logo1_'.time().'.'.request()->logo1->getClientOriginalExtension();
            $request->logo1->storeAs('public/logos', $logoName1);
            $company->logo1 = $logoName1;
        }

        if (request()->logo2 !== 'null') {
            $logoName2 = $data->id.'_logo2_'.time().'.'.request()->logo2->getClientOriginalExtension();
            $request->logo2->storeAs('public/logos', $logoName2);
            $company->logo2 = $logoName2;
        }

        $company->save();

        return [
            'success' => true,
            'company' => $company,
        ];
    }

    public function subscription(Request $request)
    {
        return view('application');
    }

    public function saveSubscription(Request $request)
    {
        \Stripe\Stripe::setApiKey(env('MIX_STRIPE_SECRET'));

        $monthly = '';
        $name = '';
        $amount = (int) $request['amount'];
        switch ($amount) {
            case 10:
                $monthly = 'month';
                $name = 'Monthly1';
            break;
            case 20:
                $monthly = 'month';
                $name = 'Monthly2';
            break;
            case 40:
                $monthly = 'month';
                $name = 'Monthly3';
            break;
            case 90:
                $monthly = 'year';
                $name = 'Yearly1';
            break;
            case 180:
                $monthly = 'year';
                $name = 'Yearly2';
            break;
            case 360:
                $monthly = 'year';
                $name = 'Yearly3';
            break;
            default:
            break;
        }

        $value = $amount * 100;
        try {
            $product = \Stripe\Product::retrieve($name);
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            $product = \Stripe\Product::create([
                'id' => $name,
                'name' => $name,
                'type' => 'service',
            ]);
        }

        try {
            $plan = \Stripe\Plan::retrieve($name);
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            $plan = \Stripe\Plan::create([
                'id' => $name,
                'currency' => 'usd',
                'interval' => $monthly,
                'product' => $product,
                'nickname' => $name,
                'amount' => $value,
            ]);
        }

        try {
            // Auth::user()->newSubscription('main', $name)->create($request['stripeToken']);
            Auth::user()->newSubscription('main', $name)->trialDays(14)->create($request['paymentMethod'], [
                'email' => Auth::user()->email,
            ]);
            $user = Auth::user();
            $user->is_trial = 0;
            $user->save();
        } catch (\Stripe\Exception\CardException $e) {
            $err = $e->getError()->message;

            return [
                'success' => false,
                'message' => $err,
            ];
        }

        return [
            'success' => true,
            'redirectTo' => '/',
        ];
    }

    public function upgradeSubscription(Request $request)
    {
        \Stripe\Stripe::setApiKey(env('MIX_STRIPE_SECRET'));
        $monthly = '';
        $name = '';
        $amount = (int) $request['amount'];
        switch ($amount) {
            case 10:
                $monthly = 'month';
                $name = 'Monthly1';
            break;
            case 20:
                $monthly = 'month';
                $name = 'Monthly2';
            break;
            case 40:
                $monthly = 'month';
                $name = 'Monthly3';
            break;
            case 90:
                $monthly = 'year';
                $name = 'Yearly1';
            break;
            case 180:
                $monthly = 'year';
                $name = 'Yearly2';
            break;
            case 360:
                $monthly = 'year';
                $name = 'Yearly3';
            break;
            default:
            break;
        }

        $value = $amount * 100;
        try {
            $product = \Stripe\Product::retrieve($name);
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            $product = \Stripe\Product::create([
                'id' => $name,
                'name' => $name,
                'type' => 'service',
            ]);
        }

        try {
            $plan = \Stripe\Plan::retrieve($name);
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            $plan = \Stripe\Plan::create([
                'id' => $name,
                'currency' => 'usd',
                'interval' => $monthly,
                'product' => $product,
                'nickname' => $name,
                'amount' => $value,
            ]);
        }
        Auth::user()->subscription('main')->swap($name);

        return [
            'success' => true,
            'data' => Subscription::where('user_id', $request->user()->id)->first(),
        ];
    }

    public function companyDetail(Request $request)
    {
        $company = Company::where('user_id', $request->user()->id)->first();

        return $company;
    }

    public function subscriptionDetail(Request $request)
    {
        $data = Subscription::where('user_id', $request->user()->id)->first();

        return [
            'success' => true,
            'data' => $data,
        ];
    }
}
