<?php
	namespace App\Controllers;

	use Psr\Http\Message\ResponseInterface;
	use Psr\Http\Message\ServerRequestInterface;
	use App\Models\DB\admin;

	class AuthController
	{
		public function login(ServerRequestInterface $request, ResponseInterface $response){
			$data = json_decode($request -> getbody() -> getcontents(),true);
			$user = admin::where([["account", "=", $data["account"]], ["password", "=", $data["password"]]])->get(["id", "name"]);
            if ($user != null){
                $jwt_data = [
                    "name"=>$user->name,
                    "iat" => time(),
                    "exp" => time()+86400
                ];
                $jwtToken = JWT::encode($jwt_data, $_ENV["JWT_SECRET"], 'HS256');
                if ($user -> password_reset != NULL){
                    $user -> password_reset = NULL;
                    $user -> save();
                }
                $response -> getBody() -> write(json_encode(["Status"=> $jwtToken]));
                return $response -> withStatus(200);
            }else{
                $response -> getBody() -> write(json_encode(["Status"=> "failed!"]));
                return $response -> withStatus(403);
            }
		}
	}
?>
