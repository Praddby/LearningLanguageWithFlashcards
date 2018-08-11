<template>
  <div>
    <div class="row">
      <a href="#" class="btn btn-primary mb-4 ml-4" data-toggle="modal" data-target="#addCardModal" data-backdrop="static">Добавить картоку</a>
    </div>
    <div class="alert alert-danger" role="alert" v-if="errors" v-for="error in errors">
      {{ error.toString() }}
    </div>
    <modal-delete :modal="modal" @delete="destroyCard"></modal-delete>
    <modal-add-cards :url="'/standard_cards'"
                     @addCardError="addCardError"
                     @addCardGroup="addCardGroup">
    </modal-add-cards>
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
              <li class="list-group-item"
              v-for="(card, index) in cards" :key="card.id">
                <span class="d-flex justify-content-between" v-if="!( isEditing && card.id == isEditing )">
                  <strong>{{ card.name_original }}</strong>
                  <span>-</span>
                  <em>{{ card.name_translation }}</em>
                  <span>
                    <i class="icon ion-md-create btn btn-warning" @click="showFormEditCard(card.id)"></i>
                    <i class="icon ion-md-trash btn btn-danger" data-toggle="modal" @click="modal = card" data-target="#deleteModal"></i>
                  </span>
                </span>
                <form v-show="( isEditing && card.id == isEditing )" method="POST">
                  <div class="input-group input-group-sm">
                    <input type="text" class="form-control mr-4" v-model="card.name_original" >
                    -
                    <input type="text" class="form-control mx-4" v-model="card.name_translation" >
                    <button type="submit" class="btn btn-success mr-4" @click.prevent="setEdite(card)">Ок</button>
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
  
  import ApiStandardCard from '../../api/standard-cards.js';

  export default {

    data(){
      return{
        cardGroup: {},
        cards: [],
        slug: '',
        isEditing: null,
        name_original: '',
        name_translation: '',
        errors: [],
        modal: {}
      }
    },
    created() {
      ApiStandardCard.get()
        .then(data => {
          this.cardGroup = data;
          this.cards = data[0].standard_cards;
          this.slug = data[0].name_category;
        })
        .catch(error => {
          this.errors = error.response.data.errors;
        });
    },
    methods: {
      setCard(card) {
          this.cards = card.standard_cards;
          this.slug = card.name_category;
          this.isEditing = null;
      },
      showFormEditCard(id){
        this.isEditing = id;
      },
      closeFormEditCard(){
        this.isEditing = null;
      },
      setEdite(card){
        let params = {
          card,
          id: card.id
        };
        ApiStandardCard.edite(params)
          .then(data => {
            this.isEditing = null;
            this.errors = [];
          }).catch(error => {
            this.errors = error.response.data.errors;
          });
      },
      addCardGroup: function (data) {
        this.cardGroup.push(data);
        this.errors = [];
      },
      addCardError: function (error) {
        this.errors = error;
      },
      destroyCard: function(card) {
        ApiStandardCard.delete(card.id)
          .then( (data) => {
            let idx = this.cards.indexOf(card);
            this.cards.splice(idx, 1);
          }).catch( (error) => {
            this.errors = [error.response.data.message];
          });
      },
    }        
  };
</script>
