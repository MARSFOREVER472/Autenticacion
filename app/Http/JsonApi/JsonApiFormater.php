<?php
/**
 * Created by IntelliJ IDEA.
 * User: Juziel Indriago
 * Date: 10/1/2015
 * Time: 1:39 PM
 */

namespace App\JsonApi;


/**
 * Class JsonApiFormater
 * @package App\Utils
 *
 * Esta clase permite formatear una respuesta
 *
 */
class JsonApiFormater {

  /**
   * @var the document's "primary data" could be an object or an array of objects
   */
  public $data= array();


  public $errors = array();


  public $message;

  /**
   * JsonApiFormater constructor.
   * @param  $data
   */

  public function __construct($data=[]) {
      try{
          //if((is_array($data))|| (!is_object($data) && (is_array($data->toArray())))){
            $this->data = $data;
          //}else{
          //  $this->data[] = $data;
         // }
      } catch (Exception $ex) {
          $this->data[] = $data;
      }
    
      


  }


  /**
   * Add a error to the array
   * @param \App\JsonApi\Error $error
   * @param null $field
   */
  public function addError(Error $error, $field = NULL) {
    $this->errors[] = $error;

  }

  public function setData($data) {
    $this->data = $data;
  }

  public function addData($data) {
    $this->data = $data;
  }

  public function setMessage($message) {
    $this->message = $message;
  }

  public function asData() {
    unset($this->errors);
    return $this;
  }

  public function asError() {
    unset($this->data);
    return $this;
  }


}