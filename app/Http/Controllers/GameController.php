<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Game;
use Ramsey\Uuid\Type\Integer;
use Illuminate\Support\Facades\DB;
/**
* @OA\Info(
*             title="API RESTful en Laravel", 
*             version="1.0",
*             description="Mostando la Lista de URI's de mi API para el Primer Campeonato Mundial de Toros y Vacas"
* )
*
* @OA\Server(url="http://127.0.0.1:8000/") 
*/
class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $game = Game::all();
        return \response($game);
    }

    /**
     * Registrar la información de un juego
     * @OA\Post (
     *     path="/api/game/",
     *     tags={"game"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="user",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="age",
     *                          type="integer"
     *                      ),
     *                      @OA\Property(
     *                          property="time",
     *                          type="integer"
     *                      )
     *                 ),
     *                 example={
     *                     "user": "Mario",
     *                     "age": "20",
     *                     "time": "9"
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="CREATED",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="integer", example=1),
     *              @OA\Property(property="message", type="string", example="El juego ha sido creado.")
     *         )
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="UNPROCESSABLE CONTENT",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="The user field is required."),
     *              @OA\Property(property="errors", type="string", example="Objeto de errores")
     *          )
     *      ) 
     * )
     */
    public function store(Request $request)
    {                   
        $request->validate([
            'user' =>'required',          
            'age' => 'required|max:100'             
        ]);
        $game = new Game();
        $game->user = $request->user;
        $game->age = $request->age;  
        $game->time = $request->time;
        $game->tries = 0;
        $game->status = false;
        $game->secret = $this->propose_combination();
        $game->last = "0000";
        $game->save();
        return \response(content: "El juego: ($game->id) ha sido creado");
    }
    /*
    Mezcla los elementos de un arreglo de manera aleatoria, extrae una parte del arreglo 
    y devuelve un string con todos los elementos del arreglo concatenados.
    Proponiendo una combinación de números del 0 al 9 para cada posición del arreglo.
    */
    public function propose_combination()
    {
        $number = range(0, 9);              
        shuffle($number);                   
        $secret = array_slice($number,6);   
        return implode("",$secret);         
     }   
        /**
     * Mostrar la información de un juego
     * @OA\Get (
     *     path="/api/game/{id}",
     *     tags={"game"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *              @OA\Property(property="id", type="integer", example=1),
     *              @OA\Property(property="user", type="string", example="Aderson Bolt"),
     *              @OA\Property(property="age", type="integer", example="38"),
     *              @OA\Property(property="tries", type="integer", example="15"),
     *              @OA\Property(property="time", type="integer", example="20"),
     *              @OA\Property(property="status", type="boolean", example="0"),
     *              @OA\Property(property="created_at", type="string", example="2023-02-23T00:09:16.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2023-02-23T12:33:45.000000Z"),
     *              @OA\Property(property="secret", type="string", example="5178"),
     *              @OA\Property(property="last", type="string", example="0000")
     *         )
     *     ),
     *      @OA\Response(
     *          response=404,
     *          description="NOT FOUND",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="No query results for model"),
     *          )
     *      )
     * )
     */
    public function show(string $id)
    {
        $game = Game::findOrFail($id);
        return \response($game);
    }
        /**
     * Proponer combinación, además de actualizar la información de un juego
     * @OA\Put (
     *     path="/api/game/{id}",
     *     tags={"game"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="time",
     *                          type="integer"
     *                      ),
     *                      @OA\Property(
     *                          property="code",
     *                          type="string"
     *                      )
     *                 ),
     *                 example={
     *                     "time": "20",
     *                     "code": "9137"
     *                }
     *             )
     *         )
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *              @OA\Property(property="id", type="integer", example=1),
     *              @OA\Property(property="user", type="string", example="Aderson Bolt"),
     *              @OA\Property(property="age", type="integer", example="38"),
     *              @OA\Property(property="tries", type="integer", example="15"),
     *              @OA\Property(property="time", type="integer", example="20"),
     *              @OA\Property(property="status", type="boolean", example="0"),
     *              @OA\Property(property="created_at", type="string", example="2023-02-23T00:09:16.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2023-02-23T12:33:45.000000Z"),
     *              @OA\Property(property="secret", type="string", example="5178"),
     *              @OA\Property(property="last", type="string", example="0000")
     *         )
     *     ),
     *      @OA\Response(
     *          response=404,
     *          description="NOT FOUND",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="No query results for model"),
     *          )
     *      )
     * )
     */
    public function update(Request $request, int $id)
    {
        $game = Game::findOrFail($id);
        if((string)$game->last != (string)$request->code)
        {
            if((int)$request->time == 0) //Game over - Juego perdido
            {
                $game->time = $request->time;
                $game->status = false;
                $game->save();
                $data=[
                    'mensaje'=>'Juego perdido.',
                    'secreto'=>$game->secret,
                    'timepoUr'=>$request->time,
                    'code'=>$request->code,
                    'tiempoGm' =>$game->time,
                    'Juego'=>$game
                ];
                return \response()->json($data);
            }
            $array_secret = preg_split('//',$game->secret,-1,PREG_SPLIT_NO_EMPTY);  //Divide un string mediante una expresión regular
            $array_code = preg_split('//',$request->code,-1,PREG_SPLIT_NO_EMPTY);   //solo serán devueltos los elementos no vacíos
        
            $result = $this->bulls_cows($array_secret,$array_code);
            
            if((int)$request->time > 0 && (int)$result[0] == 4)//Game wons(Juego ganado)
            {
                $game->time = $request->time;
                $game->status = true;                
                $evaluation = $game->time/2 + $game->tries;
                $ranking = DB::table('games')
                                    ->select('id','((time/2) + tries) as evaluacion',
                                    'user','age','tries','time','status')
                                    ->orderBy('status', 'desc')
                                    ->get();                
                $game->save();
                $data=[
                    'mensaje'=>'Juego ganado.',
                    'El numero secreto es:'=>$game->secret,
                    'T' => (int)$result[0], 'V' => $result[2],                      
                    'Evaluation'=>$evaluation,
                    'Ranking:'=>$ranking,
                    'Juego'=>$game
                ];
                return \response()->json($data);
            }else
                {
                    $game->time = $request->time;
                    $game->tries += 1;
                    $game->status = false;
                    $game->last = $request->code;
                    $game->save();
                    $data=[
                        'mensaje'=>'Juego actualizado.',
                        'timepoUr'=>$request->time,
                        'code'=>$request->code,
                        'tiempoGm' =>$game->time,
                        'T' => (int)$result[0], 'V' => $result[2],                      
                        'Juego'=>$game
                    ];
                    return \response()->json($data);                    
                }
        }
        else
        {           
            $data=[
                'message'=>'Combinación duplicada: los dígitos ya fueron enviados previamente en el mismo orden.',
                'Juego'=>$game
            ];
            return \response()->json($data);            
        }        
    }
    /*
    Este método análiza dos arreglos buscando las coincidencias según la poscición en cada arreglo,
    para devolver un arreglo con el resultado de el total de toros y vacas encontrados
    */
    private function bulls_cows($secret, $code)
    {
        $bulls = array_intersect_assoc($secret, $code); // Calcula la intersección de arrays con un chequeo adicional de índices
        $total_bulls = count($bulls);
        $cows = array_intersect($secret, $code);        //Calcula la intersección de arrays
        $temp = count($cows);
        $total_cows = $temp - $total_bulls;
        $array = array($total_bulls,"T",$total_cows,"V");
        return $array;
    }   

    /**
     * Eliminar la información de un juego(game)
     * @OA\Delete (
     *     path="/api/game/{id}",
     *     tags={"game"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="CREATED",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="number", example=1),
     *             @OA\Property(property="message", type="string", example="El juego: ($game->id) ha sido eliminado."),
     *        )
     *     ),
     * )
     */
    public function destroy(string $id)
    {
        Game::destroy($id);
        return \response(content: "El juego: ($id) ha sido eliminado");
    }
}
