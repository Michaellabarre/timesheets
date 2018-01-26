<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Client;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::pluck('name', 'id');

        return view('contacts.create', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'client_id' => 'required',
            'name' => 'required',
            'job_title' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required',
        ]);

        $contact = new Contact;

        $client = Client::findOrFail($request->input('client_id'));
        
        $contact->name = $request->input('name');
        $contact->job_title = $request->input('job_title');
        $contact->email = $request->input('email');
        $contact->phone_number = $request->input('phone_number');

        $client->contacts()->save($contact);

        $contact->save();

        flash("Contact <strong>$contact->name</strong> saved.", 'success');
        if($request->input('prev_url')!==''){
            return redirect($request->input('prev_url'));
        }
        else{
            return redirect()->route('contacts.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        $clients = Client::pluck('name', 'id');
        
        return view('contacts.edit', compact('contact', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        
        $contact->name = $request->input('name');
        $contact->job_title = $request->input('job_title');
        $contact->email = $request->input('email');
        $contact->phone_number = $request->input('phone_number');

        //$client->contacts()->save($contact);

        $contact->save();

        flash("Contact <strong>$contact->name</strong> saved.", 'success');
        if($request->input('prev_url')!==''){
            return redirect($request->input('prev_url'));
        }
        else{
            return redirect()->route('contacts.index');
        }

        $client->name = $request->input('name');

        $client->save();

        return redirect()->route('clients.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $name = $contact->name;
        Contact::destroy($contact->id);
        flash("Contact <strong>$name</strong> deleted.", 'success');
        return redirect(\URL::previous());
    }
}
