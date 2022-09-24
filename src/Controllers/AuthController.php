<?php
	namespace App\Controllers;

	use Psr\Http\Message\ResponseInterface;
	use Psr\Http\Message\ServerRequestInterface;
	use App\Models\DB\admin;

	class AuthController
	{
		public function login(ServerRequestInterface $request, ResponseInterface $response){
			$data = json_decode($request -> getbody() -> getcontents(),true);
			$order = admin::where([["account", "=", $data["account"]], ["password", "=", $data["password"]]])->get();
            if ($order != null){
                $jwt_data = [
                    "id"=>$user->getKey(),
                    "name"=>$user->name,
                    "email"=>$user->email,
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
