<template>
    <div class="container">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-1 pb-2 mb-3 border-bottom">
        <h1 class="h2">TodoList</h1>
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
import addItemForm from "./additemform"
import listView from "./listview"

export default{

    components: {
        addItemForm,
        listView
    },
    data: function(){
        return{
            items: []
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