<?php
	namespace App\Controllers;

	use Psr\Http\Message\ResponseInterface;
	use Psr\Http\Message\ServerRequestInterface;
	use App\Models\DB\admin;

	class OrderController
	{
		public function login(ServerRequestInterface $request, ResponseInterface $response){
			$data = json_decode($request -> getbody() -> getcontents(),true);
			$order = admin::where([["account", "=", $data["account"]], ["password", "=", $data["password"]]])->get();
            if ($order != null){
                $response -> getBody() -> write(json_encode(["Status"=> "Success"]));
                return $response -> withStatus(200);
            }else{
                $response -> getBody() -> write(json_encode(["Status"=> "failed!"]));
                return $response -> withStatus(403);
            }
		}
	}
?>
