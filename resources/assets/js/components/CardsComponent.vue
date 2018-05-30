<template>
  <div>
    <div class="row">
      <div class="col-md-4">
        <div class="card card-default">
          <div class="card-header">Карточки</div>
          <div class="card-body">
            <ul class="list-group list-group-flush">
              <a href="#" class="list-group-item list-group-item-action"
              v-for="(card, index) in cards"
              :class="{ active: (slag == card.name_category) }"
              :key="card.id"
              @click="setCard(card)">
                {{ card.name_category }}
              </a>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-md-7">
        <div class="card card-default">
          <div class="card-header">Слова</div>
          <div class="card-body">
            <ul class="list-group list-group-flush">
              <li class="list-group-item d-flex justify-content-between"
              v-for="(world, index) in worlds" :key="world.id">
                <strong>{{ world.name_original }}</strong> - <em>{{ world.name_translation }}</em>
                <span>
                  <i class="icon ion-md-create mr-4 btn" @click="editWorld(world)"></i>
                  <i class="icon ion-md-trash btn" @click="deleteWorld(world)"></i>
                </span>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  

    export default {

        data(){
            return{
                cards: {},
                worlds: [],
                slag: '',
            }
        },
        created() {
            const t = this;
            axios.get('/getCards') 
                .then(({data}) => {
                    t.cards = data;
                    t.worlds = data[0].cards;
                    t.slag = data[0].name_category;
                });
        },
        methods: {
            setCard(card) {
                const t = this;
                t.worlds = card.cards;
                t.slag = card.name_category;
            },
            editWorld(world){

            },
            deleteWorld(world){
                const t = this;
                let idx = t.worlds.indexOf(world);
                t.worlds.splice(idx, 1);
                axios.post('/deleteWorld', {
                    world: world,
                }).then(({data}) => {
                    t.cards = data;                 
                });
            }
        }        
    };
</script>
