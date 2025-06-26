@extends('layout')
@section('content')
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"> --}}

<div class="container mt-5">
  <h2 class="mb-4">My Tasks</h2>

  <table id="taskTable" class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>Task Name</th>
        <th>Description</th>
        <th>Code</th>
        <th>Category</th>
        <th>Action</th>
        <th>Edit</th>

      </tr>
    </thead>
    <tbody>
      @foreach($task as $tasks)
      <tr>
        <td>{{ $tasks->name }}</td>
        <td>{{ $tasks->description }}</td>
        <td>{{ $tasks->code }}</td>
        <td>
          @if ($tasks->category == 'high')
            <span class="badge bg-danger">{{ $tasks->category }}</span>
          @elseif ($tasks->category == 'low')
            <span class="badge bg-warning text-dark">{{ $tasks->category }}</span>
          @else
            <span class="badge bg-secondary">{{ $tasks->category }}</span>
          @endif
        </td>
        <td>
          <!-- View button for modal -->
          <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#taskModal{{ $tasks->id }}">
            <i class="bi bi-eye"></i> View
          </button>
        </td>
       @if($tasks->status == 'pending')
    <td>
        <button class="btn btn-outline-primary btn-sm" onclick="window.location.href='{{ route('editTask', ['id' => $tasks->id]) }}'">
            <i class="bi bi-pencil"></i> Edit
        </button>
    </td>
@endif

      </tr>

      <!-- Modal for each task -->
      <div class="modal fade" id="taskModal{{ $tasks->id }}" tabindex="-1" aria-labelledby="taskModalLabel{{ $tasks->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="taskModalLabel{{ $tasks->id }}">Images for {{ $tasks->name }}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <!-- Check if there are images for the task -->
              @if($tasks->images->isEmpty())
                <p>No images available for this task.</p>
              @else
                <!-- Show images for this task -->
                @foreach($tasks->images as $image)
                  @php
                    $imagePath = 'storage/' . $image->image_path; // Correct browser-accessible path
                    $fullPath = public_path($imagePath);          // Absolute file path for checking
                  @endphp

                  @if(file_exists($fullPath))
                    <img src="{{ asset($imagePath) }}" class="img-fluid m-2" style="max-width: 200px;">
                  @else
                    <p>Image not found: {{ $imagePath }}</p>
                  @endif
                @endforeach
              @endif
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </tbody>
  </table>
</div>

<!-- Include only Bootstrap JS -->
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script> --}}

@endsection
