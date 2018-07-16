<template>
  <div class="row">
    <div class="col">
      <input type="text" class="form-control" v-model="cards[index].name_original" placeholder="Слово в оригинале">
    </div>
    <div class="col">
      <input type="text" class="form-control" v-model="cards[index].name_translation" placeholder="Перевод">
    </div>
  </div>
</template>

<script>

  export default {

    props: ['index', 'cards']
    
  };
</script>
