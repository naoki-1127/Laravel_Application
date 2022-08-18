<template>
    <div class="container">
        <header-item :name="name"></header-item>
        <b-button squared variant="success" v-b-modal.my-modal>検索語句一覧</b-button>
        <b-button squared variant="success" @click="getnews">記事取得</b-button>
        
        <b-modal id="my-modal">
            <template #modal-title>
                検索語句
            </template>
            <div class="add-search-index">
                
                <div class ="addItem">

                <input type="text" v-model="item.name" />
                <font-awesome-icon 
                    icon='plus-circle'
                    @click="addItem()"
                    :class="[ item.name && this.index_words_count < 5 ? 'active' : 'inactive','plus']"
                />
                <div v-show="this.index_words_count>=5" class="notice">
                    登録できる単語は5つまでです
                </div>
                </div>
                
            </div>
            
            <b-list-group>
                <b-list-group-item v-for="index_word in index_words" :key="index_word.id" class="item">{{index_word.index_word}}
                    <button @click="removeItem(index_word.pid)" class="trashcan" >
                        <font-awesome-icon icon='trash' />
                    </button> 
                </b-list-group-item>
            </b-list-group>
        </b-modal>

        <ul class="nav nav-tabs">
            <li v-for="index_word in index_words" :key="index_word.id" class="nav-item">
                <a @click="isSelect(index_word)" class="nav-link" :class="{ active : isActive==index_word.id}">{{index_word.index_word}}</a>
            </li>
            <li class="nav-item">
                <a @click="isSelect2(index_words_count)" class="nav-link" :class="{ active : isActive==index_words_count}">ストック記事</a>
            </li>
        </ul>

        <div v-show="loading" class="loading">
            <vue-loading type="spiningDubbles" color="#3490dc" :size="{ width: '50px', height: '50px' }"></vue-loading>    
        </div>

        <div class="news_list" v-show="!loading">
            <li v-for="data in news" :key="data.id">
                <a :href="data.url" target="_blank">{{ data.title }}</a>
            </li>
        </div>

        <div class="news_list" v-show="!loading && this.news==''">
            <p>予期せぬエラー</p>
        </div>

    </div>
</template>

<script>
    import headerItem from "../components/Util/HeaderComponent.vue"
    export default {
        components: {
            headerItem
        },
        props: ['users','index_words'],
        data: function() {
            return{
                name: "News",
                news: [],
                selected_index_word: "Laravel9",
                index_words_count: 0,
                loading: true,
                isActive: 0,
                item:{
                    name: ""
                }
            }
        },
        mounted() {
            this.index_words_count = this.index_words.length
            this.getnews()
        },
        methods: {
            getnews: function(){
                axios.get('api/news',{
                    params: {
                        index_word: this.selected_index_word,
                    }
                })
                .then(responce=>(
                    this.news = responce.data,
                    console.log(this.news),
                    this.loading = false
                ))
                .catch((error)=> {
                    console.log(error),
                    this.loading = false
                })
            },
            getstocknews: function(){
                axios.get('api/news/stock')
                .then(responce=>(
                    this.news = responce.data,
                    console.log(this.news),
                    this.loading = false
                ))
                .catch((error)=> {
                    console.log(error),
                    this.loading = false
                })
            },
            isSelect: function (data) {
                this.loading = true,
                console.log(data.id+data.index_word),
                this.isActive = data.id,
                this.selected_index_word = data.index_word,
                this.getnews();
            },
            isSelect2: function (num) {
                this.loading = true,
                console.log(num),
                this.isActive = num,
                this.getstocknews();
            },
            addItem: function (){
                if( this.item.name == '' ){
                    return;
                }else if(this.index_words_count >= 5){
                    return;
                }
                axios.post('api/news/store',{
                    item: this.item,
                })
                .then( response => {
                    if(response.status == 201){
                        this.item.name = '';
                    }
                })
                .catch( error => {
                    console.log( error );
                })
                location.reload()
            },
            removeItem(num) {
                console.log(num);
                axios.delete('api/news/' + num)
                .then( response => {
                    if( response.status == 200) {
                    this.$emit('itemchanged');
                    location.reload
                    }
                })
                .catch( error => {
                    console.log( error );
                })
            }
        }
    }
</script>
<style scoped>
.add-search-index{
    padding: 5px;
}
a{
    color: black;
}
li{
    padding: 5px;
}
.news_list{
    margin-top: 10px;
}
.loading{
    padding-bottom: 40px;
}
.plus{
    font-size: 20px;
}
.active{
    color: #00ce25;
}
.inactive{
    color: #999999;
}
.notice{
    color: red;
    font-size: 12px;
    padding-top: 3px;
}
.trashcan {
    background-color: white;
    float: right;
    border: none;
    color: #f00;
    outline: none;
}
</style>