<template>
  <div>
    <div class="row text-center font-italic h4 mb-5">
      {{ message }}
    </div>
    <div class="row d-flex justify-content-center">
      <div  class="myCard d-flex"
            style="width: 24rem; height: 22rem;"
            v-for="(card, index) in cards"
            :key="card.id"
            v-if="(index == userIndex)">
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
                  class="btn"
                  v-if="lvl > 1"
                  :class="[ disabled ? 'btn-secondary disabled' : 'btn-success' ]"
                  @click="lvlOne(card)">Вернуть на ур. 1 </button>
          <button type="button"
                  class="btn"
                  v-if="!(lvl == 7)"
                  :class="[ disabled ? 'btn-secondary disabled' : 'btn-success' ]"
                  @click="lvlUp(card)">Перенести на ур. {{ lvl + 1 }} </button>
          <button type="button"
                  class="btn"
                  v-if="lvl == 7 || lvl == 1"
                  :class="[ disabled ? 'btn-secondary disabled' : 'btn-success' ]"
                  @click="next()"> > </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

  import LvlCard from '../../api/lvl-card.js';
  import Msg from '../../inc/message-for-lvl.js';
  import Notification from '../../api/lvl-notification.js';

  export default {

    props:['lvl'],

    data(){
      return{
        cards: [],
        userIndex: 0,
        font: false,
        disabled: false,
        message: null
      }
    },
    created() {
      this.getCards();
    },
    watch: {
      lvl: function() {
        this.getCards();
      }
    },
    methods: {
      getCards(){
        this.message = Msg.get(this.lvl);
        LvlCard.getCardsLvl(this.lvl)
          .then(data => {
            this.cards = data;
            this.userIndex = 0;
            this.disabled = false;
            this.font = false;
          });
      },
      lvlUp(card){
        let params = {
          lvl: this.lvl + 1,
          id: card.id
        };
        let idx = this.cards.indexOf(card);
        if ( (this.cards.length - 1 > this.userIndex ) && !this.disabled ) {
          LvlCard.setCardLvl(params)
          .then(data => {
            this.cards.splice(idx, 1);
            this.font = false;
          });
        } else if ( (this.cards.length - 1 == this.userIndex) && !this.disabled ) {
          Notification.setLastRepeat(this.lvl);
          LvlCard.setCardLvl(params).then(data => {
            this.cards.splice(idx, 1);
            this.userIndex--;
            this.disabled = true;
          });
        }
      },
      lvlOne(card){
        let params = {
          lvl: 1,
          id: card.id
        };
        let idx = this.cards.indexOf(card);
        if ( (this.cards.length - 1 > this.userIndex) && !this.disabled ) {
          LvlCard.setCardLvl(params)
          .then(data => {
            this.cards.splice(idx, 1);
            this.font = false;
          });
        } else if ( (this.cards.length - 1 == this.userIndex) && !this.disabled ) {
          Notification.setLastRepeat(this.lvl);
          LvlCard.setCardLvl(params).then(data => {
            this.cards.splice(idx, 1);
            this.userIndex--;
            this.disabled = true;
          });
        }
      },
      next(){
        if ( this.cards.length - 1 > this.userIndex ) {
          this.userIndex++;
          this.font = false;
        } else if ( (this.cards.length - 1 == this.userIndex) && !this.disabled ) {
          Notification.setLastRepeat(this.lvl);
          this.disabled = true;
        }
      },
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
