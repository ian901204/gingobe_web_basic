<?php
	namespace App\Controllers;

    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;
	use Psr\Http\Message\ResponseInterface;
	use Psr\Http\Message\ServerRequestInterface;
	use App\Models\DB\admin;

	class AuthController
	{
		public function login(ServerRequestInterface $request, ResponseInterface $response){
			$data = json_decode($request -> getbody() -> getcontents(),true);
			$user = admin::where([["account", "=", $data["account"]], ["password", "=", $data["password"]]])->get(["id", "name"]);
            $response -> getBody() -> write(json_encode(["test"=> $user[0]["id"]]));
            return $response ->withHeader('content-type', 'application/json') -> withStatus(200);
            if ($user != null){
                $jwt_data = [
                    "id" => $user[0]["id"],
                    "name" => $user[0]["name"],
                    "iat" => time(),
                    "exp" => time()+300
                ];
                $jwtToken = JWT::encode($jwt_data, $_ENV["JWT_SECRET"], 'HS256');
                $response -> getBody() -> write(json_encode(["token"=> $jwtToken]));
                return $response ->withHeader('content-type', 'application/json') -> withStatus(200);
            }else{
                $response -> getBody() -> write(json_encode(["Status"=> "failed!"]));
                return $response->withHeader('content-type', 'application/json') -> withStatus(403);
            }
		}

        public function verify(ServerRequestInterface $request, ResponseInterface $response){
			if(!isset($request->getHeader("Authorization")[0])){
                $response->getBody()->write(json_encode([
                    "message" => "No token provided!"
                ]));
                return $response
                    ->withHeader('content-type', 'application/json')
                    ->withStatus(403);
            }
            $jwtToken = str_replace("Bearer ", "", $request->getHeader("Authorization")[0]);
            try {
                $jwtBody = JWT::decode($jwtToken, new Key($_ENV["JWT_SECRET"], 'HS256'));
                $response -> getBody() -> write(json_encode(["Status" => "Success"]));
                return $response ->withHeader('content-type', 'application/json')
                ->withStatus(200);
            } catch (\Exception $e) {
                $response->getBody()->write(json_encode([
                    "message" => "Token is invalid!",
                ]));
                return $response
                    ->withHeader('content-type', 'application/json')
                    ->withStatus(400);
            }
		}
	}
?>
