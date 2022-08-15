<template>
    <div class="container">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-1 pb-2 mb-3 border-bottom">
            <h1 class="h2">Photo</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="mr-2">
                    <b-button v-b-modal.modal-1 class="btn btn-outline-secondary custom_button" @click="showModal">
                        <font-awesome-icon icon='upload' />
                        Upload
                    </b-button>
                    <b-modal ref="my-modal" hide-footer title="ファイルアップロード" >
                        <div class="d-block text-center">
                            <b-form-file
                            @change="selectedFile"
                            v-model="file1"
                            :state="Boolean(file1)"
                            placeholder="アップロードする画像を選択"
                            browse-text = "参照"
                            drop-placeholder="Drop file here..."
                            ></b-form-file>
                            <div class="mt-3">選択されたファイル： {{ file1 ? file1.name : '' }}</div>
                        </div>
                        <b-button class="mt-3" variant="outline-secondary" block @click="hideModal">Close</b-button>
                        <b-button class="mt-2" variant="outline-success" block @click="upload">Upload</b-button>
                        <b-button class="mt-2" variant="outline-primary" block @click="upload_from_box">Upload from Box</b-button>
                    </b-modal>
                </div>
                <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                    <font-awesome-icon icon='calendar-week' />
                    This week
                </button>
            </div>
        </div>
        <div>
            <li v-for="(box_folder_id,index) in box_folder_ids" :key="index">
                {{ box_folder_id }}
            </li>
            <photolist :photos="photos"></photolist>
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
</style>

<script>
    import headerItem from "../components/Util/HeaderComponent.vue"
    import photolist from "../vue/Photo/photolist.vue"
    export default {
        components: { photolist,headerItem },
        mounted: function() {
            this.get_photo()
            console.log('Component mounted.')
        },
        data: function() {
            return {
                file1: null,
                uploadFile: '',
                message: '',
                type: '',
                errors: '',
                photos: [],
                box_folder_ids: []
            }
        },
        methods: {
            get_photo: function() {
                axios.get('api/photo')
                    .then(responce =>{
                    this.photos = responce.data
                })
                .catch(err => {
                        console.error(err)
                })
            },
            showModal() {
                this.$refs['my-modal'].show()
            },
            hideModal() {
                this.$refs['my-modal'].hide()
            },
            upload: function() {
                // We pass the ID of the button that we want to return focus to
                // when the modal has hidden
                if(this.file1==null){
                    alert('画像が選択されていません');
                }
                const formData = new FormData()
                formData.append('file',this.uploadFile)
                axios
                .post('api/fileupload',formData).then(response =>{
                    console.log(response)
                    this.message　=　'アップロードに成功しました！'
                })
                .catch(function(error) {
                    // error 処理
                    console.log(error)
                    this.message　=　'アップロードに失敗しました！'
                });
                location.reload()
                this.$refs['my-modal'].toggle('#toggle-btn')
                console.log(this.uploadFile);
                console.log(formData);
            },
            upload_from_box: function(){
                axios
                .get('api/uploadfrombox').then(responce　=>{
                    if(responce != '認証されていません'){
                        this.box_folder_ids = responce.data
                    }
                    console.log(this.box_folder_ids)
                })
            },
            selectedFile(event){
                console.log(event)
                this.uploadFile = event.target.files[0],
                this.type = this.uploadFile.type,
                this.errors = ''
                if (this.type != 'image/jpeg' && this.type != 'image/png') {
                    this.errors += '画像だけをあげてちょうだい！！\n'
                }
                if (this.errors) {
                    //errorsが存在する場合は内容をalert
                    alert(this.errors)
                    //valueを空にしてリセットする
                    event.currentTarget.value = ''
                }
            },
        }
    }
</script>
