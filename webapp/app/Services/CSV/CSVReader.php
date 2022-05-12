<?php
namespace App\Services\CSV;

class CsvReader
{
    protected $file;
    private $separator = ',';
 
    public function __construct($filePath, $separator) {
        $this->file = fopen($filePath, 'r');
        $this->separator = $separator;
    }
 
    public function rows()
    {
        while (!feof($this->file)) {
            $row = fgetcsv($this->file, 4096, $this->separator);

            if (empty($row)) {
                continue;
            }
            
            yield $row;
        }
        
        return;
    }
}