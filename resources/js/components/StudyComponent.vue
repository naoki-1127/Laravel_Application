<template>
    <div class="container">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-1 pb-2 mb-3 border-bottom">
            <h1 class="h2">Study</h1>
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
            <div class="drop_area" @dragenter="dragEnter" @dragleave="dragLeave" @dragover.prevent @drop.prevent="dropFile" :class="{enter: isEnter}">
                ファイルアップロード
            </div>
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
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data: function() {
            return{
                isEnter: false,
                files: []
            }
        },
        methods: {
            dragEnter() {
                this.isEnter = true;
                console.log('Enter Drop Area');
            },
            dragLeave() {
            this.isEnter = false;
            },
            dragOver() {
                console.log('DragOver')
            },
            dropFile() {
                console.log(event.dataTransfer.files)
                this.isEnter = false;
                this.files = [...event.dataTransfer.files]
                this.files.forEach(file => {
                    let form = new FormData()
                    form.append('file', file)
                    axios.post('api/uploadtobox', form).then(response => {
                        console.log(response.data)
                    }).catch(error => {
                        console.log(error)
                    })
                })
            }
        }
    }
</script>
