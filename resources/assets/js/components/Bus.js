import Vue from 'vue';

export default new Vue({
  data: {
    component: ''
  },
  
  methods: {
    showComponent(component) {
      this.component = component;
    },
  }
});
