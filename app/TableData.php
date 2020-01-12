<?php


namespace App;


class TableData
{
    protected $columnHeaders = true;

    protected $rowHeaders = false;

    protected $striped = true;

    protected $bordered = false;

    protected $hoverable = false;

    protected $responsive = true;

    protected $tableClasses = [];

    protected $caption = '';

    protected $headers = [];

    protected $rows = [];

    public function __construct($caption = '', $headers = [], $rows = [], $additionalTableClasses = [])
    {
        $this->caption = $caption;
        $this->headers = $headers;
        $this->rows = $rows;

        $this->tableClasses = $additionalTableClasses;
    }

    public function addTableClass($class)
    {
        $this->tableClasses[] = $class;

        return $this;
    }

    public function getTableClasses()
    {
        return $this->tableClasses;
    }

    public function setHeaders($headers)
    {
        $this->headers = $headers;

        return $this;
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function addRow($row)
    {
        $this->rows[] = $row;

        return $this;
    }

    public function getRows()
    {
        return $this->rows;
    }

    public function caption(string $caption = null)
    {
        if (is_null($caption)) {
            return $this->caption;
        }

        $this->caption = $caption;

        return $this;
    }

    public function highlightColumnHeaders(bool $columnHeaders = null)
    {
        if (is_null($columnHeaders)) {
            return $this->columnHeaders;
        }

        $this->columnHeaders = $columnHeaders;

        return $this;
    }

    public function highlightRowHeaders(bool $rowHeaders = null)
    {
        if (is_null($rowHeaders)) {
            return $this->rowHeaders;
        }

        $this->rowHeaders = $rowHeaders;

        return $this;
    }

    public function striped(bool $striped = null)
    {
        if (is_null($striped)) {
            return $this->striped;
        }

        $this->striped = $striped;

        return $this;
    }

    public function bordered(bool $bordered = null)
    {
        if (is_null($bordered)) {
            return $this->bordered;
        }

        $this->bordered = $bordered;

        return $this;
    }

    public function hoverable(bool $hoverable = null)
    {
        if (is_null($hoverable)) {
            return $this->hoverable;
        }

        $this->hoverable = $hoverable;

        return $this;
    }

    public function responsive(bool $responsive = null)
    {
        if (is_null($responsive)) {
            return $this->responsive;
        }

        $this->responsive = $responsive;

        return $this;
    }
}
