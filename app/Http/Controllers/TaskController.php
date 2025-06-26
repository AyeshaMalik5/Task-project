<?php
namespace App\Http\Controllers;
use App\Models\Task;
use App\Models\User;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Events\sendMailevent;
use App\Events\AcceptOrrejectOder;
use App\Notifications\TaskSubmittedNotification;
use App\Notifications\TaskStatusUpdatedNotification;

class TaskController extends Controller
{
    public function store(Request $request)
{
    $data = $request->validate([
        'name' => 'required',
        'description' => 'required',
        'category' => 'required',
        'images.*' => 'required|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // Add user and code
    $data['code'] = 'AS' . rand(0, 999);
    $data['user_id'] = auth()->id();

    // Create task
    $task = Task::create($data);

    // Notify admins
    $admins = User::where('role', 'admin')->get();
    foreach ($admins as $admin) {
        $admin->notify(new TaskSubmittedNotification($task));
    }

    // Save images
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $imageFile) {
            $path = $imageFile->store('uploads', 'public');
            $task->images()->create([
                'image_path' => $path,
            ]);
        }

        try {
            event(new sendMailevent($task));
        } catch (\Throwable $e) {
            dd('Error firing event: ' . $e->getMessage());
        }
    }

    // ✅ This line now works
    return redirect()->back()->with('success', 'Task submitted successfully!');
}

    public function show()
    {
        {
    $user_id=auth()->id();
            $task=Task::where('user_id',$user_id)->get();
            return view('employee_tasklist', compact('task'));

        }
    } 
  public function updateStatus(Request $request,$task)
{
    $request->validate([
        'status' => 'required', 
    ]);
    $item = Task::findOrFail($task); 
    $item->status = $request->status;
    $item->save();
    // $task->status = $request->status;
    // $task->save();
     $task = Task::findOrFail($task);
 $employee = $task->user;

     if ($employee) {
    \Log::info('Sending notification to employee: ' . $employee->id);

    $employee->notify(new TaskStatusUpdatedNotification(
        $task->id,
        $task->name,
        $task->status
    ));
}
    // Step 2: Load the related user
    $task->load('user'); // ✅ now this works

    // Step 3: Update status
    $task->status = $request->status;
    $task->save();
try {
   event(new AcceptOrrejectOder($task));
    // dd('Event fired');
} catch (\Throwable $e) {
    dd('Error firing event: ' . $e->getMessage());
}
    return redirect()->back()->with('success', 'Task status updated.');

}
public function editTask($id){
    $task = Task::findOrFail($id);
    // dd($task);
    return view('editTask', compact('task'));
}

public function updateTask(Request $request, $id,Task $task )
{ 
    $data = $request->validate([
        'name' => 'required',
        'description' => 'required',
        'category' => 'required',
        'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // Find the task or fail if not found
    $task = Task::findOrFail($id);

    // Update task basic fields
    $task->update([
        'name' => $request->name,
        'description' => $request->description,
        'category' => $request->category,
    ]);

    // Handle images if uploaded
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $imageFile) {
            $path = $imageFile->store('uploads', 'public');

            // Save related image (assuming polymorphic or hasMany relation)
            $task->images()->create([
                'image_path' => $path,
            ]);
        }
    }

    return redirect()->route('task_list')->with('success', 'Task updated successfully!');
}
}