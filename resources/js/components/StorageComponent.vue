<template>
    <div class="container">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-1 pb-2 mb-3 border-bottom">
            <h1 class="h2">Storage</h1>
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
            <b-button variant="outline-primary" @click="boxapi" >Box連携</b-button>
        </div>
<!--         <p>
        <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
            Link with href
        </a>
        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Button with data-target
        </button>
        </p>
        <div class="collapse" id="collapseExample">
        <div class="card card-body">
            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
        </div>
        </div> -->
        <div class ="card">
            <div class="card-header">Box FOLDER</div>
            <ul v-for="(folder_names,index) in folders" :key="index" class="storage_list">
                <div @click="toggleShowPost(index)" class="cursor">
                    <font-awesome-icon icon='folder' class="folder"/>{{ folder_names.folder_name }}
                </div>
                <div v-if="show[index]">
                    <ul v-for="(folder_name,index) in folder_names.file" :key="index" class="link_color">
                        <li class="link_color" @click="getPreview(folder_name)"><a href="#" class="link_color">{{ folder_name.file_name }}</a></li>
                    </ul>
                </div>
            </ul>
        </div>
    </div>
</template>

<style scoped>
.custom_button{
    color:#6c757d;
    background-color: rgb(143, 49, 49);
}
.custom_button:hover{
    color: white;
    background-color: #6c757d;
}
.link_color{
    color: black;
}
.folder{
    color: gold;
}
.cursor{
    cursor: pointer;
}
.storage_list{
    list-style: none;
}
ul,li{
    margin: 0;
    padding: 0;
    list-style: none;
}
å#accordion_menu > li {
    border: #ccc 1px solid;
    margin-bottom: -1px;
}
#accordion_menu a{
    color: #666;
}
#accordion_menu a[data-toggle="collapse"]{
    display: block;
    padding: 10px;
    text-decoration: none;
  position: relative;
}
#accordion_menu a[data-toggle="collapse"]:hover{
    background: #e7e7e7;
}
#accordion_menu a[data-toggle="collapse"]::after{
    content:"";
    display: block;
    width: 8px;
    height: 8px;
    border-top: #666 1px solid;
    border-right: #666 1px solid;
    position: absolute;
    right: 15px;
    top: 0;
    bottom: 0;
    margin: auto;
}
#accordion_menu a[aria-expanded=false]::after{
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
    transition-duration: 0.3s;
}
#accordion_menu a[aria-expanded=true]::after{
    -webkit-transform: rotate(135deg);
    -ms-transform: rotate(135deg);
    transform: rotate(135deg);
    transition-duration: 0.3s;
}
[id^="menu"] li{
    padding: 10px 10px 10px 20px;
}
</style>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        props: {
            folders: Array,
        },
        data: function() {
            return{
                url_edit_id: 'https://localhost/sample_app/public/box/redirect',
                folder_id: null,
                menu_name: "#menu",
                show: {},
                folder_index: null
            }
        },
        methods: {
            boxapi: function(){
                location.href= this.url_edit_id;
                console.log('test')
            },
            getPreview(folder_name){
                this.file_id = folder_name.file_id
                const formData = new FormData()
                formData.append('file_id',this.file_id)
                axios.post('api/getpreview',formData).then(response =>{
                    console.log(response.data)
                })
                .catch(function(error) {
                    // error 処理
                    console.log(error)
                })
            },
            toggleShowPost(key){
                this.$set(this.show, key, !this.show[key])
                console.log(this.show[key]);
            }
        }
    }
</script>
