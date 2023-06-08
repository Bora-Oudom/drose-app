<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return redirect()->route('home');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $rules = [
            'title' => 'required|string|max:100',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,gif|max:5242',
        ];   
        
        $input = $request->all();
        $validator = Validator::make($input, $rules);
        if ($validator->fails()){
            $request->merge(['add_form_validator' => '1']);
            $input['add_form_validate'] = '1';
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $blog = new Blog();
    
            $blog->title = $request->input('title');
            $blog->description = $request->input('description');
            $blog->user_id = auth()->user()->id; // Associate blog with current user
            // dd($request->hasFile('image'));
            if($request->hasFile('image')){
                $file = $request->file('image');
                $filename = /** date('YmdHi') */ uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('image'), $filename);
                $blog->image = $filename;
            }else {
                // Set a default image filename or any appropriate value
                $blog->image = 'default.jpg';
            }
            $blog->save();
    
            return redirect()->route('home')->with('success','Blog has been created');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $blog = Blog::with('user')->find($id);
        // $blog = Blog::find($id);
        return view('blogs.index',['blog' => $blog]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    { 
        $blog = Blog::find($id);
        return view('blogs.edit', ['id' => $id, 'blog' => $blog]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'title' => 'required|string|max:100',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,gif|max:5242',
        ];  
        $input = $request->all();

        $validator = Validator::make($input, $rules);
        if ($validator->fails()){
            $request->merge(['add_form_validator' => '1']);
            $input['add_form_validate'] = '1';
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $blog =Blog::find($id);
    
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                if($request->hasFile('image')) {
                    // Delete old image
                    // dd($blog->image);
                    // Storage::delete('image/'.$blog->image);
                    if($blog->image !== 'default.jpg'){
                        // dd($blog->image);
                        unlink(public_path('image/'.$blog->image));
                    }
                    // Generate unique file name
                    $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            
                    // Move uploaded file to public directory
                    $file->move(public_path('image'), $filename);
            
                    // Update input with new image file name
                    $input['image'] = $filename;
                }
            }
            // else {
            //     // Set default image if no image is uploaded
            //     $input['image'] = 'default.jpg'; // Replace with your default image filename/path
            // }
            $blog->update($input);
            return redirect()->route('home')->with('success', 'Blog has been updated');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog = Blog::find($id);
        $blog->delete();
        unlink(public_path('image/' . $blog->image));
        return redirect()->back()->with('success', 'blog has been deleted');
    }
}
