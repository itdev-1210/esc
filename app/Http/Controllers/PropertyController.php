<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Property;
use Auth;

class PropertyController extends Controller
{
    public function allProperty(Request $request) {
        $properties = Property::where('user_id', Auth::user()->id)->get();
        return $properties;
    }

    public function addProperty(Request $request) {
        $property = Property::where('email', $request->email)->where('user_id', Auth::user()->id)->first();
        if ($property) {
            return [
                'success' => false,
                'message' => 'Email is already exist.'
            ];
        }

        $property = new Property;
        $property->user_id = Auth::user()->id;
        $property->client_id = (int)$request->client_id;
        $property->title = $request->title;
        $property->first_name = $request->first_name;
        $property->surname = $request->surname;
        $property->email = $request->email;
        $property->phone = $request->phone;
        $property->address1 = $request->address1;
        $property->address2 = $request->address2;
        $property->city = $request->city;
        $property->county = $request->county;
        $property->postcode = $request->postcode;
        $property->country = $request->country;

        $property->save();

        return [
            'success' => true,
        ];
    }

    public function PropertyDetail(Request $request, $id) {
        return Property::with([
            'client',
            'jobs',
        ])->findOrFail($id);
    }

    public function updateProperty(Request $request, Property $property) {
        $tmp = Property::where('email', $request->email)
            ->where('user_id', Auth::user()->id)
            ->where('id', '!=', $property->id)
            ->first();
        if ($tmp) {
            return [
                'success' => false,
                'message' => 'Email is already exist.'
            ];
        }

        $property->client_id = (int)$request->client_id;
        $property->title = $request->title;
        $property->first_name = $request->first_name;
        $property->surname = $request->surname;
        $property->email = $request->email;
        $property->phone = $request->phone;
        $property->address1 = $request->address1;
        $property->address2 = $request->address2;
        $property->city = $request->city;
        $property->county = $request->county;
        $property->postcode = $request->postcode;
        $property->country = $request->country;

        $property->save();

        return [
            'success' => true,
        ];
    }

    public function deleteProperty(Request $request, $id) {
        $property = Property::findOrFail($id);
        $property->delete();
        return [
            'success' => true,
        ];
    }

    public function deletePropertys(Request $request) {
        Property::whereIn('id', $request->ids)->delete();
        return [
            'success' => true,
        ];
    }
}
