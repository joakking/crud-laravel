@extends('layouts.base')

@section('content')

<div class="row">
 
@if (Session::get('success'))
{{-- <div class="alert alert-success mt-2">
    <strong>{{ Session::get('success') }}<br>
</div> --}}
<div class="alert alert-success" role="alert" mt-2>
  {{ Session::get('success') }}
</div>
@endif



<main>
  <section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">Tareas Joa</h1>
        <p class="lead text-body-secondary">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it entirely.</p>
        <p>
          <a href="{{route('tasks.create')}}" class="btn btn-primary my-2">Crear Tarea</a>
          <a href="#" class="btn btn-secondary my-2">Secondary action</a>
        </p>
      </div>
    </div>
  </section>
<div class="album py-5 bg-body-tertiary">
  <div class="container">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
      @foreach ($tasks as $task)
        <div class="col">
          <div class="card shadow-sm">
            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
            <div class="card-body">
              <p class="card-text">{{ $task->title}}</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modalnumero{{ $task->id }}">Ver</button>
                  <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-outline-secondary">Editar</a>
                  <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                </form>
                </div>
                @if ($task->status == "Completada")
                <span class="badge text-bg-success">{{ $task->status }}</span>      
              @elseif  ($task->status == "En proceso")
                <span class="badge text-bg-warning">{{ $task->status }}</span>
              @else
                <span class="badge text-bg-danger">{{ $task->status }}</span>
              @endif
                <small class="text-body-secondary">{{ $task->due_date }}</small>
              </div>
            </div>
          </div>
        </div>

          <!-- Modal -->
    <div class="modal fade" id="modalnumero{{ $task->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          {{ $task->description }}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
    </div>

      @endforeach
    </div>
  </div>
</div>
</main>
   
</div>
@endsection