<?php

namespace App\Http\Controllers;

use App\Models\Rules;
use Illuminate\Http\Request;

class RulesController extends Controller
{
    public function index()
    {
        $rules = Rules::all();
        return response()->json(['rules' => $rules]);
    }

    public function store(Request $request)
    {
        $rule = Rules::create($request->all());
        return response()->json(['message' => 'قانون با موفقیت ایجاد شد', 'rule' => $rule], 201);
    }

    public function update(Request $request, $id)
    {
        $rule = Rules::findOrFail($id);
        $rule->update($request->all());
        return response()->json(['message' => 'قانون با موفیقیت به روز رسانی شد', 'rule' => $rule]);
    }

    public function destroy($id)
    {
        $rule = Rules::findOrFail($id);
        $rule->delete($id);
        return response()->json(['message' => 'قانون با موفقیت حذف شد']);
    }

    public function restore($id)
    {
        $user = Rules::onlyTrashed()->findOrFail($id);
        $user->restore();
        return response()->json(['message' => 'قانون مورد نظر  با موفقیت بازیابی شد.'], 200);
    }
}
