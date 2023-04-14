<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Traits\ApiResponser;
use DB; 

Class UserController extends Controller {
    use ApiResponser;
    private $request;

public function __construct(Request $request){
$this->request = $request;
}
    public function g(){
        $users = User::all();
        return $this->successResponse($users);
       
    }
    public function show($id)
    {
        //
        
        $users = User::findOrFail($id);
        return $this->successResponse($users);
    }
    public function a(Request $request ){
        $rules = [
            'first_name' => 'max:20',
            'middle_name' => 'max:20',
            'last_name' => 'max:20',
        ];
        $this->validate($request,$rules);
        $user = User::create($request->all());
        return $this->successResponse($users);
       
}
    public function u(Request $request,$id)
    {
    $rules = [
    'first_name' => 'max:20',
    'middle_name' => 'max:20',
    'last_name' => 'max:20',
    
    ];
    $this->validate($request, $rules);
    $user = User::findOrFail($id);
    $user->fill($request->all());

    // if no changes happen
    if ($user->isClean()) {
    return $this->errorResponse('At least one value must
    change', Response::HTTP_UNPROCESSABLE_ENTITY);
    }
    $user->save();
    return $user;
}
    public function d($id)
    {
    $user = User::findOrFail($id);
    $user->delete();
//* asdasdasdasdasdasdasd */
 
    // old code
    /*
    $user = User::where('userid', $id)->first();
    if($user){
    $user->delete();
    return $this->successResponse($user);
    }
    {
    return $this->errorResponse('User ID Does Not Exists',
    Response::HTTP_NOT_FOUND);
    }
    */
    }
}