<?php

namespace App\Http\Controllers\Family;

use App\Family;
use App\Family\Contact;
use App\Http\Requests\Family\Contact\Store as StoreRequest;
use App\Http\Requests\Family\Contact\Update as UpdateRequest;
use App\Http\Controllers\Controller;
use App\Jobs\Family\Contact\Create;
use App\Jobs\Family\Contact\Update;
use Illuminate\Http\Request;
use function App\flashSuccess;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Family $family)
    {
        $contacts = Contact::orderBy('last_name')->orderBy('first_name')->get();

        return view('family.contacts.home', compact('family', 'contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Family $family)
    {
        $contact = new Contact;

        return view('family.contacts.new', compact('family', 'contact'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request, Family $family)
    {
        $this->dispatchNow($contactCreated = new Create(
            $request->first_name,
            $request->middle_name,
            $request->last_name,
            $request->birthdate,
            $request->phone,
            $request->secondaryPhone,
            $request->email,
            $request->secondaryEmail,
            $request->address1,
            $request->address2,
            $request->city,
            $request->state,
            $request->zip
        ));

        flashSuccess('contacts.contactCreated');

        $contact = $contactCreated->getContact();

        return redirect()->route('family.contacts.show', [$family, $contact]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Family\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Family $family, Contact $contact)
    {
        return view('family.contacts.show', compact('family', 'contact'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Family\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Family $family, Contact $contact)
    {
        return view('family.contacts.edit', compact('family', 'contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Family\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Family $family, Contact $contact)
    {
        $this->dispatchNow($contactUpdated = new Update(
            $contact,
            $request->first_name,
            $request->middle_name,
            $request->last_name,
            $request->birthdate,
            $request->phone,
            $request->secondaryPhone,
            $request->email,
            $request->secondaryEmail,
            $request->address1,
            $request->address2,
            $request->city,
            $request->state,
            $request->zip
        ));

        flashSuccess('contacts.contactUpdated');

        return redirect()->route('family.contacts.show', [$family, $contact]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Family\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Family $family, Contact $contact)
    {
        $contact->delete();

        return redirect()->route('family.contacts.index', [$family]);
    }
}
