<template>
  <div>
    <a href="#" class="list-group-item list-group-item-action"
                @click.prevent="switchComponents('user-def')"
                :class="{ active: (userComponent == 'user-def') }">Home</a>
    <a href="#" class="list-group-item list-group-item-action"
                @click.prevent="switchComponents('standard-cards')"
                :class="{ active: (userComponent == 'standard-cards') }">Стандартные карточки</a>
    <a href="#" class="list-group-item list-group-item-action"
                @click.prevent="switchComponents('user-cards')"
                :class="{ active: (userComponent == 'user-cards') }">Мои карточки</a>
    <a href="#" class="list-group-item list-group-item-action"
                @click.prevent="switchComponents(['lvl-cards', 1])"
                :class="{ active: (userlvl == '1') }">Карточки 1 уровня</a>
    <a href="#" class="list-group-item list-group-item-action"
                @click.prevent="switchComponents(['lvl-cards', 2])"
                :class="{ active: (userlvl == '2') }">Карточки 2 уровня</a>
    <a href="#" class="list-group-item list-group-item-action"
                @click.prevent="switchComponents(['lvl-cards', 3])"
                :class="{ active: (userlvl == '3') }">Карточки 3 уровня</a>
    <a href="#" class="list-group-item list-group-item-action"
                @click.prevent="switchComponents(['lvl-cards', 4])"
                :class="{ active: (userlvl == '4') }">Карточки 4 уровня</a>
    <a href="#" class="list-group-item list-group-item-action"
                @click.prevent="switchComponents(['lvl-cards', 5])"
                :class="{ active: (userlvl == '5') }">Карточки 5 уровня</a>
    <a href="#" class="list-group-item list-group-item-action"
                @click.prevent="switchComponents(['lvl-cards', 6])"
                :class="{ active: (userlvl == '6') }">Карточки 6 уровня</a>
    <a href="#" class="list-group-item list-group-item-action"
                @click.prevent="switchComponents(['lvl-cards', 7])"
                :class="{ active: (userlvl == '7') }">Карточки 7 уровня</a>
  </div>
</template>

<script>

  import Bus from '../Bus.js';

  export default {
    data(){
      return{

      }
    },
    computed: {
      userComponent: function () {
          return Bus.usercomponent;
      },
      userlvl: function () {
          return Bus.lvl;
      },
    },
    methods: {
      switchComponents(component) {
        if ( typeof component == 'object') {
          Bus.lvl = component[1];
          Bus.usercomponent = component[0];
        } else {
          Bus.lvl = 0;
          Bus.usercomponent = component;
        }
      },
    }        
  };
</script>
