<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Auth;
use Response;
use App\User;
use App\Training;
use App\Serie;

class TrainingsController extends Controller {

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
		$trainings = $user->trainings;
        $exercises = [];
        foreach ($user->exercises as $exercise){
            $exercises[$exercise['id']] =  $exercise['name'];
        }

		return view('trainings.index', compact('trainings', 'exercises'));
	}

	/**
	 * Creating empty training for view.
	 *
	 * @return Response
	 */
	public function create()
	{
		if (Auth::user()){
			$training = Auth::user()->trainings()->create([]);
			$serie = $training->series()->create([]);
            $serie['exercises'] = [];
            $training['exercises'] = [];
            $training['series'] = [$serie];
			$response = ['success' => true, 'training' => $training];
		} else {
			$response = ['success' => false];
		}
		return Response::json($response);

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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
	public function update($id, Request $request)
	{
		$training = Training::find($id);
        if ($training){
            $trainingData = $request->all();
            $trainingData = $trainingData['training'];
            foreach ($trainingData['series'] as $serie){
                $serie = Serie::find($serie['id']);
                foreach ($serie['exercises'] as $exercise){
                    echo $exercise['name'];
                }
            }
        }
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        if (Training::destroy($id)){
            return $this->userTrainings();
        }
        else {
            $response = ['success' => false];
            return Response::json($response);
        }
	}

	public function userTrainings($user_id = null){
		$user = isset($user_id) ? User::find($user_id) : Auth::user();
		$trainings = $user->trainings;
		foreach ($trainings as $training){
			$training['series'] = $training->series;
			foreach ($training['series'] as $key => $serie){
				$training['series'][$key]['exercises'] = $serie->exercises;
			}
		}
		return Response::json(['success' => true, 'trainings' => $trainings]);
	}

    public function addSerie($id, Request $request){
        $training = Training::find($id);
        if ($training){
            $training->series()->create([]);
            $series = $training->series;
            foreach ($series as $serie){
                $serie['exercises'] = $serie->exercises;
            }
            $response = ['success' => true, 'series' => $series];
        } else {
            $response = ['success' => false];
        }
        return Response::json($response);
    }
}
