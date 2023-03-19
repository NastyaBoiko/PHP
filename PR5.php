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

class ExceptionMinus extends Exception 
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

function fact($a) {
    try {
        if (is_int($a)) {
            if ($a < 0) {
                throw new ExceptionMinus('error value is less then 0!');
            } elseif ($a === 0) {
                $res = 1;
            } else {
                $res = $a * fact ($a - 1);
            }
        } else {
            throw new ExceptionLetter('error value is not numeric!');
        }
        return $res;
    } catch (ExceptionLetter | ExceptionMinus $e) {
        echo $e->getMyMessage() . "Line of exception: " . $e->getLine() . "<br>";
    }
}

echo fact("5") . "<br>";
echo fact(0) . "<br>";
echo fact(5) . "<br>";
echo fact(-5) . "<br>";




    function valIsTrue($a) {
        
        if (!is_numeric($a)) {
            $obj = new Exception('error value is not numeric!');
            throw $obj;
        }
        
        if ($a == 0) {
            throw new MyException('error y = 0!');
        }

        if ($a < 5) {
            throw new MyException2('error value is less 5!');
        }
    }


    function xDivY($x, $y) {
        try {
            valIsTrue($y);
            return $x / $y;
        } catch(MyException2 | MyException | Exception $e) {
            // var_dump($e instanceof Exception); die;

            // var_dump($e instanceof MyException2);
            // var_dump($e instanceof MyException);

            if ($e instanceof MyException) 
                echo $e->getMyMessage();
            else 
                echo $e->getMessage();
            
            throw $e;
        } /* catch(MyException $e) {
            // var_dump($e instanceof Exception); die;
            echo $e->getMyMessage();
            throw $e;
        }  */ /* catch(Exception $e) {
            // var_dump($e instanceof Exception); die;
            echo $e->getMessage();
            throw $e;
        } */
    }

    // var_dump(xDivY(0, 3));
    // var_dump(xDivY(2, 0));
    // var_dump(xDivY(3, 3));
    // var_dump(xDivY(4, 3));

try {
    $a = 1 / (xDivY(1, 7) + 3) + xDivY(3, 12);
    // echo "end - ok";
} catch(Exception $e) {
    // var_dump($e->getMessage());
    // var_dump($e->getLine());
    // var_dump($e->getFile());
}




