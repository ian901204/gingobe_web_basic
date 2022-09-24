<?php

namespace App\Middleware;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Psr\Http\Message\ServerRequestInterface ;
use Psr\Http\Server\RequestHandlerInterface ;
use Slim\Psr7\Response;

class verifyMiddleware
{
    public function __invoke(ServerRequestInterface $request, RequestHandlerInterface $handler)
    {
        $response = new Response();
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
            if ($jwtBody -> teacher != NULL){
                $request = $request -> withAttribute("teacher", ($jwtBody->teacher)?TRUE:FALSE);
                $request = $request -> withAttribute("TID", $jwtBody -> TID);
            }
            $request = $request -> withAttribute("email", $jwtBody->email);
            $request = $request -> withAttribute("id", $jwtBody->id);
            return $handler->handle($request);
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