<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogFc extends Controller
{
    public function index($slug = null)
    {
        if ($slug != null) {
            $rows = Blog::where('category_slug', '=', $slug)->orderBy('id', 'desc')->paginate(10);
        } else {
            $rows = Blog::orderBy('id', 'desc')->paginate(10);
        }
        // printArray($rows);
        // die;
        $bc = BlogCategory::all();
        $data = compact('rows', 'bc');
        return view('front.blogs')->with($data);
    }
    public function Details($id, $slug)
    {
        $where = ['id' => $id, 'slug' => $slug];
        $row = Blog::where($where)->firstOrFail();
        $rows = Blog::orderBy('id', 'desc')->where('id', '!=', $id)->limit(3)->get();
        // printArray($row);
        // die;
        $bc = BlogCategory::all();
        $data = compact('row', 'rows', 'bc');
        return view('front.blog-details')->with($data);
    }
}
