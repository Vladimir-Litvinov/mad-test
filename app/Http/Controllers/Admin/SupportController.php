<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SupportRequest;
use Illuminate\Http\Request;
use App\Models\Support;

class SupportController extends Controller
{
    public function index()
    {
        $support = Support::first();
        return view('support.index', compact('support'));
    }

    public function edit(Support $support)
    {
        return view('support.edit', compact('support'));
    }

    public function update(Support $support, SupportRequest $request)
    {

        $support->update($request->all());
        return redirect()->route('support.index');
    }
}
