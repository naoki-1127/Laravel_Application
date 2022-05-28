<template>
    <div>
        <b-container fluid class="p-2">
            <b-row>
            <b-col cols = '3' v-for= "photo in photos" :key="photo.id">
            <b-img thumbnail fluid :src="'http://localhost:8000/'+photo.path" v-b-modal.modal-scoped @click="openModal(photo)"></b-img>
            </b-col>
            <b-modal id="modal-scoped" title="画像詳細" size="lg">
                <div v-show="!loading">
                <p class="my-4">Hello from modal!</p>
                <p>アップロード日：{{ this.image_upload_date}}</p>
                <p>タイトル： {{ form ? form.title : '' }}</p>
                <b-container fluid>
                    <b-row>
                    <b-col cols = '6'>
                    <b-img thumbnail fluid :src="'http://localhost:8000/'+this.image_path"></b-img>
                    </b-col>
                    <b-col cols = '6'>
                    <b-form-group
                        id="input-group-1"
                        label="Title"
                        label-for="input-1"
                        description="画像のタイトルを入れてね"
                    >
                    <b-form-input
                        id="input-1"
                        v-model="form.title"
                        type="text"
                        placeholder=""
                        required
                        ></b-form-input>
                    </b-form-group>
                    <div>
                        <b-button class="btn btn-outline-secondary heart" @click="favorite_photo">
                            <font-awesome-icon width="19px" height="15px" icon='heart' :class="[ favorite ? 'active' : 'inactive']" class = "fa-lg" />
                        </b-button> 
                    </div>
                    </b-col>
                    </b-row>
                </b-container>
                </div>
                <template #modal-footer>
                    <!-- Emulate built in modal footer ok and cancel button actions -->
                    <b-button size="lg" variant="success" @click="test">
                        Update
                    </b-button>
                    <b-button size="lg" variant="danger" @click="delete_photo">
                        Delete
                    </b-button>
                    <!-- Button with custom close trigger value -->
                    <b-button size="lg" variant="outline-secondary" @click="hide_modal">
                        Close
                    </b-button>
                </template>
            </b-modal>
            </b-row>
        </b-container>
    </div>
</template>
<script>

export default {
    props: ['photos'],
    data() {
        return {
            mainProps: { width: 200, height: 200, class: 'm1' },
            image_path: '',
            image_upload_date: '',
            image_id: '',
            favorite: false,
            delete_image: false,
            loading: true,
            form: {
            title: '',
            },
        }
    },
    methods: {
        openModal (photo){
            this.loading = true
            this.image_path = photo.path
            this.image_upload_date = photo.created_at
            this.image_id = photo.id
            console.log(photo);

            axios.get('api/photo/detail/' + this.image_id)
                .then(response=>{
                    console.log(response.data)
                    if(response.data == true){
                        this.favorite = true
                    }else{
                        this.favorite = false
                    }
                    this.loading = false
                })
                .catch(err => {
                        console.error(err)
                })
        },
        test(){
            const formData = new FormData()
            formData.append('title',this.form.title)
            formData.append('favorite',this.favorite)
            axios.post('api/photo/'+this.image_id,formData)
            .then( response => {
                if( response.status == 200) {
                console.log('成功しました');
                this.form.title = ''
                this.delete_image = false
                this.favorite = false
                }
                this.$bvModal.hide('modal-scoped')
            })
            .catch( error => {
                console.log( error );
            })
        },
        favorite_photo(){
            this.favorite = !this.favorite
        },
        delete_photo(){
            this.delete_image = !this.delete_image
            if(this.delete_image){
                alert('ほんとに削除しますか');
            }
        },
        hide_modal(){
            this.$bvModal.hide('modal-scoped')
        }
    }
}
</script>

<style scoped>
.heart {
    border: none;
    background-color: white;
}
.trashcan {
    border: none;
    background-color: white;
}
.active{
    color: red;
}
.inactive{
    color: #6c757d;
}
</style>