<template>
  <div>
    <a href="#" class="list-group-item list-group-item-action"
                @click="switchComponents('cards-component')"
                :class="{ active: (component == 'cards-component') }">Карточки</a>

    <a href="#" class="list-group-item list-group-item-action"
                @click="switchComponents('users-component')"
                :class="{ active: (component == 'users-component') }">Пользователи</a>

    <a href="#" class="list-group-item list-group-item-action"
                @click="switchComponents('')"
                :class="{ active: (false) }">Другое ...</a>
  </div>
</template>

<script>

  import Bus from './Bus.js';

  export default {
    data(){
      return{

      }
    },
    computed: {
      component: function () {
          return Bus.component;
      },
    },
    methods: {
      switchComponents(component) {
        Bus.component = component;
      },
    }        
  };
</script>
