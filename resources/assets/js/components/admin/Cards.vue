<template>
  <div>
    <div class="row">
      <a href="#" class="btn btn-primary mb-4 ml-4" data-toggle="modal" data-target="#addCardModal" data-backdrop="static">Добавить картоку</a>
    </div>
    <ul class="list-group list-group-flush mb-4" v-if="errors">
      <li class="list-group-item list-group-item-danger" v-for="error in errors">{{ error.toString() }}</li>
    </ul>
    <modal-delete :modal="modal" @delete="destroyCard"></modal-delete>
    <modal-add-cards :url="'/standard_cards'"
                     @emitError="emitError"
                     @emitSuccess="emitSuccess">
    </modal-add-cards>
    <div class="row">
      <div class="col-md-4">
        <div class="card card-default">
          <div class="card-header">Карточки</div>
          <div class="card-body">
            <ul class="list-group list-group-flush">
              <a href="#" class="list-group-item list-group-item-action"
              v-for="(category, index) in categories"
              :class="{ active: (slug == category.name_category) }"
              :key="category.id"
              @click.prevent="setCard(category)">
                {{ category.name_category }}
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
        categories: {},
        cards: [],
        slug: '',
        isEditing: null,
        name_original: '',
        name_translation: '',
        errors: null,
        modal: {}
      }
    },
    created() {
      ApiStandardCard.get()
        .then(data => {
          this.categories = data;
          this.cards = data[0].cards;
          this.slug = data[0].name_category;
        })
        .catch(error => {
          this.errors = error.response.data.errors;
        });
    },
    methods: {
      setCard(card) {
          this.cards = card.cards;
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
            this.errors = null;
          }).catch(error => {
            this.errors = error.response.data.errors;
          });
      },
      emitSuccess: function (data) {
        this.categories.push(data);
        this.errors = null;
      },
      emitError: function (error) {
        this.errors = error;
      },
      destroyCard: function(card) {
        ApiStandardCard.delete(card.id)
          .then( (data) => {
            this.errors = null;
            let idx = this.cards.indexOf(card);
            this.cards.splice(idx, 1);
          }).catch( (error) => {
            this.errors = [error.response.data.message];
          });
      },
    }        
  };
</script>
