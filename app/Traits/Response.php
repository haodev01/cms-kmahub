<?php 
namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait Response
{
  protected $CODE_RETURN_HTTP = [200,500,400,404,403];
  public $response = [
    'message' => MSG_SUCCESS,
    'code' => SUCCESS_CODE,
    'data' => [],
    'success' => 1,
    'errors' => [],
];
public function resultArray($message = MSG_SUCCESS, $code = SUCCESS_CODE, $data = [], $success = 0, $errors = [])
{
    $this->response['message'] = $message;
    $this->response['code'] = $code;
    $this->response['data'] = $data;
    $this->response['success'] = $success;
    $this->response['errors'] = $errors;
}
  public function resultJson ($message = MSG_SUCCESS, $code = SUCCESS_CODE, $data = [], $success = 0, $errors = []) {
    $this->resultArray($message, $code, $data, $success, $errors);
    $codeHttp = in_array($this->response['code'], $this->CODE_RETURN_HTTP) ? $this->response['code'] : 400;
    return response()->json($this->response, $codeHttp);
  }
  public function success($data = [],$message = MSG_SUCCESS, $code = SUCCESS_CODE):JsonResponse
  {
    return $this->resultJson($message, $code, $data, 1);
  }



}
?>