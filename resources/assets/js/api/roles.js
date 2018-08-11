export default {

  get(){
    return axios.get('/roles').then(response => response.data);
  },

  add(params){
    let data = {
      role: params.role
    };

    return axios.post('/roles', data).then(response => response.data);
  },

  delete(id) {
    return axios.delete(`roles/${id}`);
  }

}
