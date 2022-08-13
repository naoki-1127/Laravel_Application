<template>
    <b-container class="dictionary">
        <b-row >
            <b-col class="list" md="2">
                <b-list-group
                v-model="selectedItem"
                >
                <b-list-group-item
                v-for="item in items"
                :key="item.id"
                @click="getkey(item.id)"
                >
                    
                <font-awesome-icon :icon="item.icon"/>
                {{item.text}}

                </b-list-group-item>
                </b-list-group>
            </b-col>

            <b-col>
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
                <div v-if="key==='4'">
                    <js-index/>
                </div>
            </b-col>
            
        </b-row>
    </b-container>
</template>

<script>
    import phpIndex from "./php_index.vue"
    import goIndex from "./go_index.vue"
    import gitIndex from "./git_index.vue"
    import vuejsIndex from  "./vuejs.index.vue"
    import jsIndex from "./javascript_index.vue"

  export default {
      components: {
          phpIndex,
          goIndex,
          gitIndex,
          vuejsIndex,
          jsIndex   
      },
      name: 'list',
      data: function(){
        return{
          selectedItem: this.items,
          items: [
          { id: '0', text: 'PHP', icon:  ['fab', 'php']},
          { id: '1', text: 'Go', icon: ['fab', 'golang'] },
          { id: '2', text: 'Vuejs', icon: ['fab', 'vuejs'] },
          { id: '3', text: 'Git', icon:  ['fab', 'git']},
          { id: '4', text: 'Javascript', icon:  ['fab', 'git']},
          ],
          test:"test",
          key:'0',
        }
    },
    methods:{
        getkey(key){
                this.key = key,
                console.log(this.key)
        }
    }
  }
</script>

<style scoped>
  .list{
    float: left;
    height: 100vh;
    width: 180px;
  }
  .dictionary{
      margin-top: 50PX;
  }
</style>