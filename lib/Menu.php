<?php
class Menu 
{
    public $mas;

    public function __construct($mas) {
        $this->mas = $mas;
    }

    // public function nav($pageName) { 
    //     $res .= '<aside id="colorlib-aside" role="complementary" class="js-fullheight"><nav id="colorlib-main-menu" role="navigation"><ul>';
    //         foreach($this->mas as $key => $val) {
    //             if ($key != "Регистрация") {
    //                 $res .= '<li ';
    //                 if ($pageName == $val && $key != "Вход") {
    //                     $res .= 'class="colorlib-active"';
    //                 }
    //                 $res .= ">";
    //             }

    //             if ($pageName == $val) {
    //                     $res .= "<a ";
    //                     if ($key == "Вход" || $key == "Регистрация") {
    //                         $res .= 'class="colorlib-active"';
    //                     }
    //                     $res .= "href=$val>$key</a>";
    //             } else {
    //                 $res .= "<a href=$val>$key</a>";
    //             }

    //             if ($key != "Вход") {
    //                 $res .= "</li>";
    //             } else {
    //                 $res .= " / ";
    //             }
    //         }
    //     $res .= '</ul></nav></aside>';

    //     return $res;
    // }
    
    public function nav($pageName) { 
        $res = '';
        $res .= '<aside id="colorlib-aside" role="complementary" class="js-fullheight"><nav id="colorlib-main-menu" role="navigation"><ul>';
            foreach($this->mas as $key => $val) {
                if (is_array($val)) {
                    $res .= '<li>';
                    // $tmp = ''; непонятно зачем
                    foreach ($val as $key2 => $val2) {
                        $res .= "<a ";
                        if ($pageName == $val2) {
                            $res .= 'class="colorlib-active" ';
                        }
                        $res .= "href=$val2>$key2</a>";

                        if ($key2 != array_key_last($val)) {
                            $res .= ' / ';
                        }

                    }
                    $res .= "</li>";
                    continue;
                }

                $res .= '<li ';
                if ($pageName == $val) {
                    $res .= 'class="colorlib-active"';
                }
                $res .= ">";
                $res .= "<a href=$val>$key</a>";
                $res .= "</li>";
                
            }
        $res .= '</ul></nav></aside>';

        return $res;
    }
}
