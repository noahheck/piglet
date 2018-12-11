<?php

namespace App\Http\Controllers;

use App\Http\Response\AjaxResponse;
use Illuminate\Http\Request;

class HelpController extends Controller
{
    public function help(Request $request, $key = null)
    {
        if ($key && !view()->exists("help.section.{$key}")) {
            abort(404);
        }

        if ($request->isXmlHttpRequest()) {
            $response = new AjaxResponse(true);

            $content = view("help.section.{$key}", [])->render();

            $response->set('content', $content);

            return response()->json($response);
        }

        return view('help.home', [
            'key' => $key,
        ]);
    }
}
