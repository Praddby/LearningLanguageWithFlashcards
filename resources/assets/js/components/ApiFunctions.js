import Vue from 'vue';

export default new Vue({
  
  methods: {
    get(uri, Data = null, Error = null) {
      axios.get(uri) 
        .then(({data}) => {
          Data(data);
        }).catch( (error) => {
          Error(error);
        });
    },
    show(uri, Data = null, Error = null) {
      axios.get(uri)
        .then(({data}) => {
          Data(data);
        }).catch( (error) => {
          Error(error);
        });
    },
    post(uri, objData, Data = null, Error = null) {
      axios.post(uri, objData)
        .then( ({data}) => {
          Data(data);
        }).catch( (error) => {
          Error(error);
        });
    },
    put(uri, objData, Data = null, Error = null){
      axios.put(uri, objData)
        .then(({data}) => {
          Data(data);
        }).catch( (error) => {
          Error(error);
        });
    },
    delete(uri, Data = null, Error = null) {
      axios.delete(uri)
        .then(({data}) => {
          Data(data);
        }).catch( (error) => {
          Error(error);
        });
    },
  },

});
