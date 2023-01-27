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

    public function index()
    {
        return InputedStringResource::collection(StringStorage::orderBy('created_at', 'desc')->get());
    }

    public function store(Request $request)
    {
        $receivedArray = $request->only(['inputed_string']);
        $receivedString = $receivedArray['inputed_string'];
        $lang = $this->checkLang($receivedString);
        $changedString = $this->replacedString($receivedString);
        $created_string = StringStorage::create(['language' => $lang, 'inputed_string' => $changedString]);
        return new InputedStringResource($created_string);
    }

    public function show($id)
    {
        return new InputedStringResource(StringStorage::find($id));
    }

    public function showLast()
    {
        return new InputedStringResource(StringStorage::orderBy('created_at', 'desc')->first());
    }

    public function autoCheck($str)
    {
        $changedString = $this->replacedString($str);
        return $changedString;
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        StringStorage::where('id', $id)->delete();
    }

    public function destroyAll()
    {
        StringStorage::truncate();
    }

    public function lastStrings()
    {
        return InputedStringResource::collection(StringStorage::orderBy('created_at', 'desc')->take(5)->get());
    }


    // String cheching functions

    public function checkLang($str)
    {
        $arrayString = mb_str_split($str);
        $engSymbolsLen = count(preg_grep('/[A-Za-z]/', $arrayString));
        $rusSymbolsLen = count(preg_grep('/[А-Яа-я]/', $arrayString));
        $mainLang = $rusSymbolsLen >= $engSymbolsLen ? 'rus' : 'eng';
        return $mainLang;
    }

    public function replacedString($str)
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
