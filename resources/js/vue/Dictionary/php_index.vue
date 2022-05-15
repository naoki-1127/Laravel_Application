<template>
        <div>
            <h1>php</h1>
            <div class="array_func">
                <li>配列関数
                    <b-row cols="5">
                        <b-col v-b-modal.modal-lg>array_push</b-col>
                        <b-modal id="modal-lg" size="lg" title="array_push">
                            <div class="ex">
                                (PHP 4, PHP 5, PHP 7, PHP 8)
                                array_push — 一つ以上の要素を配列の最後に追加する
                            </div>
                            <div class="text-h2 pa-12 code">
                                <p>$stack = array("orange", "banana");</p>
                                <p>array_push($stack, "apple", "raspberry");</p>
                                <p>print_r($stack);</p>
                            </div>
                            <div class="text-h2 pa-12 stdout">
                                <p>出力結果</p>
                                <p>Array</p>
                                <p>(</p>
                                <p>[0] => orange</p>
                                <p>[1] => banana</p>
                                <p>[2] => apple</p>
                                <p>[3] => raspberry</p>
                                <p>)</p>
                            </div>
                        </b-modal>

                        <b-col v-b-modal.modal-lg2>array_search</b-col>
                        <b-modal id="modal-lg2" size="lg" title="array_search">
                            <div class="ex">
                                (PHP 4 >= 4.0.5, PHP 5, PHP 7, PHP 8)
                                array_search — 指定した値を配列で検索し、見つかった場合に対応する最初のキーを返す
                            </div>
                            <div class="text-h2 pa-12 code">
                                <p>$array = array(0 => 'blue', 1 => 'red', 2 => 'green', 3 => 'red');</p>
                                <p>$key = array_search('green', $array); // $key = 2;</p>
                                <p>$key = array_search('red', $array);   // $key = 1;</p>
                            </div>
                        </b-modal>
                        <b-col v-b-modal.modal-lg3>array_shift</b-col>
                        <b-modal id="modal-lg3" size="lg" title="array_shift">
                            <div class="ex">
                                (PHP 4, PHP 5, PHP 7, PHP 8)
                                array_shift — 配列の先頭から要素を一つ取り出す
                            </div>
                            <div class="text-h2 pa-12 code">
                                <p>$stack = array("orange", "banana", "apple", "raspberry");</p>
                                <p>$fruit = array_shift($stack);</p>
                                <p>print_r($stack);</p>
                            </div>
                            <div class="text-h2 pa-12 stdout">
                                <p>出力結果</p>
                                <p>Array</p>
                                <p>(</p>
                                <p>[0] => banana</p>
                                <p>[1] => apple</p>
                                <p>[2] => raspberry</p>
                                <p>)</p>
                            </div>
                        </b-modal>

                        <b-col v-b-modal.modal-lg4>array_unshift</b-col>
                        <b-modal id="modal-lg4" size="lg" title="array_unshift">
                            <div class="ex">
                                (PHP 4, PHP 5, PHP 7, PHP 8)
                                array_unshift — 一つ以上の要素を配列の最初に加える
                            </div>
                            <div class="text-h2 pa-12 code">
                                <p>$queue = array("orange", "banana");</p>
                                <p>array_unshift($queue, "apple", "raspberry");</p>
                                <p>print_r($queue);</p>
                            </div>
                            <div class="text-h2 pa-12 stdout">
                                <p>出力結果</p>
                                <p>Array</p>
                                <p>(</p>
                                    <p>[0] => apple</p>
                                    <p>[1] => raspberry</p>
                                    <p>[2] => orange</p>
                                    <p>[3] => banana</p>
                                <p>)</p>
                            </div>
                        </b-modal>

                        <b-col v-b-modal.modal-lg5>array_flip</b-col>
                        <b-modal id="modal-lg5" size="lg" title="array_flip">
                            <div class="ex">
                                (PHP 4 >= 4.0.5, PHP 5, PHP 7, PHP 8)
                                array_flip — 配列のキーと値を反転する
                            </div>
                            <div class="text-h2 pa-12 code">
                                <p>$input = array("oranges", "apples", "pears");</p>
                                <p>$flipped = array_flip($input);</p>
                                <p>print_r($flipped);</p>
                            </div>
                            <div class="text-h2 pa-12 stdout">
                                <p>出力結果</p>
                                <p>Array</p>
                                <p>(</p>
                                    <p>[oranges] => 0</p>
                                    <p>[apples] => 1</p>
                                    <p>[pears] => 2</p>
                                <p>)</p>
                            </div>
                            <div class="ex">
                                コンフリクトがあった場合
                            </div>
                            <div class="text-h2 pa-12 code">
                                <p>$input = array("a" => 1, "b" => 1, "c" => 2);</p>
                                <p>$flipped = array_flip($input);</p>
                                <p>print_r($flipped);</p>
                            </div>
                            <div class="text-h2 pa-12 stdout">
                                <p>出力結果</p>
                                <p>Array</p>
                                <p>(</p>
                                    <p>[1] => b</p>
                                    <p>[2] => c</p>
                                <p>)</p>
                            </div>
                        </b-modal>

                        <b-col v-b-modal.modal-lg4>array_unshift</b-col>
                        <b-modal id="modal-lg4" size="lg" title="array_unshift">
                            <div class="ex">
                                (PHP 4, PHP 5, PHP 7, PHP 8)
                                array_unshift — 一つ以上の要素を配列の最初に加える
                            </div>
                            <div class="text-h2 pa-12 code">
                                <p>$queue = array("orange", "banana");</p>
                                <p>array_unshift($queue, "apple", "raspberry");</p>
                                <p>print_r($queue);</p>
                            </div>
                            <div class="text-h2 pa-12 stdout">
                                <p>出力結果</p>
                                <p>Array</p>
                                <p>(</p>
                                    <p>[0] => apple</p>
                                    <p>[1] => raspberry</p>
                                    <p>[2] => orange</p>
                                    <p>[3] => banana</p>
                                <p>)</p>
                            </div>
                        </b-modal>


                    </b-row>
                </li>
            </div>

            <div class="string_func">
                <li>文字列関数
                    <b-row cols="5">
                        <b-col v-b-modal.modal-lg-string>implode</b-col>
                        <b-modal id="modal-lg-string" size="lg" title="implode">
                            <div class="ex">
                                (PHP 4, PHP 5, PHP 7, PHP 8)
                                implode — 配列要素を文字列により連結する
                            </div>
                            <div class="text-h2 pa-12 code">
                                <p>$array = [ "a" , "b" ];</p>
                                <p>$str = implode( $array );</p>
                                <p>echo $str;  // ab</p>
                            </div>
                        </b-modal>

                        <b-col v-b-modal.modal-lg-string2>explode</b-col>
                        <b-modal id="modal-lg-string2" size="lg" title="explode">
                            <div class="ex">
                                (PHP 4, PHP 5, PHP 7, PHP 8)
                                explode — 文字列を文字列により分割する
                            </div>
                            <div class="text-h2 pa-12 code">
                                <p>$pizza  = "piece1 piece2 piece3 piece4 piece5 piece6";</p>
                                <p>$pieces = explode(" ", $pizza);</p>
                                <p>echo $pieces[0]; // piece1</p>
                                <p>echo $pieces[1]; // piece2</p>
                            </div>
                        </b-modal>

                        <b-col v-b-modal.modal-lg-string3>number_format</b-col>
                        <b-modal id="modal-lg-string3" size="lg" title="number_format">
                            <div class="ex">
                                (PHP 4, PHP 5, PHP 7, PHP 8)
                                number_format — 数字を千の位毎にグループ化してフォーマットする
                            </div>
                            <div class="text-h2 pa-12 code">
                                <p>$number = 1234.56;</p>
                                <p>// 英語での表記 (デフォルト)</p>
                                <p>$english_format_number = number_format($number);</p>
                                <p>// 1,235</p>
                            </div>
                        </b-modal>

                    </b-row>
                </li>
            </div>

            <div>
                <li>数学関数
                    <b-row cols="5">

                        <b-col v-b-modal.modal-lg-math>floor</b-col>
                        <b-modal id="modal-lg-math" size="lg" title="floor">
                            <div class="ex">
                                (PHP 4, PHP 5, PHP 7, PHP 8)
                                floor — 端数の切り捨て
                            </div>
                            <div class="text-h2 pa-12 code">
                                <p>echo floor(4.3);   // 4</p>
                                <p>echo floor(9.999); // 9</p>
                                <p>floor(-3.14); // -4</p>
                            </div>
                        </b-modal>

                        <b-col v-b-modal.modal-lg-math2>abs</b-col>
                        <b-modal id="modal-lg-math2" size="lg" title="abs">
                            <div class="ex">
                                (PHP 4, PHP 5, PHP 7, PHP 8)
                                abs — 絶対値
                            </div>
                            <div class="text-h2 pa-12 code">
                                <p>echo abs(-4.2); // 4.2 (double/float)</p>
                                <p>echo abs(5);    // 5 (integer)</p>
                                <p>echo abs(-5);    // 5 (integer)</p>
                            </div>
                        </b-modal>
                    </b-row>
                </li>
            </div>
        </div>
    
</template>

<style scoped>
.code{
    background-color: #292d3e;
    border-radius: 30px;
    margin-top: 20px;
    line-height: normal;
}
.ex{
    margin-top: 20px;
}
.stdout{
    margin-top: 20px;
    background-color: #292d3e;
    line-height: normal;
    border-radius: 30px;
}
p{
    color: white;
    padding: 10px;
    margin-left: 20px;
}
.array_func,.string_func{
    margin-bottom: 20px;
}
</style>