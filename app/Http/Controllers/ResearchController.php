<?php

namespace App\Http\Controllers;

use App\Models\Research;
use Illuminate\Http\Request;

class ResearchController extends Controller
{
    //add research
    function addResearch(Request $request)
    {
        // return $request->file('file')->store('products');//here we will create new folder called research and store the file inside of it
        // add info about research
        $Research = new Research;
        $Research->name = $request->input('name');
        $Research->section = $request->input('section');
        $Research->description = $request->input('description');
        $Research->file_path = $request->file('file')->store('Researchs');
        $Research->pdf_file = $request->file('pdfFile')->store('Researchs');
        $Research->save();

        return $Research; // to get all data

    }
    function list(){ // get data from Database
        return Research::all();
    }
    function delete($id){
        $result=Research::where("id",$id)->delete();// delete code
        if ($result)//always true
        {

        return ["result"=>"product has been deleted "]; //massage will appear if the product deleted
        }else
        {
            return ["result"=>"operation failed "];//massage will appear if the product doesn't exist

        }
    }
    function getResearch($id){
        return Research::find($id);
    }
    function updata(Request $request ,$id ){
    $data =Research::find($id);
    $data->name=$request->name;
    $data->section=$request->section;
    $data->description=$request->description;
    $data->file_path=$request->file('file')->store('Researchs');
    $data->pdf_file=$request->file('pdfFile')->store('Researchs');
    $data->save();
    }

    function search($key){
        return Research::where('name','like',"%$key%")->get(); //search its name and who is like it
    }
}
