<?php

class ExceptionLetter extends Exception 
{
    public $message;

    public function __construct($message)
    {
        parent::__construct($message);
        $this->message = $message;
    }

    public function getMyMessage() 
    {
        return "<div style='color: darkred; 
        font-weight: 600; 
        background-color: #ffbdbd; 
        padding: 5px; 
        margin: 15px 0'>" . $this->message . "</div>";
    }
}

class ExceptionIntegerMinus extends Exception 
{
    public $message;

    public function __construct($message)
    {
        parent::__construct($message);
        $this->message = $message;
    }

    public function getMyMessage() 
    {
        return "<div style='color: #9f5f00; 
        font-weight: 600; 
        background-color: #ff980075; 
        padding: 5px; 
        margin: 15px 0'>" . $this->message . "</div>";
    }
}

class ExceptionInteger extends Exception 
{
    public $message;

    public function __construct($message)
    {
        parent::__construct($message);
        $this->message = $message;
    }

    public function getMyMessage() 
    {
        return "<div style='color: #a80b83; 
        font-weight: 600; 
        background-color: #ed83d575; 
        padding: 5px; 
        margin: 15px 0'>" . $this->message . "</div>";
    }
}

class ExceptionNumOfArgs extends Exception 
{
    public $message;

    public function __construct($message)
    {
        parent::__construct($message);
        $this->message = $message;
    }

    public function getMyMessage() 
    {
        return "<div style='color: #1d6c41; 
        font-weight: 600; 
        background-color: #91f1bc; 
        padding: 5px; 
        margin: 15px 0'>" . $this->message . "</div>";
    }
}

class ExceptionValuesZero extends Exception 
{
    public $message;

    public function __construct($message)
    {
        parent::__construct($message);
        $this->message = $message;
    }

    public function getMyMessage() 
    {
        return "<div style='color: #138491; 
        font-weight: 600; 
        background-color: #9cdce3a6; 
        padding: 5px; 
        margin: 15px 0'>" . $this->message . "</div>";
    }
}

class ExceptionLinear extends Exception 
{
    public $message;

    public function __construct($message)
    {
        parent::__construct($message);
        $this->message = $message;
    }

    public function getMyMessage() 
    {
        return "<div style='color: #6f8755; 
        font-weight: 600; 
        background-color: #c8f993; 
        padding: 5px; 
        margin: 15px 0'>" . $this->message . "</div>";
    }
}
/* 
Реализовать функцию, вычисляющую факториал числа. Вызов функции произвести в блоке try…catch. Обработку ошибок каждого типа производить в своем классе, наследованным от Exception.  
*/

function fact($a) {
    if (is_int($a)) {
        if ($a < 0) {
            throw new ExceptionIntegerMinus('error value is less then 0!');
        } elseif ($a === 0) {
            $res = 1;
        } else {
            $res = $a * fact ($a - 1);
        }
    } else {
        throw new ExceptionInteger('error value is not integer!');
    }
    return $res;
}
    
try {
    echo fact(5) . "<br>";
    // echo fact(-5) . "<br>";
    // echo fact("5") . "<br>";
    echo fact(4) . "<br>";

} catch (ExceptionIntegerMinus | ExceptionInteger $e) {
    echo $e->getMyMessage() . "Line of exception: " . $e->getLine() . "<br>";
}

/* 
2) Реализовать класс, находящий корни квадратного уравнения. Вызов методов экземпляра класса произвести в блоке try…catch. Обработку ошибок каждого типа производить в своем классе, наследованным от Exception. 
*/

class Square 
{
    public $a;
    public $b;
    public $c;

    public function sqrt($mas) {
        $this->a = $mas[0];
        $this->b = $mas[1];
        $this->c = $mas[2];
    
            if (count($mas) > 3) {
                throw new ExceptionNumOfArgs('Слишком много аргументов!');
            } else if (count($mas) < 3) {
                throw new ExceptionNumOfArgs('Не хватает аргументов!');
            }

            if ($this->checkZero()){
                throw new ExceptionValuesZero('Введены все 0!');
            } else if ($this->check()) {
                if ($this->a != 0) {
                    if($this->b == 0 && $this->c == 0) {
                        $res = "0";
                    } else if ($this->b == 0 && $this->a / $this->c < 0) {
                        $x1 = (-$this->c / $this->a) ** 0.5;
                        $x2 = -((-$this->c / $this->a) ** 0.5);
                        $res = "$x1; $x2";
                    } else if ($this->b == 0 && $this->a / $this->c > 0) {
                        $res = "корней нет";
                    } else if ($this->c == 0) {
                        $x1 = 0;
                        $x2 = -($this->b / $this->a);
                        $res = "$x1; $x2";
                    } else if ($this->b != 0 && $this->c != 0) {
                        $D = $this->b ** 2 - 4 * $this->a * $this->c;
                        if ($D > 0) {
                            $x1 = (-$this->b + $D ** 0.5) / (2 * $this->a);
                            $x2 = (-$this->b - $D ** 0.5) / (2 * $this->a);
                            $res = "$x1; $x2";
                        } else if ($D == 0) {
                            $x = (-$this->b + $D ** 0.5) / (2 * $this->a);
                            $res = "$x";
                        } else {
                            $res = 'корней нет';
                        }
                    }
                } else if ($this->b == 0 && $this->c != 0) {
                    $res = "корней нет";
                } else {
                    // x = -($this->c / $this->b)
                    // $res = `${x}`
                    throw new ExceptionLinear('Введено не квадратное уравнение, а линейное!');
                }
                return "Ответ: $res";
            } else {
                throw new ExceptionLetter('В параметрах не все числа!');
            }
    }

    public function check() {
        return is_numeric($this->a) && is_numeric($this->b) && is_numeric($this->c);
    }
    
    public function checkZero() {
        return $this->a == 0 && $this->b == 0 && $this->c == 0;
    }
}

$sqrt = new Square();

try {
    echo $sqrt->sqrt([1, 0, 'a',]);
} catch (ExceptionLetter | ExceptionNumOfArgs | ExceptionValuesZero | ExceptionLinear $e) {
    echo $e->getMyMessage() . "Line of exception: " . $e->getLine() . "<br>";
}


