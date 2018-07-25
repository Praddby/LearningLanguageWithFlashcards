<template>
  <div>
  <!-- Modal -->
  <div class="modal fade" id="editingCardsModal"
                          aria-labelledby="editingCardsModalLabel"
                          tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editingCardsModalLabel">Модуль редактирование</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="row mb-2">
              <div class="col">
                <select class="custom-select" id="inputGroupSelect03"
                        v-model="selectCard" placeholder="Выберите карточку для редактирования">>
                  <option :value="card" v-for="(card, index) in cardGroup" :key="card.id">{{ card.name_category }}</option>
                </select>
              </div>
            </div>
            
            <input-card-component :index="index"
                                  :cards="cards"
                                  v-for="(card, index) in cards" :key="card.id">
            </input-card-component>
             
          </form>
        </div>
        <div class="modal-body">
          <div class="center">
            <button type="button" class="btn btn-success btn-lg btn-block" @click="addInput()">Добавить input's</button>          
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal" @click="editer()">Сохранить</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
        </div>
      </div>
    </div>
  </div>
  <!-- End modal -->
  </div>
</template>

<script>

  export default {

    data(){
      return{
        cardGroup: {},
        cards: {},
        selectCard: '',
      }
    },
    created() {
      axios.get('/user_cards') 
        .then(({data}) => {
          this.cardGroup = data;
        });
    },
    watch: {
      selectCard: function () {
        this.getCards(this.selectCard);
      }
    },
    methods: {
      getCards(card){
        this.cards = card.user_cards;
      },
      editer() {
        axios.put('/user_cards/' + this.selectCard.id,
          { cards: this.cards, name_category: this.selectCard.name_category })
          .then(({data}) => {
            console.log(data);
            this.$emit('addCardError', null);
            this.$emit('addCardGroup', true);
          }).catch( (error) => {
            this.$emit('addCardError', error.response.data.errors);
          });
      },
      addInput() {
        this.cards.push({name_original: '', name_translation: ''});
      },
    },
  };
</script>
