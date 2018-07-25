<template>
  <div>
    <div class="row">
      <div class="col-4">
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
      <div class="col-5 offset-sm-1">
        <div  class="myCard d-flex"
              style="width: 24rem; height: 22rem;"
              v-for="(card, index) in cards"
              :key="card.id"
              v-if="index == userIndex">
          <div class="card-body front"
               @click="font = !font"
               :class="{ frontHover: (font == true) }">
            <p class="card-text">{{ card.name_original }}</p>
          </div>
          <div class="card-body back"
               @click="font = !font"
               :class="{ backHover: (font == true) }">
            <p class="card-text">{{ card.name_translation }}</p>
          </div>
          <div class="footer align-self-end d-flex justify-content-around">
            <button type="button"
                    class="btn btn-dark"
                    :class="{ disabled: (index == 0) }"
                    @click="prev()"> < </button>
            <button type="button"
                    class="btn btn-success"
                    :class="{ disabled: !(card.is_level_zero === 0) }"
                    @click="addCardInLvlOne(card)">Добавить в ур. 1</button>
            <button type="button"
                    class="btn btn-dark"
                    :class="{ disabled: (index == (cards.length - 1) ) }"
                    @click="next()"> > </button>
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
        userIndex: 0,
        font: false,
      }
    },
    created() {
      axios.get('/user_cards') 
        .then(({data}) => {
          this.cardGroup = data;
          this.cards = data[0].user_cards;
          this.slug = data[0].name_category;
        }).catch( (error) => {
          this.errors =  error.response.data.errors;
        });
    },
    methods: {
      setCard(card) {
          this.cards = card.user_cards;
          this.slug = card.name_category;
      },
      addCardInLvlOne(card){

      },
      next(){
        if ( this.cards.length - 1 > this.userIndex ) {
          this.userIndex++;
          this.font = false;
        }
      },
      prev(){
        if ( this.userIndex ) {
          this.userIndex--;
          this.font = false;
        }
      }
    }        
  };
</script>

<style scoped>
.myCard {
  position: relative;
  perspective: 1000px;
}
.front, .back {
  position: absolute;
  width: 100%;
  height: 100%;
  left: 0;
  top: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  transition: 1s;
  backface-visibility: hidden;
  border-radius: 3px;
  border: 1px solid #B0B0B0;
  background-color: #fff;
}
.back {
  transform: rotateY(180deg);
}
.frontHover {transform: rotateY(180deg);}
.backHover {transform: rotateY(360deg);}
.footer{
  z-index: 5;
  padding: 0.75rem 1.25rem;
  width: 100%;
}
</style>
