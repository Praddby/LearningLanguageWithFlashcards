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
                @click.prevent="switchComponents('lvl-one-cards')"
                :class="{ active: (userComponent == 'lvl-one-cards') }">Карточки 1 уровня</a>

    <a href="#" class="list-group-item list-group-item-action"
                @click.prevent="switchComponents('lvl-two-cards')"
                :class="{ active: (userComponent == 'lvl-two-cards') }">Карточки 2 уровня</a>

    <a href="#" class="list-group-item list-group-item-action"
                @click.prevent="switchComponents('lvl-three-cards')"
                :class="{ active: (userComponent == 'lvl-three-cards') }">Карточки 3 уровня</a>
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
