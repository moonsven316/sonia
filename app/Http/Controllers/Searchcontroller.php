<?php

namespace App\Http\Controllers;
use App\Models\Shop;
// use App\Models\Shoparea;
use Illuminate\Http\Request;

class Searchcontroller extends Controller
{
    public function search(Request $request)
    {
        $data = Shop::query();
        if ($request->prefecture_city != Null) {
            $cities = array_map('trim', explode(',', $request->prefecture_city));
            $data = $data->whereIn('area_id', $cities);
        }
        if ($request->category != Null) {
            $categories = array_map('trim', explode(',', $request->category));
            $data = $data->whereIn('category_id', $categories);
        }
        if ($request->search_keyword != Null) {
            $data = $data->Where('name', 'like', '%' . $request->search_keyword . '%');
            // $area = Shoparea::all();
            // $data = $data->where(function ($query) use ($request, $area) {
            //     $query->where('name', 'like', '%' . $request->search_keyword . '%');
            //     foreach ($area as $item) {
            //         $query->orWhere($item->name, 'like', '%' . $request->search_keyword . '%');
            //     }
            // });
        }
        $data = $data->paginate(7);
        return view('searchResult', compact('data'));
    }
}
