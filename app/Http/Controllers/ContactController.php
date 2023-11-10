<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostMessageRequest;
use App\Http\Requests\ReplyContactRequest;
use App\Models\CategoryModel;
use App\Models\ContactModel;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index() {
        $categories = CategoryModel::where('m_id_parent', 0)->get();
        return view('Auth.contact.index', compact('categories'));
    }

    public function postMessage(PostMessageRequest $request) {
        $request->validated();
        ContactModel::insert([
            'm_name' => $request->name,
            'm_email' => $request->email,
            'm_title' => $request->title,
            'm_phone' => $request->phone,
            'm_content' => $request->message
        ]);
        return redirect()->back()->with('message_success', 'Cảm ơn bạn đã gửi phản hồi cho chúng tôi, chúng tôi sẽ liên hệ lại bạn trong thời gian sớm nhất.');
    }

    public function getContact(Request $request) {
        $data = [
            'title' => 'Phản hồi',
            'action'=> 'contact'
        ];
        $listContacts = ContactModel::paginate(10);
        return view('admin.contact.index', compact('data', 'listContacts'));
    }

    public function getEditContact($id) {
        $data = [
            'title' => 'Phản hồi',
            'action'=> 'contact'
        ];
        $contact = ContactModel::where('id', $id)->first();
        return view('admin.contact.edit', compact('data', 'contact'));
    }

    public function postEditContact(ReplyContactRequest $request, $id) {
        $request->validated();
        $contact = ContactModel::where('id', $id)->first();
        $email = $contact->m_email;
        $name = $contact->m_name;
        $reply = $request->reply;
        Mail::to($email)->send(new ContactMail($name, $reply));
        return redirect()->route('contact-edit-admin', ['id' => $id])->with('alert_success', 'Gửi phản hồi thành công.');
    }

    public function getDeleteContact($id) {
        ContactModel::where('id', $id)->delete();
        return redirect()->route('contact-delete-admin', ['id' => $id])->with('alert_success', 'Gửi phản hồi thành công.');
    }
}
