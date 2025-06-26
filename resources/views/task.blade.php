@extends('layout')

@section('content')

<style>
  .main-content {
    padding: 20px;
    background-color: #f9f9f9;
    display: flex;
    justify-content: center;
  }

  .task-form {
    width: 100%;
    max-width: 500px;
    background: #ffffff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 5px rgba(0,0,0,0.1);
  }

  .task-form label {
    display: block;
    font-weight: bold;
    margin-top: 15px;
    margin-bottom: 5px;
  }

  .task-form input[type="text"],
  .task-form textarea,
  .task-form select {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
  }

  .task-form input[type="file"] {
    margin-top: 5px;
  }

  .task-form .error {
    font-size: 13px;
    color: red;
    margin-top: 5px;
  }

  .task-form button {
    margin-top: 20px;
    padding: 10px 15px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }

  .task-form button:hover {
    background-color: #0056b3;
  }
</style>

<div class="main-content">
  <form class="task-form" action="{{ route('store_data') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <label for="name">Name:</label>
    <input type="text" value="{{ old('name') }}" id="name" name="name">
    @error('name') <div class="error">{{ $message }}</div> @enderror

    <label for="description">Description:</label>
    <textarea id="description" name="description" rows="4">{{ old('description') }}</textarea>
    @error('description') <div class="error">{{ $message }}</div> @enderror

    <label for="images">Upload Images:</label>
    <input type="file" id="images" name="images[]" multiple accept="image/*">
    @error('images[]') <div class="error">{{ $message }}</div> @enderror

    <label for="category">Category:</label>
    <select id="category" name="category">
      <option value="">-- Select Category --</option>
      <option value="high">High Priority</option>
      <option value="low">Low Priority</option>
    </select>
    @error('category') <div class="error">{{ $message }}</div> @enderror

    <button type="submit">Submit</button>
  </form>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "timeOut": "3000",
        "positionClass": "toast-top-right"
    };

    @if(session('success'))
        toastr.success("{{ session('success') }}");
    @endif
</script>

<