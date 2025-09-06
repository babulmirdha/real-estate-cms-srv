<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProjectController extends Controller
{
    public function index(Request $request)
    {


        $perPage = $request->integer('per_page', 10);
        $term    = trim($request->string('term'));

        $projects = Project::query()
            ->when($term, fn($q) =>
                $q->where('title','like',"%{$term}%")
                  ->orWhere('city','like',"%{$term}%")
                  ->orWhere('area','like',"%{$term}%")
            )
            ->when($request->filled('status'), fn($q) =>
                $q->where('status', $request->string('status'))
            )
            ->latest()
            ->paginate($perPage)
            ->withQueryString();

        return Inertia::render('Projects/Index', [
            'filters'  => [
                'term'   => $term,
                'status' => $request->string('status')->toString(),
                'per_page' => $perPage,
            ],
            'projects' => $projects, // paginator goes straight to Inertia
        ]);
    }

    public function create()
    {
        return Inertia::render('Projects/Create');
    }

    public function store(ProjectRequest $request)
    {
        $data = $request->validated();
        Project::create($data);

        return redirect()->route('projects.index')->with('success','Project created.');
    }

    public function show(Project $project)
    {
        return Inertia::render('Projects/Show', [
            'project' => $project,
        ]);
    }

    public function edit(Project $project)
    {
        return Inertia::render('Projects/Edit', [
            'project' => $project,
        ]);
    }

    public function update(ProjectRequest $request, Project $project)
    {
        $project->update($request->validated());

        return redirect()->route('projects.index')->with('success','Project updated.');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->back()->with('success','Project deleted.');
    }
}
