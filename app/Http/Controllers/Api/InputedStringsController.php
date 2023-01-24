<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StringStorage;
use Dotenv\Store\StringStore;
use App\Http\Resources\InputedStringResource;
use Illuminate\Http\Response;


class InputedStringsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return InputedStringResource::collection(StringStorage::orderBy('created_at', 'desc')->take(10)->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $inputed_string = $request->inputed_string;
        $receivedArray = $request->only(['inputed_string']);

        $receivedString = $receivedArray['inputed_string'];

        $lang = $this->checkLang($receivedString);
        
        $changedString = $this->replacedString($receivedString);

        $created_string = StringStorage::create(['language' => $lang, 'inputed_string' => $changedString]);

        return new InputedStringResource($created_string);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new InputedStringResource(StringStorage::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        StringStorage::where('id', $id)->delete();
    }

    function checkLang($str)
    {
        $arrayString = mb_str_split($str);
        $engSymbolsLen = count(preg_grep('/[A-Za-z]/', $arrayString));
        $rusSymbolsLen = count(preg_grep('/[А-Яа-я]/', $arrayString));
        $mainLang = $rusSymbolsLen >= $engSymbolsLen ? 'rus' : 'eng';
        return $mainLang;
    }

    function replacedString($str)
    {
        $arrayString = mb_str_split($str);
        if ($this->checkLang($str) === 'rus') {
            $newStr = implode(array_map(fn($value) => preg_replace('/[A-Za-z]/', '<b>'.$value.'</b>', $value), $arrayString));
            return $newStr;
        } else {
            $newStr = implode(array_map(fn($value) => mb_ereg_replace('[А-Яа-я]', '<b>'.$value.'</b>', $value), $arrayString));
            return $newStr;
        }
    }
}
