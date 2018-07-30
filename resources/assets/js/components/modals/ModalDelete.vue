<template>
  <div>
  <!-- Modal -->
  <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Удалить?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary px-4" data-dismiss="modal" @click="onDelete(modal)">Да</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Нет</button>
        </div>
      </div>
    </div>
  </div>
  <!-- End modal -->
  </div>
</template>

<script>

  export default {

    props: ['modal'],
    methods: {
      onDelete(modal) {
        this.$emit('delete', modal);
      },
    },
  };
</script>
