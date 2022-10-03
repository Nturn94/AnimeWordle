<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\Model;
use App\Models\Anime;
use Illuminate\Support\Facades\DB;
use DateTime;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class ImageController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {

    }
    public function Autocomplete(Request $request)
    {
        // This function serves as an autocomplete for the input field
        $data = Anime::select("name")
                    ->where('name', 'LIKE', '%'. $request->get('query'). '%')
                    ->get();
        return response()->json($data);
    }
    public function gameView(){
        session_start();
        // Calculate the current day number (based off the fixed starting date)
        $dayNumber = Carbon::now()->diff('2022-09-18')->days;

        // Since each day has it's own puzzle we can easily find today's puzzle by it's (day) ID
        $anime = Anime::where('id', $dayNumber);
        // $_SESSION['guesses'] = [];
        // $_SESSION['anime_id'] = 100;
        if (!isset($_SESSION['anime_id'])){
            $_SESSION['anime_id'] = $anime->value("id");
        }elseif( $_SESSION['anime_id'] !=  $anime->value("id")){
            $_SESSION['anime_id'] = $anime->value("id");
            $_SESSION['guesses'] = [];
            
        }
        $list = array();
        $animelist = Anime::all();
        foreach ($animelist as $name){
            array_push($list, $name->name);
        }
        $maxGuesses = 6;
        
        if(!isset($_SESSION['guesses'])){
            $guesses = [];
        }else{
            $guesses = $_SESSION['guesses'];
        }
        if (
            in_array($anime->value("name"), $guesses)
            && count($guesses) <= $maxGuesses
        ) {
            if(!isset($_COOKIE["consec"])){
                $_COOKIE["consec"] = 1;
            }else{
                $_COOKIE["consec"]+=1;
            }
            $consec = $_COOKIE["consec"];
            return view('Game.game_win', [
                'anime' => $anime,
                'consec' => $_COOKIE["consec"],
            ]);
        } elseif (count($guesses) >= $maxGuesses) {
            $_COOKIE["consec"] = 0;
            return view('Game.game_fail', [
                'anime' => $anime,
            ]);
        }

        return view('Game.view_game', [
            'anime' => $anime,
            'guesses' => $guesses,
            'list' => $list,
        ]);
    }
    public function Scrape(){
        return view('Game.view_scrape');
    }
    public function Guess(Request $request){
        // An empty guess will be replaced with a "-"
        session_start();
        $input = $request->guess;
        if (empty($input)){
            $input = "-";
        }
        array_push($_SESSION['guesses'], $input);
        return redirect('/');
}

    //This function checks if entry exists and if it doesn't, it adds a new entry.
    public function Postanime(Request $request){
        $array = unserialize($_POST['result']);
        // dd($array);
        for($ii = 1; $ii<10; $ii++){
            $temp = $array[$ii][0];
            $data = Anime::select("name")->where('name', $temp)->get();
            if(!$data){
                if($array[$ii][0]){
                    $anime = new Anime();
                    // $anime->name = strip_tags($array[$ii][0]);
                    $parse = str_replace("'", " ", $array[$ii][0]);
                    $anime->name = $parse;
                    $anime->image = $array[$ii][1];
                    $anime->image2 = $array[$ii][2];
                    $anime->image3 = $array[$ii][3];
                    $anime->image4 = $array[$ii][4];
                    $anime->image5 = $array[$ii][5];
                    $anime->image6 = $array[$ii][6];
                    $anime->save();
                }
            }
        }
        return view('Game.view_scrape');
    }
}
