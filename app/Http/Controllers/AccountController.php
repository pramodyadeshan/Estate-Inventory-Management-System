<?php

namespace App\Http\Controllers;

use App\Models\Expenditure;
use App\Models\Income;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    //Income Functions
    public function list_income()
    {
        $income_data = Income::with('users')->orderBy('updated_at', 'desc')->paginate(10);

        $firstDayOfMonth = date('Y-m-01');
        $lastDayOfMonth = date('Y-m-t');

        $thisyearFirst = date('Y-01-01');
        $lastDayOfLastMonth = date('Y-m-d', strtotime($firstDayOfMonth . ' - 1 day'));

        $sumOfThisMonthIncome = Income::whereBetween('date', [$firstDayOfMonth, $lastDayOfMonth])->sum('price');
        $sumOfPreMonthIncome = Income::whereBetween('date', [$thisyearFirst, $lastDayOfLastMonth])->sum('price');

        return view('pages.acco_manage.income', compact('income_data','sumOfThisMonthIncome', 'sumOfPreMonthIncome'));
    }

    public function add_income(Request $request)
    {
        $validate_data = $request->validate([
            'income_date' => 'required',
            'note' => 'required',
            'amount' => 'required|numeric|min:0|not_in:0',
        ],
        [
            'amount.required' => 'The income amount field is required.',
            'amount.integer' => 'The income amount must be an integer..',
            'note.required' => 'The income note field is required.',
        ]);

        $income = new Income();
        $income->date = $request->income_date;
        $income->note = $request->note;
        $income->price = $request->amount;
        $income->user_id = Auth::user()->id;

        $income->save();

        return redirect('/list-income')->with('success', 'Income record has been saved!');
    }

    public function delete_income($id)
    {
        Income::destroy($id);
        return redirect('/list-income')->with('success', 'Income record has been deleted!');
    }

    public function edit_income_form($id)
    {
        $edit_income_data = Income::find($id);
        return view('pages.acco_manage.edit_income', compact('edit_income_data'));
    }

    public function edit_income(Request $request, $id)
    {
        $income_data = Income::find($id);

        $validate_data = $request->validate([
            'income_date' => 'required',
            'note' => 'required',
            'amount' => 'required|numeric|min:0|not_in:0',
        ],
        [
            'amount.required' => 'The income amount field is required.',
            'amount.integer' => 'The income amount must be an integer..',
            'note.required' => 'The income note field is required.',
        ]);

        $income_data->date = $request->income_date;
        $income_data->note = $request->note;
        $income_data->price = $request->amount;
        $income_data->user_id = Auth::user()->id;

        $income_data->update();
        return redirect()->back()->with('success', 'Income record has been updated!');
    }



    // ------------ Expenditure Functions -------------

    public function list_expend()
    {
        $expend_data = Expenditure::with('users')->orderBy('updated_at', 'desc')->paginate(10);

        $firstDayOfMonth = date('Y-m-01');
        $lastDayOfMonth = date('Y-m-t');

        $thisyearFirst = date('Y-01-01');
        $lastDayOfLastMonth = date('Y-m-d', strtotime($firstDayOfMonth . ' - 1 day'));

        $sumOfThisMonthExpend = Expenditure::whereBetween('date', [$firstDayOfMonth, $lastDayOfMonth])->sum('price');
        $sumOfPreMonthExpend = Expenditure::whereBetween('date', [$thisyearFirst, $lastDayOfLastMonth])->sum('price');

        return view('pages.acco_manage.expend', compact('expend_data','sumOfThisMonthExpend', 'sumOfPreMonthExpend'));
    }

    public function add_expend(Request $request)
    {
        $validate_data = $request->validate([
            'date' => 'required',
            'note' => 'required',
            'amount' => 'required|numeric|min:0|not_in:0',
        ],[
            'amount.required' => 'The income amount field is required.',
            'amount.integer' => 'The income amount must be an integer..',
            'note.required' => 'The income note field is required.',
        ]);

        $expend = new Expenditure();
        $expend->date = $request->date;
        $expend->note = $request->note;
        $expend->price = $request->amount;
        $expend->user_id = Auth::user()->id;

        $expend->save();

        return redirect('/list-expend')->with('success', 'Expenditure record has been saved!');
    }

    public function delete_expend($id)
    {
        Expenditure::destroy($id);
        return redirect('/list-expend')->with('success', 'Expenditure record has been deleted!');
    }

    public function edit_expend_form($id)
    {
        $edit_expend_data = Expenditure::find($id);
        return view('pages.acco_manage.edit_expend', compact('edit_expend_data'));
    }

    public function edit_expend(Request $request, $id)
    {
        $expend_data = Expenditure::find($id);

        $validate_data = $request->validate([
            'date' => 'required',
            'note' => 'required',
            'amount' => 'required|numeric|min:0|not_in:0',
        ], [
                'amount.required' => 'The expenditure amount field is required.',
                'amount.integer' => 'The expenditure amount must be an integer..',
                'note.required' => 'The expenditure note field is required.',
            ]);

        $expend_data->date = $request->date;
        $expend_data->note = $request->note;
        $expend_data->price = $request->amount;
        $expend_data->user_id = Auth::user()->id;

        $expend_data->update();
        return redirect()->back()->with('success', 'Expenditure record has been updated!');

    }
}
