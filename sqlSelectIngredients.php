<?php
$sql = "SELECT  ri.id FROM ingredients ri
            LEFT JOIN   (";
for($i=0;$i<$amount;$i++) {
    if($i==0) {
        $sql .= "SELECT '$ing[$i]' AS ingredient";
    }
    else if($i==$amount) {
        $sql .= "SELECT  '$ing[$i]'";
    } else {
        $sql .= "
        UNION all
        SELECT  '$ing[$i]'";
    }
}
$sql .= ")             
            search ON ri.ingredient = search.ingredient
            GROUP BY ri.id
            HAVING COUNT(case WHEN search.ingredient IS NULL THEN 1 END) = 0 LIMIT 30";
?>