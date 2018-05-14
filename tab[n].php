<?php

   function tree($n)
    {
        $nb = $n;
        $str = "return ";
        while ($n > 0) {
            $str .= "array(" . treeHelper() . " => ";
            $n--;
        }
        $str .= "'end')";

        while ($nb > 1) {
            $str .= ")";
            $nb--;
        }
        $str .= ";";
        return eval($str);
    }


    fuction treeHelper() {

}

    $tab = (tree(20));

   var_dump($tab);
