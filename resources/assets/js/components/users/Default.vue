<template>
  <div>
    <modal-add-cards :url="'/user_cards'"
                     @addCardError="addCardErrors"
                     @addCardGroup="addCardSuccess">
    </modal-add-cards>
    <modal-editing-card @addCardError="addCardErrors"
                        @addCardGroup="addCardSuccess">
    </modal-editing-card>
    <div class="alert alert-danger" role="alert" v-if="errors" v-for="error in errors">
      {{ error.toString() }}
    </div>
    <div class="alert alert-success" role="alert" v-if="success">
      <span>{{ success }}</span>
    </div>
    <div class="row">
      <div class="card border-primary mb-3 mr-3" style="max-width: 18rem;">
        <div class="card-header">Создание карточек</div>
        <div class="card-body text-primary">
          <p class="card-text">
            Для комфортного изучения слов по определенной тематике создайте собственные карточеки.
          </p>
        </div>
        <div class="card-footer bg-transparent border-primary btn-group-vertical">
          <a href="" class="btn btn-primary"
                     data-toggle="modal"
                     data-target="#addCardModal"
                     data-backdrop="static">Создать</a>
        </div>
      </div>
      <div class="card border-primary mb-3" style="max-width: 18rem;">
        <div class="card-header">Редактирование карточек</div>
        <div class="card-body text-primary">
          <p class="card-text">
            В этом разделе вы можете редактировать или удалять свои карточки.
          </p>
        </div>
        <div class="card-footer bg-transparent border-primary btn-group-vertical">
          <a href="" class="btn btn-primary"
                     data-toggle="modal"
                     data-target="#editingCardsModal"
                     data-backdrop="static">Редактировать</a>
        </div>
      </div>
    </div>
    
  </div>
</template>

<script>

  export default {
    data(){
      return{
        success: null,
        errors: [],
      }
    },
    methods: {
      addCardSuccess: function (success){
        this.success = success;
        this.errors = null;
      },
      addCardErrors: function(errors) {
        this.errors = errors;
      },
    },
       
  };
</script>
