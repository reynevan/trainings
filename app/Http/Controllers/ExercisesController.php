<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Exercise;
use App\User;
use Auth;
use Input;
use Response;

class ExercisesController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$user = Auth::user();
		$exercises = $user->exercises;
		return view('exercises.index', compact('exercises'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$user = Auth::user();
		$exercises_num = Exercise::where('name', '=', $request->input('name'))->count();
		if ($exercises_num > 0){
			return Response::json(['succes', false]);
		}
		$exercise = new Exercise(['name' => $request->input('name')]);
		if ($user->exercises()->save($exercise)){
			$exercises = $user->exercises;
			return Response::json(['exercises' => $exercises, 'success' => true]);
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function userExercises($user_id = null){
		$response = [];
		if (Auth::user()){
			$user = isset($user_id) ? User::find($user_id) : Auth::user();
			if ($user){
				$exercises = $user->exercises;
				foreach ($exercises as $exercise){
					$exercise['maxRepeats'] = $exercise->maxRepeats($user['id']);
				}
				$response = ['success' => true, 'exercises' => $exercises];							
			} else {
				$response = ['success' => false];
			}
		} else {
			$response = ['success' => false];
		}
		return response()->json($response);	
	}

}
