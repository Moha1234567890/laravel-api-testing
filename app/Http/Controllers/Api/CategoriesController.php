<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Traits\GeneralTrait;
class CategoriesController extends Controller
{
    

    use GeneralTrait;
    public function getCats() {

        $allCats = Category::all();

        return $this->returnData("categories", $allCats);
    }
    

    public function getCatsLang(Request $request) {

        $allCats = Category::select('id', 'name_' . app()->getLocale())->get();

        return $this->returnData('all cats', $allCats, 'success');

        //return $request;

    }


    public function getSingelCat(Request $request) {

        $singleCat = Category::select()->find($request->id);

        if(!$singleCat) {
            return $this->returnError('001', 'error');
        }

        return $this->returnData('category', $singleCat);
    }


    public function changeCategoryStatus(Request $request) {

        Category::where('id', $request->id)->update(['active'=> $request->active]);

        return $this->returnSuccessMessage('success');
    }



    
    
}
