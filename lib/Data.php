<?php

// Данный класс должны наследовать классы, связанные с данными: пользователя, постов, комментариев. 

class Data 
{
    public function validateData() {
        foreach (get_object_vars($this) as $key => $val) {
            if (str_contains($key, 'valid') && !empty($val)) {
                return false;
                // echo "$key => $val <br>";
            }
        }
        return true;
    }

    public function load($mas) {
        foreach ($mas as $key => $val) {
            if (property_exists($this, $key)) {
                $this->$key = $val;
            }    
        }
        return true;
    }
}

