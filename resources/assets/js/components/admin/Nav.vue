<template>
  <div>
    <a href="#" class="list-group-item list-group-item-action"
                @click.prevent="switchComponents('admin-cards')"
                :class="{ active: (component == 'admin-cards') }">Карточки</a>

    <a href="#" class="list-group-item list-group-item-action"
                @click.prevent="switchComponents('users')"
                :class="{ active: (component == 'users') }">Пользователи</a>

    <a href="#" class="list-group-item list-group-item-action"
                @click.prevent="switchComponents('roles')"
                :class="{ active: (component == 'roles') }">Роли</a>
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
