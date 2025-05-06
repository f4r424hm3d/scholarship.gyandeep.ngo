<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class EventFc extends Controller
{
    public function index()
    {
        $rows = Event::orderBy('id')->paginate(18);
        // printArray($rows);
        // die;
        $data = compact('rows');
        return view('front.events')->with($data);
    }
    public function eventDetail($id, $slug)
    {
        $where = ['id' => $id, 'slug' => $slug];
        $row = Event::where($where)->firstOrFail();
        // printArray($row);
        // die;
        $data = compact('row');
        return view('front.event-details')->with($data);
    }
}
