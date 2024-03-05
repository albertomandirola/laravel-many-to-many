<?php

namespace App\Http\Controllers\Admin;

use App\Models\Technology;
use App\Http\Requests\StoreTechnologyRequest;
use App\Http\Requests\UpdateTechnologyRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Type;
use App\Models\Project;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $technologies = Technology::all();
        return view('admin.technologies.index', compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        $technologies = Technology::all();
        return view('admin.technologies.create', compact('technologies'));
        
    }
       

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTechnologyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTechnologyRequest $request)
    {
        $form_data = $request->all();

         $technology = new Technology;

         $slug = Str::slug($form_data['name'], '-');
         $form_data['slug'] = $slug;

         $technology->fill($form_data);
 
         $technology->save();

         return redirect()->route('admin.technologies.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function show(Technology $technology)
    {
        return view('admin.technologies.show', compact('technologies'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function edit(Technology $technology, Request $request )
    {
        $error_message = '';
        if (!empty($request->all())) {
            $messages = $request->all();
            $error_message = $messages['error_message'];
        }
        return view('admin.technologies.edit' , compact('technology','error_message'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTechnologyRequest  $request
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTechnologyRequest $request, Technology $technology)
    {
        $form_data = $request->all();

        $exists = Technology::where('name','LIKE', $form_data['name'])
        ->where('id', '!=', $technology->id)
        ->exists();
        

        if ($exists) {
            $error_message = 'The technology name already exist!';
            return redirect()->route('admin.technologies.edit', compact('technology', 'error_message'));
        }

        $slug = Str::slug($form_data['name'], '-');
        $form_data['slug'] = $slug;
    
        $technology->update($form_data);

        return redirect()->route('admin.technologies.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();
        return redirect()->route('admin.technologies.index');
    }
}
