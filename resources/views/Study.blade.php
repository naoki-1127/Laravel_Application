@extends('layouts.user')
@section('content')
<h1>
    <?php
    //$objDateTime = new DateTime();
    //echo $objDateTime->format('Y-m-d');
    echo date('Y-m-d l');
    ?>
</h1>
<p>1234</p>
<p>数字のフォーマット：<?php echo number_format(1234) ?>
</p>
<?php

if (file_exists(storage_path('app/public/sample.xml'))) {
    $tree = simplexml_load_file(storage_path('app/public/sample.xml'));
    $parent = $tree;
    foreach ($tree -> Address as $a) {
        echo $a -> Name."\n";
        echo $a -> Street."\n";
        echo $a -> City."</br>";
    }
}

//print_r($tree->Address);
//print_r($parent);
//echo $parent;
?>
</br>
<?php

if (file_exists(storage_path('app/public/sample.json'))) {
    $tree_json = file_get_contents(storage_path('app/public/sample.json'));
    $json = json_decode($tree_json);

    foreach ($json -> menu -> popup -> menuitem as $items) {
        echo "<h1>".$items -> value."\n";
        echo $items -> onclick."</br>"."</h1>";
    }
    echo "</br>";
}

if (file_exists(storage_path('app/public/sample2.xml'))) {
    $tree_xml = simplexml_load_file(storage_path('app/public/sample2.xml'));
    foreach ($tree_xml -> popup -> menuitem as $xml_items) {
        echo($xml_items -> attributes() -> value."\n");
        echo $xml_items -> attributes() -> onclick."</br>";
    };
}


?>
@endsection