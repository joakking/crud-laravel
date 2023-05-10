@extends('layouts.base')

@section('content')
<div class="row">
    <div class="col-12">
        <div>
            <h2>CRUD de Tareas</h2>
        </div>
        <div>
            <a href="{{route('tasks.create')}}" class="btn btn-primary">Crear tarea</a>
        </div>
    </div>

@if (Session::get('success'))
{{-- <div class="alert alert-success mt-2">
    <strong>{{ Session::get('success') }}<br>
</div> --}}
<div class="alert alert-success" role="alert" mt-2>
  {{ Session::get('success') }}
</div>
@endif

@foreach ($tasks as $task)
<div class="accordion" id="accordionExample">
  <div class="accordion-item">
    <h2 class="accordion-header" id="{{$task->id}}">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$task->id}}" aria-expanded="false" aria-controls="collapseTwo">
        {{ $task->id}} {{$task->title}}
      </button>
    </h2>
    <div id="collapse{{$task->id}}" class="accordion-collapse collapse" aria-labelledby="{{$task->id}}" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <strong> {{ $task->description}} </strong> 
      </div>
    </div>
  </div>
</div>
@endforeach


    <div class="col-12 mt-4">
        <table class="table table-bordered">
            <tr class="text-secondary">
                <th>Tarea</th>
                <th>Descripción</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Acción</th>
                <th>prueba</th>
            </tr>
            @foreach ($tasks as $task)
            <tr>
                <td class="fw-bold">{{ $task->title}}</td>
                <td>{{ $task->description}}</td>
                <td>
                    {{$task->due_date}}
                </td>
                <td>
               @if ($task->status == "Completada")
                 <span class="badge bg-success fs-6">{{ $task->status }}</span>      
               @elseif  ($task->status == "En proceso")
                 <span class="badge bg-info fs-6">{{ $task->status }}</span>
               @else
                 <span class="badge bg-warning fs-6">{{ $task->status }}</span>
               @endif

                
                </td>
                <td>
                    <a href="{{ route('tasks.edit', $task) }}" class="btn btn-info">Editar</a>


                    
                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"  data-toggle="modal" data-target="#exampleModal">Eliminar</button>
                    </form>
                    
                </td>
                <td>
   <!-- Button trigger modal -->
   <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Ver Modal
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
                </td>
            </tr>
            @endforeach
        </table>
              
        {{ $tasks->links()}}
    </div>
</div>
@endsection