<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Type;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::orderBy('id', 'desc')->get();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();

        return view('admin.projects.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $form_data = $request->all();

        $project = new Project();
        
        if ($request->hasFile('cover_image')) {
            // eseguo l'upload del file e recupero il path
            $path = Storage::disk('public')->put('projects_image', $form_data['cover_image']);
            $form_data['cover_image'] = $path;
        }

        $slug = Str::slug($form_data['title'], '-');
        $form_data['slug'] = $slug;

        $project->fill($form_data);
        $project->save();

        return redirect()->route('admin.projects.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show' , compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project,Request $request)
    {
        $error_message = '';
        if (!empty($request->all())) {
            $messages = $request->all();
            $error_message = $messages['error_message'];
        }
        return view('admin.projects.edit' , compact('project','error_message'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $form_data = $request->all();

    // Verifica se esiste un altro progetto con lo stesso titolo
    $exists = Project::where('title','LIKE', $form_data['title'])
        ->where('id', '!=', $project->id)
        ->exists();
    
    if ($exists) {
        $error_message = 'Hai inserito un titolo già presente in un altro articolo';
        return redirect()->route('admin.projects.edit', compact('project', 'error_message'));
    }

    // Aggiorna lo "slug" con il nuovo titolo
    $form_data['slug'] = Str::slug($form_data['title'], '-');

    // Aggiorna i dati del progetto con i nuovi dati
    $project->update($form_data);

    return redirect()->route('admin.projects.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
       $project->delete();
        return redirect()->route('admin.projects.index');
    }
}
