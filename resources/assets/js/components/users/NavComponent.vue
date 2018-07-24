<template>
  <div>
    <a href="#" class="list-group-item list-group-item-action"
                @click="switchComponents('user-def-component')"
                :class="{ active: (userComponent == 'user-def-component') }">Home</a>

    <a href="#" class="list-group-item list-group-item-action"
                @click="switchComponents('standard-cards-component')"
                :class="{ active: (userComponent == 'standard-cards-component') }">Стандартные карточки</a>

    <a href="#" class="list-group-item list-group-item-action"
                @click="switchComponents('user-cards-component')"
                :class="{ active: (userComponent == 'user-cards-component') }">Мои карточки</a>

    <a href="#" class="list-group-item list-group-item-action"
                @click="switchComponents('lvl-one-cards-component')"
                :class="{ active: (userComponent == 'lvl-one-cards-component') }">Карточки 1 уровня</a>

    <a href="#" class="list-group-item list-group-item-action"
                @click="switchComponents('lvl-two-cards-component')"
                :class="{ active: (userComponent == 'lvl-two-cards-component') }">Карточки 2 уровня</a>

    <a href="#" class="list-group-item list-group-item-action"
                @click="switchComponents('lvl-three-cards-component')"
                :class="{ active: (userComponent == 'lvl-three-cards-component') }">Карточки 3 уровня</a>
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
    },
    methods: {
      switchComponents(component) {
        Bus.usercomponent = component;
      },
    }        
  };
</script>
