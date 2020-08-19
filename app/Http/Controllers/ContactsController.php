<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Contact;

class ContactsController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $user_id = Auth::user()->id;
        $admin = Auth::user()->admin;

        if($admin === 1) {
            $user_contacts = Contact::orderBy('updated_at', 'desc')->paginate(5);
        }else {
            $user_contacts = User::findOrFail($user_id)->contacts()->orderBy('updated_at', 'desc')->paginate(5);
        }

        return view('contacts.index', [
            'contacts' => $user_contacts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $form_array = array(
            'action' => 'ContactsController@store',
            'method' => 'POST',
            'label' => 'Create'
        );

        return view('contacts.form', [
            'form_array' => $form_array
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate([
            'first_name' => 'required|min:3|max:25',
            'last_name' => 'required|min:3|max:25',
            'number' => 'required|min:3|max:25',
        ]);

        $new_contact = new Contact();
        $new_contact->user_id = Auth::user()->id;
        $new_contact->first_name = strval($request->input('first_name'));
        $new_contact->last_name = strval($request->input('last_name'));
        $new_contact->number = intval($request->input('number'));
        $new_contact->save();

        return redirect('/contacts')->with('status', 'Contact created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $contact = Contact::findOrFail($id);   
        $form_array = array(
            'action' => 'ContactsController@update',
            'method' => 'PUT',
            'label' => 'Update'
        );     
        
        return view('contacts.form', [
            'contact' => $contact,
            'form_array' => $form_array
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $request->validate([
            'first_name' => 'required|min:3|max:25',
            'last_name' => 'required|min:3|max:25',
            'number' => 'required|min:3|max:25',
        ]);
        
        $contact = Contact::findOrFail($id);
        $contact->first_name = strval($request->input('first_name'));
        $contact->last_name = strval($request->input('last_name'));
        $contact->number = intval($request->input('number'));
        $contact->save();        

        return redirect('/contacts')->with('status', 'Contact updated successfully!');
    }

    /**
     * Confirm remove the specified resource.
     *
     * @param int $id
     */    
    public function confirm_destroy($id) {
        $contact = Contact::findOrFail($id);
        return view('contacts.confirm_destroy', ['contact' => $contact]);
    }    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return redirect('/contacts')->with('status', 'Contact deleted successfully!');        
    }
}
