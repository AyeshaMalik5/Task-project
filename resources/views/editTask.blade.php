@extends('layout')

@section('content')
<style>
  .main-content {
    display: flex;
    justify-content: center;
    background-color: #f4f4f4;
    padding:20px;
  }

  .edit_form {
    background: #fff;
    padding: 20px;
    width: 100%;
    max-width: 500px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
  }

  .edit_h5 {
    margin-top: 0;
    margin-bottom: 20px;
    font-size: 1.25rem;
    font-weight: bold;
  }

  .edit_label {
    font-weight: bold;
    display: block;
    margin-top: 15px;
  }

  .edit_input[type="text"],
  .edit_textarea,
  .edit_select {
    width: 100%;
    padding: 8px;
    margin-top: 5px;
    box-sizing: border-box;
  }

  .edit_button {
    margin-top: 20px;
    padding: 10px 20px;
    background-color: #3498db;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

 .edit_button:hover {
    background-color: #2980b9;
  }
</style>

<div class="main-content">
  <form  class="edit_form" action="{{ route('updateTask', ['id' => $task->id]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <h5  class="edit_h5">Edit Task</h5>

    <label class="edit_label" for="name">Name:</label>
    <input  class="edit_input" type="text" value="{{ old('name', $task->name) }}" id="name" name="name">
    <div style="text-align: left">
      @error('name') <span class="error text-danger">{{ $message }}</span> @enderror
    </div>

    <label class="edit_label" for="description">Description:</label>
    <textarea   class="edit_textarea" id="description" name="description" rows="4">{{ old('description',$task->description) }}</textarea>
    <div>
      @error('description') <span class="error text-danger">{{ $message }}</span> @enderror
    </div>

    <label class="edit_label" for="images">Upload Images:</label>
    <input class="edit_input" type="file" id="images"name="images[]" multiple accept="image/*">
    <div>
      @error('images[]') <span class="error text-danger">{{ $message }}</span> @enderror
    </div>

    <label  class="edit_label" for="category">Category:</label>
    <select  class="edit_select" id="category" name="category">
      <option value="{{ old('description',$task->category) }}">High Priority</option>
      <option value="{{ old('description',$task->category) }}">Low Priority</option>
    </select>
    <div>
      @error('category') <span class="error text-danger">{{ $message }}</span> @enderror
    </div>

    <button class="edit_button" type="submit">Submit</button>
  </form>
</div>
@endsection










