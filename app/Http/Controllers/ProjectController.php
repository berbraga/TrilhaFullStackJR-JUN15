<?php

namespace App\Http\Controllers;

use App\Models\project;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = project::all();
        
        
        return Inertia::render('Project/Index', [
            // 'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'projects' => $projects,
            'status' => session('status'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Project/Create', [
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $projeto = new project([
            "name"=>$request->name,
            "description"=>$request->description
        ]);
        $projeto->save();

        return to_route('project.index');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $project = project::findOrFail($id);
        // dd(json_encode($project));
        
        return Inertia::render('Project/Edit', [
            // 'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'project' =>$project,
            "id"=>$id,
            'status' => session('status'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id , Request $request)
    {
        $project = project::findOrFail($id);
        
        $project->name = $request['name'];
        $project->description = $request['description'];
      
        $project->save();
        return to_route('project.index');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $project = project::findOrFail($id);

        $project->delete();
        return to_route('project.index');
    }
}
