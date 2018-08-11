export default {

  get(){
    return axios.get('/user_roles').then(response => response.data);
  },

  show(id){
    return axios.get(`user_roles/${id}`).then(response => response.data);
  },
  
  changeRole(params){
    let data = {
      roleId: params.roleId
    };
    return axios.put(`user_roles/${params.userId}`, data).then(response => response.data);
  },

  deleteRole(id){
    return axios.delete(`user_roles/${id}`);
  }

}
