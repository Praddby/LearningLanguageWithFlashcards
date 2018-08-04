<template>
  <div>
  <!-- Modal -->
  <div class="modal fade" id="addCardModal" tabindex="-1" role="dialog" aria-labelledby="addCardModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addCardModalLabel">Добавить карточку!</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="row mb-2">
              <div class="col">
                <input type="text" class="form-control" v-model="name_category" placeholder="Название карточки">
              </div>
            </div>
            
            <input-card :index="index"
                                  :cards="cards"
                                  v-for="(card, index) in cards" :key="card.id">
            </input-card>
             
          </form>
        </div>
        <div class="modal-body">
          <div class="center">
            <button type="button" class="btn btn-success btn-lg btn-block" @click="addInput()">Добавить input's</button>          
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal" @click="add()">Сохранить</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
        </div>
      </div>
    </div>
  </div>
  <!-- End modal -->
  </div>
</template>

<script>

  import Api from '../ApiFunctions.js';

  export default {
    props:['url'],

    data(){
      return{
        name_category: '',
        cards: [
          {name_original: '', name_translation: ''},
        ]
      }
    },
    methods: {
      add() {
        Api.post(this.url, { cards: this.cards, name_category: this.name_category },
          (data) => {
            if ( this.url == "/standard_cards" )
              this.$emit('addCardGroup', data);
            else
              this.$emit('addCardGroup', 'Добавлено успешно!');
          },
          (error) => {
            let errors;
            if ( error.response.status == 500 ) {
              errors = ['Произошла ошибка, повторите попытку чуть позже.'];
            } else {
              errors = error.response.data.errors;
            }
            this.$emit('addCardError', errors);
          }
        );
      },
      addInput() {
        this.cards.push({name_original: '', name_translation: ''});
      },
    },
  };
</script>
