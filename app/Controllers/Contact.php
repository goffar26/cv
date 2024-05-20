<?php

namespace App\Controllers;

use App\Models\ContactModel;
use CodeIgniter\Controller;

class Contact extends Controller
{
    public function index()
    {
        return view('cv'); // Make sure 'cv.php' exists in 'app/Views'
    }

    public function submit()
    {
        // Load the validation library
        $validation = \Config\Services::validation();

        // Set the validation rules
        $validation->setRules([
            'name' => 'required|min_length[3]',
            'email' => 'required|valid_email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        // Validate the form input
        if (!$validation->withRequest($this->request)->run()) {
            // If validation fails, return to the form with errors
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Create an instance of the ContactModel
        $model = new ContactModel();

        // Prepare the data to be saved
        $data = [
            'name'    => $this->request->getPost('name'),
            'email'   => $this->request->getPost('email'),
            'subject' => $this->request->getPost('subject'),
            'message' => $this->request->getPost('message'),
        ];

        // Save the data to the database
        if ($model->save($data)) {
            // If save is successful, redirect with a success message
            return redirect()->to('/contact')->with('status', 'Your message has been sent. Thank you!');
        } else {
            // If save fails, redirect back with an error message
            return redirect()->back()->with('status', 'There was an error sending your message.');
        }
    }
}
