<template>
  <div>
  	<modal-add-cards-component :url="'/user_cards'"
                               @addCardError="function(error){errors = error}"
                               @addCardGroup="function(data){success = true}">
    </modal-add-cards-component>
    <div class="alert alert-danger" role="alert" v-if="errors" v-for="error in errors">
      {{ error.toString() }}
    </div>
    <div class="alert alert-success" role="alert" v-if="success">
      <span>Карточка создана успешна</span>
    </div>
    <div class="card border-primary mb-3" style="max-width: 18rem;">
      <div class="card-header">Создание карточек</div>
      <div class="card-body text-primary">
        <p class="card-text">Для комфортного изучения слов по определенной тематике создайте собственные карточеки.</p>
      </div>
      <div class="card-footer bg-transparent border-primary btn-group-vertical">
      	<a href="" class="btn btn-primary" data-toggle="modal" data-target="#addCardModal" data-backdrop="static">Создать</a>
      </div>
    </div>
  </div>
</template>

<script>

  export default {
    data(){
      return{
        success: false,
        errors: null,
      }
    },
       
  };
</script>
