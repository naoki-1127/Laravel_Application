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
@endsection