<?php

namespace App\Http\Response;

use JsonSerializable;

class AjaxResponse implements JsonSerializable
{
    /**
     * @var boolean
     */
    private $success;

    /**
     * @var array
     */
    private $errors = [];

    /**
     * @var array
     */
    private $data = [];

    public function jsonSerialize()
    {
        return [
            'success' => $this->success,
            'errors'  => $this->errors,
            'data'    => $this->data,
        ];
    }

    /**
     * AjaxResponse constructor.
     *
     * @param bool $success
     * @param array $errors
     * @param array $data
     */
    public function __construct($success = false, $errors = [], $data = [])
    {
        $this->success = $success;
        $this->errors  = $errors;
        $this->data    = $data;
    }

    /* -------------------------------------------------------------------------------- */

    /**
     * @param null $success
     * @return AjaxResponse|bool
     */
    public function success($success = null)
    {
        if ($success) {
            return $this->setSuccess($success);
        }

        return $this->getSuccess();
    }

    /**
     * @param null $errors
     * @return AjaxResponse|array
     */
    public function errors($errors = null)
    {
        if ($errors) {
            return $this->setErrors($errors);
        }

        return $this->getErrors();
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return $this
     */
    public function set($key, $value)
    {
        $this->data[$key] = $value;

        return $this;
    }

    /* -------------------------------------------------------------------------------- */

    /**
     * @param boolean $success
     * @return $this
     */
    public function setSuccess($success)
    {
        $this->success = (boolean) $success;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getSuccess()
    {
        return $this->success;
    }

    /**
     * @param string $error
     * @return $this
     */
    public function addError($error)
    {
        $this->errors[] = $error;

        return $this;
    }

    /**
     * @param array $errors
     * @return $this
     */
    public function setErrors($errors)
    {
        $this->errors = $errors;

        return $this;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param array $data
     * @return $this
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }
}
