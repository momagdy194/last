<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::paginate(env('PAGINATION_COUNT'));
        return view('admin.tags.tags')->with([
            'tags' => $tags,
            'showLinks' => true
        ]);
    }

     private function TagNameExists($tagName){
        $tag = Tag::where(
            'tag', '=' ,$tagName
            )->first();
          
            if (!is_null($tag)) {
                Session::flash('message', 'Tag ('.$tagName.') already exists');
                return false;
            }
            return true;
    }

    public function store(Request $request){
       
        $request->validate([
            'tag' => 'required'
        ]);

        $tagName = $request->input('tag');
        
        if (!$this->TagNameExists($tagName)) {
               return redirect()->back();
           } 
           
        $tag = new Tag();
        $tag->tag = $tagName;
        $tag->save();
        Session::flash('message', 'Tag ' . $tagName . ' has been added' );
        return redirect()->back();    

    }

    public function update(Request $request)
    {
        $request->validate([
            'tag' => 'required',
            'tag_id' => 'required',
        ]);


        $tagName = $request->input('tag');
        if (!$this->TagNameExists($tagName)) {
            return redirect()->back();
        }

        $tag_id = intval($request->input('tag_id'));

        $tag = Tag::find($tag_id);
        $tag->tag = $request->input('tag');
        $tag->save();
        
        Session::flash('message', ' Tag ' . $tag->tag . ' has been Updated');
        return \redirect()->back();

    }

    public function search(Request $request)
    {
        $request->validate([
            'tag_search' => 'required'
        ]);

        $searchTerm = $request->input('tag_search');

        $tags = Tag::where(
            
           'tag' , 'LIKE' , '%' .$searchTerm . '%'

        )->get();

        if (count($tags) > 0) {
            return view('admin.tags.tags')->with([
                'tags' => $tags,
                'showLinks' => false
            ]);
        }
        Session::flash('message' , 'Nothing Found!');
        return redirect()->back();

    }

    public function delete(Request $request)
    {
       if (is_null($request->input('tag_id')) || empty($request->input('tag_id'))) {
            Session::flash('message', ' Tag ID is required');
            return \redirect()->back();
        }

        $id = $request->input('tag_id');
        Tag::destroy($id);
        Session::flash('message', ' Tag has been deleted');
        return \redirect()->back();
        
    }

}
