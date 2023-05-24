<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Type;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            $projects = Project::all();
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
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function store(StoreProjectRequest $request)
        {
            $validated_data = $request->validated();

            $validated_data['slug'] = Project::generateSlug($request->title);

            $checkProject = Project::where('slug', $validated_data['slug'])->first();
            if ($checkProject) {
                return back()->withInput()->withErrors(['slug' => 'Impossibile creare lo slug per questo progetto, cambia il titolo']);
            }

            $newProject = Project::create($validated_data);

            return redirect()->route('admin.projects.show', ['project' => $newProject->slug])->with('status', 'Progetto creato con successo!');
        }

        /**
         * Display the specified resource.
         *
         * @param  \App\Models\project  $project
         * @return \Illuminate\Http\Response
         */
        public function show(project $project)
        {

            return view('admin.projects.show', compact('project'));
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  \App\Models\project  $project
         * @return \Illuminate\Http\Response
         */
        public function edit(project $project)
        {
            $types = Type::all();
            return view('admin.projects.edit', compact('project', 'types'));

        }

        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  \App\Models\project  $project
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, project $project)
        {
            //
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  \App\Models\project  $project
         * @return \Illuminate\Http\Response
         */
        public function destroy(project $project)
        {
            $project->delete();
            return redirect()->route('projects.index');
        }
    }

