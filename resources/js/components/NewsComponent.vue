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
                <font-awesome-icon icon='plus-circle'/>
            </div>
            
            <b-list-group>
                <b-list-group-item>PHP</b-list-group-item>
                <b-list-group-item>Dapibus ac facilisis in</b-list-group-item>
                <b-list-group-item>Morbi leo risus</b-list-group-item>
                <b-list-group-item>Porta ac consectetur ac</b-list-group-item>
                <b-list-group-item>Vestibulum at eros</b-list-group-item>
            </b-list-group>
        </b-modal>
        <div class="news_list">
            <li v-for="data in news" :key="data.id">
                <a :href="data.url" target="_blank">{{ data.title }}</a>
            </li>
        </div>
        
    </div>
</template>

<script>
    import headerItem from "../components/Util/HeaderComponent.vue"
    export default {
        components: {
            headerItem
        },
        props: ['users'],
        mounted() {
            console.log('Component mounted.')
        },
        data: function() {
            return{
                name: "News",
                news: []
            }
        },
        methods: {
            getnews: function(){
                console.log('getnews')
                axios.get('api/news')
                .then(responce=>(
                    this.news = responce.data,
                    console.log(this.news)
                ))
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
    margin-top: 50px;
}
</style>