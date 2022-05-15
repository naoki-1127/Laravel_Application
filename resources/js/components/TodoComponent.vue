<template>
    <div class="container">
        <header-item :name="name"></header-item>
        <div class ="todoListContainer"> 
            <div class="heading">
                <h2 id="title">Todo List</h2>
                <add-item-form
                    v-on:reloadlist="getList()"
                />
            </div>
            <list-view 
                :items="items" 
                v-on:reloadlist="getList()" 
            />
        </div>
    </div>
</template>

<script>
import addItemForm from "../vue/Todo/additemform.vue"
import listView from "../vue/Todo/listview.vue"
import headerItem from "../components/Util/HeaderComponent.vue"

export default{

    components: {
        addItemForm,
        listView,
        headerItem
    },
    data: function(){
        return{
            items: [],
            name: "TodoList"
        }
    },
    methods: {
        getList(){
            axios.get('api/items')
            .then(response=>{
                this.items =response.data
                console.log(this.item);
            })
            .catch( error=>{
                console.log( error );
            })
        }
    },
    created(){
        this.getList();
    }
}
</script>

<style scoped>
.todoListContainer{
    width: 350px;
    margin: auto;
}
.heading{
    background: #e6e6e6;
    padding: 10px;
}
#title{
    text-align: center;
}
</style>