<template>
    <div class="container">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-1 pb-2 mb-3 border-bottom">
            <h1 class="h2">Dictionary</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group mr-2">
                    <button type="button" class="btn btn-outline-secondary">Share</button>
                    <button type="button" class="btn btn-outline-secondary">Export</button>
                </div>
                <button type="button" class="btn btn-outline-secondary dropdown-toggle">
                    <font-awesome-icon icon='calendar-week' />
                    This week
                </button>
            </div>
        </div>
        <div>
            <div>
                <!-- <list @test="getkey"/> -->
                <list/>
            </div>
            <!-- <div>
                <div v-if="key==='0'">
                    <php-index/>
                </div>
                <div v-if="key==='1'">
                    <go-index/>
                </div>
                <div v-if="key==='2'">
                    <vuejs-index/>
                </div>
                <div v-if="key==='3'">
                    <git-index/>
                </div>
            </div> -->
        </div>
    </div>
</template>

<style scoped>
.custom_button{
    color:#6c757d;
    background-color: white;
}
.custom_button:hover{
    color: white;
    background-color: #6c757d;
}
.drop_area {
        color: gray;
        font-weight: bold;
        font-size: 1.2em;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 500px;
        height: 300px;
        border: 5px solid gray;
        border-radius: 15px;
}
.enter {
    border: 10px dotted powderblue;
}
</style>

<script>
    import list from "../vue/dictionaryindex.vue"
    /* import phpIndex from "../vue/php_index.vue"
    import goIndex from "../vue/go_index.vue"
    import gitIndex from "../vue/git_index.vue"
    import vuejsIndex from "../vue/vuejs.index.vue" */

export default {
    components: {
        list,
    },
    methods:{
        getkey(key){
            this.key = key,
            console.log(this.key)
        }
    },
}

</script>
    