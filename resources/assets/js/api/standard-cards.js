export default {

  get() {
    return axios.get('/standard_cards').then(response => response.data);
  },

  edite(params){
    let data = {
      card: params.card
    };

    return axios.put(`/standard_cards/${params.id}`, data);
  },

  add(params) {
    let data = {
      cards: params.cards,
      name_category: params.name_category
    };
    let t = params.t;

    return axios.post('/standard_cards', data)
      .then( (response) => {
        t.$emit('emitSuccess', response.data);
      })
      .catch( (error) => {
        let errors;
        if ( error.response.status == 500 ) {
          errors = ['Произошла ошибка, повторите попытку чуть позже.'];
        } else if (error.response.status == 422) {
          errors = error.response.data.errors;
        } else {
          errors = error.response.statusText;
        }
        t.$emit('emitError', errors);
      });
  },

  delete(id){
    return axios.delete(`standard_cards/${id}`);
  }

}
