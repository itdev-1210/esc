<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Client;
use Auth;

class ClientController extends Controller
{
    public function allClient(Request $request) {
        $clients = Client::where('user_id', Auth::user()->id)->get();
        return $clients;
    }

    public function addClient(Request $request) {
        $client = Client::where('email', $request->email)->where('user_id', Auth::user()->id)->first();
        if ($client) {
            return [
                'success' => false,
                'message' => 'Email is already exist.'
            ];
        }

        $client = new Client;
        $client->user_id = Auth::user()->id;
        $client->company = $request->company;
        $client->title = $request->title;
        $client->first_name = $request->first_name;
        $client->surname = $request->surname;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->address1 = $request->address1;
        $client->address2 = $request->address2;
        $client->city = $request->city;
        $client->county = $request->county;
        $client->postcode = $request->postcode;
        $client->country = $request->country;

        $client->save();

        return [
            'success' => true,
        ];
    }

    public function clientDetail(Request $request, $id) {
        return Client::with('properties')->findOrFail($id);
    }

    public function updateClient(Request $request, Client $client) {
        $tmp = Client::where('email', $request->email)
            ->where('user_id', Auth::user()->id)
            ->where('id', '!=', $client->id)
            ->first();
        if ($tmp) {
            return [
                'success' => false,
                'message' => 'Email is already exist.'
            ];
        }

        $client->company = $request->company;
        $client->title = $request->title;
        $client->first_name = $request->first_name;
        $client->surname = $request->surname;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->address1 = $request->address1;
        $client->address2 = $request->address2;
        $client->city = $request->city;
        $client->county = $request->county;
        $client->postcode = $request->postcode;
        $client->country = $request->country;

        $client->save();

        return [
            'success' => true,
        ];
    }

    public function deleteClient(Request $request, $id) {
        $client = Client::findOrFail($id);
        $client->delete();
        return [
            'success' => true,
        ];
    }

    public function deleteClients(Request $request) {
        Client::whereIn('id', $request->ids)->delete();
        return [
            'success' => true,
        ];
    }
}
