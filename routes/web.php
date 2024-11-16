<?php

use Illuminate\Support\Facades\Route;
use App\Http\Requests\TaskRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Task;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/',function(){
  return redirect()->route('tasks.index');
});

Route::get('/tasks', function (){
    return view('index',[
        'tasks' => Task::latest()->paginate(3)
    ]);
})->name('tasks.index');


Route::view('/tasks/create','create')->name('tasks.create');

Route::get('/tasks/{task}/edit',function(Task $task){
    return view('edit',['task'=> $task]);
 })->name('tasks.edit');

Route::get('/tasks/{task}',function(Task $task){
   return view('show',['task'=> $task]);
})->name('tasks.show');

Route::post('/tasks',function(TaskRequest $request){
   $task = Task::create($request->validated());
   return redirect()->route('tasks.show',['task' => $task->id])->with('success','Task created successfully!');
})->name('tasks.store');


Route::put('/tasks/{task} ',function(Task $task,TaskRequest $request){
    $data = $request->validated();
    $task->update($request->validated());
    return redirect()->route('tasks.show',['task' => $task->id])->with('success','Task updated successfully!');
 })->name('tasks.update');

 Route::put('/tasks/{task}/toggle-complete',function(Task $task){
    // $task->completed = ! $task->completed;
    // $task->save();
    $task->toggleComplete();
    return redirect()->back()->with('success','Task updated successfully!');
 })->name('tasks.toggle-complete');

 Route::delete('/tasks/{task}', function (Task $task) {
   $task->delete();
   return redirect()->route('tasks.index')->with('success','Task deleted successfully!');
 })->name('tasks.destroy');

Route::fallback(function(){
    return "Page not found!";
});
