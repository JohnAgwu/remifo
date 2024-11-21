<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReminderRequest;
use App\Models\Reminder;
use Illuminate\Http\Request;
use League\ISO3166\ISO3166;

class ReminderController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Reminder::class);
    }

    public function index(Request $request)
    {
        $reminders = Reminder::viewable()->paginate(9);
        $data = $request->all();

        return view('pages.dashboard.index', compact('reminders', 'data'));
    }

    public function create()
    {
        $option = \request()->option;

        return view('pages.reminders.create', compact('option'));
    }

    public function store(ReminderRequest $request): \Illuminate\Http\RedirectResponse
    {

        $validationError = $request->validateOption();

        if ($validationError !== null) {

            return redirect()->back()->withErrors($validationError)->withInput();
        }

        $data = $request->fulfil();

        $request->user()->reminders()->create($data);

        return to_route('/')->with('success', 'New reminder for created.');
    }

    public function show(Reminder $reminder)
    {
        return view('pages.reminders.show', compact('reminder'));
    }

    public function edit(Reminder $reminder)
    {
        return view('pages.reminders.edit', compact('reminder'));
    }

    public function update(ReminderRequest $request, Reminder $reminder)
    {
        $validationError = $request->validateOption();

        if ($validationError !== null) {

            return redirect()->back()->withErrors($validationError)->withInput();
        }

        $data = $request->fulfil();

        $reminder->update($data);

        return to_route('/')->with('success', 'Reminder has been Updated!.');
    }

    public function destroy(Reminder $reminder)
    {
        $name = $reminder->name;
        $email = $reminder->email;
        $subject = $reminder->subject;

        $reminder->delete();

        return back()->with('success', "Reminder for $name | $email, Subject - $subject has been deleted successfully!");
    }

    public function saveOption(Request $request)
    {
        $option = $request->option;

        return redirect()->route('reminders.create', ['option' => $option]);
    }

    public function toggleReminder(Request $request, Reminder $reminder): \Illuminate\Http\RedirectResponse
    {
        $isDone = !$reminder->is_done;

        $reminder->update(['is_done' => $isDone]);

        $msg = $reminder->is_done ? 'has been completed' : 'is now pending';

        return back()->with('success', "Reminder for $reminder->email $msg ");
    }


}














//if (!App::hasDebugModeEnabled()) throw new NotFoundHttpException();
