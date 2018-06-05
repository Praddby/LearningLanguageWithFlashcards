<template>
  <div>
    <div class="row">
      <div class="col-md-4">
        <div class="card card-default">
          <div class="card-header">Карточки</div>
          <div class="card-body">
            <ul class="list-group list-group-flush">
              <a href="#" class="list-group-item list-group-item-action"
              v-for="(card, index) in cardGroup"
              :class="{ active: (slug == card.name_category) }"
              :key="card.id"
              @click.prevent="setCard(card)">
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
              v-for="(card, index) in cards" :key="card.id">
                <strong v-show="!isEditing">{{ card.name_original }}</strong> <span v-show="!isEditing">-</span> <em v-show="!isEditing">{{ card.name_translation }}</em>
                <span v-show="!isEditing">
                  <i class="icon ion-md-create mr-4 btn" @click="showFormEditCard"></i>
                  <i class="icon ion-md-trash btn" @click="deleteCard(card)"></i>
                </span>

                <form v-show="isEditing" method="POST">
                  <div class="input-group input-group-sm">
                    <input type="text" class="form-control mr-4" v-model="card.name_original" >
                    -
                    <input type="text" class="form-control mx-4" v-model="card.name_translation" >
                    <button type="submit" class="btn btn-primary mr-4" @click.prevent="setEdite(card)">Ок</button>
                    <button type="submit" class="btn btn-primary" @click.prevent="closeFormEditCard">Отмена</button>
                  </div>
                </form>

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
        cardGroup: {},
        cards: [],
        slug: '',
        isEditing: false,
        name_original: '',
        name_translation: ''
      }
    },
    created() {
      axios.get('/getCards') 
        .then(({data}) => {
          this.cardGroup = data;
          this.cards = data[0].cards;
          this.slug = data[0].name_category;
        });
    },
    methods: {
      setCard(card) {
          this.cards = card.cards;
          this.slug = card.name_category;
      },
      showFormEditCard(){
        this.isEditing = true;
      },
      closeFormEditCard(){
        this.isEditing = false;
      },
      setEdite(card){
        this.isEditing = false;
        axios.post('/editWorld', {
          card: card,
        });
      },
      deleteCard(card){
        let idx = this.cards.indexOf(card);
        axios.post('/deleteWorld', {
          card: card,
        }).then(({data}) => {
          this.cards.splice(idx, 1);
        });
      }
    }        
  };
</script>
