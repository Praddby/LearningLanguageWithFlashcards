export default {

  get() {
    return axios.get('/user_cards').then(response => response.data);
  },

  edite(params){
    let data = {
      cards: params.cards,
      name_category: params.name_category
    };
    let t = params.t;

    return axios.put(`/user_cards/${params.id}`, data)
      .then( response => t.$emit('emitSuccess', 'Редактирование выполнено успешно') )
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

  add(params) {
    let data = {
      cards: params.cards,
      name_category: params.name_category
    };
    let t = params.t;

    return axios.post('/user_cards', data)
      .then( (data) => {
        t.$emit('emitSuccess', 'Добавлено успешно!');
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
  }

}
