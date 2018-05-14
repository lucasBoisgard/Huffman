<?php


    /**
     * @param string $str
     * @return array
     * stock all char on a key of array, recurrences in value and creasing value sorting
     */
    function    check_recurrences(string $str)
    {
        $array_of_recurence = array_count_values(str_split($str));
        asort($array_of_recurence);
        $index_new_array = 0;
        foreach ($array_of_recurence as $key => $value)
        {
            $array_of_recurence[$index_new_array++] = array($key, $value);
            unset($array_of_recurence[$key]);
        }
        return $array_of_recurence;
    }


    /**
    * @param $old_tree
    * @return array
    */
    function   make_tree($old_tree)
    {
        //print_r($old_tree);
        $new_tree = array();
        $i = 0;
        $nb = 0;
        static $node_check = 0;
        while($i < count($old_tree)) {
            /* Add Node */
            if (isset($old_tree[$i+1])) {
                /*
                 * If is leaf check index 1 for get value recurrences
                 * */
                if (!array_key_exists("node", $old_tree[$i])) {
                    $new_tree[$nb] = array("node" => $old_tree[$i][1] + $old_tree[$i + 1][1],
                        "fils 0" => $old_tree[$i], "fils 1" => $old_tree[$i + 1]);
                }
                /*
                 * If is not leaf check index "node" or 1 (sum of both tree leaf)
                 */
                else {
                    if (array_key_exists("node", $old_tree[$i])) {
                        if (array_key_exists("node", $old_tree[$i + 1])) {
                            $new_tree[$nb] = array("node" => $old_tree[$i]["node"] + $old_tree[$i + 1]["node"],
                                "fils 0" => $old_tree[$i], "fils 1" => $old_tree[$i + 1]);
                        } else {
                            $new_tree[$nb] = array("node" => $old_tree[$i]["node"] + $old_tree[$i + 1][1],
                                "fils 0" => $old_tree[$i], "fils 1" => $old_tree[$i + 1]);
                        }
                    } else
                        if (array_key_exists("node", $old_tree[$i + 1])) {
                            $new_tree[$nb] = array("node" => $old_tree[$i][1] + $old_tree[$i + 1]["node"],
                                "fils 0" => $old_tree[$i], "fils 1" => $old_tree[$i + 1]);
                        } else {
                            $new_tree[$nb] = array("node" => $old_tree[$i][1] + $old_tree[$i + 1][1],
                                "fils 0" => $old_tree[$i], "fils 1" => $old_tree[$i + 1]);

                        }
                }
            }
            /*
             *  If is leaf alone : Up dimension
             */
            else
                array_push($new_tree, $old_tree[$i]);
            $old_tree[$i] = null;
            $old_tree[$i + 1] = null;
            $i += 2;
            $nb++;
          /*debug*/ //  print_r($new_tree);
        }
        $node_check++;
        array_filter($old_tree);
        if (count($new_tree) == 1 ) {
            /*return bugué*/
            print_r($new_tree);

        }
        else {
            sort_tree(sort_tree($new_tree));
            make_tree($new_tree);

        }

    }


    function    sort_tree($tree)
    {
        $swap = null;
        foreach ($tree as $key => &$value)
        {
            if(array_key_exists("node", $value)) {
                if (array_key_exists("node", next($value))) {
                    if ($tree[$key]["node"] > next($tree[$key])["node"]) {
                        next($tree[$key]) = $value;
                        $tree[$key] = next($tree[$key]);
                        sort_tree($tree);
                    }
                }
                else {
                    next($tree[$key]) = $value;
                    $tree[$key] = next($tree[$key]);
                    sort_tree($tree);
                }
            }
            else {
                if (array_key_exists("node", next($value))) {
                    if ($tree[$key][1] > next($tree[$key])["node"]) {
                        next($tree[$key]) = $value;
                        $tree[$key] = next($tree[$key]);
                        sort_tree($tree);
                    }
                }
                else {
                    next($tree[$key]) = $value;
                    $tree[$key] = next($tree[$key]);
                    sort_tree($tree);
                }
            }

        }
        return $tree;
    }


    function    main()
    {
        $str_to_compress = check_recurrences("ceycia");
        var_dump(make_tree($str_to_compress));
    }
    main();
        ?>