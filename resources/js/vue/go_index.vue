<template>
    <div>
        <h1>go</h1>
        <v-container class="list-item">
            <div class="func">
                <li>Strings関数
                    <v-row no-gutters>
                        <v-dialog transition="dialog-top-transition" max-width="700">
                            <template v-slot:activator="{ on, attrs }">
                                <v-col cols="2" align="center" v-bind="attrs" v-on="on">
                                    <v-card outlined tile>Split</v-card>
                                </v-col>
                            </template>
                            <template v-slot:default="dialog">
                                <v-card>
                                    <v-toolbar color="primary" dark>Strings.Split</v-toolbar>
                                    <v-card-text>
                                        <div class="ex">
                                            func Split(s, sep string) []string
                                            <br>
                                            Split は s を sep で区切り， sep 間の部分文字列のスライスを返します。
                                            sep が s 中に存在せず， sep が空でないなら， Split は s のみからなる長さ 1 のスライスを返します。
                                        </div>
                                        <div class="text-h2 pa-12 code">
                                            <p>fmt.Printf("%q\n", strings.Split("a,b,c", ","))</p>
                                            <p>fmt.Printf("%q\n", strings.Split("a man a plan a canal panama", "a "))</p>
                                            <p>fmt.Printf("%q\n", strings.Split(" xyz ", ""))</p>
                                        </div>
                                        <div class="text-h2 pa-12 stdout">
                                            <p>出力結果</p>
                                            <p>["a" "b" "c"]</p>
                                            <p>["" "man " "plan " "canal panama"]</p>
                                            <p>[" " "x" "y" "z" " "]</p>
                                        </div>
                                    </v-card-text>
                                    <v-card-actions class="justify-end">
                                        <v-btn text @click="dialog.value = false">Close</v-btn>
                                    </v-card-actions>
                                </v-card>
                            </template>
                        </v-dialog>

                        
                    </v-row>
                </li>
            </div>
            <div class="func">
                <li>Strconv関数
                    <v-row no-gutters>
                        <v-dialog transition="dialog-top-transition" max-width="700">
                            <template v-slot:activator="{ on, attrs }">
                                <v-col cols="2" align="center" v-bind="attrs" v-on="on">
                                    <v-card outlined tile>Atoi</v-card>
                                </v-col>
                            </template>
                            <template v-slot:default="dialog">
                                <v-card>
                                    <v-toolbar color="primary" dark>Strconv.Atoi</v-toolbar>
                                    <v-card-text>
                                        <div class="ex">
                                            func Atoi(s string) (int, error)
                                            <br>
                                            Atoi は ParseInt(s, 10, 0) の返り値をint型に変換した関数です。
                                        </div>
                                        <div class="text-h2 pa-12 code">
                                            <p>v := "10"</p>
                                            <p>if s, err := strconv.Atoi(v); err == nil {</p>
                                            <p>fmt.Printf("%T, %v", s, s)</p>
                                            <p>}</p>
                                        </div>
                                        <div class="text-h2 pa-12 stdout">
                                            <p>出力結果</p>
                                            <p>int, 10</p>
                                        </div>
                                    </v-card-text>
                                    <v-card-actions class="justify-end">
                                        <v-btn text @click="dialog.value = false">Close</v-btn>
                                    </v-card-actions>
                                </v-card>
                            </template>
                        </v-dialog>

                        <v-dialog transition="dialog-top-transition" max-width="700">
                            <template v-slot:activator="{ on, attrs }">
                                <v-col cols="2" align="center" v-bind="attrs" v-on="on">
                                    <v-card outlined tile>Itoa</v-card>
                                </v-col>
                            </template>
                            <template v-slot:default="dialog">
                                <v-card>
                                    <v-toolbar color="primary" dark>Strconv.Itoa</v-toolbar>
                                    <v-card-text>
                                        <div class="ex">
                                            func Itoa(i int) string
                                            <br>
                                            Itoa は FormatInt(int64(i), 10) と同じです。
                                        </div>
                                        <div class="text-h2 pa-12 code">
                                            <p>i := 10</p>
                                            <p>s := strconv.Itoa(i)</p>
                                            <p>fmt.Printf("%T, %v\n", s, s)</p>
                                        </div>
                                        <div class="text-h2 pa-12 stdout">
                                            <p>出力結果</p>
                                            <p>string, 10</p>
                                        </div>
                                    </v-card-text>  
                                    <v-card-actions class="justify-end">
                                        <v-btn text @click="dialog.value = false">Close</v-btn>
                                    </v-card-actions>
                                </v-card>
                            </template>
                        </v-dialog>

                        
                    </v-row>
                </li>
            </div>
            <div class="func">
                <li>Math関数
                    <v-row no-gutters>
                        <v-dialog transition="dialog-top-transition" max-width="700">
                            <template v-slot:activator="{ on, attrs }">
                                <v-col cols="2" align="center" v-bind="attrs" v-on="on">
                                    <v-card outlined tile>Split</v-card>
                                </v-col>
                            </template>
                            <template v-slot:default="dialog">
                                <v-card>
                                    <v-toolbar color="primary" dark>Strings.Split</v-toolbar>
                                    <v-card-text>
                                        <div class="ex">
                                            func Split(s, sep string) []string
                                            <br>
                                            Split は s を sep で区切り， sep 間の部分文字列のスライスを返します。
                                            sep が s 中に存在せず， sep が空でないなら， Split は s のみからなる長さ 1 のスライスを返します。
                                        </div>
                                        <div class="text-h2 pa-12 code">
                                            <p>fmt.Printf("%q\n", strings.Split("a,b,c", ","))</p>
                                            <p>fmt.Printf("%q\n", strings.Split("a man a plan a canal panama", "a "))</p>
                                            <p>fmt.Printf("%q\n", strings.Split(" xyz ", ""))</p>
                                        </div>
                                        <div class="text-h2 pa-12 stdout">
                                            <p>出力結果</p>
                                            <p>["a" "b" "c"]</p>
                                            <p>["" "man " "plan " "canal panama"]</p>
                                            <p>[" " "x" "y" "z" " "]</p>
                                        </div>
                                    </v-card-text>
                                    <v-card-actions class="justify-end">
                                        <v-btn text @click="dialog.value = false">Close</v-btn>
                                    </v-card-actions>
                                </v-card>
                            </template>
                        </v-dialog>

                        <v-dialog transition="dialog-top-transition" max-width="700">
                            <template v-slot:activator="{ on, attrs }">
                                <v-col cols="2" align="center" v-bind="attrs" v-on="on">
                                    <v-card outlined tile>array_search</v-card>
                                </v-col>
                            </template>
                            <template v-slot:default="dialog">
                                <v-card>
                                    <v-toolbar
                                    color="primary"
                                    dark
                                    >array_search</v-toolbar>
                                    <v-card-text>
                                        <div class="ex">
                                            (PHP 4 >= 4.0.5, PHP 5, PHP 7, PHP 8)
                                            array_search — 指定した値を配列で検索し、見つかった場合に対応する最初のキーを返す
                                        </div>
                                        <div class="text-h2 pa-12 code">
                                            <p>$array = array(0 => 'blue', 1 => 'red', 2 => 'green', 3 => 'red');</p>
                                            <p>$key = array_search('green', $array); // $key = 2;</p>
                                            <p>$key = array_search('red', $array);   // $key = 1;</p>
                                        </div>
                                    </v-card-text>  
                                    <v-card-actions class="justify-end">
                                    <v-btn
                                        text
                                        @click="dialog.value = false"
                                    >Close</v-btn>
                                    </v-card-actions>
                                </v-card>
                            </template>
                        </v-dialog>

                        <v-dialog transition="dialog-top-transition" max-width="700">
                            <template v-slot:activator="{ on, attrs }">
                                <v-col cols="2" align="center" v-bind="attrs" v-on="on">
                                    <v-card outlined tile>array_shift</v-card>
                                </v-col>
                            </template>
                            <template v-slot:default="dialog">
                                <v-card>
                                    <v-toolbar color="primary" dark>array_shift</v-toolbar>
                                    <v-card-text>
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
                                    </v-card-text>  
                                    <v-card-actions class="justify-end">
                                        <v-btn text @click="dialog.value = false">Close</v-btn>
                                    </v-card-actions>
                                </v-card>
                            </template>
                        </v-dialog>
                
                        <v-dialog transition="dialog-top-transition" max-width="700">
                            <template v-slot:activator="{ on, attrs }">
                                <v-col cols="2" align="center" v-bind="attrs" v-on="on">
                                    <v-card outlined tile>array_unshift</v-card>
                                </v-col>
                            </template>
                            <template v-slot:default="dialog">
                                <v-card>
                                    <v-toolbar color="primary" dark>array_unshift</v-toolbar>
                                    <v-card-text>
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
                                    </v-card-text>  
                                    <v-card-actions class="justify-end">
                                        <v-btn text @click="dialog.value = false">Close</v-btn>
                                    </v-card-actions>
                                </v-card>
                            </template>
                        </v-dialog>

                        <v-col cols="2" align="center">
                            <v-card outlined tile>セル1-5</v-card>
                        </v-col>
                        <v-col cols="2" align="center">
                            <v-card outlined tile>セル1-6</v-card>
                        </v-col>
                    </v-row>
                </li>
            </div>

            <div class="func">
                <li>httpパッケージ
                    <v-row no-gutters>
                        <v-dialog transition="dialog-top-transition" max-width="700">
                            <template v-slot:activator="{ on, attrs }">
                                <v-col cols="2" align="center" v-bind="attrs" v-on="on">
                                    <v-card outlined tile>net/http</v-card>
                                </v-col>
                            </template>
                            <template v-slot:default="dialog">
                                <v-card>
                                    <v-toolbar color="primary" dark>net/http</v-toolbar>
                                    <v-card-text>
                                        <div class="ex">
                                            http パッケージは，HTTP クライアントとサーバを実装します。
                                            Get，Head，Post，PostForm は HTTP (または HTTPS) リクエストを行います。
                                        </div>
                                        <div class="text-h2 pa-12 code">
                                            <p>resp, err := http.Get("http://example.com/")</p>
                                            <p>resp, err := http.Post("http://example.com/upload", "image/jpeg", &buf)</p>
                                            <p>resp, err := http.PostForm("http://example.com/form",</p>
                                            <p>         url.Values{"key": {"Value"}, "id": {"123"}})</p>
                                        </div>
                                        <div class="ex">
                                            終わったら，クライアントはレスポンスボディを閉じる必要があります。
                                        </div>
                                        <div class="text-h2 pa-12 stdout">
                                            <p>resp, err := http.Get("http://example.com/")</p>
                                            <p>if err != nil {</p>
                                            <p>     // handle error</p>
                                            <p>}</p>
                                            <p>defer resp.Body.Close()</p>
                                            <p>body, err := ioutil.ReadAll(resp.Body)</p>

                                        </div>
                                    </v-card-text>
                                    <v-card-actions class="justify-end">
                                        <v-btn text @click="dialog.value = false">Close</v-btn>
                                    </v-card-actions>
                                </v-card>
                            </template>
                        </v-dialog>
                    </v-row>
                </li>
            </div>
        </v-container>
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
    font-size: 18px;
    color: white;
}
.func{
    margin-bottom: 20px;
}
</style>