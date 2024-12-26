<?php
namespace App\Http\Controllers\Api\V1\App\CheckConnection;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Core;
use Throwable;

class IndexController extends Controller {

    function __invoke(): void {
        $Core = new Core;

        $class = $_GET['class'] ?? '';
        $error = false;

        if ($class) {
            $class_name = "\\App\\Http\\Controllers\\ExternalApi\\$class";
            
            if (!class_exists($class_name, true)) {
                $error = 'Несуществующий класс.';
            }
            
            if (!$error && !method_exists($class_name, 'check')) {
                $error = 'Отсутствует проверка для сервиса.';
            }

            if (!$error) {
                try {
                    $obj = new $class_name;
                    $is_positive_result = $obj->check();

                    if (!$is_positive_result) {
                        $error = 'Ошибка авторизации в сервисе.';
                    }

                } catch (Throwable $th) {
                    $error = $th->getMessage();
                }
            }
            
        }
        
        http_response_code(200);

        if (!$error) {
            echo json_encode(['status' => 'ok']);
        } else {
            echo json_encode(['status' => 'error', 'error' => $error]);
        }

    }
}