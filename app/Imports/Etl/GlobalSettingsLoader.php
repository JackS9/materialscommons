<?php

// Loads a global settings worksheet that contains attributes to apply to different processes. Format
// of file is:
// Col 1 | Col 2 | Col 3
// Process | Attribute | Value
// For example:
// Heat Treatment | P:Time(s) | 300
//
// The above would mean that every Heat Treatment process has Time attribute with units 's' and value 300.

namespace App\Imports\Etl;

use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Worksheet\Row;
use PhpOffice\PhpSpreadsheet\Worksheet\RowCellIterator;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class GlobalSettingsLoader
{
    /** @var array */
    public $worksheets;

    private const WORKSHEET_NAME_CELL = 0;
    private const ATTRIBUTE_HEADER_CELL = 1;
    private const ATTRIBUTE_VALUE_CELL = 2;

    public function __construct()
    {
        $this->worksheets = [];
    }

    public function loadGlobalWorksheet(Worksheet $worksheet)
    {
        foreach ($worksheet->getRowIterator() as $row) {
            $this->loadRow($row);
        }
    }

    public function getGlobalSettingsForWorksheet($worksheetName)
    {
        if (array_key_exists($worksheetName, $this->worksheets)) {
            return $this->worksheets[$worksheetName];
        }

        return [];
    }

    private function loadRow(Row $row)
    {
        $cellIterator = $row->getCellIterator();
        if (!$this->hasCells($cellIterator)) {
            return;
        }

        $this->loadGlobalSettingForWorksheet($cellIterator);
    }

    private function hasCells(RowCellIterator $cellIterator)
    {
        try {
            $cellIterator->setIterateOnlyExistingCells(true);
            return true;
        } catch (Exception $e) {
            // No cells in worksheet
            return false;
        }
    }

    private function loadGlobalSettingForWorksheet(RowCellIterator $cellIterator)
    {
        $cellIndex = 0;
        $worksheet = '';
        $globalSetting = new GlobalSetting();
        foreach ($cellIterator as $cell) {
            if ($cellIndex > self::ATTRIBUTE_VALUE_CELL) {
                break;
            }

            $value = $cell->getValue();

            if (is_null($value)) {
                return;
            }

            switch ($cellIndex) {
                case self::WORKSHEET_NAME_CELL:
                    // Worksheet name
                    if (!array_key_exists($value, $this->worksheets)) {
                        $this->worksheets[$value] = [];
                    }
                    $worksheet = $value;
                    break;

                case self::ATTRIBUTE_HEADER_CELL:
                    // Attribute type, name and optional unit
                    $globalSetting->attributeHeader = AttributeHeader::parse($value);
                    break;

                case self::ATTRIBUTE_VALUE_CELL:
                    // Attribute value
                    $globalSetting->value = $cell->getFormattedValue();
                    break;
            }
            $cellIndex++;
        }

        if (blank($worksheet)) {
            return;
        }

        // If we are here then we have successfully loaded a global setting.
        array_push($this->worksheets[$worksheet], $globalSetting);
    }
}