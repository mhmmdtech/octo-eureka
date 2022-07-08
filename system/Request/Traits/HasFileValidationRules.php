<?php

namespace System\Request\Traits;


trait HasFileValidationRules
{
    protected function fileValidation($name, $ruleArray)
    {
        foreach ($ruleArray as $rule) {
            if ($rule == "required") {
                $this->fileRequired($name);
            } elseif (strpos($rule, "mimes:") === 0) {
                $rule = str_replace('mimes:', "", $rule);
                $rule = explode(',', $rule);
                $this->fileType($name, $rule);
            } elseif (strpos($rule, "format:") === 0) {
                $rule = str_replace('format:', "", $rule);
                $rule = explode(',', $rule);
                $this->formatType($name, $rule);
            } elseif (strpos($rule, "max:") === 0) {
                $rule = str_replace('max:', "", $rule);
                $this->maxFile($name, $rule);
            } elseif (strpos($rule, "min:") === 0) {
                $rule = str_replace('min:', "", $rule);
                $this->minFile($name, $rule);
            }
        }
    }


    protected function fileRequired($name)
    {
        if (!isset($this->files[$name]['name']) || empty($this->files[$name]['name']) && $this->checkFirstError($name)) {
            $this->setError($name, "$name is required");
        }
    }

    protected function fileType($name, $typesArray)
    {
        if ($this->checkFirstError($name) && $this->checkFileExist($name)) {
            $currentFileType = explode('/', $this->files[$name]['type'])[1];
            if (!in_array($currentFileType, $typesArray)) {
                $this->setError($name, "$name type must be " . implode(', ', $typesArray));
            }
        }
    }
    protected function formatType($name, $typesArray)
    {
        if ($this->checkFirstError($name) && $this->checkFileExist($name)) {
            $currentFileType = pathinfo($this->files[$name]['name'], PATHINFO_EXTENSION);
            if (!in_array($currentFileType, $typesArray)) {
                $this->setError($name, "$name type must be " . implode(', ', $typesArray));
            }
        }
    }

    protected function maxFile($name, $size)
    {
        // https://stackoverflow.com/questions/14380205/phpmyadmin-max-upload-size-will-not-change-wrong-php-ini-file
        // https://itechzo.com/how-to-change-php-upload-limit-in-xampp/
        $size = $size * 1024;
        if ($this->checkFirstError($name) && $this->checkFileExist($name)) {
            if (!is_array($this->files[$name]['name'])) {
                if ($this->files[$name]['size'] > $size) {
                    $this->setError($name, "$name size must be lower than " . ($size / 1024) . " kb");
                }
            } else {
                $files = $this->files[$name];
                $files = reArrayFiles($files);
                foreach ($files as $file) {
                    if ($file['size']  > $size) {
                        $this->setError($name, "each $name size must be lower than " . ($size / 1024) . " kb");
                    }
                }
            }
        }
    }

    protected function minFile($name, $size)
    {
        $size = $size * 1024;
        if ($this->checkFirstError($name) && $this->checkFileExist($name)) {
            if (!is_array($this->files[$name]['name'])) {
                if ($this->files[$name]['size'] < $size) {
                    $this->setError($name, "$name size must be upper than " . ($size / 1024) . " kb");
                }
            } else {
                $files = $this->files[$name];
                $files = reArrayFiles($files);
                foreach ($files as $file) {
                    if ($file['size']  < $size) {
                        $this->setError($name, "each $name size must be upper than " . ($size / 1024) . " kb");
                    }
                }
            }
        }
    }
}
