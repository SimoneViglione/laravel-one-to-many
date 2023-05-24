@extends ('layouts.app')

@section('content')

<div class="container mt-4">

    <h1>{{$project->title}}</h1>
    <h6><small>Slug: {{$project->slug}}</small></h6>

    <h3>Categoria: {{$project->category?$project->category->name:'Nessuna categoria abbinata'}}</h3>

    @if ($project->cover_image)
        <img class="img-thumbnail" src="{{$project->cover_image}}" alt="{{$project->title}}"/>
    @endif

    <p>{{$project->content}}</p>

    <a class="btn btn-primary" href="{{route('admin.projects.index')}}">Torna alla lista</a>

</div>

@endsection