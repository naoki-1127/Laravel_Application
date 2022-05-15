<template>
    <div class="container">
        <header-item :name="name"></header-item>
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
    import list from "../vue/Dictionary/dictionaryindex.vue"
    import headerItem from "../components/Util/HeaderComponent.vue"

export default {
    components: {
        list,
        headerItem
    },
    methods:{
        getkey(key){
            this.key = key,
            console.log(this.key)
        }
    },
    data: function(){
        return{
            name:"Dictionary"
        }
    }
}

</script>
    