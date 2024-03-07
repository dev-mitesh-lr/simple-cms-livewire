<?php

function renderOptions($tree, $indent = 0,$selectedvalue) {
    $options = '';
    foreach ($tree as $node) {
        $select = "";
        if($selectedvalue == $node['id'])
        {
            $select ="selected";
        }
        
        $title = str_repeat('-', $indent * 4) . $node['title'];
        $options .= '<option  value="'.$node['id'].'"  '. $select .' >' . $title . '</option>';
        if (!empty($node['children'])) {
            $options .= renderOptions($node['children'], $indent + 1,$selectedvalue);
        }
    }
    return $options;
}
