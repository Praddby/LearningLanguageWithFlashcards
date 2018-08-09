export default {
  
  // Users Cards
  getUserCards() {
    return axios.get('/user_cards').then(response => response.data);
  },

  editeUserCards(params){
    let data = {
      cards: params.cards,
      name_category: params.name_category
    };
    let t = params.t;

    return axios.put(`/user_cards/${params.id}`, data)
      .then( response => t.$emit('addCardGroup', 'Редактирование выполнено успешно') )
      .catch( (error) => {
        if ( error.response.status == 500 ) {
          let errors = ['Произошла ошибка, повторите попытку чуть позже.'];
        } else if (error.response.status == 422) {
          let errors = error.response.data.errors;
        } else {
          let errors = error.response.statusText;
        }
        t.$emit('addCardError', errors);
      });
  },

  addUserCards(params) {
    let data = {
      cards: params.cards,
      name_category: params.name_category
    };
    let t = params.t;

    return axios.post('/user_cards', data)
      .then( (data) => {
        t.$emit('addCardGroup', 'Добавлено успешно!');
      })
      .catch( (error) => {
        if ( error.response.status == 500 ) {
          let errors = ['Произошла ошибка, повторите попытку чуть позже.'];
        } else if (error.response.status == 422) {
          let errors = error.response.data.errors;
        } else {
          let errors = error.response.statusText;
        }
        t.$emit('addCardError', errors);
      });
  },
  
  //Standard Cards
  getStandardCards() {
    return axios.get('/standard_cards').then(response => response.data);
  },

  editeStandardCards(params){
    let data = {
      card: params.card
    };

    return axios.put(`/standard_cards/${params.id}`, data);
  },

  addStandardCards(params) {
    let data = {
      cards: params.cards,
      name_category: params.name_category
    };
    let t = params.t;

    return axios.post('/standard_cards', data)
      .then( (response) => {
        t.$emit('addCardGroup', response.data);
      })
      .catch( (error) => {
        if ( error.response.status == 500 ) {
          let errors = ['Произошла ошибка, повторите попытку чуть позже.'];
        } else if (error.response.status == 422) {
          let errors = error.response.data.errors;
        } else {
          let errors = error.response.statusText;
        }
        t.$emit('addCardError', errors);
      });
  },

  deleteStandardCard(id){
    return axios.delete(`standard_cards/${id}`);
  },
  
  //Role
  getRole(){
    return axios.get('/roles').then(response => response.data);
  },

  addRole(params){
    let data = {
      role: params.role
    };

    return axios.post('/roles', data).then(response => response.data);
  },

  deleteRole(id) {
    return axios.delete(`roles/${id}`);
  },


  // Pagination
  nextPageUrl(params) {
    return axios.get(params.path.next_page_url).then(response => response.data);
  },
  prevPageUrl(params) {
    return axios.get(params.path.prev_page_url).then(response => response.data);
  },
  PageUrl(params) {
    return axios.get(params.path + '?page=' + params.pageNo).then(response => response.data);
  },


  // Users
  getUsers(){
    return axios.get('/user_roles').then(response => response.data);
  },

  showUser(id){
    return axios.get(`user_roles/${id}`).then(response => response.data);
  },
  
  changeRole(params){
    let data = {
      roleId: params.roleId
    };
    return axios.put(`user_roles/${params.userId}`, data).then(response => response.data);
  },

  deleteUserRole(id){
    return axios.delete(`user_roles/${id}`);
  },
}
