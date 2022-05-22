<template>
<div>
    <h1>git</h1>
    <div>
        <li>基本的なコマンド
            <b-row cols="5">
                <b-col v-b-modal.modal-lg>git init</b-col>
                <b-modal id="modal-lg" size="lg" title="git init">
                    <div class="ex">
                        リポジトリを新規作成する、または既存のリポジトリを初期化する
                    </div>
                    <div class="text-h2 pa-12 code">
                        <p>git init</p>
                    </div>
                </b-modal>

                <b-col v-b-modal.modal-lg3>git status</b-col>
                <b-modal id="modal-lg3" size="lg" title="git status">
                    <div class="ex">
                        ワークツリーにあるファイルの状態を表示する
                    </div>
                    <div class="text-h2 pa-12 code">
                        <p>git status</p>
                    </div>
                    
                </b-modal>

                <b-col v-b-modal.modal-lg2>git add</b-col>
                <b-modal id="modal-lg2" size="lg" title="git add">
                    <div class="ex">
                        ファイルをインデックスに追加する（コミットの対象にする）
                    </div>
                    <div class="text-h2 pa-12 code">
                        <p>git add [ファイル名]</p>
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