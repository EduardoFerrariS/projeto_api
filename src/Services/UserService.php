<?php 

namespace App\Services;

use App\Http\JWT;
use App\Utils\Validator;
use Exception;
use PDOException;
use App\Models\User;

class UserService
{
    public static function create(array $data)
    {
        try {
            $fields = Validator::validate([
                'name'     => $data['name']     ?? '',
                'email'    => $data['email']    ?? '',
                'password' => $data['password'] ?? '',
            ]);

            $fields['password'] = password_hash($fields['password'], PASSWORD_DEFAULT);

            $user = User::save($fields);

            if (!$user) return ['error' => 'não foi possível criar sua conta.'];

            return "Usuário criado com sucesso!";

        } 
        catch (PDOException $e) {
            if ($e->errorInfo[0] === '08006') return ['error' => 'não foi possivel conectar ao banco de dados'];
            if ($e->errorInfo[0] === '23505') return ['error' => 'usuário já existe.'];
            return ['error' => $e->errorInfo[0]];
        }
        catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public static function auth(array $data)
    {
        try {
            $fields = Validator::validate([
                'email'    => $data['email']    ?? '',
                'password' => $data['password'] ?? '',
            ]);

            $user = User::authentication($fields);

            if (!$user) return ['error'=> 'não conseguimos autenticá-lo.'];

            return JWT::generate($user);
        } 
        catch (PDOException $e) {
            if ($e->errorInfo[0] === '08006') return ['error' => 'não foi  possivel nos conectar ao banco de dados.'];
            return ['error' => $e->errorInfo[0]];
        }
        catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public static function fetch(mixed $authorization)
    {
        try {
            if (isset($authorization['error'])) {
                return ['unauthorized'=> $authorization['error']];
            }

            $userFromJWT = JWT::verify($authorization);

            if (!$userFromJWT) return ['unauthorized'=> "faça login para acessar este recurso."];

            $user = User::find($userFromJWT['id']);

            if (!$user) return ['error'=> 'não conseguimos encontrar sua conta.'];

            return $user;
        } 
        catch (PDOException $e) {
            if ($e->errorInfo[0] === '08006') return ['error' => 'não foi  possivel nos conectar ao banco de dados.'];
            return ['error' => $e->errorInfo[0]];
        }
        catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public static function update(mixed $authorization, array $data)
    {
        try {
            if (isset($authorization['error'])) {
                return ['unauthorized'=> $authorization['error']];
            }

            $userFromJWT = JWT::verify($authorization);

            if (!$userFromJWT) return ['unauthorized'=> "faça login para acessar este recurso."];

            $fields = Validator::validate([
                'name' => $data['name'] ?? ''
            ]);

            $user = User::update($userFromJWT['id'], $fields);

            if (!$user) return ['error'=> 'não foi possível atualizar sua conta.'];

            return "Usuário atualizado com sucesso!";
        } 
        catch (PDOException $e) {
            if ($e->errorInfo[0] === '08006') return ['error' => 'não foi  possivel nos conectar ao banco de dados.'];
            return ['error' => $e->getMessage()];
        }
        catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public static function delete(mixed $authorization, int|string $id)
    {
        try {
            if (isset($authorization['error'])) {
                return ['unauthorized'=> $authorization['error']];
            }

            $userFromJWT = JWT::verify($authorization);

            if (!$userFromJWT) return ['unauthorized'=> "faça login para acessar este recurso."];

            $user = User::delete($id);

            if (!$user) return ['error'=> 'não foi possível deletar sua conta.'];

            return "Usuário deletado com sucesso!";
        } 
        catch (PDOException $e) {
            if ($e->errorInfo[0] === '08006') return ['error' => 'não foi  possivel nos conectar ao banco de dados.'];
            return ['error' => $e->getMessage()];
        }
        catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}